<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order Confirmation</title>
</head>
<body>
    Hi, {{ $order->firstname }} {{ $order->lastname }}

    <p>Your order has been successfully placed</p>

    <table style="width: 600px;text-align:center;">
        <thead>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Quantity</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->orderItems as $item)
            <tr>
                <td><img src="{{ asset('storage/'.json_decode($item->product->image)[0]) }}" alt=""></td>
                <td>{{ $item->product->name }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ $item->price * $item->quantity }}</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="3" style="border-top: 1px solid #ccc;"></td>
                <td style="font-size: 15px;font-weight: bold;border-top: 1px solid #ccc;">Subtotal: ${{ $order->subtotal }}</td>
            </tr>

            <tr>
                <td colspan="3" style="border-top: 1px solid #ccc;"></td>
                <td style="font-size: 15px;font-weight: bold;border-top: 1px solid #ccc;">Tax: ${{ $order->tax }}</td>
            </tr>
            <tr>
                <td colspan="3" style="border-top: 1px solid #ccc;"></td>
                <td style="font-size: 15px;font-weight: bold;border-top: 1px solid #ccc;">Shipping: Free shipping</td>
            </tr>
            <tr>
                <td colspan="3" style="border-top: 1px solid #ccc;"></td>
                <td style="font-size: 15px;font-weight: bold;border-top: 1px solid #ccc;">Total: ${{ $order->total }}</td>
            </tr>
        </tbody>
    </table>
</body>
</html>
