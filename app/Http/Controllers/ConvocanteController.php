<?php

namespace App\Http\Controllers;

use App\Convocante;
use Illuminate\Http\Request;

class ConvocanteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
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
     * @param  \App\Convocante  $convocante
     * @return \Illuminate\Http\Response
     */
    public function show(Convocante $convocante)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Convocante  $convocante
     * @return \Illuminate\Http\Response
     */
    public function edit(Convocante $convocante)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Convocante  $convocante
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Convocante $convocante)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Convocante  $convocante
     * @return \Illuminate\Http\Response
     */
    public function destroy(Convocante $convocante)
    {
        //
    }
}
