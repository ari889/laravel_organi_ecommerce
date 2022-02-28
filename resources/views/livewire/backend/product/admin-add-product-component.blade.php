@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" integrity="sha512-EZSUkJWTjzDlspOoPSpUFR0o0Xy7jdzW//6qhUkoZ9c4StFkVsp9fbbd0O06p9ELS3H486m4wmrCELjza4JEog==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush
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
                    <h5 class="mb-0 text-info">Add Product</h5>
                    <a href="{{ route('admin.product') }}" class="btn btn-success btn-sm ms-auto">Back</a>
                </div>
                <hr>
                <form enctype="multipart/form-data" wire:submit.prevent="addProduct">
                    <div class="row">
                        <div class="col-xl-9 col-md-7">
                            <div class="mb-3">
                                <label for="name" class="form-label">Product Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Enter product name" wire:model="name" wire:keyup="generateSlug">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                @if($slug)
                                <p class="mb-3 mt-3"><strong>Slug:</strong> {{ $slug }}</p>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <div wire:ignore>
                                    <textarea id="description" cols="30" rows="10" class="form-control" placeholder="Enter product description"></textarea>
                                </div>
                                @error('description')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="short_description" class="form-label">Short Description</label>
                                <div wire:ignore>
                                    <textarea id="short_description" cols="30" rows="5" class="form-control" placeholder="Enter product short description"></textarea>
                                </div>
                                @error('short_description')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="regular_price" class="form-label">Regular Price</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">$</span>
                                            <input type="text" class="form-control @error('regular_price') is-invalid @enderror" wire:model="regular_price" placeholder="Regular Price" id="regular_price">
                                            @error('regular_price')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="regular_price" class="form-label">Sale Price</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">$</span>
                                            <input type="text" class="form-control @error('sale_price') is-invalid @enderror" wire:model="sale_price" placeholder="Sale Price" id="regular_price">
                                            @error('sale_price')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="sku" class="form-label">SKU (Shop Keeping Unit)</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text">organi_</span>
                                    <input type="text" class="form-control @error('sku') is-invalid @enderror" wire:model="sku" placeholder="SKU" id="sku">
                                    @error('sku')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="stock_status" class="form-label">Stock Status</label>
                                <select class="form-select @error('stock_status') is-invalid @enderror" id="stock_status" wire:model="stock_status">
                                    <option value="">--Select Stock--</option>
                                    <option value="instock">In Stock</option>
                                    <option value="outofstock">Out Of Stock</option>
                                </select>
                                @error('stock_status')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="featured" class="form-label">Featured</label>
                                <select class="form-select @error('featured') is-invalid @enderror" id="featured" wire:model="featured">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                                @error('featured')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="quantity" class="form-label">Quantity</label>
                                <input type="text" class="form-control @error('quantity') is-invalid @enderror" wire:model="quantity" placeholder="Product quantity">
                                @error('quantity')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-5">
                            <div class="mb-3">
                                <label for="image" class="form-label">Product Image</label>
                                <div wire:ignore>
                                    <input type="file" class="dropify" id="product_image" wire:model="image" data-height="300" data-max-file-size="3M" data-allowed-file-extensions="jpg png jpeg gif">
                                </div>
                                @error('image')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="images" class="form-label">Gallery Images</label>
                                <input type="file" id="images" wire:model="images" class="form-control @error('images') is-invalid @enderror" multiple>
                                @if($images)
                                <div class="row mt-3">
                                    @foreach($images as $image)
                                    <div class="col-sm-6">
                                        <img src="{{ $image->temporaryUrl() }}" class="img-fluid py-2" alt="">
                                    </div>
                                    @endforeach
                                </div>
                                @endif

                                @error('images')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="category_id" class="form-label">Category</label>
                                <select class="form-select @error('category_id') is-invalid @enderror" id="category_id" wire:model="category_id">
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
                            <button type="submit" class="btn btn-success">Publish</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js" integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function(){

        /**
        * upload product image
        */
        $('.dropify').dropify({
            messages: {
                'default': 'Drag and drop product image here',
                'replace': 'Drag and drop or click to replace',
                'remove':  'Remove',
                'error':   'Ooops, something wrong happended.'
            },
            error: {
                'fileSize': 'The file size is too big (3M max).',
                'imageFormat': 'The image format is not allowed (jpg png jpeg gif only).'
            }
        });

        // $('#product_image').on('change', function(){
        //     let image = $(this).val();
        //     @this.set('image', image)
        // })

        /**
        * tinymnc editor for description and short description
        */
        tinymce.init({
            selector : '#description',
            setup : function(editor){
                editor.on('change', function(){
                    tinyMCE.triggerSave();
                    let sd_data = $('#description').val();
                    @this.set('description', sd_data)
                })
            }
        })

        tinymce.init({
            selector : '#short_description',
            setup : function(editor){
                editor.on('change', function(){
                    tinyMCE.triggerSave();
                    let d_data = $('#short_description').val();
                    @this.set('short_description', d_data)
                })
            }
        })
    });
</script>
@endpush

