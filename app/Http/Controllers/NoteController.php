<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Note;
use App\Models\Order;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notes = Note::with('client', 'order')->latest()->get();
        return view('pages.notes.index', compact('notes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request) // create should be only in task or client show
    {
        $clientId = $request->query('client_id');
        if($clientId){
            $client = Client::find($clientId);
        }else $client = null;

        $orderId = $request->query('order_id');
        if($orderId){
            $order = Order::find($orderId);
        }else $order = null;

        return view('pages.notes.create', compact('clientId', 'client', 'orderId', 'order'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
            'client_id' => 'nullable|exists:clients,id',
            'order_id' => 'nullable|exists:orders,id',
        ]);

        if (!$request->client_id && !$request->order_id) {
            return back()->withErrors('A note must be linked to either a client or an order.');
        }

        $note = Note::create($request->only('content', 'client_id', 'order_id'));

        if ($note->client_id) {
            return redirect()->route('clients.show', $note->client_id)->with('success', 'Note created!');
        }

        if ($note->order_id) {
            return redirect()->route('orders.show', $note->order_id)->with('success', 'Note created!');
        }

        return redirect()->route('notes.index')->with('success', 'Note created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {
        return view('pages.notes.show', compact('note'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Note $note)
    {
        $client = $note->client ?? null;
        $order = $note->order ?? null;
        return view('pages.notes.edit', compact('note', 'client', 'order'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Note $note)
    {
        $validated_note = $request->validate([
            'content' => 'required|string|max:1000',
            'client_id' => 'nullable|exists:clients,id',
            'order_id' => 'nullable|exists:orders,id',
        ]);
        $note->update($validated_note);
        return redirect()->route('notes.show', $note->id)->with('success', 'Note updated!');
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(Request $request, Note $note)
    {
        $note->delete();

        if ($request->has('client_id')) {
            return redirect() ->route('clients.show', $request->input('client_id'))
                ->with('success', 'Note deleted.');
        }

        return redirect() -> route('notes.index') -> with('success', 'Note deleted!');
    }


    //destroy with AJAX
/*public function destroy(Request $request, Note $note)
    {

        $note->delete();
        dd('Deleted');
        if ($request->ajax()) {
            return response()->json(['success' => true]);
        }

        if ($request->has('client_id')) {
            return redirect()->route('clients.show', $request->input('client_id'))->with('success', 'Note deleted.');
        }

        return redirect()->route('clients.show', $note->client_id)->with('success', 'Note deleted.');
    }*/
}
