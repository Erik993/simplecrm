<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\ClientStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class ClientController extends Controller
{
    use SoftDeletes;
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */

    public function myClients(){
        $user = Auth::user();
        $clients = Client::with('status', 'user', 'notes', 'tasks.status', 'orders.status')->
            where('user_id', $user->id)->get();

        $ClientStatuses = ClientStatus::all();
        return view('pages.clients.index', compact('clients', 'ClientStatuses'));

    }


    public function index(Request $request)
    {
        $ClientStatuses = ClientStatus::all();

        //$clients = Client::all();
        $clients = Client::with('status', 'user', 'notes', 'tasks.status', 'orders.status')->
            when($request->filled('status_id') && $request->status_id !== '', function($query) use ($request){
                $query->where('client_status_id', $request->status_id);})->get();
        return view('pages.clients.index', compact('clients', 'ClientStatuses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Client::class);

        $users = User::all();
        $clientStatuses = ClientStatus::all();
        return view('pages.clients.create', compact('clientStatuses', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $data = $request->validate([
            'name' => 'required|string|max:255|regex:/^[a-zA-Z\s\-]+$/',
            'email' => 'nullable|email|max:50|unique:clients,email',
            'company_name' => 'nullable|string|max:255',
            'phone' => 'required|string|max:30|regex:/^\+?[0-9\s\-]+$/',
            'client_status_id' => 'required|exists:client_statuses,id',
            'user_id' => 'required|exists:users,id',
        ], [
        'name.required' => 'Client name is required.',
        'name.regex' => 'Client name may only contain letters, spaces, and dashes.',
]);
        //$data['user_id'] = 1;
        Client::create($data);
        return redirect()->route('clients.index')->with('success', 'Client created!');
    }

    /**
     * Display the specified resource.
     */
    // Client $client is the same as $client = Client::findorFail($id);
    public function show(Client $client)
    {
        //$client = Client::findorFail($id);
        return view('pages.clients.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        $this->authorize('update', $client);
        $users = User::all();
        $clientStatuses = ClientStatus::all();
        return view('pages.clients.edit', compact('client', 'users', 'clientStatuses'));

        /*
        $employees = Employee::with('user')->get();
        $clientStatuses = ClientStatus::all();
        return view('pages.clients.edit', compact('client', 'employees', 'clientStatuses'));*/
    }

    /**
     * Update the specified resource in storage.
     */
    //public function update(Request $request, string $id)
    public function update(Client $client)
    {
        $this->authorize('update', $client);
        $data = request()->validate([
            'name' => 'required|string|max:255|regex:/^[a-zA-Z\s\-]+$/',
            'email' => ['nullable', 'email', 'max:50',
                Rule::unique('clients')->ignore($client->id),
            ],
            'company_name' => 'nullable|string|max:255',
            'phone' => 'required|string|max:30|regex:/^\+?[0-9\s\-]+$/',
            'client_status_id' => 'required|exists:client_statuses,id',
            'user_id' => 'required|exists:users,id',
        ], [
            'name.required' => 'Client name is required.',
            'name.regex' => 'Client name may only contain letters, spaces, and dashes.',
        ]);

        $client->update($data);
        return redirect()->route('clients.show', $client->id)->with('success', 'Client updated!');
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(Client $client)
    {
        $this->authorize('delete', $client); // Uses ClientPolicy::delete()

        $client->delete();
        return redirect()->route('clients.index')->with('success', 'Client deleted!');
    }
}
