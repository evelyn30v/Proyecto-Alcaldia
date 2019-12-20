<?php

namespace App\Http\Controllers;

use App\Remision;
use Illuminate\Http\Request;

class RemisionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $remision = Remision::get();
        return $remision;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'nombre'=>'request|string|max:500',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Remision  $remision
     * @return \Illuminate\Http\Response
     */
    public function show(Remision $remision)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Remision  $remision
     * @return \Illuminate\Http\Response
     */
    public function edit(Remision $remision)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Remision  $remision
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Remision $remision)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Remision  $remision
     * @return \Illuminate\Http\Response
     */
    public function destroy(Remision $remision)
    {
        //
    }
}
