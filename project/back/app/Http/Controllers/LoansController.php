<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLoansRequest;
use App\Http\Requests\UpdateLoansRequest;
use App\Models\Loan;
use Symfony\Component\HttpFoundation\Response;

class LoansController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
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
    public function store(StoreLoansRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(int $routeId)
    {
        $loans = Loan::where('route_id', $routeId)->orderBy('order')->orderBy('status')->get();
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
    public function update(UpdateLoansRequest $request, Loans $loans)
    {
        //
    }

}
