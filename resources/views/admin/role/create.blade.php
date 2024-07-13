@extends('admin.admin-master')

@section('content')
    <!-- Role cards -->
    <div class="row">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h4 class="">Roles Create</h4>
            @if (Auth::user()->can('role.view'))
                <a href="{{ route('roles.index') }}" class="btn btn-success "> <i class="ti ti-eye ti-xs me-md-2"></i> Role
                    List</a>
            @endif
        </div>
        <div class="col-12">
            <!-- Role Table -->
            <div class="card p-5">
                <form id="addRoleForm" class="row g-6" onsubmit="{{ route('roles.store') }}" method="POST">
                    @csrf
                    <div class="col-12">
                        <label class="form-label" for="name">Role Name</label>
                        <input type="text" id="name" name="name"
                            class="form-control @error('name') is-invalid @enderror" placeholder="Enter a role name"
                            tabindex="-1" />
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center mb-0">
                            <h5 class="">Permissions</h5>
                            <div class=" ">
                                <div class="form-check mb-0">
                                    <input class="form-check-input" type="checkbox" id="selectAll" />
                                    <label class="form-check-label" for="selectAll">
                                        Select All
                                    </label>
                                </div>
                            </div>
                        </div>
                        <!-- Permission table -->
                        <?php
                        $permissionsArray = [];
                        foreach ($permissions as $permission) {
                            $sectionTitle = explode('.', $permission->name);
                            $permissionsArray[$sectionTitle[0]][] = $permission->name;
                        }
                        ?>

                        @foreach ($permissionsArray as $key => $permissionData)
                            <div class="card mb-5">
                                <div class="card-header bg-light px-5 py-3">
                                    <span class="text-capitalize">{{ $key }}</span>
                                </div>
                                <div class="card-body pt-3 pb-2">
                                    <div class="row">
                                        @foreach ($permissionData as $permission)
                                            <div class="col-md-3 col-sm-6 col-12 p-1">
                                                <div class="p-3 border text-capitalize">
                                                    {{ str_replace('.', ' ', $permission) }} <br>
                                                    <div class="form-check form-switch mt-2 mb-0">
                                                        <input name="permissions[]" value="{{ $permission }}"
                                                            class="form-check-input" type="checkbox" />
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary me-3">
                            Submit
                        </button>
                        <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
            <!--/ Role Table -->
        </div>
    </div>
    <!--/ Role cards -->
@endsection

@push('scripts')
    <script type="text/javascript">
        "use strict";
        document.addEventListener("DOMContentLoaded", function(e) {
            {
                FormValidation.formValidation(document.getElementById("addRoleForm"), {
                    fields: {
                        name: {
                            validators: {
                                notEmpty: {
                                    message: "Please enter role name"
                                },
                            },
                        },
                    },
                    plugins: {
                        trigger: new FormValidation.plugins.Trigger(),
                        bootstrap5: new FormValidation.plugins.Bootstrap5({
                            eleValidClass: "",
                            rowSelector: ".col-12",
                        }),
                        submitButton: new FormValidation.plugins.SubmitButton(),
                        autoFocus: new FormValidation.plugins.AutoFocus(),
                    },
                }).on('core.form.valid', function() {
                    // Form is valid, proceed with submission
                    document.getElementById("addRoleForm").submit();
                }).on('core.form.invalid', function() {
                    // Form is invalid, prevent submission
                    console.log('Form is invalid');
                });;

                const t = document.querySelector("#selectAll"),
                    o = document.querySelectorAll('[type="checkbox"]');
                t.addEventListener("change", (t) => {
                    o.forEach((e) => {
                        e.checked = t.target.checked;
                    });
                });
            }
        });
    </script>
@endpush
