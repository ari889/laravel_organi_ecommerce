

<div>
    <style>
        .dropify-wrapper .dropify-message p {
            font-size: 16px;
        }
    </style>
    @include('backend.includes.breadcrumb', ['page_title' => $page_title])

    @if(Session::has('message'))
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        Toast.fire({
            icon: 'success',
            title: '{{ Session::get("message") }}'
        })

    </script>
    @endif

    <div class="card border-top border-0 border-4 border-info">
        <div class="card-body">
            <div class="border p-4 rounded">
                <div class="card-title d-flex align-items-center">
                    <div><i class="bx bxs-category me-1 font-22 text-info"></i>
                    </div>
                    <h5 class="mb-0 text-info">Order "{{ $order->id }}"</h5>
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-success btn-sm ms-auto">Back</a>
                </div>
                <hr>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h3>Order  Details</h3>
                                    </div>
                                    <div class="col-md-6">
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped">
                                    <tr>
                                        <th>Order Id</th>
                                        <td>{{ $order->id }}</td>
                                        <th>Order Date</th>
                                        <td>{{ $order->created_at }}</td>
                                        <th>Status</th>
                                        <td>{{ $order->status }}</td>
                                        @if($order->status == 'delivered')
                                            <th>Delivery Date</th>
                                            <td>{{ $order->delivered_date }}</td>
                                        @elseif($order->status == 'cancel')
                                            <th>Cancellation Date</th>
                                            <td>{{ $order->cancel_date }}</td>
                                        @endif
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h3>Order Items</h3>
                                    </div>
                                    <div class="col-md-6">

                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="wrap-iten-in-cart">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Image</th>
                                                <th>Product name</th>
                                                <th>Attribute</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($order->orderItems as $item)
                                            <tr>
                                                <td><img width="100" src="storage/{{ json_decode($item->product->image)[0] }}" alt="{{ $item->product->name }}"></td>
                                                <td><a class="link-to-product" href="{{ route('product.detail', ['slug' => $item->product->slug]) }}">{{ $item->product->name }}</a></td>
                                                <td>
                                                    @if($item->options)
                                                    <div class="product-name">
                                                        @foreach(unserialize($item->options) as $key=>$value)
                                                        <p><b>{{ $key }} : </b> {{ $value }}</p>
                                                        @endforeach
                                                    </div>
                                                    @else
                                                    <p>No attribute selected</p>
                                                    @endif
                                                </td>
                                                <td>{{ $item->price }}</td>
                                                <td>{{ $item->quantity }}</td>
                                                <td>{{ $item->price * $item->quantity }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="summary">
                                    <div class="order-summary">
                                        <h4 class="title-box">Order Summary</h4>
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Option</th>
                                                    <th class="">Value</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Subtotal</td>
                                                    <td><b class="index">${{ $order->subtotal }}</b></td>
                                                </tr>
                                                <tr>
                                                    <td>Tax</td>
                                                    <td><b class="index">${{ $order->tax }}</b></td>
                                                </tr>
                                                <tr>
                                                    <td>Shipping</td>
                                                    <td><b class="index text-danger">Free Shipping</b></td>
                                                </tr>
                                                <tr>
                                                    <td>Total</td>
                                                    <td><b class="index">${{ $order->total }}</b></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                Billing Details
                            </div>
                            <div class="card-body">
                                <table class="table table-striped">
                                    <tr>
                                        <th>First Name</th>
                                        <td>{{ $order->firstname }}</td>
                                        <th>Last Name</th>
                                        <td>{{ $order->lastname }}</td>
                                    </tr>
                                    <tr>
                                        <th>Phone</th>
                                        <td>{{ $order->mobile }}</td>
                                        <th>Email</th>
                                        <td>{{ $order->email }}</td>
                                    </tr>
                                    <tr>
                                        <th>Line1</th>
                                        <td>{{ $order->line1 }}</td>
                                        <th>Line2</th>
                                        <td>{{ $order->line2 }}</td>
                                    </tr>
                                    <tr>
                                        <th>City</th>
                                        <td>{{ $order->city }}</td>
                                        <th>Province</th>
                                        <td>{{ $order->province }}</td>
                                    </tr>
                                    <tr>
                                        <th>Country</th>
                                        <td>{{ $order->country }}</td>
                                        <th>Zip-Code</th>
                                        <td>{{ $order->zipcode }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                @if($order->is_shipping_different)
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                Shipping Details
                            </div>
                            <div class="card-body">
                                <table class="table table-striped">
                                    <tr>
                                        <th>First Name</th>
                                        <td>{{ $order->shipping->firstname }}</td>
                                        <th>Last Name</th>
                                        <td>{{ $order->shipping->lastname }}</td>
                                    </tr>
                                    <tr>
                                        <th>Phone</th>
                                        <td>{{ $order->shipping->mobile }}</td>
                                        <th>Email</th>
                                        <td>{{ $order->shipping->email }}</td>
                                    </tr>
                                    <tr>
                                        <th>Line1</th>
                                        <td>{{ $order->shipping->line1 }}</td>
                                        <th>Line2</th>
                                        <td>{{ $order->shipping->line2 }}</td>
                                    </tr>
                                    <tr>
                                        <th>City</th>
                                        <td>{{ $order->shipping->city }}</td>
                                        <th>Province</th>
                                        <td>{{ $order->shipping->province }}</td>
                                    </tr>
                                    <tr>
                                        <th>Country</th>
                                        <td>{{ $order->shipping->country }}</td>
                                        <th>Zip-Code</th>
                                        <td>{{ $order->shipping->zipcode }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                Transection Details
                            </div>
                            <div class="card-body">
                                <table class="table table-stripped">
                                    <tr>
                                        <th>Transection Mode</th>
                                        <td>{{ $order->transection->mode }}</td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td>{{ $order->transection->status }}</td>
                                    </tr>
                                    <tr>
                                        <th>Transection Date</th>
                                        <td>{{ $order->transection->created_at }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
