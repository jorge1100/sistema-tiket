<h1>Tickets</h1>
@if (session('success'))
    <p>
        {{ session('success') }}
    </p>
@endif
<a href="{{ route('tickets.create') }}">
    Nuevo Ticket
</a>
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
                <td>
                    {{ $ticket->id }}
                </td>
                <td>
                    {{ $ticket->titulo }}
                </td>
                <td></td>
                {{ $ticket->user->name }}
                </td>
                <td>
                    {{ $ticket->estado }}
                </td>
                <td>
                    <a href="{{ route('tickets.show', $ticket) }}">
                        Ver
                    </a>
                    <a href="{{ route('tickets.edit', $ticket) }}">
                        Editar
                    </a>
                    @if ($ticket->estado === 'abierto')
                        <form method="POST" action="{{ route('tickets.cerrar', $ticket) }}" @csrf @method('PATCH')
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
