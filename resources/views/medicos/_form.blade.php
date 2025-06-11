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

    <div>
        <label class="block font-semibold mb-1" for="especialidad">Especialidad</label>
        <input type="text" name="especialidad" id="especialidad" value="{{ old('especialidad', $medico->especialidad ?? '') }}"
            class="w-full border border-gray-300 rounded px-4 py-2" required>
    </div>

    <div>
        <label class="block font-semibold mb-1" for="email">Correo</label>
        <input type="email" name="email" id="email" value="{{ old('email', $usuario->email ?? '') }}"
            class="w-full border border-gray-300 rounded px-4 py-2" required>
    </div>

    <div>
        <label class="block font-semibold mb-1" for="contacto">Contacto</label>
        <input type="text" name="contacto" id="contacto" value="{{ old('contacto', $usuario->contacto ?? '') }}"
            class="w-full border border-gray-300 rounded px-4 py-2" required>
    </div>

    @if(!isset($medico))
    <div>
        <label class="block font-semibold mb-1" for="password">Contraseña</label>
        <input type="password" name="password" id="password" class="w-full border border-gray-300 rounded px-4 py-2" required>
    </div>

    <div>
        <label class="block font-semibold mb-1" for="password_confirmation">Confirmar Contraseña</label>
        <input type="password" name="password_confirmation" id="password_confirmation"
            class="w-full border border-gray-300 rounded px-4 py-2" required>
    </div>
    @endif
    <div>
        <label class="block font-semibold mb-1" for="rol_id">Rol</label>

        <!-- Visible pero no editable -->
        <input type="text" class="w-full border border-gray-300 rounded px-4 py-2 bg-gray-100" 
            value="{{ $roles->nombre }}" disabled>

        <!-- Oculto pero se envía al backend -->
        <input type="hidden" name="rol_id" value="{{ $roles->id }}">
    </div>
