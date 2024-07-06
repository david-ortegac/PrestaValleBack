<?php

namespace App\Http\Controllers;

use App\Models\Interest;
use Illuminate\Http\Request;

/**
 * Class InterestController
 * @package App\Http\Controllers
 */
class InterestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $interests = Interest::paginate();

        return view('interest.index', compact('interests'))
            ->with('i', (request()->input('page', 1) - 1) * $interests->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $interest = new Interest();
        return view('interest.create', compact('interest'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Interest::$rules);

        $interest = Interest::create($request->all());

        return redirect()->route('interests.index')
            ->with('success', 'Interest created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $interest = Interest::find($id);

        return view('interest.show', compact('interest'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $interest = Interest::find($id);

        return view('interest.edit', compact('interest'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Interest $interest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Interest $interest)
    {
        request()->validate(Interest::$rules);

        $interest->update($request->all());

        return redirect()->route('interests.index')
            ->with('success', 'Interest updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $interest = Interest::find($id)->delete();

        return redirect()->route('interests.index')
            ->with('success', 'Interest deleted successfully');
    }
}
