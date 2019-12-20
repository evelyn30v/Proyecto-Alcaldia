@extends('layouts.app')

@section('content')
@if(auth()->user()->tipo_usuario_id==1)
    <admin usuario="{{ auth()->user()->name }}" identificador_id="{{ auth()->user()->id }}"></admin>
@elseif(auth()->user()->tipo_usuario_id==2)
    <panel_c usuario="{{ auth()->user()->name }}" identificador_id="{{ auth()->user()->id }}"></panel_c>
@elseif(auth()->user()->tipo_usuario_id==3)
    <panel_a usuario="{{ auth()->user()->name }}" identificador_id="{{ auth()->user()->id }}"></panel_a>
@endif

@endsection
