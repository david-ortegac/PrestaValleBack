<?php

namespace App\Http\Controllers\Api;

use App\Models\Loan;
use Illuminate\Http\Request;
use App\Http\Requests\LoanRequest;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\LoanResource;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $loans = Loan::paginate();

        return LoanResource::collection($loans);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LoanRequest $request): Loan
    {
        return Loan::create($request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show(Loan $loan): Loan
    {
        return $loan;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LoanRequest $request, Loan $loan): Loan
    {
        $loan->update($request->validated());

        return $loan;
    }

    public function destroy(Loan $loan): Response
    {
        $loan->delete();

        return response()->noContent();
    }
}
