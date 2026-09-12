<h1>Tickets</h1>

@if (session('success'))
    <p>{{ session('success') }}</p>
@endif

@can('crear tickets')
    {{ route('tickets.create') }}
        Nuevo Ticket
    </a>
@endcan

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Título</th>
            <th>Usuario</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($tickets as $ticket)
            <tr>
                <td>{{ $ticket->id }}</td>

                <td>{{ $ticket->titulo }}</td>

                <td>{{ $ticket->user->name ?? 'Sin usuario' }}</td>

                <td>{{ $ticket->estado }}</td>

                <td>
                    @can('ver tickets')
                            Ver
                        </a>
                    @endcan

                    @can('editar tickets')
                            Editar
                        </a>
                    @endcan

                    @if ($ticket->estado === 'abierto')
                            @csrf
                            @method('PATCH')

                            <button type="submit">
                                Cerrar
                            </button>
                        </form>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
