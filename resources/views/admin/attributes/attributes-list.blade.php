@extends('admin.admin-master')

@section('title', 'Attributes List - ' . env('APP_NAME'))

@push('css')
    <link rel="stylesheet" href="/assets/backend/vendor/libs/tagify/tagify.css" />
@endpush

@section('content')
    <!-- Role cards -->
    <div class="row">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h4 class="">Attributes List</h4>
            @if (Auth::user()->can('brand.create'))
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_modal"> Add New
                    Attribute </button>
            @endif
        </div>
        <div class="col-12">
            <!-- Role Table -->
            <div class="card">

                <div class="card-datatable table-responsive">
                    <table class="table border-top attribute_table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Values</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($all_data as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>
                                        @if ($item->attributeValues->isNotEmpty())
                                            @foreach ($item->attributeValues as $value)
                                                <span class="badge bg-label-info me-1">{{ $value->name }}</span>
                                            @endforeach
                                        @else
                                            <span class="badge bg-label-secondary me-1">No Values</span>
                                        @endif
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
                                                <a href="{{ route('attributes.status', $item->id) }}" title="Active Now"
                                                    class="btn btn-icon btn-text-secondary waves-effect waves-light rounded-pill">
                                                    <i class="fa-solid fa-toggle-on text-success fs-5"></i></a>
                                            @else
                                                <a href="{{ route('attributes.status', $item->id) }}" title="Inactive Now"
                                                    class="btn btn-icon btn-text-secondary waves-effect waves-light rounded-pill">
                                                    <i class="fa-solid fa-toggle-off text-danger fs-5"></i></a>
                                            @endif
                                            @if (Auth::user()->can('attributes.view'))
                                                <a href="{{ route('attributes-value.values', $item->id) }}"
                                                    class="btn btn-sm btn-icon btn-text-info rounded-pill waves-effect waves-light m-1"><i
                                                        class="fa-solid fa-gear fs-5"></i></a>
                                            @endif
                                            @if (Auth::user()->can('attributes.edit'))
                                                <a href="{{ route('attributes.show', $item->id) }}" data-bs-toggle="modal"
                                                    data-bs-target="#edit_modal"
                                                    class="attribute_edit_button btn btn-sm btn-icon btn-text-success rounded-pill waves-effect waves-light m-1"><i
                                                        class="ti ti-edit ti-md"></i></a>
                                            @endif
                                            @if (Auth::user()->can('attributes.delete'))
                                                <form action="{{ route('attributes.destroy', $item->id) }}" method="post">
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
                                    <td colspan="4">
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

    <!-- Add Modal -->
    <div class="modal fade" id="add_modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered1 modal-simple modal-add-new-cc">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center mb-6">
                        <h4 class="mb-2">Add New Attribute</h4>
                    </div>
                    <form action="{{ route('attributes.store') }}" method="post">
                        @csrf
                        <div class="col-12 mb-4">
                            <label class="form-label w-100" for="modalAddCard">Attribute Name</label>
                            <input id="name" name="name" class="form-control credit-card-mask" type="text"
                                placeholder="Attribute name" required />
                            <span id="attribute-add-name"></span>
                        </div>

                        <div class="col-12 col-md-12 mb-4">
                            <label for="ecommerce-product-tags" class="form-label mb-1">Attribute Values</label>
                            <input id="ecommerce-product-tags" class="form-control" name="attribute_values" value=""
                                placeholder="Enter Attribute Values" aria-label="Attribute Values" required />
                        </div>

                        <div class="col-12 mb-4">
                            <div class="form-check form-switch">
                                <input type="checkbox" name="status" class="form-check-input" id="status" checked />
                                <label for="status" class="switch-label">Status</label>
                            </div>
                        </div>
                        <div class="col-12 text-center mt-3">
                            @if (Auth::user()->can('attributes.create'))
                                <button type="submit" class="btn btn-primary me-3">Submit</button>
                            @endif
                            <button type="reset" class="btn btn-label-secondary btn-reset" data-bs-dismiss="modal"
                                aria-label="Close">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- END Add Modal -->

    <!-- Edit Modal -->
    <div class="modal fade" id="edit_modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered1 modal-simple modal-add-new-cc">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center mb-6">
                        <h4 class="mb-2">Edit Attribute</h4>
                    </div>
                    <form action="{{ route('attributes.update') }}" method="post">
                        @csrf
                        <input type="hidden" id="edit-id" name="id">
                        <div class="col-12 mb-4">
                            <label class="form-label w-100" for="edit-name">Attribute Name</label>
                            <div class="input-group input-group-merge">
                                <input id="edit-name" name="name" class="form-control credit-card-mask"
                                    type="text" placeholder="Attribute name" />
                                <span id="attribute-add-name"></span>
                            </div>
                        </div>

                        <div class="col-12 col-md-12 mb-4">
                            <label for="ecommerce-product-tags" class="form-label mb-1">Attribute Values</label>
                            <input id="ecommerce-product-tags" class="form-control" name="attribute_values" value=""
                                placeholder="Enter Attribute Values" aria-label="Attribute Values" required />
                        </div>

                        <div class="col-12 mb-4">
                            <div class="form-check form-switch">
                                <input type="checkbox" name="status" class="form-check-input" id="edit-status" />
                                <label for="edit-status" class="switch-label">Status</label>
                            </div>
                        </div>
                        <div class="col-12 text-center mt-3">
                            @if (Auth::user()->can('attributes.create'))
                                <button type="submit" class="btn btn-primary me-3">Submit</button>
                            @endif
                            <button type="reset" class="btn btn-label-secondary btn-reset" data-bs-dismiss="modal"
                                aria-label="Close">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- END Edit Modal -->
@endsection

@push('scripts')
    <script>
        $(document).on('click', '.attribute_edit_button', function(e) {
            e.preventDefault();
            var href = $(this).attr('href');
            $.ajax({
                url: href,
                type: "GET",
                success: function(resp) {
                    if (resp.status == 200) {
                        $("#edit-id").val(resp.data.id);
                        $("#edit-name").val(resp.data.name);
                        if (resp.data.status == 1) {
                            $("#edit-status").prop('checked', true);
                        } else {
                            $("#edit-status").prop('checked', false);
                        }
                    }
                },
                error: function(err) {
                    toastr.error('Something is wrong!');
                    console.log(err);
                }
            });
        });
    </script>
@endpush

@push('scripts')
    <script src="/assets/backend/vendor/libs/tagify/tagify.js"></script>
    <script src="/assets/backend/js/app-ecommerce-product-add.js"></script>
@endpush
