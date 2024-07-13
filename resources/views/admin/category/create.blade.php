@extends('admin.admin-master')

@section('title', 'Brand Create - ' . env('APP_NAME'))

@push('css')
    <link rel="stylesheet" href="/assets/backend/vendor/libs/quill/typography.css" />
    <link rel="stylesheet" href="/assets/backend/vendor/libs/quill/katex.css" />
    <link rel="stylesheet" href="/assets/backend/vendor/libs/quill/editor.css" />
    <link rel="stylesheet" href="/assets/backend/vendor/libs/dropzone/dropzone.css" />
    <link rel="stylesheet" href="/assets/backend/vendor/libs/flatpickr/flatpickr.css" />
    <link rel="stylesheet" href="/assets/backend/vendor/libs/tagify/tagify.css" />
@endpush


@section('content')
    <div class="app-ecommerce">

        <div class="row">
            <div class="col-12 d-flex justify-content-between align-items-center">
                <h4 class="">Category Create</h4>
                @if (Auth::user()->can('category.view'))
                    <a href="{{ route('categories.index') }}" class="btn btn-success "> <i
                            class="ti ti-list ti-xs me-md-2"></i>
                        Category List</a>
                @endif
            </div>

            <!-- First column-->
            <div class="col-12 col-lg-12">
                <!-- Inventory -->
                <div class="card mb-6">
                    <div class="card-body">
                        <div class="row">
                            <!-- Options -->
                            <div class="col-12 col-md-12 col-xl-9 col-xxl-8 pt-6 pt-md-0">
                                <form action="{{ route('categories.store') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row mb-6">

                                        <div class="col-12 col-md-6 mb-4">
                                            <label class="form-label" for="name">Category name: <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                id="name" placeholder="Category name" name="name"
                                                aria-label="Category name" value="{{ old('name') }}" />
                                            @error('name')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-12 col-md-6 mb-4">
                                            <label class="form-label" for="slug">Category slug:</label>
                                            <input type="text" class="form-control @error('slug') is-invalid @enderror"
                                                id="slug" placeholder="Please Enter Slug" name="slug"
                                                aria-label="Category slug" value="{{ old('slug') }}" />
                                            @error('slug')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="col-12 col-md-6 mb-4 ecommerce-select2-dropdown">
                                            <label class="form-label" for="category_type">Select category type</label>
                                            <select id="category_type" name="category_type" class="form-select"
                                                data-placeholder="Select category status">
                                                <option value="">Select category type</option>
                                                <option value="physical">Physical</option>
                                                <option value="digital">Digital</option>
                                            </select>
                                        </div>

                                        <!-- Parent category -->
                                        <div class="col-12 col-md-6 mb-4 ecommerce-select2-dropdown">
                                            <label class="form-label" for="appendCategoriesLevel">Parent
                                                category</label>
                                            <select id="appendCategoriesLevel" name="parent_id"
                                                class="select2 form-select" data-placeholder="Select parent category">                                                
                                                    @include('admin.category.append_categories_level')
                                            </select>
                                        </div>

                                        <div class="col-12 col-md-6 mb-4">
                                            <label class="form-label" for="ordering_number">Ordering Number: <span
                                                    class="text-danger">*</span></label>
                                            <input type="text"
                                                class="form-control @error('ordering_number') is-invalid @enderror"
                                                id="ordering_number" placeholder="Category ordering number"
                                                name="ordering_number" aria-label="Category ordering number"
                                                value="{{ old('ordering_number') }}" />
                                            <small class="text-muted"><i class="fa fa-question-circle"></i> Please
                                                Higher number has high priority.</small> <br>
                                            @error('ordering_number')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="col-12 col-md-6 mb-4">
                                            <label class="form-label" for="icon">Category Icon: <span
                                                    class="text-danger">*</span></label>
                                            <input class="form-control @error('icon') is-invalid @enderror"
                                                onchange="loadFile(event, 'icon-preview')" name="icon" type="file"
                                                id="icon">
                                            @error('icon')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                            <small class="text-muted"><i class="fa fa-question-circle"></i> Please
                                                Please choose a site logo (supported format: PNG, JPG, JPEG, GIF,
                                                max:2048).</small> <br>
                                            <img id="icon-preview" src="{{ asset('assets/common/no-image.png') }}"
                                                alt="Image" style="width: 100px; height: 80px;">
                                        </div>

                                        <div class="col-12 col-md-6 mb-4">
                                            <label class="form-label" for="cover_image">Category Cover Image: <span
                                                    class="text-danger">*</span></label>
                                            <input class="form-control @error('cover_image') is-invalid @enderror"
                                                onchange="loadFile(event, 'cover_image-preview')" name="cover_image"
                                                type="file" id="cover_image">
                                            @error('cover_image')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                            <small class="text-muted"><i class="fa fa-question-circle"></i> Please
                                                Please choose a site cover image (supported format: PNG, JPG, JPEG, GIF,
                                                max:2048).</small> <br>
                                            <img id="cover_image-preview" src="{{ asset('assets/common/no-image.png') }}"
                                                alt="Image" style="width: 100px; height: 80px;">
                                        </div>

                                        <div class="col-12 col-md-6 mb-4">
                                            <label class="form-label" for="banner">Category Banner: <span
                                                    class="text-danger">*</span></label>
                                            <input class="form-control @error('banner') is-invalid @enderror"
                                                onchange="loadFile(event, 'banner-preview')" name="banner"
                                                type="file" id="banner">
                                            @error('banner')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                            <small class="text-muted"><i class="fa fa-question-circle"></i> Please
                                                Please choose a site banner (supported format: PNG, JPG, JPEG, GIF,
                                                max:2048).</small> <br>
                                            <img id="banner-preview" src="{{ asset('assets/common/no-image.png') }}"
                                                alt="Image" style="width: 100px; height: 80px;">
                                        </div>

                                        <div class="col-12 col-md-12 mb-4">
                                            <label class="form-label" for="description">Category Description:</label>
                                            <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description"
                                                cols="30" rows="4" placeholder="Please enter description.">{{ old('description') }}</textarea>
                                            @error('description')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="col-12 col-md-12 mb-4">
                                            <label class="form-label" for="meta_title">Meta Title: </label>
                                            <input type="text" class="form-control" id="meta_title"
                                                placeholder="Please enter meta title" name="meta_title"
                                                aria-label="Meta title" value="{{ old('meta_title') }}" />
                                        </div>

                                        <div class="col-12 col-md-12 mb-4">
                                            <label class="form-label" for="meta_description">Meta
                                                Description:</label>
                                            <textarea class="form-control" name="meta_description" id="meta_description" cols="30" rows="4"
                                                placeholder="Please enter meta description.">{{ old('meta_description') }}</textarea>
                                            <small class="text-muted"><i class="fa fa-question-circle"></i> Please enter
                                                meta description (it will also make in your site SEO
                                                friendly).</small>
                                        </div>

                                        <div class="col-12 col-md-12 mb-4">
                                            <label for="ecommerce-product-tags" class="form-label mb-1">Meta
                                                Keywords</label>
                                            <input id="ecommerce-product-tags" class="form-control" name="meta_keywords"
                                                value="{{ old('meta_keywords') }}" placeholder="Enter metadata keywords"
                                                aria-label="Meta keywoerds" />
                                        </div>

                                        <div class="col-12 mb-4">
                                            <div class="form-check form-switch">
                                                <input type="checkbox" name="status" class="form-check-input"
                                                    id="edit-status" checked />
                                                <label for="edit-status" class="switch-label">Status</label>
                                            </div>
                                        </div>

                                        <div class="col-8 col-md-3 mx-auto mt-3">
                                            <button type="submit"
                                                class="btn btn-primary waves-effect waves-light">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- /Options-->
                        </div>
                    </div>
                </div>
                <!-- /Inventory -->
            </div>
            <!-- /Second column -->
        </div>
    </div>
@endsection

@push('scripts')
    <script src="/assets/backend/vendor/libs/quill/katex.js"></script>
    <script src="/assets/backend/vendor/libs/quill/quill.js"></script>
    <script src="/assets/backend/vendor/libs/dropzone/dropzone.js"></script>
    <script src="/assets/backend/vendor/libs/jquery-repeater/jquery-repeater.js"></script>
    <script src="/assets/backend/vendor/libs/flatpickr/flatpickr.js"></script>
    <script src="/assets/backend/vendor/libs/tagify/tagify.js"></script>
    <script src="/assets/backend/js/app-ecommerce-product-add.js"></script>
    <script src="/assets/backend/js/forms-editors.js"></script>

    <script type="text/javascript">
        //  Append Category Lavel
        $("#category_type").change(function() {
            var category_type = $(this).val();
            $.ajax({
                type: 'get',
                url: "{{ route('categories.append-categories-level') }}",
                data: {
                    category_type: category_type
                },
                success: function(resp) {
                    console.log(resp);
                    $("#appendCategoriesLevel").html(resp);
                },
                error: function() {
                    alert('Error');
                }
            });
        });
    </script>
@endpush
