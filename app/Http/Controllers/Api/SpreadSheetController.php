<?php

namespace App\Http\Controllers\Api;

use App\Models\SpreadSheet;
use Illuminate\Http\Request;
use App\Http\Requests\SpreadSheetRequest;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\SpreadSheetResource;

class SpreadSheetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $spreadSheets = SpreadSheet::paginate();

        return SpreadSheetResource::collection($spreadSheets);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SpreadSheetRequest $request): SpreadSheet
    {
        return SpreadSheet::create($request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show(SpreadSheet $spreadSheet): SpreadSheet
    {
        return $spreadSheet;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SpreadSheetRequest $request, SpreadSheet $spreadSheet): SpreadSheet
    {
        $spreadSheet->update($request->validated());

        return $spreadSheet;
    }

    public function destroy(SpreadSheet $spreadSheet): Response
    {
        $spreadSheet->delete();

        return response()->noContent();
    }
}
