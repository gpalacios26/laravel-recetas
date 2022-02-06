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
            <h2 class="text-center mb-4">Editar Mi Perfil</h2>
        </div>
        <div class="col-md-8 mt-4 bg-white p-3">
            <form method="POST" action="{{ route('perfiles.update', ['perfil' => $perfil->id]) }}"
                enctype="multipart/form-data" novalidate>
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror" id="nombre"
                        placeholder="Tu Nombre" value="{{ $perfil->usuario->name }}">

                    @error('nombre')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group mt-3">
                    <label for="url">Sitio Web</label>
                    <input type="text" name="url" class="form-control @error('url') is-invalid @enderror" id="url"
                        placeholder="Tu Sitio Web" value="{{ $perfil->usuario->url }}">

                    @error('url')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group mt-3">
                    <label for="biografia">Biografia</label>
                    <input id="biografia" type="hidden" name="biografia" value="{{ $perfil->biografia }}">
                    <trix-editor class="form-control @error('biografia') is-invalid @enderror" input="biografia">
                    </trix-editor>

                    @error('biografia')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group mt-3">
                    <label for="imagen">Tu Imagen</label>
                    <input id="imagen" type="file" class="form-control @error('imagen') is-invalid @enderror" name="imagen">

                    @if ($perfil->imagen)
                        <div class="mt-4">
                            <p>Imagen Actual:</p>
                            <img src="/storage/{{ $perfil->imagen }}" style="width: 300px">
                        </div>

                        @error('imagen')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    @endif
                </div>

                <div class="form-group mt-3">
                    <input type="submit" class="btn btn-primary text-white" value="Actualizar Perfil">
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.js"
        integrity="sha256-2D+ZJyeHHlEMmtuQTVtXt1gl0zRLKr51OCxyFfmFIBM=" crossorigin="anonymous" defer></script>
@endsection
