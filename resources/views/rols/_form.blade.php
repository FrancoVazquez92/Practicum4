@csrf

<div class="mb-4">
    <label class="block text-sm font-medium mb-1">Nombre</label>
    <input type="text" name="nombre" value="{{ old('nombre', $rol->nombre ?? '') }}" required class="w-full border border-gray-300 p-2 rounded">
</div>

<div class="mb-4">
    <label class="block text-sm font-medium mb-1">Descripción</label>
    <textarea name="descripcion" class="w-full border border-gray-300 p-2 rounded" rows="3">{{ old('descripcion', $rol->descripcion ?? '') }}</textarea>
</div>

<div class="mb-4">
    <label class="block text-sm font-medium mb-1">Permisos</label>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
        @foreach ($permisosDisponibles as $permiso => $etiqueta)
            <label class="inline-flex items-center">
                <input
                    type="checkbox"
                    name="permisos[]"
                    value="{{ $permiso }}"
                    class="form-checkbox text-blue-600"
                    @if(is_array(old('permisos', $permisosSeleccionados ?? [])) && in_array($permiso, old('permisos', $permisosSeleccionados ?? [])))
                        checked
                    @endif
                >
                <span class="ml-2">{{ $etiqueta }}</span>
            </label>
        @endforeach
    </div>
</div>

<button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
    {{ isset($rol) ? 'Actualizar' : 'Guardar' }}
</button>
<a href="{{ route('rols.index') }}" class="text-blue-700 hover:underline ml-2">Cancelar</a>
