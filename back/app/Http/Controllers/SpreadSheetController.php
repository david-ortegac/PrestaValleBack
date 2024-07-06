<?php

namespace App\Http\Controllers;

use App\Models\SpreadSheet;
use Illuminate\Http\Request;

/**
 * Class SpreadSheetController
 * @package App\Http\Controllers
 */
class SpreadSheetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $spreadSheets = SpreadSheet::paginate();

        return view('spread-sheet.index', compact('spreadSheets'))
            ->with('i', (request()->input('page', 1) - 1) * $spreadSheets->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $spreadSheet = new SpreadSheet();
        return view('spread-sheet.create', compact('spreadSheet'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(SpreadSheet::$rules);

        $spreadSheet = SpreadSheet::create($request->all());

        return redirect()->route('spread-sheets.index')
            ->with('success', 'SpreadSheet created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $spreadSheet = SpreadSheet::find($id);

        return view('spread-sheet.show', compact('spreadSheet'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $spreadSheet = SpreadSheet::find($id);

        return view('spread-sheet.edit', compact('spreadSheet'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  SpreadSheet $spreadSheet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SpreadSheet $spreadSheet)
    {
        request()->validate(SpreadSheet::$rules);

        $spreadSheet->update($request->all());

        return redirect()->route('spread-sheets.index')
            ->with('success', 'SpreadSheet updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $spreadSheet = SpreadSheet::find($id)->delete();

        return redirect()->route('spread-sheets.index')
            ->with('success', 'SpreadSheet deleted successfully');
    }
}
