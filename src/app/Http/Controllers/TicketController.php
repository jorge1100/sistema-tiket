<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;


class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::with('user')
            ->latest()
            ->get();
        return view(
            'tickets.index',
            compact('tickets')
        );
    }
    public function create()
    {
        return view('tickets.create');
    }
    public function store(Request $request)
    {
        $datos = $request->validate([
            'titulo' => [
                'required',
                'string',
                'max:255'
            ],
            'descripcion' => [
                'required',
                'string'
            ],
        ]);
        Ticket::create([
            'user_id' => auth()->id(),
            'titulo' => $datos['titulo'],
            'descripcion' => $datos['descripcion'],
            'estado' => 'abierto',
        ]);
        return redirect()
            ->route('tickets.index')
            ->with(
                'success',
                'Ticket creado correctamente.'
            );
    }
    public function show(Ticket $ticket)
    {
        return view(
            'tickets.show',
            compact('ticket')
        );
    }
    public function edit(Ticket $ticket)
    {
        return view(
            'tickets.edit',
            compact('ticket')
        );
    }
    public function update(
        Request $request,
        Ticket $ticket
    ) {
        $datos = $request->validate([
            'titulo' => [
                'required',
                'string',
                'max:255'
            ],
            'descripcion' => [
                'required',
                'string'
            ],
        ]);
        $ticket->update($datos);
        return redirect()
            ->route('tickets.index')
            ->with(
                'success',
                'Ticket actualizado correctamente.'
            );
    }
    public function cerrar(Ticket $ticket)
    {
        $ticket->update([
            'estado' => 'cerrado'
        ]);
        return redirect()
            ->route('tickets.index')
            ->with(
                'success',
                'Ticket cerrado correctamente.'
            );
    }
}
