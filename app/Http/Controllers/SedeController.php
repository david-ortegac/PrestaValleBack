<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSedeRequest;
use App\Http\Requests\UpdateSedeRequest;
use App\Models\Sede;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class SedeController
 * @package App\Http\Controllers
 */
class SedeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $sedes = Sede::paginate();

        foreach ($sedes as $sede) {
            $sede->created_by = $sede->createdBy;
            $sede->modified_by = $sede->modifiedBy;
        }

        return response()->json(
            $sedes, Response::HTTP_OK
        );

    }

    /*
     * Obtiene la informacion de todas las rutas sin paginación
     * No recibe parametros
     * */
    public function getAll()
    {
        $sedes = Sede::all();

        foreach ($sedes as $sede) {
            $sede->created_by = $sede->createdBy;
            $sede->modified_by = $sede->modifiedBy;
        }

        return response()->json(
            $sedes, Response::HTTP_OK,
        );

    }

    public function show(int $id): JsonResponse
    {
        $sede = Sede::findOrFail($id);
        if (isset($sede)) {
            $sede->created_by = $sede->createdBy;
            $sede->modified_by = $sede->modifiedBy;
            return response()->json(
                $sede, Response::HTTP_OK
            );
        } else {
            return response()->json([
                'status' => Response::HTTP_BAD_REQUEST,
                'error' => 'No existen registros para retornar',
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(StoreSedeRequest $request): JsonResponse
    {
        $sede = new Sede;
        $sede->name = $request->name;
        $sede->created_by = Auth()->User()->id;
        $sede->modified_by = Auth()->User()->id;

        $sede->save();

        $sede->created_by = $sede->createdBy;
        $sede->modified_by = $sede->modifiedBy;

        return response()->json(
            $sede, Response::HTTP_OK
        );

    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Sede $sede
     * @return JsonResponse
     */
    public function update(UpdateSedeRequest $request, Sede $sede): JsonResponse
    {
        $sede->name = $request->name;
        $sede->modified_by = Auth()->User()->id;

        $sede->update();

        $sede->created_by = $sede->createdBy;
        $sede->modified_by = $sede->modifiedBy;

        return response()->json(
            $sede,Response::HTTP_OK
        );

    }
}
