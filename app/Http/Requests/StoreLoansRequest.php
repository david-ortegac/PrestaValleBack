<?php

namespace App\Http\Requests;

use App\Models\Client;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class StoreLoansRequest extends FormRequest
{
    public int $order;
    public Client $client_id;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'route_id'=> 'required',
            'client_id'=> 'required',
            'order'=> 'required',
            'amount'=> 'required',
            'dailyPayment'=> 'required',
            'daysToPay'=> 'required',
            'deposit'=> 'required',
            'pico'=> 'required',
            'date'=> 'required',
            'daysPastDue'=> 'required',
            'balance'=> 'required',
            'dues'=> 'required',
            'status'=> 'required',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status' => "Error en datos requeridos",
            'data' => $validator->errors()
        ], Response::HTTP_BAD_REQUEST));
    }

    public function messages(): array
    {
        return [
            'route_id'=> 'La ruta es requerida',
            'client_id'=> 'El cliente es requerido',
            'order'=> 'El orden de la ruta es requerido',
            'amount'=> 'El monto es requerido',
            'dailyPayment'=> 'El valor del pago diario es requerido',
            'daysToPay'=> 'Los días del credito son requeridos',
            'deposit'=> 'El valor abonado es requerido',
            'pico'=> 'El valor del pico es requerido',
            'date'=> 'La fecha de pago es requerida',
            'daysPastDue'=> 'Los dias de mora son requeridos',
            'balance'=> 'El valor del saldo a pagar es requerido',
            'dues'=> 'La cantidad de cuotas restantes son requeidas',
            'status'=> 'El estado del credito es requerido',
        ];
    }
}
