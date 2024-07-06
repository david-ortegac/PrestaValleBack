<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class StoreClientRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string
     */
    public function rules(): array
    {
        return [
            'document_type' => 'required',
            'document_number' => 'required|unique:clients',
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
            'status' => "Error en datos requeridos",
            'data' => $validator->errors()
        ], Response::HTTP_BAD_REQUEST));
    }

    public function messages(): array
    {
        return [
            "document_type" => "El tipo de documento es requerido",
            "document_number" => "El número de documento ingresado ya existe",
            "route_id" => "La ruta es requerida",

            "name.required" => "El nombre es requerido",
            "last_name.required" => "El apellido es requerido",
            "phone.required" => "El telefono es requerido",
            "neighborhood.required" => "El barrio es requerido",
            "address.required" => "La dirección es requerida",
            "city.required" => "La ciudad es requerida",
            "profession.required" => "La profesión es requerida",
        ];
    }

}
