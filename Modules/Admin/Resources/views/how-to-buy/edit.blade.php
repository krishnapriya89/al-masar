@extends('admin::layouts.app')
@section('title', 'Edit How To Buy Choose Common Content')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-tools">
                        {{-- <a href="{{route('testimonials.index')}}" class="btn btn-primary btn-sm">
                            <i class="fas fa-list"></i> Testimonials
                        </a> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- form start -->
    <form method="POST" action=" {{ route('how-to-buy.update',$common_content->id)}}" enctype="multipart/form-data">
        @csrf
    <!-- /.row -->
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
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                           id="title" name="title" value="{{ old('title',@$common_content->title) }}">
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
                                           id="sub_title" name="sub_title" value="{{ old('sub_title',@$common_content->sub_title) }}">
                                    @error('sub_title')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="section_one_title">Section One Title </label>
                                    <input type="text" class="form-control @error('section_one_title') is-invalid @enderror"
                                           id="section_one_title" name="section_one_title" value="{{ old('section_one_title',@$common_content->section_one_title) }}">
                                    @error('section_one_title')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="section_one_description">Section One  Description</label>
                                    <textarea name="section_one_description" id="section_one_description" class="form-control @error('section_one_description') is-invalid @enderror">{{old('mission_description',@$common_content->section_one_description)}}</textarea>
                                    @error('section_one_description')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="section_two_title">Section Two Title</label>
                                    <input type="text" class="form-control @error('section_two_title') is-invalid @enderror"
                                           id="section_two_title" name="section_two_title" value="{{ old('section_two_title',@$common_content->section_two_title) }}">
                                    @error('section_two_title')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="section_two_description">Section Two  Description</label>
                                    <textarea name="section_two_description" id="section_two_description" class="form-control @error('section_two_description') is-invalid @enderror">{{old('section_two_description',@$common_content->section_two_description)}}</textarea>
                                    @error('section_two_description')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="section_three_title">Section Three Title </label>
                                    <input type="text" class="form-control @error('section_three_title') is-invalid @enderror"
                                           id="section_three_title" name="section_three_title" value="{{ old('section_three_title',@$common_content->section_three_title) }}">
                                    @error('section_three_title')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="section_three_description">Section Three  Description</label>
                                    <textarea name="section_three_description" id="section_three_description" class="form-control @error('section_three_description') is-invalid @enderror">{{old('section_three_description',@$common_content->section_three_description)}}</textarea>
                                    @error('section_three_description')
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
                                       1008 x 1072
                                        <div class="pt-3 file-holder"> </div>
                                    </div>
                                    @error('image')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-12 image-container-div">
                                    @if($common_content->image != '' || $common_content->image != NULL)
                                    <div class="form-group" style="display:inline-block;margin-right:10px;">
                                        <div class="image-container">
                                            <img src="{{ Storage::disk('public')->exists($common_content->image) ? Storage::url($common_content->image) : asset($common_content->image) }}"
                                                 alt="Uploaded Image" id="uploadedImage" class="uploaded-image">

                                        </div>
                                    </div>
                                    {{-- <div style="display:inline-block;">
                                        <a href="javascript:void(0)"><i class="fa fa-times text-red deleteImg" data-model="HowToBuy" data-column="image" data-id="{{$common_content->id}}"></i></a>
                                    </div> --}}
                                @endif
                                </div>
                            </div>
                        </div>
                        {{-- <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="section_one_image">Section One Image</label>
                                    <div class="input-group @error('section_one_image') is-invalid @enderror">
                                            <input type="file" class="custom-file-input file-preview" id="section_one_image"
                                                   name="section_one_image">
                                            <label class="custom-file-label" for="file">Choose file</label>

                                        <div class="pt-3 file-holder"> </div>
                                    </div>
                                    @error('section_one_image')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-12 image-container-div">
                                    @if($common_content->section_one_image != '' || $common_content->section_one_image != NULL)
                                    <div class="form-group" style="display:inline-block;margin-right:10px;">
                                        <div class="image-container">
                                            <img src="{{ Storage::disk('public')->exists($common_content->section_one_image) ? Storage::url($common_content->section_one_image) : asset($common_content->section_one_image) }}"
                                                 alt="Uploaded Image" id="uploadedImage" class="uploaded-image">

                                        </div>
                                    </div>
                                    <div style="display:inline-block;">
                                        <a href="javascript:void(0)"><i class="fa fa-times text-red deleteImg" data-model="HowToBuy" data-column="section_one_image" data-id="{{$common_content->id}}"></i></a>
                                    </div>
                                @endif
                                </div>
                            </div>
                        </div> --}}
                        {{-- <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="section_two_image">Section Two Image </label>
                                    <div class="input-group @error('section_two_image') is-invalid @enderror">
                                            <input type="file" class="custom-file-input file-preview" id="banner_image"
                                                   name="section_two_image">
                                            <label class="custom-file-label" for="file">Choose file</label>

                                        <div class="pt-3 file-holder"> </div>
                                    </div>
                                    @error('section_two_image')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-12 image-container-div">
                                    @if($common_content->section_two_image != '' || $common_content->section_two_image != NULL)
                                    <div class="form-group" style="display:inline-block;margin-right:10px;">
                                        <div class="image-container">
                                            <img src="{{ Storage::disk('public')->exists($common_content->section_two_image) ? Storage::url($common_content->section_two_image) : asset($common_content->banner_image) }}"
                                                 alt="Uploaded Image" id="uploadedImage" class="uploaded-image">

                                        </div>
                                    </div>
                                    <div style="display:inline-block;">
                                        <a href="javascript:void(0)"><i class="fa fa-times text-red deleteImg" data-model="HowToBuy" data-column="section_two_image" data-id="{{$common_content->id}}"></i></a>
                                    </div>
                                @endif
                                </div>
                            </div>
                        </div> --}}
                        {{-- <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="section_three_image">Section Three Image </label>
                                    <div class="input-group @error('section_three_image') is-invalid @enderror">
                                            <input type="file" class="custom-file-input file-preview" id="section_three_image"
                                                   name="section_three_image">
                                            <label class="custom-file-label" for="file">Choose file</label>

                                        <div class="pt-3 file-holder"> </div>
                                    </div>
                                    @error('section_three_image')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-12 image-container-div">
                                    @if($common_content->section_three_image != '' || $common_content->section_three_image != NULL)
                                    <div class="form-group" style="display:inline-block;margin-right:10px;">
                                        <div class="image-container">
                                            <img src="{{ Storage::disk('public')->exists($common_content->section_three_image) ? Storage::url($common_content->section_three_image) : asset($common_content->section_three_image) }}"
                                                 alt="Uploaded Image" id="uploadedImage" class="uploaded-image">

                                        </div>
                                    </div>
                                    <div style="display:inline-block;">
                                        <a href="javascript:void(0)"><i class="fa fa-times text-red deleteImg" data-model="HowToBuy" data-column="section_three_image" data-id="{{$common_content->id}}"></i></a>
                                    </div>
                                @endif
                                </div>
                            </div>
                        </div> --}}
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
            $('#section_one_description,#section_two_description,#section_three_description').summernote({
                minHeight: 200,
            });
        });
    </script>
@endpush
