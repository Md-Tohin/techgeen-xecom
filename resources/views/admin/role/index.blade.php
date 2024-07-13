@extends('admin.admin-master')

@section('content')
    <!-- Role cards -->
    <div class="row">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h4 class="">Role List</h4>
            @if (Auth::user()->can('role.create'))
                <a href="{{ route('roles.create') }}" class="btn btn-success "> <i class="ti ti-plus ti-xs me-md-2"></i> Add
                    New Role</a>
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
                                <th>Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($roles as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            @if (Auth::user()->can('role.edit'))
                                                <a href="{{ route('roles.edit', $item->id) }}"
                                                    class="btn btn-sm btn-icon btn-text-success rounded-pill waves-effect waves-light m-1"><i
                                                        class="ti ti-edit ti-md"></i></a>
                                            @endif
                                            @if (Auth::user()->can('role.delete'))
                                                <form action="{{ route('roles.destroy', $item->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a type="submit"
                                                        class="btn btn-icon btn-text-danger text-danger waves-effect waves-light rounded-pill delete-record m-1">
                                                        <i class="ti ti-trash ti-md"></i></a>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3">
                                        <div class="py-4 text-center">
                                            <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop"
                                                colors="primary:#405189,secondary:#0ab39c" style="width:72px;height:72px">
                                            </lord-icon>
                                            <h5 class="mt-4">Sorry! No Result Found</h5>
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
