@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" integrity="sha512-aEe/ZxePawj0+G2R+AaIxgrQuKT68I28qh+wgLrcAJOz3rxCP+TwrK5SPN+E5I+1IQjNtcfvb96HDagwrKRdBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush
<div>
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
                    <h5 class="mb-0 text-info">Edit "{{ $code }}"</h5>
                    <a href="{{ route('admin.coupons') }}" class="btn btn-success btn-sm ms-auto">Back</a>
                </div>
                <hr>
                <form wire:submit.prevent="updateCoupon">
                    <div class="mb-3">
                        <label for="code" class="form-label">Coupon Code</label>
                        <input type="text" class="form-control @error('code') is-invalid @enderror" placeholder="Enter product name" wire:model="code">
                        @error('code')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="type" class="form-label">Discount Type</label>
                        <select id="type" class="form-select @error('type') is-invalid @enderror" wire:model="type">
                            <option value="">--Discount Type--</option>
                            <option value="fixed">Fixed</option>
                            <option value="percent">Percent</option>
                        </select>
                        @error('type')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="value" class="form-label">Coupon Value</label>
                        <input type="text" class="form-control @error('value') is-invalid @enderror" placeholder="Enter product name" wire:model="value">
                        @error('value')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="cart_value" class="form-label">Cart Value</label>
                        <input type="text" class="form-control @error('cart_value') is-invalid @enderror" placeholder="Enter product name" wire:model="cart_value">
                        @error('cart_value')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="expiry_date" class="form-label">Expiry Date</label>
                        <input type="text" id="expiry_date" wire:model="expiry_date" class="form-control @error('expiry_date') is-invalid @enderror" placeholder="Enter product name" wire:model="expiry_date">
                        @error('expiry_date')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-success">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js" integrity="sha512-GDey37RZAxFkpFeJorEUwNoIbkTwsyC736KNSYucu1WJWFK9qTdzYub8ATxktr6Dwke7nbFaioypzbDOQykoRg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(function(){
        $('#expiry_date').datetimepicker({
            format : 'Y-MM-DD'
        })
        .on('dp.change', function(ev){
            var data = $('#expiry_date').val();
            @this.set('expiry_date', data);
        })
    })
</script>
@endpush

