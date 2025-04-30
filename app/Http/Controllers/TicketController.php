<?php

    
    namespace App\Http\Controllers;

    use App\Models\Ticket;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth; // Si estás usando la autenticación de Laravel
    
    class TicketController extends Controller
    {
        /**
         * Muestra un listado de los tickets.
         *
         * @return \Illuminate\Http\Response
         */
        public function index()
        {
            $tickets = Ticket::with('usuario')->get(); // Carga ansiosamente el usuario
            return view('tickets.index', compact('tickets'));
        }
    
        /**
         * Muestra el formulario para crear un nuevo ticket.
         *
         * @return \Illuminate\Http\Response
         */
        public function create()
        {
            return view('tickets.create');
        }
    
        /**
         * Almacena un ticket recién creado en el almacenamiento.
         *
         * @param  \Illuminate\Http\Request  $request
         * @return \Illuminate\Http\Response
         */
        public function store(Request $request)
        {
            $request->validate([
                'Tipo' => 'required|in:Hardware,Software,Red,Otro',
                'Descripcion' => 'required',
                'Prioridad' => 'required|in:Alta,Media,Baja',
            ]);
    
            $ticket = new Ticket();
            $ticket->Tipo = $request->Tipo;
            $ticket->Descripcion = $request->Descripcion;
            $ticket->Prioridad = $request->Prioridad;
            $ticket->Estado = 'Abierto'; // Estado por defecto
            $ticket->FechaCreacion = date('Y-m-d');
            $ticket->idUsuario = Auth::id(); // Obtiene el ID del usuario actualmente autenticado
            $ticket->save();
    
            return redirect()->route('tickets.index')->with('success', 'Ticket creado exitosamente.');
        }
    
        /**
         * Muestra el ticket especificado.
         *
         * @param  \App\Models\Ticket  $ticket
         * @return \Illuminate\Http\Response
         */
        public function show(Ticket $ticket)
        {
            return view('tickets.show', compact('ticket'));
        }
    
        /**
         * Muestra el formulario para editar el ticket especificado.
         *
         * @param  \App\Models\Ticket  $ticket
         * @return \Illuminate\Http\Response
         */
        public function edit(Ticket $ticket)
        {
            return view('tickets.edit', compact('ticket'));
        }
    
        /**
         * Actualiza el ticket especificado en el almacenamiento.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  \App\Models\Ticket  $ticket
         * @return \Illuminate\Http\Response
         */
        public function update(Request $request, Ticket $ticket)
        {
            $request->validate([
                'Tipo' => 'required|in:Hardware,Software,Red,Otro',
                'Descripcion' => 'required',
                'Prioridad' => 'required|in:Alta,Media,Baja',
                'Estado' => 'required|in:Abierto,En Proceso,Resuelto,Cerrado',
            ]);
    
            $ticket->Tipo = $request->Tipo;
            $ticket->Descripcion = $request->Descripcion;
            $ticket->Prioridad = $request->Prioridad;
            $ticket->Estado = $request->Estado;
            $ticket->save();
    
            return redirect()->route('tickets.index')->with('success', 'Ticket actualizado exitosamente.');
        }
    
        /**
         * Elimina el ticket especificado del almacenamiento.
         *
         * @param  \App\Models\Ticket  $ticket
         * @return \Illuminate\Http\Response
         */
        public function destroy(Ticket $ticket)
        {
            $ticket->delete();
            return redirect()->route('tickets.index')->with('success', 'Ticket eliminado exitosamente.');
        }
    }



