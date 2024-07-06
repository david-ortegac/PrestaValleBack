<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
			'route_id' => 'required',
			'client_id' => 'required',
			'order' => 'required',
			'amount' => 'required',
			'dailyPayment' => 'required',
			'daysToPay' => 'required',
			'paymentDays' => 'required|string',
			'deposit' => 'required',
			'pico' => 'required',
			'date' => 'required',
			'daysPastDue' => 'required',
			'balance' => 'required',
			'dues' => 'required',
			'lastPayment' => 'required',
			'startDate' => 'required',
			'finalDate' => 'required',
			'status' => 'required',
			'created_by' => 'required',
			'modified_by' => 'required',
        ];
    }
}
