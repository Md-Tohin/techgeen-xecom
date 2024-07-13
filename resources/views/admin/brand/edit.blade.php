@extends('admin.admin-master')

@section('title', 'Brand Edit - ' . env('APP_NAME'))

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
                <h4 class="">Brand Edit</h4>
                @if (Auth::user()->can('brand.view'))
                    <a href="{{ route('brands.index') }}" class="btn btn-success "> <i class="ti ti-list ti-xs me-md-2"></i>
                        Brand List</a>
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
                                <form action="{{ route('brands.update', $brand->id) }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                    <input type="hidden" name="old_logo" value="{{ $brand->logo }}">
                                    <div class="row mb-6">
                                        <div class="col-12 col-md-6 mb-4">
                                            <label class="form-label" for="name">Brand name: <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                id="name" placeholder="Brand name" name="name"
                                                aria-label="Brand name" value="{{ $brand->name }}" />
                                            @error('name')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-12 col-md-6 mb-4">
                                            <label class="form-label" for="slug">Brand slug:</label>
                                            <input type="text" class="form-control @error('slug') is-invalid @enderror"
                                                id="slug" placeholder="Please Enter Slug" name="slug"
                                                aria-label="Product barcode" value="{{ $brand->slug }}" />
                                            @error('slug')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-12 col-md-6 mb-4">
                                            <label class="form-label" for="logo">Logo: <span
                                                    class="text-danger">*</span></label>
                                            <input class="form-control @error('logo') is-invalid @enderror"
                                                onchange="loadFile(event, 'logo-preview')" name="logo" type="file"
                                                id="logo">
                                            @error('logo')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                            <small class="text-muted"><i class="fa fa-question-circle"></i> Please
                                                Please choose a site logo (supported format: PNG, JPG, JPEG, GIF,
                                                max:2048).</small> <br>
                                            @if (!empty($brand->logo) && file_exists($brand->logo))
                                                <img id="logo-preview" src="{{ asset($brand->logo) }}" alt="Logo"
                                                    style="width: 100px; height: 80px;">
                                            @else
                                                <img id="logo-preview" src="{{ asset('assets/common/no-image.png') }}"
                                                    alt="Image" style="width: 100px; height: 80px;">
                                            @endif
                                        </div>

                                        <div class="col-12 col-md-12 mb-4">
                                            <label class="form-label" for="description">Brand Description:</label>
                                            <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description"
                                                cols="30" rows="4" placeholder="Please enter description (it will also show in your site footer).">{!! $brand->description !!}</textarea>
                                            @error('description')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="col-12 col-md-12 mb-4">
                                            <label class="form-label" for="meta_title">Meta Title: </label>
                                            <input type="text" class="form-control" id="meta_title"
                                                placeholder="Please enter meta title" name="meta_title"
                                                aria-label="Meta title" value="{{ $brand->meta_title }}" />
                                        </div>

                                        <div class="col-12 col-md-12 mb-4">
                                            <label class="form-label" for="meta_description">Meta
                                                Description:</label>
                                            <textarea class="form-control" name="meta_description" id="meta_description" cols="30" rows="4"
                                                placeholder="Please enter meta description.">{!! $brand->meta_description !!}</textarea>
                                            <small class="text-muted"><i class="fa fa-question-circle"></i> Please enter
                                                meta description (it will also make in your site SEO
                                                friendly).</small>
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
@endpush
