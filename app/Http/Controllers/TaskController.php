<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Order;
use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::with('order','client', 'status', 'user')->latest()->get();
        return view('pages.tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $clientId = $request->query('client_id');
        $orderId = $request->query('order_id');

        $client = $clientId ? Client::find($clientId) : null;
        $order = $orderId ? Order::find($orderId) : null;

        $clients = Client::all();
        $orders = Order::all();
        $users = User::all();
        $statuses = TaskStatus::all();

        return view('pages.tasks.create', compact(
            'client', 'clientId',
            'order', 'orderId',
            'clients', 'orders',
            'users', 'statuses'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated_task = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'user_id' => 'required|exists:users,id',
            'task_status_id' => 'required|exists:task_statuses,id',
            'due_date' => 'required|date',
            'client_id' => 'required_without:order_id|nullable|exists:clients,id',
            'order_id' => 'required_without:client_id|nullable|exists:orders,id',
        ]);
        $task = Task::create($validated_task);

        if ($request->has('client_id')) {
            return redirect()->route('clients.show', $request->input('client_id'))
                ->with('success', 'Task created and linked to client!');
        }

        if ($request->has('order_id')) {
            return redirect()->route('orders.show', $request->input('order_id'))
                ->with('success', 'Task created and linked to order!');
        }

        return redirect()->route('tasks.index')->with('success', 'Task created!');

    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return view('pages.tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        $clients = Client::all();
        $orders = Order::all();
        $users = User::all();
        $statuses = TaskStatus::all();
        return view('pages.tasks.edit', compact('task', 'clients', 'orders', 'users', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'user_id' => 'required|exists:users,id',
            'task_status_id' => 'required|exists:task_statuses,id',
            'due_date' => 'required|date',
            'client_id' => 'required_without:order_id|nullable|exists:clients,id',
            'order_id' => 'required_without:client_id|nullable|exists:orders,id',
        ]);

        $task->update($validated);

        if ($request->has('client_id')) {
            return redirect()->route('clients.show', $request->input('client_id'))
                ->with('success', 'Task updated.');
        }

        return redirect()->route('tasks.index')->with('success', 'Task updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Task $task)
    {
        $task->delete();

        if ($task->client_id) {
            return redirect()->route('clients.show', $task->client_id)->with('success', 'Task deleted.');
        }
        if ($task->order_id) {
            return redirect()->route('orders.show', $task->order_id)->with('success', 'Task deleted.');
        }

        return redirect()->route('tasks.index')->with('success', 'Task deleted.');
    }
}
