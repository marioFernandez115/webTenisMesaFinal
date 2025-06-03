@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Crear Usuario</h1>

    <form action="{{ route('usuarios.store') }}" method="POST">
        @csrf
        @include('crud.form', ['btnText' => 'Crear'])
    </form>
</div>
@endsection
