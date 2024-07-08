<!DOCTYPE html>
<html>

<head>
    <title>Order Report</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>

<body>
    <h1>Order Report</h1>
    <h3>From: {{ $from }} To: {{ $to }}</h3>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Menu Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orderDetails as $orderDetail)
            <tr>
                <td>{{ $orderDetail->id }}</td>
                <td>{{ $orderDetail->menu->name }}</td>
                <td>{{ number_format($orderDetail->price, 0, ',', '.') }}</td>
                <td>{{ $orderDetail->qty }}</td>
                <td>{{ number_format($orderDetail->total, 0, ',', '.') }}</td>
                <td>{{ $orderDetail->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h3>Revenue: Rp{{ number_format($revenue, 0, ',', '.') }}</h3>
</body>

</html>