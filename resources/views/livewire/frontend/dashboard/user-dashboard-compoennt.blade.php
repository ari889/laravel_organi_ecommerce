<div>
    <div class="container">
        <table class="table table-striped">
            <thead class>
                <tr>
                    <th>SL</th>
                    <th>OrderId</th>
                    <th>Suntotal</th>
                    <th>Discount</th>
                    <th>Tax</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Order Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr>
                    <td>{{ $orders->firstItem()+$loop->index }}</td>
                    <td>{{ $order->id }}</td>
                    <td>${{ $order->subtotal }}</td>
                    <td>${{ $order->discount }}</td>
                    <td>${{ $order->tax }}</td>
                    <td>${{ $order->total }}</td>
                    <td>
                        @if($order->status == 'ordered')
                        <span class="badge badge-info badge-pill">Ordered</span>
                        @elseif($order->status == 'delivered')
                        <span class="badge badge-success badge-pill">delivered</span>
                        @else
                        <span class="badge badge-danger badge-pill">Cancel</span>
                        @endif
                    </td>
                    <td>{{ $order->created_at->diffForHumans() }}</td>
                    <td>
                        <a href="{{ route('user.order', ['id' => $order->id]) }}" class="btn btn-info"><i class="fa fa-eye"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $orders->links("pagination::bootstrap-4") }}
    </div>
</div>
