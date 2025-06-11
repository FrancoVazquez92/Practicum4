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
    <textarea name="permisos" class="w-full border border-gray-300 p-2 rounded" rows="3">{{ old('permisos', $rol->permisos ?? '') }}</textarea>
</div>

<button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
    {{ isset($rol) ? 'Actualizar' : 'Guardar' }}
</button>
