@extends('admin.admin-master')

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
        <!-- Add Product -->
        <div
            class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-6 row-gap-4">
            <div class="d-flex flex-column justify-content-center">
                <h4 class="mb-1">Website Setup</h4>
            </div>
        </div>

        <div class="row">
            <!-- First column-->
            <div class="col-12 col-lg-12">
                <!-- Inventory -->
                <div class="card mb-6">
                    <div class="card-body">
                        <div class="row">
                            <!-- Navigation -->
                            <div class="col-12 col-md-2 col-xl-3 col-xxl-4 mx-auto card-separator">
                                <div class="d-flex justify-content-between flex-column mb-4 mb-md-0 pe-md-4">
                                    <div class="nav-align-left">
                                        <ul class="nav nav-pills flex-column w-100">
                                            <li class="nav-item">
                                                <button class="nav-link active" data-bs-toggle="tab"
                                                    data-bs-target="#restock">
                                                    <i class="ti ti-box ti-sm me-1_5"></i>
                                                    <span class="align-middle">General Settings</span>
                                                </button>
                                            </li>
                                            <li class="nav-item">
                                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#shipping">
                                                    <i class="ti ti-car ti-sm me-1_5"></i>
                                                    <span class="align-middle">SEO Settings</span>
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- /Navigation -->
                            <!-- Options -->
                            <div class="col-12 col-md-10 col-xl-9 col-xxl-8 pt-6 pt-md-0">
                                <div class="tab-content p-0 ps-md-4">
                                    <!-- Restock Tab -->
                                    <div class="tab-pane fade show active" id="restock" role="tabpanel">
                                        <form action="{{ route('setup.general-settings.store') }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row mb-6">
                                                <div class="col-12 col-md-6 mb-4">
                                                    <label class="form-label" for="project-name">Project Name: <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text"
                                                        class="form-control @error('name') is-invalid @enderror"
                                                        id="project-name" placeholder="Project name" name="name"
                                                        aria-label="Product name" value="{{ $data->name }}" />
                                                    @error('name')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                                <div class="col-12 col-md-6 mb-4">
                                                    <label class="form-label" for="email">Default Email:</label>
                                                    <input type="email"
                                                        class="form-control @error('email') is-invalid @enderror"
                                                        id="email" placeholder="Please Enter Email (info@example.com)"
                                                        name="email" aria-label="Product barcode" value="{{ $data->email }}" />
                                                    @error('email')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                                <div class="col-12 col-md-6 mb-4">
                                                    <label class="form-label" for="app-url">APP URL:</label>
                                                    <input type="text" name="url"
                                                        class="form-control @error('url') is-invalid @enderror"
                                                        id="app-url" placeholder="http://" aria-label="app-url" value="{{ $data->url }}" />
                                                    @error('url')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                                <div class="col-12 col-md-6 mb-4">
                                                    <label class="form-label" for="phone">Mobile:</label>
                                                    <input type="text"
                                                        class="form-control @error('phone') is-invalid @enderror"
                                                        id="phone" placeholder="Please Enter mobile number"
                                                        name="phone" aria-label="Product Mobile" value="{{ $data->phone }}" />
                                                    @error('phone')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                                <div class="col-12 col-md-12 mb-4">
                                                    <label class="form-label" for="address">Address:</label>
                                                    <textarea class="form-control @error('address') is-invalid @enderror" name="address" id="address" cols="30"
                                                        rows="4" placeholder="Please enter address (it will also show in your site footer).">{{ $data->address }}</textarea>
                                                    @error('address')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                    <small class="text-muted"><i class="fa fa-question-circle"></i> Please
                                                        enter
                                                        address (it will also show in your site footer).</small>
                                                </div>
                                                <div class="col-12 col-md-6 mb-4">
                                                    <label class="form-label" for="logo">Logo:</label>
                                                    <input class="form-control @error('logo') is-invalid @enderror"
                                                        onchange="loadFile(event, 'logo-preview')" name="logo"
                                                        type="file" id="logo">
                                                    @error('logo')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                    <small class="text-muted"><i class="fa fa-question-circle"></i> Please
                                                        Please choose a site logo (supported format: PNG, JPG, JPEG, GIF,
                                                        WEBP).</small> <br>

                                                        @if (!empty($data->logo) && file_exists($data->logo))
                                                        <img id="logo-preview" src="{{ asset($data->logo) }}" alt="Logo"
                                                            style="width: 100px; height: 80px;">
                                                        @else
                                                        <img id="logo-preview" src="{{ asset('assets/common/no-image.png') }}" alt="Image"
                                                            style="width: 100px; height: 80px;">
                                                        @endif
                                                </div>
                                                <div class="col-12 col-md-6 mb-4">
                                                    <label class="form-label" for="formFile">Favicon:</label>
                                                    <input class="form-control @error('favicon') is-invalid @enderror"
                                                        name="favicon" onchange="loadFile(event, 'favicon-preview')"
                                                        type="file" id="formFile">
                                                    @error('favicon')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                    <small class="text-muted"><i class="fa fa-question-circle"></i> Please
                                                        Please choose a site logo (supported format: PNG, JPG, JPEG, GIF,
                                                        WEBP).</small> <br>
                                                        @if (!empty($data->favicon) && file_exists($data->favicon))
                                                        <img id="favicon-preview" src="{{ asset($data->favicon) }}" alt="favicon"
                                                            style="width: 100px; height: 80px;">
                                                        @else
                                                        <img id="favicon-preview" src="{{ asset('assets/common/no-image.png') }}" alt="Image"
                                                            style="width: 100px; height: 80px;">
                                                        @endif
                                                </div>

                                                <div class="col-8 col-md-3 mx-auto mt-3">
                                                    <button type="submit"
                                                        class="btn btn-primary waves-effect waves-light">Submit</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- Shipping Tab -->
                                    <div class="tab-pane fade" id="shipping" role="tabpanel">
                                        <form action="{{ route('setup.seo-settings.store') }}" method="post">
                                            @csrf
                                            <div class="row mb-6">
                                                <div class="col-12 col-md-12 mb-4">
                                                    <label class="form-label" for="meta_title">Meta Title: <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="meta_title"
                                                        placeholder="Please enter meta title" name="meta_title"
                                                        aria-label="Meta title" value="{{ $seoInfo->meta_title }}" />
                                                </div>

                                                <div class="col-12 col-md-12 mb-4">
                                                    <label class="form-label" for="meta_description">Meta
                                                        Description:</label>
                                                    <textarea class="form-control" name="meta_description" id="meta_description" cols="30" rows="4"
                                                        placeholder="Please enter meta description (it will also make in your site SEO
                                                        friendly).">{{ $seoInfo->meta_description }}</textarea>
                                                    <small class="text-muted"><i class="fa fa-question-circle"></i> Please
                                                        enter meta description (it will also make in your site SEO
                                                        friendly).</small>
                                                </div>

                                                <div class="col-12 col-md-12 mb-4">
                                                    <label for="ecommerce-product-tags" class="form-label mb-1">Meta
                                                        Keywords</label>
                                                    <input id="ecommerce-product-tags" class="form-control"
                                                        name="meta_keywords" value="{{ $seoInfo->meta_keywords }}"
                                                        placeholder="Enter metadata keywords"
                                                        aria-label="Meta keywoerds" />
                                                </div>

                                                <div class="col-12 col-md-12 mb-4">
                                                    <label class="form-label" for="google_analytics">Google
                                                        Analytics:</label>
                                                    <textarea class="form-control" name="google_analytics" id="google_analytics" cols="30" rows="4"
                                                        placeholder="Please enter google analytics (it will also make in your site SEO
                                                        friendly).">{{ $seoInfo->google_analytics }}</textarea>
                                                    <small class="text-muted"><i class="fa fa-question-circle"></i> Please
                                                        enter google analytics (it will also make in your site SEO
                                                        friendly).</small>
                                                </div>

                                                <div class="col-8 col-md-3 mx-auto mt-3">
                                                    <button type="submit"
                                                        class="btn btn-primary waves-effect waves-light">Submit</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>                                   
                                </div>
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

    <script type="text/javascript">
        console.log("Ok Test.");
        loadFile('out')
    </script>
@endpush
