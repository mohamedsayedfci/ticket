<?php

namespace App\Http\Controllers\Dashboard;



use App\Ticket;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Notification;
use App\Notifications\TicketCreated;
use App\Notifications\changeStatus;
class TicketController extends Controller
{
    public function index(Request $request)
    {
        if(!auth()->user()->hasRole('users')) {
            $tickets = Ticket::when($request->from_date && $request->to_date, function ($q) use ($request) {

                return $q->whereBetween('deadline', array($request->from_date, $request->to_date));

            })->get();
        }
        else{
            $tickets = Ticket::when($request->from_date && $request->to_date, function ($q) use ($request) {

                return $q->whereBetween('deadline', array($request->from_date, $request->to_date));

            })->where('user_id', auth()->id())->get();

        }

            return view('dashboard.tickets.index', compact('tickets'));

    }//end of index

    public function create()
    {
        $user = DB::table('users')->get();
        return view('dashboard.tickets.create',compact('user'));

    }//end of create

    public function store(Request $request)
    {

        $rules = [
            'user_id' => 'required',
            'ticket_by' => 'required',
            'ticket_price' => 'required|numeric',
            'date' => 'required|date',
            'deadline' => 'required|date',
        ];

        foreach (config('translatable.locales') as $locale) {

            $rules += [$locale . '.name' => ['required', Rule::unique('ticket_translations', 'name')]];

        }//end of for each

        $request->validate($rules);


       $ticket= Ticket::create($request->all());
        $user=User::find($ticket->user_id);


       Notification::send($user, new TicketCreated($user));
        session()->flash('success', __('site.added_successfully'));


        return redirect()->route('dashboard.tickets.index');


    }//end of store

    public function edit(Ticket $ticket)
    {
        return view('dashboard.tickets.edit', compact('ticket'));

    }//end of edit
    public function changeStatus($ticket)
    {
        $id=Ticket::find($ticket);
        $id->update(['active'=>'1']);
        $user=User::find($id->user_id);


        Notification::send($user, new changeStatus($user));
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.tickets.index');

    }//end of edit

    public function update(Request $request, Ticket $ticket)
    {
        $rules = [];

        foreach (config('translatable.locales') as $locale) {

            $rules += [$locale . '.name' => ['required', Rule::unique('ticket_translations', 'name')->ignore($ticket->id, 'ticket_id')]];

        }//end of for each

        $request->validate($rules);

        $ticket->update($request->all());

        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.tickets.index');

    }//end of update

    public function destroy(Ticket $ticket)
    {
        $ticket->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.tickets.index');

    }//end of destroy

}//end of controller
