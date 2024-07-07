<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\StoreLoansRequest;
use App\Http\Requests\UpdateLoansRequest;
use App\Models\Client;
use App\Models\Loan;
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
            $loan->route = $loan->route;
            $loan->client = $loan->client;
            $loan->created_by = $loan->createdBy;
            $loan->modified_by = $loan->modifiedBy;
        }

        return response()->json($loans, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLoansRequest $request): JsonResponse
    {
        $loan = new Loan();
        $this->extracted($request, $loan);
        $loan->created_by = Auth()->user()->id;
        $loan->modified_by = Auth()->user()->id;

        $loan->save();

        $loan->created_by = $loan->createdBy;
        $loan->modified_by = $loan->modifiedBy;

        return response()->json([
            'status' => "Credito creado con exito",
            'data' => $loan
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $routeId)
    {
        $loans = Loan::where('route_id', $routeId)->orderByDesc('status')->orderBy('order')->get();
        $count = $loans->count();

        if (isset($loans)) {
            foreach ($loans as $loan) {
                $loan->route = $loan->route;
                $loan->client = $loan->client;
                $loan->created_by = $loan->createdBy;
                $loan->modified_by = $loan->modifiedBy;
            }
            return response()->json([
                'total' => $count,
                'data' => $loans,
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'status' => Response::HTTP_BAD_REQUEST,
                'error' => 'No existen registros para retornar',
            ]);
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLoansRequest $request, Loan $loan)
    {
        $loanUpdate = Loan::find($request->id);
        if(isset($loanUpdate)){
            $this->extracted($request, $loan);
            $loanUpdate->modified_by = Auth()->User()->id;
            Rule::unique('loans')->ignore($loanUpdate);

            $loanUpdate->save();

            $loanUpdate->created_by = $loan->createdBy;
            $loanUpdate->modified_by = $loan->modifiedBy;

            return response()->json([
                'status' => "Credito actualizado con exito",
                'data' => $loan,
            ], Response::HTTP_OK);
        }else{
            return response()->json([
                'status' => Response::HTTP_BAD_REQUEST,
                'error' => 'No existe el credito para actualizar',
            ]);
        }
    }

    /**
     * @param StoreLoansRequest|Request $request
     * @param Client $client
     * @return void
     */
    public function extracted(StoreLoansRequest|Request $request, Loan $loan): void
    {
        $loan->route_id = $request->route_id;
        $loan->client_id = $request->client_id;
        $loan->order = $request->order;
        $loan->amount = $request->amount;
        $loan->dailyPayment = $request->dailyPayment;
        $loan->daysToPay = $request->daysToPay;
        $loan->paymentDays = $request->paymentDays;
        $loan->deposit = $request->deposit;
        $loan->pico = $request->pico;
        $loan->date = $request->date;
        $loan->daysPastDue = $request->daysPastDue;
        $loan->balance = $request->balance;
        $loan->dues = $request->dues;
        $loan->lastPayment = $request->lastPayment;
        $loan->startDate = $request->startDate;
        $loan->finalDate = $request->finalDate;
        $loan->status = $request->status;
    }

}
