<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Models\Client;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Crypt;

/**
 * Class ClientController
 * @package App\Http\Controllers
 */
class ClientController extends Controller
{
    /**
     * Display a listing of the resource paged.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $clients = Client::paginate();

        foreach ($clients as $client) {
            $client->created_by = $client->createdBy;
            $client->modified_by = $client->modifiedBy;
        }
        return response()->json($clients, Response::HTTP_OK);
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function getAll(): JsonResponse
    {
        $clients = Client::all();

        foreach ($clients as $client) {
            $client->created_by = $client->createdBy;
            $client->modified_by = $client->modifiedBy;
            unset($client->created_at);
            unset($client->updated_at);
        }
        return response()->json($clients, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return
     */
    public function store(StoreClientRequest $request): JsonResponse
    {
        $client = new Client();
        $this->extracted($request, $client);
        $client->created_by = Auth()->User()->id;
        $client->modified_by = Auth()->User()->id;

        $client->save();

        $client->created_by = $client->createdBy;
        $client->modified_by = $client->modifiedBy;

        return response()->json([
            'status' => "Cliente creado con exito",
            'data' => $client
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(string $id): JsonResponse
    {
        $client = Client::findOrFail($id);

        if (isset($client)) {
            $client->created_by = $client->createdBy;
            $client->modified_by = $client->modifiedBy;
            return response()->json(
                $client, Response::HTTP_OK
            );
        } else {
            return response()->json([
                'status' => Response::HTTP_BAD_REQUEST,
                'error' => 'No existen registros para retornar',
            ]);
        }
    }

    public function searchByDocumentNumber(string $documentNumber): JsonResponse
    {
        $client = Client::where('document_number', $documentNumber)->first();
        if (isset($client)) {
            $client->created_by = $client->createdBy;
            $client->modified_by = $client->modifiedBy;
            unset($client->created_at);
            unset($client->updated_at);

            return response()->json(
                $client, Response::HTTP_OK
            );
        } else {
            return response()->json([
                'status' => Response::HTTP_BAD_REQUEST,
                'error' => 'No existen registros para retornar',
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Client $client
     * @return JsonResponse
     */
    public function update(UpdateClientRequest $request, Client $client): JsonResponse
    {
        $client = Client::find($request->id);

        if (isset($client)) {

            $this->extracted($request, $client);
            $client->modified_by = Auth()->User()->id;
            Rule::unique('clients')->ignore($client);

            $client->save();

            $client->created_by = $client->createdBy;
            $client->modified_by = $client->modifiedBy;

            return response()->json([
                'status' => "Cliente actualizado con exito",
                'data' => $client,
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'status' => Response::HTTP_BAD_REQUEST,
                'error' => 'No existe el cliente para actualizar',
            ]);
        }
    }

    /**
     * @param StoreClientRequest|Request $request
     * @param Client $client
     * @return void
     */
    public function extracted(StoreClientRequest|Request $request, Client $client): void
    {
        $client->document_type = $request->document_type;
        $client->document_number = $request->document_number;
        $client->name = $request->name;
        $client->last_name = $request->last_name;
        $client->phone = $request->phone;
        $client->neighborhood = $request->neighborhood;
        $client->address = $request->address;
        $client->city = $request->city;
        $client->profession = $request->profession;
        $client->notes = $request->notes;
        $client->type = $request->type;
    }
}
