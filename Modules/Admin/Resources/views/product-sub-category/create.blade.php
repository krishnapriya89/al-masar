@extends('admin::layouts.app')
@section('title', 'Create Product Sub Category')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Create Product Sub Category</h3>
                    <div class="card-tools">
                        <a href="{{ route('product-sub-category.index') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-list"></i> Product Sub Categories
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- form start -->
    <form method="POST" action="{{ route('product-sub-category.store') }}" enctype="multipart/form-data">
    @csrf
    <!-- /.row -->
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Add Details</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="title">Title*</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                           id="title" name="title" value="{{ old('title') }}">
                                    @error('title')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sort_order">Sort Order</label>
                                    <input type="number" class="form-control @error('sort_order') is-invalid @enderror"
                                           id="sort_order" name="sort_order" value="{{ old('sort_order') }}">
                                    @error('sort_order')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-control @error('status') is-invalid @enderror" id="status"
                                            name="status">
                                        <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                    @error('status')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 not-last-child-div">
                                <div class="form-group">
                                    <label for="is_last_child">Is Last Child</label>
                                    <select class="form-control @error('is_last_child') is-invalid @enderror"
                                            id="is_last_child"
                                            name="is_last_child">
                                        <option value="1" {{ old('is_last_child') == '1' ? 'selected' : '' }}>Yes
                                        </option>
                                        <option value="0" {{ old('is_last_child') == '0' ? 'selected' : '' }}>No
                                        </option>
                                    </select>
                                    @error('is_last_child')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
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
                                    <label for="main_category">Choose Main Category*</label>
                                    <select id="main_category" name="main_category"
                                            class="form-control @error('main_category') is-invalid @enderror">
                                        <option value="" disabled selected>Select Category</option>
                                        @foreach($main_categories as $main_category)
                                            <option
                                                {{ old('main_category') == $main_category->id ? 'selected' : '' }} value="{{ $main_category->id }}">{{ $main_category->title }}</option>
                                        @endforeach
                                    </select>
                                    @error('main_category')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="sub_category">Choose Sub Category</label>
                                    <select id="sub_category" name="sub_category"
                                            class="form-control @error('sub_category') is-invalid @enderror">
                                        <option value="" selected>Select Sub Category</option>
                                    </select>
                                    @error('sub_category')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" id="submitBtn">Create</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
@push('js')
    <script>

        $(document).ready(function () {
            @if(old('main_category'))
            get_sub_categories('{{ old('main_category') }}');
            @endif
            $('#main_category').change(function () {
                get_sub_categories($(this).val());
            });

            @if(old('sub_category'))
            $('.not-last-child-div').addClass('d-none');
            @endif

            $('#sub_category').change(function () {
                if ($(this).val() != '')
                    $('.not-last-child-div').addClass('d-none');
                else
                    $('.not-last-child-div').removeClass('d-none');
            });
        });

        function get_sub_categories(category_id) {
            $('#sub_category').empty();
            var sub_category_id = '';
            @if(old('sub_category'))
                sub_category_id = '{{ old('sub_category') }}';
            @endif
            $.ajax({
                url: "{{ route('get-not-last-child-sub-categories', '') }}" + "/" + category_id,
                dataType: 'json',
                success: function (result) {
                    $('#sub_category').append('<option selected value=""> Select sub category </option>');
                    var selected_value = '';
                    $.each(result, function (key, value) {
                        if (sub_category_id == value.id)
                            var selected_value = 'selected';
                        $('#sub_category').append('<option ' + selected_value + ' value= ' + value.id + ' > ' + value.title + ' </option>');
                    });
                }
            });
        }
    </script>
@endpush
