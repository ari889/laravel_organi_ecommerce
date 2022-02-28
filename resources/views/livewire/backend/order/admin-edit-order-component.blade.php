

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
                    <h5 class="mb-0 text-info">Order "{{ $order_id }}"</h5>
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-success btn-sm ms-auto">Back</a>
                </div>
                <hr>

                <form wire:submit.prevent="updateOrder">
                    <div class="mb-3">
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
                                @foreach($orderItems as $item)
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
                    <h5>Billing Address</h5>
                    <div class="mb-3">
                        <label for="mobile" class="form-label">Mobile</label>
                        <input type="text" id="mobile" class="form-control @error('mobile') is-invalid @enderror" placeholder="Mobile" wire:model="mobile">
                        @error('mobile')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" wire:model="email">
                        @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="line1" class="form-label">Address line 1</label>
                        <input type="text" id="line1" class="form-control @error('line1') is-invalid @enderror" placeholder="Address line 1" wire:model="line1">
                        @error('line1')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="line2" class="form-label">Address line 2</label>
                        <input type="text" id="line2" class="form-control @error('line2') is-invalid @enderror" placeholder="Address line 2" wire:model="line2">
                        @error('line2')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="country" class="form-label">Country</label>
                        <input type="text" id="country" class="form-control @error('country') is-invalid @enderror" placeholder="Country" wire:model="country">
                        @error('country')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="city" class="form-label">City</label>
                        <input type="text" id="city" class="form-control @error('city') is-invalid @enderror" placeholder="City" wire:model="city">
                        @error('city')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="province" class="form-label">Province</label>
                        <input type="text" id="province" class="form-control @error('province') is-invalid @enderror" placeholder="Province" wire:model="province">
                        @error('province')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="zipcode" class="form-label">Zipcode</label>
                        <input type="text" id="zipcode" class="form-control @error('zipcode') is-invalid @enderror" placeholder="Zipcode" wire:model="zipcode">
                        @error('zipcode')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select wire:model="status" class="form-select @error('status') is-invalid @enderror" id="status">
                            <option value="ordered">Ordered</option>
                            <option value="delivered">Delivered</option>
                        </select>
                        @error('status')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" value="1" wire:model="is_shipping_different" id="is_shipping_different">
                        <label class="form-check-label" for="is_shipping_different">
                          Ship to different address
                        </label>
                      </div>
                    @if($is_shipping_different)
                    <h5>Shipping Address</h5>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="mobile" class="form-label">First Name</label>
                                <input type="text" class="form-control @error('s_firstname') is-invalid @enderror" placeholder="First name" wire:model="s_firstname">
                                @error('s_firstname')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="mobile" class="form-label">Last Name</label>
                                <input type="text" class="form-control @error('s_lastname') is-invalid @enderror" placeholder="Last name" wire:model="s_lastname">
                                @error('s_lastname')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="mobile" class="form-label">Mobile</label>
                        <input type="text" class="form-control @error('s_mobile') is-invalid @enderror" placeholder="Mobile" wire:model="s_mobile">
                        @error('s_mobile')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="mobile" class="form-label">Email</label>
                        <input type="text" class="form-control @error('s_email') is-invalid @enderror" placeholder="Email" wire:model="s_email">
                        @error('s_email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="mobile" class="form-label">Address line 1</label>
                        <input type="text" class="form-control @error('s_line1') is-invalid @enderror" placeholder="Address line 1" wire:model="s_line1">
                        @error('s_line1')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="mobile" class="form-label">Address line 2</label>
                        <input type="text" class="form-control @error('s_line2') is-invalid @enderror" placeholder="Address line 2" wire:model="s_line2">
                        @error('s_line2')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="mobile" class="form-label">Country</label>
                        <input type="text" class="form-control @error('s_country') is-invalid @enderror" placeholder="Country" wire:model="s_country">
                        @error('s_country')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="mobile" class="form-label">City</label>
                        <input type="text" class="form-control @error('s_city') is-invalid @enderror" placeholder="City" wire:model="s_city">
                        @error('s_city')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="mobile" class="form-label">Province</label>
                        <input type="text" class="form-control @error('s_province') is-invalid @enderror" placeholder="Province" wire:model="s_province">
                        @error('s_province')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="mobile" class="form-label">Zipcode</label>
                        <input type="text" class="form-control @error('s_zipcode') is-invalid @enderror" placeholder="Zipcode" wire:model="s_zipcode">
                        @error('s_zipcode')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    @endif
                    <button type="submit" class="btn btn-success">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
