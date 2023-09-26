@extends('admin::layouts.app')
@section('title', 'Edit Home Banner')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit  Home Banner</h3>
                    <div class="card-tools">
                        <a href="{{route('home-banner.index')}}" class="btn btn-primary btn-sm">
                            <i class="fas fa-list"></i>  Home Banners
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- form start -->
    <form method="POST" action="{{route('home-banner.update',$home_banner->id)}}" enctype="multipart/form-data" >
        @method('PUT')
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
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                           id="title" name="title" value="{{ old('title',@$home_banner->title) }}">
                                    @error('title')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="sub_title">Sub Title</label>
                                    <input type="text" class="form-control @error('sub_title') is-invalid @enderror"
                                           id="sub_title" name="sub_title" value="{{ old('sub_title',@$home_banner->sub_title) }}">
                                    @error('sub_title')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="button_name">Button Name</label>
                                    <input type="text" class="form-control @error('button_name') is-invalid @enderror"
                                           id="button_name" name="button_name" value="{{ old('button_name',@$home_banner->button_name) }}">
                                    @error('button_name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="button_link">Button Link</label>
                                        <input type="text" class="form-control @error('button_link') is-invalid @enderror"
                                               id="button_link" name="button_link" value="{{ old('button_link',@$home_banner->button_link) }}">
                                        @error('button_link')
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
                                           id="sort_order" name="sort_order" value="{{ old('sort_order',@$home_banner->sort_order) }}">
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
                                            <option value="1" {{ old('status',@$home_banner->status) == '1' ? 'selected' : '' }}>Active</option>
                                            <option value="0" {{ old('status'.@$home_banner->status) == '0' ? 'selected' : '' }}>Inactive</option>
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
                                    <label for="image">Image</label>
                                    <div class="input-group @error('image') is-invalid @enderror">
                                            <input type="file" class="custom-file-input file-preview" id="image"
                                                   name="image">
                                            <label class="custom-file-label" for="file">Choose file</label>
                                        768 x 350
                                        <div class="pt-3 file-holder"> </div>
                                    </div>
                                    @error('image')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-12 image-container-div">
                                    @if($home_banner->image != '' || $home_banner->image != NULL)
                                    <div class="form-group" style="display:inline-block;margin-right:10px;">
                                        <div class="image-container">
                                            <img src="{{ Storage::disk('public')->exists($home_banner->image) ? Storage::url($home_banner->image) : asset($home_banner->image) }}"
                                                 alt="Uploaded Image" id="uploadedImage" class="uploaded-image">

                                        </div>
                                    </div>
                                    {{-- <div style="display:inline-block;">
                                        <a href="javascript:void(0)"><i class="fa fa-times text-red deleteImg" data-model="FixedHomeBanner" data-column="image" data-id="{{$home_banner->id}}"></i></a>
                                    </div> --}}
                                @endif
                                </div>
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
        $(document).ready(function() {
            // Summernote
            $('#description').summernote({
                minHeight: 200,
            });
        });
    </script>
@endpush
