@extends('admin.admin-master')

@section('title', 'Product Create - ' . env('APP_NAME'))

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
                <h4 class="">Product Create</h4>
                @if (Auth::user()->can('brand.view'))
                    <a href="{{ route('brands.index') }}" class="btn btn-success"> <i class="ti ti-list ti-xs me-md-2"></i>
                        Product List</a>
                @endif
            </div>

            <div class="col-12 col-lg-12">
                <!-- Inventory -->
                <div class="card mb-6">
                    <div class="card-body">
                        <div class="row">
                            <!-- Options -->
                            <div class="col-12">
                                <form action="{{ route('setup.general-settings.store') }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row mb-6">
                                        <div class="col-12">
                                            <p class="text-danger">Genearl Information</p>
                                        </div>
                                        <div class="col-12 col-md-6 mb-4">
                                            <label class="form-label" for="product-name">Product Name: <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                id="product-name" placeholder="Product name" name="name"
                                                aria-label="Product name" value="{{ old('name') }}" />
                                            @error('name')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-12 col-md-6 mb-4">
                                            <label class="form-label" for="slug">Slug:</label>
                                            <input type="text" class="form-control @error('slug') is-invalid @enderror"
                                                id="slug" placeholder="Please enter slug" name="slug"
                                                aria-label="Product barcode" value="{{ old('slug') }}" />
                                            @error('slug')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="col-12 col-md-6 mb-4">
                                            <div class="col ecommerce-select2-dropdown">
                                                <label class="form-label" for="brand_id">Brand
                                                </label>
                                                <select id="brand_id" class="select2 form-select"
                                                    data-placeholder="Select Brand">
                                                    <option value="">Select Brand</option>
                                                    @foreach ($brands as $brand)
                                                        <option value="{{ $brand->id }}">{{ $brand->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6 mb-4">
                                            <label class="form-label" for="url">Unit: <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="unit"
                                                class="form-control @error('unit') is-invalid @enderror" id="unit"
                                                placeholder="Unit (kg, pc etc)" aria-label="unit"
                                                value="{{ old('unit') }}" />
                                            @error('unit')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="col-12 col-md-6 mb-4">
                                            <label class="form-label" for="weight">Weight <small>(In
                                                    Kg)</small>:</label>
                                            <input type="text" class="form-control @error('weight') is-invalid @enderror"
                                                id="weight" placeholder="Please enter product weight" name="weight"
                                                aria-label="Product Weight" value="{{ old('name') ? old('name') : 0 }}" />
                                            @error('weight')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="col-12 col-md-6 mb-4">
                                            <label class="form-label" for="purchase_qty">Minimum Purchase Qty:
                                                <span class="text-danger">*</span></label>
                                            <input type="number" name="purchase_qty" min="1"
                                                class="form-control @error('purchase_qty') is-invalid @enderror"
                                                id="purchase_qty" placeholder="Minimun purchase qty"
                                                aria-label="Purchase Qty"
                                                value="{{ old('purchase_qty') ? old('purchase_qty') : 1 }}" />
                                            @error('purchase_qty')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="col-12 col-md-6 mb-4">
                                            <label for="ecommerce-product-tags" class="form-label mb-1">Product
                                                Tags</label>
                                            <input id="ecommerce-product-tags" class="form-control" name="product_tags"
                                                value="{{ old('product_tags') }}" placeholder="Enter Product tags"
                                                aria-label="Product Tags" />
                                        </div>

                                        <div class="col-12 col-md-12 mb-4">
                                            <label class="form-label" for="description">Description:</label>
                                            <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description"
                                                cols="30" rows="4" placeholder="Please enter description.">{{ old('description') }}</textarea>
                                            @error('description')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="col-12 col-md-6 mb-4">
                                            <label class="form-label" for="logo">Logo:</label>
                                            <input class="form-control @error('logo') is-invalid @enderror"
                                                onchange="loadFile(event, 'logo-preview')" name="logo" type="file"
                                                id="logo">
                                            @error('logo')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                            <small class="text-muted"><i class="fa fa-question-circle"></i> Please
                                                Please choose a site logo (supported format: PNG, JPG, JPEG, GIF,
                                                WEBP).</small> <br>
                                            <img id="logo-preview" src="{{ asset('assets/common/no-image.png') }}"
                                                alt="Image" style="width: 100px; height: 80px;">
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

                                            <img id="favicon-preview" src="{{ asset('assets/common/no-image.png') }}"
                                                alt="Image" style="width: 100px; height: 80px;">
                                        </div>

                                        <div class="col-8 col-md-3 mx-auto mt-3">
                                            <button type="submit"
                                                class="btn btn-primary waves-effect waves-light">Submit</button>
                                        </div>
                                    </div>
                                </form>

                                <div class="tab-content p-0 ps-md-4">
                                    <!-- Restock Tab -->
                                    <div class="tab-pane fade show active" id="restock" role="tabpanel">
                                        <form action="{{ route('setup.general-settings.store') }}" method="post"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="row mb-6">
                                                <div class="col-12 col-md-6 mb-4">
                                                    <label class="form-label" for="product-name">Product Name: <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text"
                                                        class="form-control @error('name') is-invalid @enderror"
                                                        id="product-name" placeholder="Product name" name="name"
                                                        aria-label="Product name" value="{{ old('name') }}" />
                                                    @error('name')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                                <div class="col-12 col-md-6 mb-4">
                                                    <label class="form-label" for="slug">Slug:</label>
                                                    <input type="text"
                                                        class="form-control @error('slug') is-invalid @enderror"
                                                        id="slug" placeholder="Please enter slug" name="slug"
                                                        aria-label="Product barcode" value="{{ old('slug') }}" />
                                                    @error('slug')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>

                                                <div class="col-12 col-md-6 mb-4">
                                                    <div class="col ecommerce-select2-dropdown">
                                                        <label class="form-label" for="brand_id">Brand
                                                        </label>
                                                        <select id="brand_id" class="select2 form-select"
                                                            data-placeholder="Select Brand">
                                                            <option value="">Select Brand</option>
                                                            @foreach ($brands as $brand)
                                                                <option value="{{ $brand->id }}">{{ $brand->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-md-6 mb-4">
                                                    <label class="form-label" for="url">Unit: <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" name="unit"
                                                        class="form-control @error('unit') is-invalid @enderror"
                                                        id="unit" placeholder="Unit (kg, pc etc)" aria-label="unit"
                                                        value="{{ old('unit') }}" />
                                                    @error('unit')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>

                                                <div class="col-12 col-md-6 mb-4">
                                                    <label class="form-label" for="weight">Weight <small>(In
                                                            Kg)</small>:</label>
                                                    <input type="text"
                                                        class="form-control @error('weight') is-invalid @enderror"
                                                        id="weight" placeholder="Please enter product weight"
                                                        name="weight" aria-label="Product Weight"
                                                        value="{{ old('name') ? old('name') : 0 }}" />
                                                    @error('weight')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>

                                                <div class="col-12 col-md-6 mb-4">
                                                    <label class="form-label" for="purchase_qty">Minimum Purchase Qty:
                                                        <span class="text-danger">*</span></label>
                                                    <input type="number" name="purchase_qty" min="1"
                                                        class="form-control @error('purchase_qty') is-invalid @enderror"
                                                        id="purchase_qty" placeholder="Minimun purchase qty"
                                                        aria-label="Purchase Qty"
                                                        value="{{ old('purchase_qty') ? old('purchase_qty') : 1 }}" />
                                                    @error('purchase_qty')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>

                                                <div class="col-12 col-md-6 mb-4">
                                                    <label for="ecommerce-product-tags" class="form-label mb-1">Product
                                                        Tags</label>
                                                    <input id="ecommerce-product-tags" class="form-control"
                                                        name="product_tags" value="{{ old('product_tags') }}"
                                                        placeholder="Enter Product tags" aria-label="Product Tags" />
                                                </div>

                                                <div class="col-12 col-md-12 mb-4">
                                                    <label class="form-label" for="description">Description:</label>
                                                    <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description"
                                                        cols="30" rows="4" placeholder="Please enter description.">{{ old('description') }}</textarea>
                                                    @error('description')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
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
                                                    <img id="logo-preview"
                                                        src="{{ asset('assets/common/no-image.png') }}" alt="Image"
                                                        style="width: 100px; height: 80px;">
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

                                                    <img id="favicon-preview"
                                                        src="{{ asset('assets/common/no-image.png') }}" alt="Image"
                                                        style="width: 100px; height: 80px;">
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
                                                        aria-label="Meta title" value="{{ old('name') }}" />
                                                </div>

                                                <div class="col-12 col-md-12 mb-4">
                                                    <label class="form-label" for="meta_description">Meta
                                                        Description:</label>
                                                    <textarea class="form-control" name="meta_description" id="meta_description" cols="30" rows="4"
                                                        placeholder="Please enter meta description (it will also make in your site SEO
                                                        friendly).">{{ old('name') }}</textarea>
                                                    <small class="text-muted"><i class="fa fa-question-circle"></i> Please
                                                        enter meta description (it will also make in your site SEO
                                                        friendly).</small>
                                                </div>

                                                <div class="col-12 col-md-12 mb-4">
                                                    <label for="ecommerce-product-tags" class="form-label mb-1">Meta
                                                        Keywords</label>
                                                    <input id="ecommerce-product-tags" class="form-control"
                                                        name="meta_keywords" value="{{ old('name') }}"
                                                        placeholder="Enter metadata keywords"
                                                        aria-label="Meta keywoerds" />
                                                </div>

                                                <div class="col-12 col-md-12 mb-4">
                                                    <label class="form-label" for="google_analytics">Google
                                                        Analytics:</label>
                                                    <textarea class="form-control" name="google_analytics" id="google_analytics" cols="30" rows="4"
                                                        placeholder="Please enter google analytics (it will also make in your site SEO
                                                        friendly).">{{ old('name') }}</textarea>
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
                                    <!-- Shipping Tab -->
                                    <div class="tab-pane fade" id="media" role="tabpanel">
                                        <form action="{{ route('setup.seo-settings.store') }}" method="post">
                                            @csrf
                                            <div class="row mb-6">
                                                <div class="col-12 col-md-12 mb-4">
                                                    <label class="form-label" for="meta_title">Meta Title: <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="meta_title"
                                                        placeholder="Please enter meta title" name="meta_title"
                                                        aria-label="Meta title" value="{{ old('name') }}" />
                                                </div>

                                                <div class="col-12 col-md-12 mb-4">
                                                    <label class="form-label" for="meta_description">Meta
                                                        Description:</label>
                                                    <textarea class="form-control" name="meta_description" id="meta_description" cols="30" rows="4"
                                                        placeholder="Please enter meta description (it will also make in your site SEO
                                                        friendly).">{{ old('name') }}</textarea>
                                                    <small class="text-muted"><i class="fa fa-question-circle"></i> Please
                                                        enter meta description (it will also make in your site SEO
                                                        friendly).</small>
                                                </div>

                                                <div class="col-12 col-md-12 mb-4">
                                                    <label for="ecommerce-product-tags" class="form-label mb-1">Meta
                                                        Keywords</label>
                                                    <input id="ecommerce-product-tags" class="form-control"
                                                        name="meta_keywords" value="{{ old('name') }}"
                                                        placeholder="Enter metadata keywords"
                                                        aria-label="Meta keywoerds" />
                                                </div>

                                                <div class="col-12 col-md-12 mb-4">
                                                    <label class="form-label" for="google_analytics">Google
                                                        Analytics:</label>
                                                    <textarea class="form-control" name="google_analytics" id="google_analytics" cols="30" rows="4"
                                                        placeholder="Please enter google analytics (it will also make in your site SEO
                                                        friendly).">{{ old('name') }}</textarea>
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
