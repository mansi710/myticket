<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Notifications\WhenTicketCreatedByUser;
use App\Notifications\WhenTicketStatusChangeNotification;
use App\Notifications\createTicketNotification;
use App\Events\TicketStatusChangeEvent;
use App\Listeners\TicketStatusChangeListener;
use App\Events\SendMail;
use App\Listeners\SendMailFired;
use Auth;
use Notification;
use Mail;
use App\Mail\testMail;
use Event;
use App\Mail\CreateTicketMailToAdmin;
use DB;


class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * THIS METHOD CAN GET ALL THE TICKETS AND SHOW RECORD TO ADMIN WITH SORTING AND PAGINATION
     */


    public function __construct()
    {
        $this->middleware('auth');
    }


    //user index
    public function index(Ticket $tickets, Request $request)
    {
        $user = auth()->user()->id;
        $tickets = Ticket::with('user')->where('user_id', Auth::user()->id)->sortable();
        // dd($tickets);
        //search for id
        if ($request->has('searchId') && $request->searchId != null) {
            $tickets = $tickets->where('id', $request->searchId);
        }
        //search for ticket_name
        if ($request->has('searchName') && $request->searchName != null) {
            $tickets = $tickets->where('ticket_name', $request->searchName);
        }
        //search for status
        if ($request->has('searchStatus') && $request->searchStatus != null) {
            $tickets = $tickets->where('status', $request->searchStatus);
        }
        //search for priority
        if ($request->has('searchPriority') && $request->searchPriority != null) {
            $tickets = $tickets->where('priority', $request->searchPriority);
        }
        //search for ticket_message
        if ($request->has('searchMessage') && $request->searchMessage != null) {
            $tickets = $tickets->where('ticket_message', $request->searchMessage);
        }
        // else
        // {
        //     $tickets = Ticket::with('user')->where('user_id','=',$user)->sortable()->paginate(5);
        // }
        // dd($tickets);
        $tickets = $tickets->paginate(5);
        return view('tickets.indexUser', compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * THIS METHOD CAN GIVE THE VIEW TO USER FOR CREATING TICKETS
     */
    public function create()
    {
        //
        return view('tickets.ticketsRaised');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    /**
     * THIS METHOD CAN STOR THE TICKETS WHICH WAS CREATED BY USER
     */
    public function store(Request $request, Ticket $tickets)
    {
        //
        // dd($request->all());
        $request->validate([
            'ticket_name' => 'required',
            'priority' => 'required',
            'ticket_message' => 'required|string|max:50',
        ]);

        $tickets = Ticket::create([
            'user_id' => Auth::user()->id,
            'ticket_name' => $request->input('ticket_name'),
            'priority' => $request->input('priority'),
            'ticket_message' => $request->input('ticket_message')

        ]);
        // Student::create($request->all());

        // Ticket::create($request->all());

        $data = $tickets->user;
        //  dump($data);

        $tickets->save();



        Mail::to($tickets->user->email)->send(new CreateTicketMailToAdmin($tickets));
        $tickets->notify(new createTicketNotification($tickets));
        //  Notification::sendNow($tickets, new WhenTicketCreatedByUser($tickets));

        return redirect()->route('tickets.index')->with('success', 'Ticket Created Successfully.');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */

    /**
     * THIS METHOD CAN SHOW PARTICULAR 1 TICKET
     */
    public function show(Ticket $ticket)
    {
        //

        $user = auth()->user();

        $id = auth()->user()->id;

        // $ticket=Ticket::select('ticket_name')->where('id',$ticket)->get();
        // dd($ticket);
        if ($user->hasRole('user')) {
            //    $ticket=Ticket::where('id','=',$ticket->id)->where('user_id',$id)->firstOrFail();
            $ticket = Ticket::where('id', '=', $ticket->id)->where('user_id', $id)->first();

            if ($ticket) {
                return view('tickets.show', compact('ticket'));
            } else {

                return redirect()->route('tickets.index');
            }
        } else if ($user->hasRole('admin')) {
            return view('tickets.show', compact('ticket'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */

    /**
     * THIS METHOD CAN RETURN THE EDIT VIEW WITH ALREADY FILL OLD DATA AND SHOWN TO ADMIN 
     */
    public function edit(Ticket $ticket)
    {
        //

        return view('tickets.edit', compact('ticket'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */


    /**
     * THIS METHOD CAN UPDATE THE RECORD WHICH WE FILL WITH EDIT VIEW
     */
    public function update(Request $request, Ticket $ticket,)
    {
        //
        // dump($request);
        $request->validate([
            'ticket_name' => 'required',
            'status' => 'required',
            'ticket_message' => 'required|string|max:50'
        ]);

        // Ticket::update($request->all());

        //find email thotugh this 
        // $data=$ticket->user;

        $ticket->update($request->all());


        // dd($data);  

        $tickets = $ticket->save();

        //    dump($tickets);
        // $tickets->notify(new WhenTicketStatusChangeNotification());

        // $users = User::select('users.email')
        //     ->join('tickets', 'tickets.user_id', '=', 'users.id')
        //     ->get();

        //     dd($users);

        // Mail::to($tickets->users()->email)->send(new testMail($users));
        // // Notification::send($tickets, new WhenTicketStatusChangeNotification($tickets));
        Event::dispatch(new SendMail($tickets));

        // Event::dispatch(new TicketStatusChangeEvent($tickets));


        return redirect()->route('tickets.index')->with('success', 'Ticket Updated Sucessfully');
    }

    /**
     * Remove the specified resource from storage.
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */


    /**
     * THIS METHOD CAN DELETE SPECIFIC TICKET
     */

    public function destroy(Ticket $ticket)
    {
        //
        $ticket->delete();
        return redirect()->route('tickets.index')->with('success', 'ticket deleted successfully.');
    }

    public function indexAdmin(Ticket $tickets, Request $request)
    {

        $tickets = Ticket::select('*')->sortable();


        //search for id
        if ($request->has('searchId') && $request->searchId != null) {
            $tickets = $tickets->where('id', $request->searchId);
        }

        //search for user name
        if ($request->has('searchUserName') && $request->searchUserName != null) {

            $tickets = $tickets->where('user_id', $request->searchUserName);
        }
        //search for ticket_name
        if ($request->has('searchName') && $request->searchName != null) {
            $tickets = $tickets->where('ticket_name', 'like', $request->searchName);
        }

        //search for status
        if ($request->has('searchStatus') && $request->searchStatus != null) {
            $tickets = $tickets->where('status', $request->searchStatus);
        }

        //search for priority
        if ($request->has('searchPriority') && $request->searchPriority != null) {
            $tickets = $tickets->where('priority', $request->searchPriority);
        }

        //search for ticket_message
        if ($request->has('searchMessage') && $request->searchMessage != null) {
            $tickets = $tickets->where('ticket_message', $request->searchMessage);
        }


        $tickets = $tickets->paginate(5);

        return view('tickets.indexAdmin', compact('tickets'));
    }
}
