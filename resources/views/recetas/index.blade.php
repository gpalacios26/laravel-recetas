@extends('layouts.app')

@section('botones')
    @include('ui.navegacion')
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h2 class="text-center mb-4">Administra tus Recetas</h2>
        </div>
        <div class="col-md-10 mx-auto bg-white p-3">
            <table class="table">
                <thead class="bg-primary text-light">
                    <tr>
                        <th scope="col" class="text-center">Título</th>
                        <th scope="col" class="text-center">Categoría</th>
                        <th scope="col" class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($recetas as $receta)
                        <tr>
                            <td>{{ $receta->titulo }}</td>
                            <td>{{ $receta->categoria->nombre }}</td>
                            <td class="text-center">
                                <eliminar-receta receta-id={{ $receta->id }}></eliminar-receta>
                                <a href="{{ route('recetas.edit', [$receta->id]) }}" class="btn btn-dark text-white m-2">
                                    Editar
                                </a>
                                <a href="{{ route('recetas.show', [$receta->id]) }}"
                                    class="btn btn-success text-white m-2">
                                    Ver
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{ $recetas->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
@endsection
