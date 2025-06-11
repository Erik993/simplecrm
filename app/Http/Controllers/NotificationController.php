<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\User;
use App\Mail\NotifyHead;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function notifyHeads()
    {
        $message = "Important update for all heads.";

        $pendingStatusId = OrderStatus::where('status', 'Pending')->value('id');

        if (!$pendingStatusId) {
            return back()->with('error', 'No order with pending statuses');
        }
        // Load orders with that status, including their clients
        $pendingOrders = Order::where('order_status_id', $pendingStatusId)
            ->with('client')->get();

        $heads = User::where('role', 'head')->get();
        //$pendingOrders = Order::where('status', 'pending')->with('client')->get();

        foreach ($heads as $head) {
            Mail::to($head->email)->send(new NotifyHead($pendingOrders));
        }

        return back()->with('success', 'Emails sent to all heads!');
    }
}
