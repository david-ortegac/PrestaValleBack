<?php
namespace App\Http\Controllers;

use App\Http\Requests\StoreLoansRequest;
use App\Http\Requests\UpdateLoansRequest;
use App\Models\Loan;
use App\Models\SpreadSheet;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Response;

class LoansController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $loans = Loan::paginate();

        foreach ($loans as $loan) {
            $loan->route       = $loan->route;
            $loan->client      = $loan->client;
            $loan->created_by  = $loan->createdBy;
            $loan->modified_by = $loan->modifiedBy;
        }

        return response()->json($loans, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLoansRequest $request)
    {
        $loan = new Loan();
        $this->loanSave($request, $loan);
        $loan->created_by  = Auth()->user()->id;
        $loan->modified_by = Auth()->user()->id;
        $loan->save();

        $loan->created_by  = $loan->createdBy;
        $loan->modified_by = $loan->modifiedBy;

        $this->spreadsheetSave($loan);

        return response()->json([
            'status' => "Credito creado con exito",
            'data'   => $loan,
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $routeId): JsonResponse
    {
        $loans = Loan::where('route_id', $routeId)->orderByDesc('status')->orderBy('order')->get();
        $count = $loans->count();

        if (isset($loans)) {
            foreach ($loans as $loan) {
                $loan->route       = $loan->route;
                $loan->client      = $loan->client;
                $loan->created_by  = $loan->createdBy;
                $loan->modified_by = $loan->modifiedBy;
            }
            return response()->json([
                'total' => $count,
                'data'  => $loans,
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'status' => Response::HTTP_BAD_REQUEST,
                'error'  => 'No existen registros para retornar',
            ]);
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLoansRequest $request)
    {
        $loan = Loan::find($request->id);
        if (isset($loan)) {
            $this->loanUpdate($request, $loan);
            $loan->modified_by = Auth()->User()->id;
            Rule::unique('loans')->ignore($loan);
            $loan->save();

            $spreadsheet = $this->spreadsheetUpdate($loan);
            return response()->json([
                'status'      => "Credito actualizado con exito",
                'data'        => $loan,
                'spreadsheet' => $spreadsheet,
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'status' => Response::HTTP_BAD_REQUEST,
                'error'  => 'No existe el credito para actualizar',
            ]);
        }
    }

    /**
     * @param StoreLoansRequest|Request $request
     * @param Loan $loan
     * @return void
     */
    public function loanSave(StoreLoansRequest | Request $request, Loan $loan): void
    {
        $loan->route_id     = $request->route_id;
        $loan->client_id    = $request->client_id;
        $loan->order        = $request->order;
        $loan->amount       = $request->amount;
        $loan->dailyPayment = $request->dailyPayment;
        $loan->daysToPay    = $request->daysToPay;
        $loan->paymentDays  = $request->paymentDays;
        $loan->deposit      = $request->deposit;
        $loan->pico         = $request->pico;
        $loan->date         = $request->date;
        $loan->daysPastDue  = $request->daysPastDue;
        $loan->balance      = $request->balance;
        $loan->dues         = $request->dues;
        $loan->lastPayment  = $request->lastPayment;
        $loan->startDate    = $request->startDate;
        $loan->finalDate    = $request->finalDate;
        $loan->status       = $request->status;
    }

    public function loanUpdate(UpdateLoansRequest | Request $request, Loan $loan): void
    {
        $loan->order        = $request->order;
        $loan->amount       = $request->amount;
        $loan->dailyPayment = $request->dailyPayment;
        $loan->daysToPay    = $request->daysToPay;
        $loan->paymentDays  = $request->paymentDays;
        $loan->deposit      = $request->deposit;
        $loan->pico         = $request->pico;
        $loan->date         = $request->date;
        $loan->daysPastDue  = $request->daysPastDue;
        $loan->balance      = $request->balance;
        $loan->dues         = $request->dues;
        $loan->lastPayment  = $request->lastPayment;
        $loan->startDate    = $request->startDate;
        $loan->finalDate    = $request->finalDate;
        $loan->status       = $request->status;
    }

    public function spreadsheetSave(Loan $loan): void
    {
        $spreadsheet                  = new SpreadSheet();
        $spreadsheet->loan_id         = $loan->id;
        $spreadsheet->client_id       = $loan->client_id;
        $spreadsheet->loandDate       = $loan->date;
        $spreadsheet->payment         = $loan->deposit;
        $spreadsheet->lastDaysPastDue = $loan->daysPastDue;
        $spreadsheet->created_by      = Auth()->user()->id;
        $spreadsheet->modified_by     = Auth()->user()->id;

        $spreadsheet->save();
    }

    public function spreadsheetUpdate(Loan $loan): SpreadSheet
    {
        $spreadsheet = SpreadSheet::where('loan_id', $loan->id)
            ->where('client_id', $loan->client_id)
            ->where('loandDate', $loan->date)
            ->get()
            ->first();
        $spreadsheet->lastDaysPastDue = $loan->daysPastDue;
        $spreadsheet->payment         = $loan->deposit;
        $spreadsheet->modified_by     = Auth()->user()->id;

        $spreadsheet->save();

        return $spreadsheet;
    }

    /**
     * Calcula los totales diarios basados en los días de pago de los préstamos
     */
    private function calculateDailyTotals($loans): array
    {
        $totals = [
            'lun' => 0,
            'mar' => 0,
            'mie' => 0,
            'jue' => 0,
            'vie' => 0,
            'sab' => 0,
            'dom' => 0,
        ];

        foreach ($loans as $loan) {
            $paymentDays  = strtolower($loan->paymentDays ?? '*');
            $dailyPayment = $loan->dailyPayment ?? 0;

            // Si es '*', suma a todos los días
            if ($paymentDays === '*' || $paymentDays === '') {
                foreach ($totals as $day => $value) {
                    $totals[$day] += $dailyPayment;
                }
            } else {
                // Procesar días específicos
                if (strpos($paymentDays, 'lunes') !== false || strpos($paymentDays, 'lun') !== false) {
                    $totals['lun'] += $dailyPayment;
                }
                if (strpos($paymentDays, 'martes') !== false || strpos($paymentDays, 'mar') !== false) {
                    $totals['mar'] += $dailyPayment;
                }
                if (strpos($paymentDays, 'miércoles') !== false || strpos($paymentDays, 'miercoles') !== false || strpos($paymentDays, 'mie') !== false) {
                    $totals['mie'] += $dailyPayment;
                }
                if (strpos($paymentDays, 'jueves') !== false || strpos($paymentDays, 'jue') !== false) {
                    $totals['jue'] += $dailyPayment;
                }
                if (strpos($paymentDays, 'viernes') !== false || strpos($paymentDays, 'vie') !== false) {
                    $totals['vie'] += $dailyPayment;
                }
                if (strpos($paymentDays, 'sábado') !== false || strpos($paymentDays, 'sabado') !== false || strpos($paymentDays, 'sab') !== false) {
                    $totals['sab'] += $dailyPayment;
                }
                if (strpos($paymentDays, 'domingo') !== false || strpos($paymentDays, 'dom') !== false) {
                    $totals['dom'] += $dailyPayment;
                }
            }
        }

        // Calcular total diario (promedio o suma según necesidad)
        $totals['diario'] = array_sum([
            $totals['lun'],
            $totals['mar'],
            $totals['mie'],
            $totals['jue'],
            $totals['vie'],
            $totals['sab'],
            $totals['dom'],
        ]);

        return $totals;
    }

    public function export(Request $request, ?int $routeId = null)
    {
        // Obtener el route_id del request o del parámetro de ruta
        $routeId = $routeId ?? $request->input('route_id');

        if (! $routeId) {
            return response()->json([
                'status' => Response::HTTP_BAD_REQUEST,
                'error'  => 'El ID de la ruta es requerido',
            ], Response::HTTP_BAD_REQUEST);
        }

        // Buscar los préstamos de la ruta con sus relaciones
        $loans = Loan::where('route_id', $routeId)
            ->orderByDesc('status')
            ->orderBy('order')
            ->with(['route', 'client'])
            ->get();

        if ($loans->isEmpty()) {
            return response()->json([
                'status' => Response::HTTP_NOT_FOUND,
                'error'  => 'No se encontraron préstamos para la ruta especificada',
            ], Response::HTTP_NOT_FOUND);
        }

        // Preparar los datos para la vista
        $loansData = $loans->map(function ($loan) {
            $clientName = trim(($loan->client->name ?? '') . ' ' . ($loan->client->last_name ?? ''));

            return [
                'id'           => $loan->id,
                'order'        => $loan->order,
                'amount'       => $loan->amount,
                'dailyPayment' => $loan->dailyPayment,
                'daysToPay'    => $loan->daysToPay,
                'paymentDays'  => $loan->paymentDays,
                'deposit'      => $loan->deposit,
                'pico'         => $loan->pico,
                'date'         => $loan->date,
                'daysPastDue'  => $loan->daysPastDue,
                'balance'      => $loan->balance,
                'dues'         => $loan->dues,
                'lastPayment'  => $loan->lastPayment,
                'startDate'    => $loan->startDate,
                'finalDate'    => $loan->finalDate,
                'status'       => $loan->status,
                'route'        => [
                    'id'   => $loan->route->id ?? null,
                    'name' => $loan->route->name ?? '',
                ],
                'client'       => [
                    'id'           => $loan->client->id ?? null,
                    'name'         => $clientName,
                    'profession'   => $loan->client->profession ?? '',
                    'address'      => $loan->client->address ?? '',
                    'neighborhood' => $loan->client->neighborhood ?? '',
                    'phone'        => $loan->client->phone ?? '',
                ],
            ];
        })->toArray();

        // Calcular totales diarios basados en paymentDays
        $dailyTotals = $this->calculateDailyTotals($loans);

        // Formatear fecha en español
        $meses = [
            'January' => 'Enero', 'February'   => 'Febrero', 'March'      => 'Marzo',
            'April'   => 'Abril', 'May'        => 'Mayo', 'June'          => 'Junio',
            'July'    => 'Julio', 'August'     => 'Agosto', 'September'   => 'Septiembre',
            'October' => 'Octubre', 'November' => 'Noviembre', 'December' => 'Diciembre',
        ];
        $generationDate = $request->input('generationDate');
        if (! $generationDate) {
            $fecha = date('d F Y');
            foreach ($meses as $en => $es) {
                $fecha = str_replace($en, $es, $fecha);
            }
            $generationDate = $fecha;
        }

        // Generar el PDF
        $pdf = Pdf::loadView('pdf', [
            'loans'          => $loansData,
            'generationDate' => $generationDate,
            'collector'      => $request->input('collector', ''),
            'dailyTotals'    => $dailyTotals,
            'pageNumber'     => 1,
        ])->setPaper('a4', 'landscape');

        $fileName = 'listado_cobro_ruta_' . $routeId . '_' . date('Y-m-d') . '.pdf';

        return $pdf->stream($fileName);
    }

}
