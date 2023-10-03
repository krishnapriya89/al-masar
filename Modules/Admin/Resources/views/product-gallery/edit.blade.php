@extends('admin::layouts.app')
@section('title', 'Update Product Gallery')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('product.index') }}">Products</a></li>
    <li class="breadcrumb-item"><a href="{{ route('product-gallery.index', base64_encode($product->id)) }}">Product Gallery</a></li>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Update <strong>{{ $gallery->product->title }}</strong> Product Gallery</h3>
                </div>
            </div>
        </div>
    </div>
    <!-- form start -->
    <form method="POST" action="{{ route('product-gallery.update', ['product' => $gallery->product_id, 'gallery' => $gallery->id]) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
    <!-- /.row -->
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Edit Details</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="file_type">FileType*</label>
                                    <select class="form-control @error('file_type') is-invalid @enderror" id="file_type"
                                            name="file_type" disabled>
                                        <option value="Image" {{ old('file_type', $gallery->file_type) == 'Image' ? 'selected' : '' }}>
                                            Image
                                        </option>
                                        <option value="Video" {{ old('file_type', $gallery->file_type) == 'Video' ? 'selected' : '' }}>
                                            Video
                                        </option>
                                    </select>
                                    @error('file_type')
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
                                           id="sort_order" name="sort_order" value="{{ old('sort_order', $gallery->sort_order) }}">
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
                                        <option value="1" {{ old('status', $gallery->status) == '1' ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ old('status', $gallery->status) == '0' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                    @error('status')
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
                        <h3 class="card-title">Upload File</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="file" class="file_label">{{ old('file_type', $gallery->file_type) }}*</label>
                                    <div class="input-group @error('file') is-invalid @enderror">
                                        <input type="file" class="custom-file-input file-preview" id="file"
                                               name="file">
                                        <label class="custom-file-label" for="file">Choose file</label>
                                        <span class="pb-2 imageDimDiv"
                                              @if(old('file_type', $gallery->file_type) == 'Video') style="display: none;" @endif>1080 × 1080 </span>
                                        <div class="pt-3 file-holder"></div>
                                    </div>
                                    @error('file')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="image-container image-container-div">
                                        @if ($gallery->file_type == 'Image')
                                            <img src="{{ Storage::disk('public')->exists($gallery->file) ? Storage::url($gallery->file) : asset($gallery->file) }}"
                                                 alt="Uploaded Image" id="uploadedImage" class="uploaded-image">
                                        @else
                                            <video controls="" controlslist="nodownload" preload="none" height="100"
                                                   onclick="this.play()" src="{{ asset(Storage::url($gallery->file)) }}">
                                            </video>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row thumbImageDiv" @if(old('file_type', $gallery->file_type) != 'Video') style="display: none;" @endif>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="thumb_image">Thumb Image*</label>
                                    <div class="input-group @error('thumb_image') is-invalid @enderror">
                                        <input type="file" class="custom-file-input file-preview" id="thumb_image"
                                               name="thumb_image">
                                        <label class="custom-file-label" for="file">Choose file</label>
                                        <span class="pb-2">1080 × 1080 </span>
                                        <div class="pt-3 file-holder"></div>
                                    </div>
                                    @error('thumb_image')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                @if($gallery->thumb_image)
                                    <div class="form-group">
                                        <div class="image-container image-container-div">
                                            <img src="{{ Storage::disk('public')->exists($gallery->thumb_image) ? Storage::url($gallery->thumb_image) : asset($gallery->thumb_image) }}"
                                                 alt="Uploaded Image" id="uploadedImage" class="uploaded-image">
                                        </div>
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
                        <button type="submit" class="btn btn-primary" id="submitBtn">Update</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
@push('js')
    <script>
        $(document).ready(function () {
            // Summernote
            $('#description').summernote({
                minHeight: 200,
            });

            $("#file_type").change(function () {
                $('.file_label').html($(this).val());
                $('.invalid-feedback').html('');
                if ($(this).val() === 'Image') {
                    $('.imageDimDiv').show();
                    $('.thumbImageDiv').hide();
                } else {
                    $('.imageDimDiv').hide();
                    $('.thumbImageDiv').show();
                }
            });
        });
    </script>
@endpush
