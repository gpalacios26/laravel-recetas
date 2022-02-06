@extends('layouts.app')

@section('content')
    <div class="row justify-content-center mb-4">
        <article class="contenido-receta col-8 bg-white p-5">
            <h1 class="text-center mb-4">{{ $receta->titulo }}</h1>
            <div class="imagen-receta mb-4">
                <img class="w-100" src="/storage/{{ $receta->imagen }}" alt="{{ $receta->titulo }}">
            </div>
            <div class="receta-meta">
                <p>
                    <span class="font-weight-bold text-primary">Escrito en:</span>
                    <a class="text-dark" href="{{ route('categorias.show', [$receta->categoria->id]) }} ">
                        {{ $receta->categoria->nombre }}
                    </a>
                </p>
                <p>
                    <span class="font-weight-bold text-primary">Autor:</span>
                    <a class="text-dark" href="{{ route('perfiles.show', [$receta->autor->id]) }} ">
                        {{ $receta->autor->name }}
                    </a>
                </p>
                <p>
                    <span class="font-weight-bold text-primary">Fecha:</span>
                    @php
                        $fecha = $receta->created_at;
                    @endphp

                    <fecha-receta fecha="{{ $fecha }}"></fecha-receta>
                </p>
                <div class="ingredientes">
                    <h2 class="my-3 text-primary">Ingredientes</h2>
                    {!! $receta->ingredientes !!}
                </div>
                <div class="preparacion">
                    <h2 class="my-3 text-primary">Preparación</h2>
                    {!! $receta->preparacion !!}
                </div>
            </div>
        </article>
    </div>
@endsection
