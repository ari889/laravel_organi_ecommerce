
@push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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
                    <h5 class="mb-0 text-info">Manage Home Categories</h5>
                </div>
                <hr>
                <form wire:submit.prevent="updateHomeCategories">
                    <div class="mb-3" wire:ignore>
                        <label for="code" class="form-label">Choose Categories</label>
                        <select multiple id="categories" class="form-control @error('selected_categories') is-invalid @enderror" wire:model="selected_categories">
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('selected_categories')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="no_products" class="form-label">No of products</label>
                        <input type="text" class="form-control @error('noofproducts') is-invalid @enderror" placeholder="No of product" wire:model="noofproducts">
                        @error('noofproducts')
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
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function(){
        $('#categories').select2();
        $('#categories').on('change', function(){
            var data = $('#categories').select2('val');
            @this.set('selected_categories', data);
        });
    });
</script>
@endpush

