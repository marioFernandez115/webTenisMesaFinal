@extends('layouts.app')
@section('title', 'Sobre Nosotros | Tenis de mesa')

@section('header')
@endsection

@section('content')
<div class="text-center">
    <h1 class="display-4">Sobre Nosotros</h1>
    <p class="lead">
        🏓 En el Club de Tenis de Mesa Rivas, vivimos la emoción del juego punto a punto. 
        Formamos parte de una comunidad vibrante donde entrenar, competir y disfrutar 
        se convierte en una experiencia inolvidable. ¡Súmate a nuestro equipo! 🏓
    </p>

    <div class="row my-5 align-items-center">

        <div class="col-md-6">
            <h2 class="display-5">Nuestra Comunidad</h2>
            <p class="lead">
                Somos más que un club: somos una familia unida por la pasión por el tenis de mesa.
                Compartimos noticias, organizamos eventos y fomentamos un entorno inclusivo 
                donde jugadores de todos los niveles pueden crecer y disfrutar del deporte.
            </p>
        </div>
        <div class="col-md-6 text-center">
            <img class="imgNosotros img-fluid rounded shadow" src="{{ asset('img/comunidad.jpg') }}" alt="Comunidad Tenis de Mesa">
        </div>
    </div>

    <div class="row my-5 align-items-center">

        <div class="col-md-6 text-center order-md-1">
            <img class="imgNosotros img-fluid rounded shadow" src="{{ asset('img/equipo.jpg') }}" alt="Equipo Tenis de Mesa">
        </div>
        <div class="col-md-6 order-md-2">
            <h2 class="display-5">Nuestro Equipo</h2>
            <p class="lead">
                Entrenadores, jugadores y colaboradores comprometidos con el crecimiento del tenis de mesa.
                Nos esforzamos en cada entrenamiento y en cada partido, trabajando juntos con respeto,
                esfuerzo y espíritu deportivo.
            </p>
        </div>
    </div>
</div>
@endsection
