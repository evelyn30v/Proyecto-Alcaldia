<?php

namespace App\Http\Controllers;

use App\Citacion;
use Illuminate\Http\Request;

class CitacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        // $this->validate($request,[
        //     'observacion'=>'text|max:500',
        //     'fecha'=>'required|date',
        //     'hora_inicio'=>'required',
        //     'hora_fin'=>'required',
        // ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Citacion  $citacion
     * @return \Illuminate\Http\Response
     */
    public function show(Citacion $citacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Citacion  $citacion
     * @return \Illuminate\Http\Response
     */
    public function edit(Citacion $citacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Citacion  $citacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Citacion $citacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Citacion  $citacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Citacion $citacion)
    {
        //
    }
}
