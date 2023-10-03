<?php

namespace App\Http\Controllers;

use App\Models\Sede;
use Illuminate\Http\Request;

/**
 * Class SedeController
 * @package App\Http\Controllers
 */
class SedeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sedes = Sede::paginate();

        if ($sedes->count() > 0) {
            return response()->json($sedes, 200);
        } else {
            return response()->json($sedes, 404);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sede = new Sede();
        return view('sede.create', compact('sede'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Sede::$rules);

        $sede = Sede::create($request->all());

        return redirect()->route('sedes.index')
            ->with('success', 'Sede created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sede = Sede::find($id);

        return view('sede.show', compact('sede'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sede = Sede::find($id);

        return view('sede.edit', compact('sede'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Sede $sede
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sede $sede)
    {
        request()->validate(Sede::$rules);

        $sede->update($request->all());

        return redirect()->route('sedes.index')
            ->with('success', 'Sede updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $sede = Sede::find($id)->delete();

        return redirect()->route('sedes.index')
            ->with('success', 'Sede deleted successfully');
    }
}