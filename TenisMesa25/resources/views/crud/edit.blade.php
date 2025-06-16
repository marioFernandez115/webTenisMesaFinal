@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Editar Usuario</h1>

    <form action="{{ route('usuarios.update', ['id' => $usuario->id]) }}" method="POST">
        @csrf
        @method('PUT')


        <div class="mb-3">
    <label for="nombreyapellidos" class="form-label">Nombre y Apellidos</label>
    <input type="text" class="form-control" name="nombreyapellidos" value="{{ old('nombreyapellidos', $usuario->nombreyapellidos ?? '') }}" required>
</div>
        <div class="mb-3">
            <label for="email" class="form-label">Correo electrónico</label>
            <input type="email" class="form-control" name="email" value="{{ old('email', $usuario->email ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="text" class="form-control" name="telefono" value="{{ old('telefono', $usuario->telefono ?? '') }}">
        </div>

        @if (!isset($usuario)) 
        <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input type="password" class="form-control" name="password" required>
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
            <input type="password" class="form-control" name="password_confirmation" required>
        </div>
        @endif

 
        <div class="mb-3">
            <label for="rol" class="form-label">Rol</label>
            <select name="rol" class="form-select" required>
                <option value="usuario" {{ old('rol', $usuario->rol ?? '') == 'usuario' ? 'selected' : '' }}>Usuario</option>
                <option value="mantenimiento" {{ old('rol', $usuario->rol ?? '') == 'mantenimiento' ? 'selected' : '' }}>Administrador</option>
                <option value="admin_noticias" {{ old('rol', $usuario->rol ?? '') == 'admin_noticias' ? 'selected' : '' }}>Admin Noticias</option>
                <option value="capitan" {{ old('rol', $usuario->rol ?? '') == 'capitan' ? 'selected' : '' }}>Capitán</option>
            </select>
        </div>


        <div class="mb-3">
            <label for="division" class="form-label">División</label>
            <select name="division" class="form-select" required>
                <option value="">-- Seleccionar División --</option>
                <option value="Superdivisión (Femenina)" {{ old('division', $usuario->division ?? '') == 'Superdivisión (Femenina)' ? 'selected' : '' }}>Nacional - Superdivisión (Femenina)</option>
                <option value="Superdivisión (Masculina)" {{ old('division', $usuario->division ?? '') == 'Superdivisión (Masculina)' ? 'selected' : '' }}>Nacional - Superdivisión (Masculina)</option>

                <option value="División de Honor (Femenina)" {{ old('division', $usuario->division ?? '') == 'División de Honor (Femenina)' ? 'selected' : '' }}>Nacional - División de Honor (Femenina)</option>
                <option value="División de Honor (Masculina)" {{ old('division', $usuario->division ?? '') == 'División de Honor (Masculina)' ? 'selected' : '' }}>Nacional - División de Honor (Masculina)</option>

                <option value="Primera División (Femenina)" {{ old('division', $usuario->division ?? '') == 'Primera División (Femenina)' ? 'selected' : '' }}>Nacional - Primera División (Femenina)</option>
                <option value="Primera División (Masculina)" {{ old('division', $usuario->division ?? '') == 'Primera División (Masculina)' ? 'selected' : '' }}>Nacional - Primera División (Masculina)</option>

                <option value="Segunda División (Femenina)" {{ old('division', $usuario->division ?? '') == 'Segunda División (Femenina)' ? 'selected' : '' }}>Nacional - Segunda División (Femenina)</option>
                <option value="Segunda División (Masculina)" {{ old('division', $usuario->division ?? '') == 'Segunda División (Masculina)' ? 'selected' : '' }}>Nacional - Segunda División (Masculina)</option>                
                <option value="Tercera División (Femenina)" {{ old('division', $usuario->division ?? '') == 'Tercera División (Femenina)' ? 'selected' : '' }}>Nacional - Tercera División (Femenina)</option>
                <option value="Tercera División (Masculina)" {{ old('division', $usuario->division ?? '') == 'Tercera División (Masculina)' ? 'selected' : '' }}>Nacional - Tercera División (Masculina)</option>


                <option value="Territorial 1ª (T1)" {{ old('division', $usuario->division ?? '') == 'Territorial 1ª (T1)' ? 'selected' : '' }}>Autonómico - Territorial 1ª (T1)</option>
                <option value="Territorial 2ª (T2)" {{ old('division', $usuario->division ?? '') == 'Territorial 2ª (T2)' ? 'selected' : '' }}>Autonómico - Territorial 2ª (T2)</option>
                <option value="Territorial 3ª (T3)" {{ old('division', $usuario->division ?? '') == 'Territorial 3ª (T3)' ? 'selected' : '' }}>Autonómico - Territorial 3ª (T3)</option>
            </select>
        </div>

   
      <div class="mb-3">
    <label for="equipo" class="form-label">Equipo</label>
    <select class="form-control" name="equipo" id="equipo" required>
        <option value="">-- Seleccionar Equipo --</option>
        <option value="Rivas (Parque Sureste)" {{ old('equipo', $usuario->equipo ?? '') == 'Rivas (Parque Sureste)' ? 'selected' : '' }}>
            Rivas (Parque Sureste)
        </option>
        <option value="Rivas Promesas (Colegio Cigüeñas)" {{ old('equipo', $usuario->equipo ?? '') == 'Rivas Promesas (Colegio Cigüeñas)' ? 'selected' : '' }}>
            Rivas Promesas (Colegio Cigüeñas)
        </option>
    </select>
</div>

      
        <button class="btn btn-primary">{{ $btnText }}</button>
  
        <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">Cancelar</a>

        @if ($errors->any())
        <div class="alert alert-danger mt-3">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </form>
</div>
@endsection