<h1>Nuevo Ticket</h1>
    @csrf

    <div>
        <label for="titulo">Título</label>
        <input
            type="text"
            id="titulo"
            name="titulo"
            value="{{ old('titulo') }}"
        >

        @error('titulo')
            <p>{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="descripcion">Descripción</label>

        <textarea
            id="descripcion"
            name="descripcion"
        >{{ old('descripcion') }}</textarea>

        @error('descripcion')
            <p>{{ $message }}</p>
        @enderror
    </div>

    <button type="submit">
        Crear Ticket
    </button>
</form>
