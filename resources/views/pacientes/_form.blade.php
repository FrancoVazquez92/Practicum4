<div>
    <label class="block font-semibold mb-1" for="nombre">Nombre</label>
    <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $usuario->nombre ?? '') }}"
        class="w-full border border-gray-300 rounded px-4 py-2" required>
</div>

<div>
    <label class="block font-semibold mb-1" for="apellido">Apellido</label>
    <input type="text" name="apellido" id="apellido" value="{{ old('apellido', $usuario->apellido ?? '') }}"
        class="w-full border border-gray-300 rounded px-4 py-2" required>
</div>

{{-- NUEVO: Número de Identificación --}}
<div>
    <label class="block font-semibold mb-1" for="numero_identificacion">Número de Identificación</label>
    <input type="text" name="numero_identificacion" id="numero_identificacion"
        value="{{ old('numero_identificacion', $paciente->numero_identificacion ?? '') }}"
        class="w-full border border-gray-300 rounded px-4 py-2" required>
</div>

{{-- NUEVO: Fecha de nacimiento --}}
<div>
    <label class="block font-semibold mb-1" for="fecha_nacimiento">Fecha de Nacimiento</label>
    <input type="date" name="fecha_nacimiento" id="fecha_nacimiento"
        value="{{ old('fecha_nacimiento', $paciente->fecha_nacimiento ?? '') }}"
        class="w-full border border-gray-300 rounded px-4 py-2" required>
</div>

<div>
    <label class="block font-semibold mb-1" for="direccion">Dirección</label>
    <input type="text" name="direccion" id="direccion" value="{{ old('direccion', $paciente->direccion ?? '') }}"
        class="w-full border border-gray-300 rounded px-4 py-2" required>
</div>

<div class="form-group">
    <label for="genero">Género</label>
    <select name="genero" id="genero" class="form-control" required>
        <option value="">Seleccione una opción</option>
        <option value="masculino" {{ (old('genero') ?? ($paciente->genero ?? '')) == 'masculino' ? 'selected' : '' }}>Masculino</option>
        <option value="femenino" {{ (old('genero') ?? ($paciente->genero ?? '')) == 'femenino' ? 'selected' : '' }}>Femenino</option>
        <option value="otro" {{ (old('genero') ?? ($paciente->genero ?? '')) == 'otro' ? 'selected' : '' }}>Otro</option>
    </select>
</div>

<div>
    <label class="block font-semibold mb-1" for="email">Correo electrónico</label>
    <input type="email" name="email" id="email" value="{{ old('email', $usuario->email ?? '') }}"
        class="w-full border border-gray-300 rounded px-4 py-2" required>
    @error('email')
        <small class="text-danger">Correo ya registrado</small>
    @enderror
</div>

<div>
    <label class="block font-semibold mb-1" for="contacto">Contacto</label>
    <input type="text" name="contacto" id="contacto" value="{{ old('contacto', $usuario->contacto ?? '') }}"
        class="w-full border border-gray-300 rounded px-4 py-2" required>
</div>

@if (!isset($paciente))
<div>
    <label class="block font-semibold mb-1" for="password">Contraseña</label>
    <input type="password" name="password" id="password"
        class="w-full border border-gray-300 rounded px-4 py-2" required>
</div>

<div>
    <label class="block font-semibold mb-1" for="password_confirmation">Confirmar Contraseña</label>
    <input type="password" name="password_confirmation" id="password_confirmation"
        class="w-full border border-gray-300 rounded px-4 py-2" required>
</div>
@endif

<div>
    <label class="block font-semibold mb-1" for="rol_id">Rol</label>
    <input type="text" class="w-full border border-gray-300 rounded px-4 py-2 bg-gray-100"
        value="{{ $rol->nombre ?? 'Paciente' }}" disabled>
    <input type="hidden" name="rol_id" value="{{ $rol->id ?? '' }}">
</div>
