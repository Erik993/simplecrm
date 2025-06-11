<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\TaskStatus;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    use SoftDeletes;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $statuses = OrderStatus::all();
        $ordersByStatus = Order::with(['client', 'status'])
            ->orderBy('finished_at', 'desc')
            ->get()
            ->groupBy('order_status_id');

        return view('pages.orders.index', compact('statuses', 'ordersByStatus'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $clientId = $request->query('client_id');
        $client = $clientId ? Client::find($clientId) : null;

        $statuses = OrderStatus::all();

        return view('pages.orders.create', compact('client', 'clientId', 'statuses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedOrder = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'order_status_id' => 'required|exists:order_statuses,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'amount' => 'nullable|numeric|min:0',
            'finished_at' => 'nullable|date',
        ]);

        $order = Order::create($validatedOrder);

        return redirect()->route('clients.show', $order->client_id)->with('success', 'Order created!');

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $order = Order::with('client', 'status')->findOrFail($id);
        return view('pages.orders.show', compact('order'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $order = Order::findOrFail($id);
        $statuses = OrderStatus::all();

        return view('pages.orders.edit', compact('order', 'statuses'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'client_id' => 'required|exists:clients,id',
            'user_id' => 'required|exists:users,id',
            'status' => 'required|string|max:100',
            'due_date' => 'required|date',
        ]);

        $order->update($validated);

        return redirect()->route('pages.orders.index')->with('success', 'Order updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Order $order)
    {
        $order->delete();

        if ($request->has('client_id')) {
            return redirect()->route('clients.show', $request->input('client_id'))
                ->with('success', 'Order deleted.');
        }

        return redirect()->route('clients.show', $order->client_id)->with('success', 'Order deleted!');
    }
}
