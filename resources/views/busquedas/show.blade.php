@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="titulo-categoria text-uppercase mb-4">
            Resultados Búsqueda: {{ $busqueda }}
        </h2>

        <div class="row">
            @foreach ($recetas as $receta)
                @include('ui.receta')
            @endforeach
        </div>

        <div class="d-flex justify-content-center mt-5">
            {{ $recetas->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection
