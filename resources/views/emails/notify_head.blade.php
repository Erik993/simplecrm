<!DOCTYPE html>
<html>
<head>
    <title>Important Update</title>
</head>
<body>
<h2>Pending Orders Report</h2>

@if($orders->isEmpty())
    <p>There are no pending orders at the moment.</p>
@else
    <ul>
        @foreach($orders as $order)
            <li>
                <strong>{{ $order->title }}</strong><br>
                Client: {{ $order->client->name ?? 'Unknown' }}<br>
                Amount: €{{ $order->amount }}<br>
            </li>
        @endforeach
    </ul>
@endif

<p>Best regards,<br>SimpleCRM Team</p>
</body>
</html>
