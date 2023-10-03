@extends('admin::layouts.app')
@section('title', 'Update Product')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Update Product</h3>
                    <div class="card-tools">
                        <a href="{{ route('product.index') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-list"></i> Products
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- form start -->
    <form id="ProductUpdateForm" method="POST" action="{{ route('product.update', $product->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Edit Details</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="title">Title*</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                           id="title" name="title" value="{{ old('title', $product->title) }}">
                                    @error('title')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="sku">SKU*</label>
                                    <input type="text"
                                           class="form-control uniqueCheck @error('sku') is-invalid @enderror"
                                           id="sku" name="sku" value="{{ old('sku', $product->sku) }}" data-model="Product"
                                           data-column="sku" data-id="">
                                    @error('sku')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="product_code">Product Code*</label>
                                    <input type="text"
                                           class="form-control uniqueCheck @error('product_code') is-invalid @enderror"
                                           id="product_code" name="product_code" value="{{ old('product_code', $product->product_code) }}" data-model="Product"
                                           data-column="product_code" data-id="">
                                    @error('product_code')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="model_number">Model Number*</label>
                                    <input type="text"
                                           class="form-control uniqueCheck @error('model_number') is-invalid @enderror"
                                           id="model_number" name="model_number" value="{{ old('model_number', $product->model_number) }}" data-model="Product"
                                           data-column="model_number" data-id="">
                                    @error('model_number')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea id="description" name="description"
                                              class="form-control @error('description') is-invalid @enderror">{{ old('description', $product->description) }}</textarea>
                                    @error('description')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="specification">Specification</label>
                                    <textarea id="specification" name="specification"
                                              class="form-control @error('specification') is-invalid @enderror">{{ old('specification', $product->specification) }}</textarea>
                                    @error('specification')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="search_keywords">Search Keyword</label>
                                    <textarea id="search_keywords" name="search_keywords"
                                              class="form-control @error('search_keywords') is-invalid @enderror">{{ old('search_keywords', $product->search_keywords) }}</textarea>
                                    @error('search_keywords')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="base_price">Base Price*</label>
                                    <input type="number"
                                           class="form-control @error('base_price') is-invalid @enderror"
                                           id="base_price" placeholder="0.00" name="base_price"
                                           value="{{ old('base_price', $product->base_price) }}">
                                    @error('base_price')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="discount_type">Discount Type</label>
                                    <select name="discount_type" id="discount_type"
                                            class="form-control @error('discount_type') is-invalid @enderror">
                                        <option value="" selected>Select</option>
                                        <option value="1" {{ old('discount_type', $product->discount_type) == '1' ? 'selected' : '' }}>Flat
                                        </option>
                                        <option value="2" {{ old('discount_type', $product->discount_type) == '2' ? 'selected' : '' }}>
                                            Percentage
                                        </option>
                                    </select>
                                    @error('discount_type')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="discount">Discount</label>
                                    <input type="text" class="form-control @error('discount') is-invalid @enderror"
                                           id="discount" name="discount" value="{{ old('discount', $product->discount) }}">
                                    @error('discount')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="min_quantity_to_buy">Min Quantity to Buy*</label>
                                    <input type="number" class="form-control @error('min_quantity_to_buy') is-invalid @enderror"
                                           id="min_quantity_to_buy" name="min_quantity_to_buy" value="{{ old('min_quantity_to_buy', $product->min_quantity_to_buy) }}">
                                    @error('min_quantity_to_buy')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-control @error('status') is-invalid @enderror" id="status"
                                            name="status">
                                        <option value="1" {{ old('status', $product->status) == '1' ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ old('status', $product->status) == '0' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                    @error('status')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="sort_order">Sort Order</label>
                                    <input type="number" class="form-control @error('sort_order') is-invalid @enderror"
                                           id="sort_order" name="sort_order" value="{{ old('sort_order', $product->sort_order) }}">
                                    @error('sort_order')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" style="display: inline-block;">
                        <h3 class="card-title">Meta Details</h3>
                        <button class="btn-sm" style="float: right;" type="button" data-toggle="collapse"
                                data-target="#collapseMetaDiv" aria-expanded="false"
                                aria-controls="collapseMetaDiv">
                            <i class="fas fa-sort-down"></i>
                        </button>
                    </div>
                    <div class="collapse" id="collapseMetaDiv">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="meta_title">Title</label>
                                        <input type="text"
                                               class="form-control @error('meta_title') is-invalid @enderror"
                                               id="meta_title" name="meta_title"
                                               value="{{ old('meta_title', $product->meta_title) }}">
                                        @error('meta_title')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="meta_keyword">Keyword</label>
                                        <input type="text"
                                               class="form-control @error('meta_keyword') is-invalid @enderror"
                                               id="meta_keyword" name="meta_keyword"
                                               value="{{ old('meta_keyword', $product->meta_keyword) }}">
                                        @error('meta_keyword')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="meta_description">Description</label>
                                        <textarea id="meta_description" name="meta_description"
                                                  class="form-control @error('meta_description') is-invalid @enderror">{{ old('meta_description', $product->meta_description) }}</textarea>
                                        @error('meta_description')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="other_meta_tags">Other</label>
                                        <textarea id="other_meta_tags" name="other_meta_tags"
                                                  class="form-control @error('other_meta_tags') is-invalid @enderror">{{ old('other_meta_tags', $product->other_meta_tags) }}</textarea>
                                        @error('other_meta_tags')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Category</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="category">Main Category*</label>
                                    <select id="category" name="category" class="form-control required category">
                                        <option value="" selected disabled>Select category</option>
                                        @foreach($main_categories as $category)
                                            <option value="{{ $category->id }}" @selected($category->id == $product->product_main_category_id)>{{ $category->title }}</option>
                                        @endforeach
                                    </select>
                                    @error('category')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="sub_category">Sub Category*</label>
                                    <select id="sub_category" name="sub_category" class="form-control sub_category">
                                        <option value="" selected disabled>Select Sub category</option>
                                        @if($sub_categories)
                                            @foreach($sub_categories as $sub_category)
                                                <option value="{{ $sub_category->id }}" @selected($sub_category->id == $product->product_sub_category_id)>{{ $sub_category->title }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('sub_category')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="sub_category_child">Sub Category Child</label>
                                    <select id="sub_category_child" name="sub_category_child" class="form-control sub_category_child">
                                        <option value="" selected disabled>Select Sub category Child</option>
                                        @if($sub_categories)
                                            @foreach($sub_category_children as $sub_category_child)
                                                <option value="{{ $sub_category_child->id }}" @selected($sub_category_child->id == $product->product_sub_category_child_id)>{{ $sub_category_child->title }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('sub_category_child')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Stock</h3>
                    </div>
                    <div class="card-body">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="stock">Stock*</label>
                                <input type="number"
                                       class="form-control @error('stock') is-invalid @enderror"
                                       id="stock" name="stock" value="{{ old('stock', $product->stock) }}">
                                @error('stock')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="min_stock">Minimum Stock</label>
                                <input type="number"
                                       class="form-control @error('min_stock') is-invalid @enderror"
                                       id="min_stock" name="min_stock" value="{{ old('min_stock', $product->min_stock) }}">
                                @error('min_stock')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="stock_status">Stock Status</label>
                                <select class="form-control @error('stock_status') is-invalid @enderror"
                                        id="stock_status"
                                        name="stock_status">
                                    <option value="1" {{ old('stock_status', $product->stock_status) == '1' ? 'selected' : '' }}>In
                                        stock
                                    </option>
                                    <option value="0" {{ old('stock_status', $product->stock_status) == '0' ? 'selected' : '' }}>Out
                                        of stock
                                    </option>
                                </select>
                                @error('stock_status')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Upload Image</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 image-container-div">
                                @if($product->image)
                                    <div class="form-group" style="display:inline-block;margin-right:10px;">
                                        <div class="image-container">
                                            <img
                                                src="{{ Storage::disk('public')->exists($product->image) ? Storage::url($product->image) : asset($product->image) }}"
                                                alt="Uploaded Image" id="uploadedImage" class="uploaded-image"
                                                onerror="this.onerror=null;this.src='';this.height='';this.width='';">
                                        </div>
                                    </div>
                                    <div style="display:inline-block;">
                                        <a href="javascript:void(0)"><i class="fa fa-times text-red deleteImg"
                                                                        data-model="Product" data-column="image"
                                                                        data-id="{{$product->id}}"></i></a>
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="detail_page_image">Details Page Image</label>
                                    <div class="input-group @error('detail_page_image') is-invalid @enderror">
                                        <input type="file" class="custom-file-input file-preview"
                                               id="detail_page_image"
                                               name="detail_page_image">
                                        <label class="custom-file-label" for="file">Choose file</label>
                                        <span class="pb-2">1080 × 1080</span>
                                        <div class="pt-3 file-holder"></div>
                                    </div>
                                    @error('detail_page_image')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12 image-container-div">
                                @if($product->detail_page_image)
                                    <div class="form-group" style="display:inline-block;margin-right:10px;">
                                        <div class="image-container">
                                            <img
                                                src="{{ Storage::disk('public')->exists($product->detail_page_image) ? Storage::url($product->detail_page_image) : asset($product->detail_page_image) }}"
                                                alt="Uploaded Image" id="uploadedImage" class="uploaded-image"
                                                onerror="this.onerror=null;this.src='';this.height='';this.width='';">
                                        </div>
                                    </div>
                                    <div style="display:inline-block;">
                                        <a href="javascript:void(0)"><i class="fa fa-times text-red deleteImg"
                                                                        data-model="Product" data-column="detail_page_image"
                                                                        data-id="{{$product->id}}"></i></a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-footer">
                        <span class="text-danger add-btn-error-cls"></span><br>
                        <button type="submit" class="btn btn-primary" id="">Update</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            // Summernote
            $('#specification,#description').summernote({
                minHeight: 200,
            });

            $('#category').on('change', function (e) {
                $('#sub_category').empty();
                $('#sub_category_child').empty();
                $.ajax({
                    url: "{{ route('get-parent-sub-categories', '') }}" + "/" + $(this).val(),
                    dataType: 'json',
                    success: function (result) {
                        $('#sub_category').append('<option selected value=""> Select sub category </option>');
                        var selected_value = '';
                        $.each(result, function (key, value) {
                            $('#sub_category').append('<option ' + selected_value + ' value= ' + value.id + ' > ' + value.title + ' </option>');
                        });
                    }
                });
            });

            $('#sub_category').on('change', function (e) {
                $('#sub_category_child').empty();
                $.ajax({
                    url: "{{ route('get-child-sub-categories', '') }}" + "/" + $(this).val(),
                    dataType: 'json',
                    success: function (result) {
                        $('#sub_category_child').append('<option selected value=""> Select child sub category </option>');
                        var selected_value = '';
                        $.each(result, function (key, value) {
                            $('#sub_category_child').append('<option ' + selected_value + ' value= ' + value.id + ' > ' + value.title + ' </option>');
                        });
                    }
                });
            });

            //form submit through ajax
            var debounceTimer;
            $('#ProductUpdateForm').on('submit', function (e) {
                clearTimeout(debounceTimer);
                e.preventDefault();

                $("#submitBtn").prop("disabled", true);

                var _this = $(this);
                let formData = new FormData(this);
                debounceTimer = setTimeout(function () {
                    $.ajax({
                        type: 'POST',
                        url: '{{ route('product.update', $product->id) }}',
                        data: formData,
                        contentType: false,
                        processData: false,
                        beforeSend: function () {
                            $('.add-btn-error-cls').html('');
                            $('#ProductUpdateForm').find('input, select, textarea').removeClass('is-invalid');
                            $('.invalid-feedback').remove();
                        }
                    })
                    .done(function (response) {
                        // toastr.success('Product Updated successfully')
                        window.location.href = "{{ route('product.index')}}";
                    })
                    .fail(function (response) {
                        $("#submitBtn").prop("disabled", false);
                        $('.add-btn-error-cls').html('Please fill all mandatory fields.');
                        $.each(response.responseJSON.errors, function (field_name, error) {
                            var msg = '<span class="error invalid-feedback" for="' + field_name + '">' + error + '</span>';
                            $("#ProductUpdateForm").find('input[name="' + field_name + '"], select[name="' + field_name + '"], textarea[name="' + field_name + '"]')
                                .removeClass('is-valid').addClass('is-invalid').attr("aria-invalid", "true").after(msg);
                        });
                        setTimeout(function () {
                            $('.add-btn-error-cls').empty()
                        }, 1000);
                    });
                }, 300);
            });
        });
    </script>
@endpush
