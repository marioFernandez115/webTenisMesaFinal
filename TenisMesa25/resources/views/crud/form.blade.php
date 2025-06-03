<div class="mb-3">
    <label for="nombre" class="form-label">Nombre</label>
    <input type="text" class="form-control" name="nombre" value="{{ old('nombre', $usuario->nombre ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="apellido_1" class="form-label">Primer Apellido</label>
    <input type="text" class="form-control" name="apellido_1" value="{{ old('apellido_1', $usuario->apellido_1 ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="apellido_2" class="form-label">Segundo Apellido</label>
    <input type="text" class="form-control" name="apellido_2" value="{{ old('apellido_2', $usuario->apellido_2 ?? '') }}" required>
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
    <label for="equipo" class="form-label">Equipo</label>
    <select name="equipo" class="form-select" required>
        <option value="">-- Seleccionar Equipo --</option>
        <option value="Rivas (Parque Suereste)" {{ old('equipo', $usuario->equipo ?? '') == 'Rivas (Parque Suereste)' ? 'selected' : '' }}>Rivas (Parque Sureste)</option>
        <option value="Rivas Promesas (Colegio Cigüeñas)" {{ old('equipo', $usuario->equipo ?? '') == 'Rivas Promesas (Colegio Cigüeñas)' ? 'selected' : '' }}>Rivas Promesas (Colegio Cigüeñas)</option>
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

        <option value="Territorial 1ª (T1)" {{ old('division', $usuario->division ?? '') == 'Territorial 1ª (T1)' ? 'selected' : '' }}>Autonómico - Territorial 1ª (T1)</option>
        <option value="Territorial 2ª (T2)" {{ old('division', $usuario->division ?? '') == 'Territorial 2ª (T2)' ? 'selected' : '' }}>Autonómico - Territorial 2ª (T2)</option>
        <option value="Territorial 3ª (T3)" {{ old('division', $usuario->division ?? '') == 'Territorial 3ª (T3)' ? 'selected' : '' }}>Autonómico - Territorial 3ª (T3)</option>
    </select>
</div>

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
    <button class="btn btn-primary">{{ $btnText }}</button>
    <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">Cancelar</a>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
