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
                    <h5 class="mb-0 text-info">Add Category</h5>
                    <a href="{{ route('admin.category') }}" class="btn btn-success btn-sm ms-auto">Back</a>
                </div>
                <hr>
                <form wire:submit.prevent="addCategoryOrSubcategory" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="" class="form-label">Image</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror" wire:model="image">
                        @error('image')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        @if($image)
                            <img src="{{ $image->temporaryUrl() }}" class="mt-2" width="200" alt="">
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter name" wire:model="name" wire:keyup="generateSlug" />
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    @if($slug)
                        <div class="mb-3">
                            <p><b>Slug: </b> {{ $slug }}</p>
                        </div>
                    @endif
                    <div class="mb-3">
                        <label for="name" class="form-label">Category</label>
                        <select id="category_id" class="form-control @error('category_id') is-invaid @enderror" wire:model="category_id">
                            <option value="">--Select Category--</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
