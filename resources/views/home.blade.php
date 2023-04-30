@extends('layouts.app')

@section('titulo')
    Pagina Principal
@endsection

@section('contenido')
    {{-- importante el nombre posts --}}
    <x-listar-post :posts="$posts" />
@endsection