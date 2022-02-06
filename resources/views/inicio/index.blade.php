@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
        integrity="sha256-UhQQ4fxEeABh4JrcmAJ1+16id/1dnlOEVCFOxDef9Lw=" crossorigin="anonymous" />
@endsection

@section('hero')
    <div class="hero-categorias">
        <form class="container h-100" action={{ route('recetas.search') }}>
            <div class="row h-100 align-items-center">
                <div class="col-md-4 texto-buscar">
                    <p class="display-4">Encuentra una receta para tu próxima comida</p>

                    <input type="search" name="buscar" class="form-control" placeholder="Buscar Receta" />
                </div>
            </div>
        </form>
    </div>
@endsection

@section('content')
    <div class="container nuevas-recetas">
        <h2 class="titulo-categoria text-uppercase mb-4">Últimas Recetas</h2>
        <div class="owl-carousel owl-theme">
            @foreach ($nuevas as $nueva)
                <div class="card ">
                    <img src="/storage/{{ $nueva->imagen }} " class="card-img-top" alt="imagen receta">

                    <div class="card-body h-100">
                        <h3>{{ Str::title($nueva->titulo) }}</h3>
                        <a href=" {{ route('recetas.show', [$nueva->id]) }} "
                            class="btn btn-primary d-block font-weight-bold text-white">Ver Receta
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    @foreach ($recetas as $key => $grupo)
        <div class="container">
            @if (count($grupo) > 0)
                <h2 class="titulo-categoria text-uppercase mt-5 mb-4"> {{ str_replace('-', ' ', $key) }} </h2>
                <div class="row">
                    @foreach ($grupo as $receta)
                        @include('ui.receta')
                    @endforeach
                </div>
            @endif
        </div>
    @endforeach

@endsection
