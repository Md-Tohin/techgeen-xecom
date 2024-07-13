@extends('admin.admin-master')

@section('title', 'Brand List - ' . env('APP_NAME'))

@section('content')
    <!-- Role cards -->
    <div class="row">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h4 class="">Category List</h4>
            @if (Auth::user()->can('category.create'))
                <a href="{{ route('categories.create') }}" class="btn btn-success "> <i class="ti ti-plus ti-xs me-md-2"></i>
                    Add
                    New Category</a>
            @endif
        </div>
        <div class="col-12">
            <!-- Role Table -->
            <div class="card">

                <div class="card-datatable table-responsive">
                    <table class="table border-top">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Category Name</th>
                                <th>Parent Category</th>
                                <th>Icon</th>
                                <th>Cover Image</th>
                                <th>Banner</th>
                                <th>Ordering Number</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($categories as $key => $item)
                                @php
                                    if (isset($item->parent_category->name) && (!empty($item->parent_category->name))){
                                        $parent_category = $item->parent_category->name;
                                    }                                                
                                    else{
                                        $parent_category = "Root";
                                    }                                                
                                @endphp
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $parent_category }}</td>
                                    <td>
                                        @if (!empty($item->icon) && file_exists($item->icon))
                                            <img src="{{ asset($item->icon) }}" alt="Logo"
                                                style="width: 60px; height: 60px;">
                                        @else
                                            <img src="{{ asset('assets/common/no-image.png') }}" alt="Image"
                                                style="width: 60px; height: 60px;">
                                        @endif
                                    </td>
                                    <td>
                                        @if (!empty($item->cover_image) && file_exists($item->cover_image))
                                            <img src="{{ asset($item->cover_image) }}" alt="Logo"
                                                style="width: 60px; height: 60px;">
                                        @else
                                            <img src="{{ asset('assets/common/no-image.png') }}" alt="Image"
                                                style="width: 60px; height: 60px;">
                                        @endif
                                    </td>
                                    <td>
                                        @if (!empty($item->banner) && file_exists($item->banner))
                                            <img src="{{ asset($item->banner) }}" alt="Logo"
                                                style="width: 60px; height: 60px;">
                                        @else
                                            <img src="{{ asset('assets/common/no-image.png') }}" alt="Image"
                                                style="width: 60px; height: 60px;">
                                        @endif
                                    </td>
                                    <td>{{ $item->ordering_number }} </td>                                    
                                    <td>
                                        <span class="badge me-1 {{ $item->ordering_number == 'physical' ? 'bg-label-info' : 'bg-label-secondary' }}">{{ $item->category_type }}</span>
                                    </td>                                    
                                    <td>
                                        @if ($item->status == 1)
                                            <span class="badge bg-label-success me-1">Active</span>
                                        @else
                                            <span class="badge bg-label-warning me-1">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            @if ($item->status == 1)
                                                <a href="{{ route('categories.status', $item->id) }}" title="Active Now"
                                                    class="btn btn-icon btn-text-secondary waves-effect waves-light rounded-pill">
                                                    <i class="fa-solid fa-toggle-on text-success fs-5"></i></a>
                                            @else
                                                <a href="{{ route('categories.status', $item->id) }}" title="Inactive Now"
                                                    class="btn btn-icon btn-text-secondary waves-effect waves-light rounded-pill">
                                                    <i class="fa-solid fa-toggle-off text-danger fs-5"></i></a>
                                            @endif
                                            @if (Auth::user()->can('brand.edit'))
                                                <a href="{{ route('categories.edit', $item->id) }}"
                                                    class="btn btn-sm btn-icon btn-text-success rounded-pill waves-effect waves-light m-1"><i
                                                        class="ti ti-edit ti-md"></i></a>
                                            @endif
                                            @if (Auth::user()->can('role.delete'))
                                                <form action="{{ route('categories.destroy', $item->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a type="submit"
                                                        class="btn btn-icon btn-text-danger text-danger waves-effect waves-light rounded-pill delete-record m-1">
                                                        <i class="ti ti-trash ti-md"></i></a>
                                                </form>
                                            @endif
                                            {{-- <a href="javascript:;" class="btn btn-icon btn-text-secondary waves-effect waves-light rounded-pill dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown"><i class="ti ti-dots-vertical ti-md"></i></a>
                                            <div class="dropdown-menu dropdown-menu-end m-0">
                                                <a href="javascript:;" "="" class="dropdown-item">Edit</a>
                                                <a href="javascript:;" class="dropdown-item">Suspend</a>
                                            </div> --}}
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10">
                                        <div class="py-4 text-center">
                                            <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop"
                                                colors="primary:#405189,secondary:#0ab39c" style="width:72px;height:72px">
                                            </lord-icon>
                                            <h5 class="mt-4 text-center text-danger">Sorry! No Result Found</h5>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
            <!--/ Role Table -->
        </div>
    </div>
    <!--/ Role cards -->
@endsection
