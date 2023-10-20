@extends('admin::layouts.app')
@section('title', 'Create Product Gallery')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('product.index') }}">Products</a></li>
    <li class="breadcrumb-item"><a href="{{ route('product-gallery.index', base64_encode($product->id)) }}">Product Gallery</a></li>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Create <strong>{{ $product->title }}</strong> Product Gallery</h3>
                    <div class="card-tools">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- form start -->
    <form method="POST" action="{{ route('product-gallery.store', $product->id) }}" enctype="multipart/form-data">
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
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="file_type">FileType*</label>
                                    <select class="form-control @error('file_type') is-invalid @enderror" id="file_type"
                                            name="file_type">
                                        <option value="Image" {{ old('file_type') == 'Image' ? 'selected' : '' }}>
                                            Image
                                        </option>
                                        <option value="Video" {{ old('file_type') == 'Video' ? 'selected' : '' }}>
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
                        <div class="row imageDiv"  @if(old('file_type') && old('file_type') != 'Image') style="display: none;" @endif>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="image_file" class="file_label">Image *</label>
                                    <div class="input-group @error('image_file') is-invalid @enderror">
                                        <input type="file" multiple accept="image/jpeg,image/png,image/webp,image/jpg" class="custom-file-input" id="image_file"
                                               name="image_file[]">
                                        <label class="custom-file-label" for="image_file">Choose file</label>
                                        <span class="pb-2">1080 × 1080 </span>
                                        <div class="pt-3 image-count-holder"></div>
                                    </div>
                                    @error('image_file')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div style="font-size: 13px;">Hint: You can select mulitple images
                                    <span></span>
                                    </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 videoDiv"  @if(old('file_type') != 'Video') style="display: none;" @endif>
                                <div class="form-group">
                                    <label for="video_file" class="file_label">Video *</label>
                                    <div class="input-group @error('video_file') is-invalid @enderror">
                                        <input type="file" accept="video/*" class="custom-file-input file-preview" id="video_file"
                                               name="video_file">
                                        <label class="custom-file-label" for="video_file">Choose file</label>
                                        <div class="pt-3 file-holder"></div>
                                    </div>
                                    @error('video_file')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row thumbImageDiv" @if(old('file_type') != 'Video') style="display: none;" @endif>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="thumb_image">Thumb Image*</label>
                                    <div class="input-group @error('thumb_image') is-invalid @enderror">
                                        <input type="file" accept="image/jpeg,image/png,image/webp,image/jpg" class="custom-file-input file-preview" id="thumb_image"
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
            // Summernote
            $('#description').summernote({
                minHeight: 200,
            });

            $('#image_file').on('change', function() {
                var selectedImagesCount = $(this).get(0).files.length;
                $('.image-count-holder').text(selectedImagesCount + ' images selected.');
            });

            $("#file_type").change(function () {
                $('.invalid-feedback').html('');
                if ($(this).val() === 'Image') {
                    $('.imageDiv').show();
                    $('.videoDiv').hide();
                    $('.thumbImageDiv').hide();
                } else {
                    $('.imageDiv').hide();
                    $('.videoDiv').show();
                    $('.thumbImageDiv').show();
                }
            });
        });
    </script>
@endpush
