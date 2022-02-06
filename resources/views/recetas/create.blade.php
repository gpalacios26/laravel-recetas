@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.css"
        integrity="sha256-yebzx8LjuetQ3l4hhQ5eNaOxVLgqaY1y8JcrXuJrAOg=" crossorigin="anonymous" />
@endsection

@section('botones')
    <div style="float:left">
        <a href="{{ route('recetas.index') }}" class="btn btn-primary text-white p-2">Volver al Panel</a>
    </div>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h2 class="text-center mb-4">Crear Nueva Receta</h2>
        </div>
        <div class="col-md-8 mt-4 bg-white p-3">
            <form method="POST" action="{{ route('recetas.store') }}" autocomplete="off" enctype="multipart/form-data"
                novalidate>
                @csrf
                <div class="form-group">
                    <label for="categoria">Categoría</label>
                    <select name="categoria" id="categoria" class="form-control @error('categoria') is-invalid @enderror">
                        <option value="">-- Seleccione --</option>
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id }}"
                                {{ old('categoria') == $categoria->id ? 'selected' : '' }}>
                                {{ $categoria->nombre }}
                            </option>
                        @endforeach
                    </select>

                    @error('categoria')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group mt-3">
                    <label for="titulo">Título Receta</label>
                    <input type="text" name="titulo" id="titulo" class="form-control @error('titulo') is-invalid @enderror"
                        placeholder="Título Receta" value="{{ old('titulo') }}">

                    @error('titulo')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group mt-3">
                    <label for="ingredientes">Ingredientes</label>
                    <input type="hidden" id="ingredientes" name="ingredientes" value="{{ old('ingredientes') }}">
                    <trix-editor input="ingredientes" class="form-control @error('ingredientes') is-invalid @enderror">
                    </trix-editor>

                    @error('ingredientes')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group mt-3">
                    <label for="preparacion">Preparación</label>
                    <input type="hidden" id="preparacion" name="preparacion" value="{{ old('preparacion') }}">
                    <trix-editor input="preparacion" class="form-control @error('preparacion') is-invalid @enderror">
                    </trix-editor>

                    @error('preparacion')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group mt-3">
                    <label for="imagen">Elige la imagen</label>
                    <input type="file" id="imagen" name="imagen" class="form-control @error('imagen') is-invalid @enderror">

                    @error('imagen')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group mt-3">
                    <input type="submit" class="btn btn-primary text-white" value="Agregar Receta">
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.js"
        integrity="sha256-2D+ZJyeHHlEMmtuQTVtXt1gl0zRLKr51OCxyFfmFIBM=" crossorigin="anonymous" defer></script>
@endsection
