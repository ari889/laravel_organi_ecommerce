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
                    <h5 class="mb-0 text-info">Categories</h5>
                    <a href="{{ route('admin.addcategory') }}" class="btn btn-success btn-sm ms-auto">Add Category/SubCategory</a>
                </div>
                <hr>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Category Name</th>
                            <th>Category slug</th>
                            <th>Sub Category</th>
                            <th>Created At</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                        <tr>
                            <td>{{ $categories->firstItem()+$loop->index }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->slug }}</td>
                            <td>
                                <ul>
                                    @foreach($category->subcategories as $subcategory)
                                    <li class="list-unstyled">
                                        <i class="lni lni-angle-double-right me-2" style="font-size: 10px;"></i>{{ $subcategory->name }}
                                        <a href="{{ route('admin.editsubcategory', ['id' => $subcategory->id]) }}" class="text-primary ms-2">Edit</a>
                                        <a href="javascript:;" class="text-danger" onclick="return confirm('Are you sure to delete?') || event.stopImmediatePropagation();" wire:click.prevent="deleteSubcategory({{ $subcategory->id }})">Delete</a>
                                    </li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>{{ $category->created_at->diffForHumans(); }}</td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="{{ route('admin.editcategory', ['id' => $category->id]) }}" class="btn btn-warning">Edit</a>
                                    <a href="javascript:;" class="btn btn-danger" onclick="return confirm('Are you sure to delete?') || event.stopImmediatePropagation();;" wire:click.prevent="deleteCategory({{ $category->id }})">Delete</a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $categories->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>
