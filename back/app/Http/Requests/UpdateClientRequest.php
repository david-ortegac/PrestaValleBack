<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UpdateClientRequest extends FormRequest
{
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
            'document_type' => 'required',
            'document_number' => 'required',
            'name' => 'required',
            'last_name' => 'required',
            'phone' => 'required',
            'neighborhood' => 'required',
            'address' => 'required',
            'city' => 'required',
            'profession' => 'required'
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status'   => "Error en datos requeridos",
            'data'      => $validator->errors()
        ], Response::HTTP_BAD_REQUEST));
    }

    public function messages(): array
    {
        return [
            "document_type"=>"El tipo de documento es requerido",
            "document_number"=>"El número de documento es requerido",
            "name" =>"El nombre es requerido",
            "last_name" =>"El apellido es requerido",
            "phone"=>"El telefono es requerido",
            "neighborhood"=>"El barrio es requerido",
            "address"=>"La dirección es requerida",
            "city"=>"La ciudad es requerida",
            "profession"=>"La profesión es requerida",

        ];
    }
}
