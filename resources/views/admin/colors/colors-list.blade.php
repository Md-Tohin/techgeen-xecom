@extends('admin.admin-master')

@section('title', 'Colors List - ' . env('APP_NAME'))

@section('content')
    <!-- Role cards -->
    <div class="row">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h4 class="">Colors List</h4>
            @if (Auth::user()->can('brand.create'))
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_modal"> Add New
                    Color </button>
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
                                <th>Code</th>
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
                                        {{ $item->code }}
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
                                                <a href="{{ route('colors.status', $item->id) }}" title="Active Now"
                                                    class="btn btn-icon btn-text-secondary waves-effect waves-light rounded-pill">
                                                    <i class="fa-solid fa-toggle-on text-success fs-5"></i></a>
                                            @else
                                                <a href="{{ route('colors.status', $item->id) }}" title="Inactive Now"
                                                    class="btn btn-icon btn-text-secondary waves-effect waves-light rounded-pill">
                                                    <i class="fa-solid fa-toggle-off text-danger fs-5"></i></a>
                                            @endif                                           
                                            @if (Auth::user()->can('colors.edit'))
                                                <a href="{{ route('colors.show', $item->id) }}" data-bs-toggle="modal"
                                                    data-bs-target="#edit_modal"
                                                    class="color_edit_button btn btn-sm btn-icon btn-text-success rounded-pill waves-effect waves-light m-1"><i
                                                        class="ti ti-edit ti-md"></i></a>
                                            @endif
                                            @if (Auth::user()->can('colors.delete'))
                                                <form action="{{ route('colors.destroy', $item->id) }}" method="post">
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
                                    <td colspan="5">
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
                        <h4 class="mb-2">Add New Color</h4>
                    </div>
                    <form action="{{ route('colors.store') }}" method="post">
                        @csrf
                        <div class="col-12 mb-4">
                            <label class="form-label w-100" for="name">Color Name</label>
                            <input id="name" name="name" class="form-control credit-card-mask" type="text"
                                placeholder="Color name" value="{{ old('name') }}" required />
                            <span id="attribute-add-name"></span>
                        </div>

                        <div class="col-12 col-md-12 mb-4">
                            <label for="code" class="form-label mb-1">Color Code</label>
                            <input id="code" class="form-control" name="code" value="{{ old('code') }}"
                                placeholder="Enter color code" aria-label="Color code" required />
                        </div>

                        <div class="col-12 mb-4">
                            <div class="form-check form-switch">
                                <input type="checkbox" name="status" class="form-check-input" id="status" checked />
                                <label for="status" class="switch-label">Status</label>
                            </div>
                        </div>
                        <div class="col-12 text-center mt-3">
                            @if (Auth::user()->can('colors.create'))
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
                        <h4 class="mb-2">Edit Color</h4>
                    </div>
                    <form action="{{ route('colors.update') }}" method="post">
                        @csrf
                        <input type="hidden" id="edit-id" name="id">

                        <div class="col-12 mb-4">
                            <label class="form-label w-100" for="edit-name">Color Name</label>
                            <div class="input-group input-group-merge">
                                <input id="edit-name" name="name" class="form-control credit-card-mask"
                                    type="text" placeholder="Color name" />
                                <span id="color-edit-name"></span>
                            </div>
                        </div>

                        <div class="col-12 col-md-12 mb-4">
                            <label for="edit-code" class="form-label mb-1">Color Code</label>
                            <input id="edit-code" class="form-control" name="code"
                                placeholder="Enter color code" aria-label="Color code" required />
                                <span id="color-edit-code"></span>
                        </div>

                        <div class="col-12 mb-4">
                            <div class="form-check form-switch">
                                <input type="checkbox" name="status" class="form-check-input" id="edit-status" />
                                <label for="edit-status" class="switch-label">Status</label>
                            </div>
                        </div>
                        <div class="col-12 text-center mt-3">
                            @if (Auth::user()->can('colors.create'))
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
        $(document).on('click', '.color_edit_button', function(e) {
            e.preventDefault();
            var href = $(this).attr('href');
            $.ajax({
                url: href,
                type: "GET",
                success: function(resp) {
                    if (resp.status == 200) {
                        $("#edit-id").val(resp.data.id);
                        $("#edit-name").val(resp.data.name);
                        $("#edit-code").val(resp.data.code);
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