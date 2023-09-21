@extends('admin::layouts.app')
@section('title', 'Edit Contact Common Content')
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
    <form method="POST" action="{{ route('contact.update',$common_content->id)}}" enctype="multipart/form-data">
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
                                    <label for="application_form_title">Application Form Title</label>
                                    <input type="text" class="form-control @error('application_form_title') is-invalid @enderror"
                                           id="application_form_title" name="application_form_title" value="{{ old('application_form_title',@$common_content->application_form_title) }}">
                                    @error('application_form_title')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
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
                                    <label for="description"> Description</label>
                                    <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror">{{old('description',@$common_content->description)}}</textarea>
                                    @error('description')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone">Phone Number </label>
                                    <input type="number" class="form-control @error('phone') is-invalid @enderror"
                                           id="phone" name="phone" value="{{ old('phone',@$common_content->phone) }}">
                                    @error('phone')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                           id="email" name="email" value="{{ old('email',@$common_content->email) }}">
                                    @error('email')
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
                                    <label for="background_image">Background Image</label>
                                    <div class="input-group @error('background_image') is-invalid @enderror">
                                            <input type="file" class="custom-file-input file-preview" id="background_image"
                                                   name="background_image">
                                            <label class="custom-file-label" for="file">Choose file</label>
                                        804 × 493
                                        <div class="pt-3 file-holder"> </div>
                                    </div>
                                    @error('background_image')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-12 image-container-div">
                                    @if($common_content->background_image != '' || $common_content->background_image != NULL)
                                    <div class="form-group" style="display:inline-block;margin-right:10px;">
                                        <div class="image-container">
                                            <img src="{{ Storage::disk('public')->exists($common_content->background_image) ? Storage::url($common_content->background_image) : asset($common_content->background_image) }}"
                                                 alt="Uploaded Image" id="uploadedImage" class="uploaded-image">

                                        </div>
                                    </div>
                                    <div style="display:inline-block;">
                                        <a href="javascript:void(0)"><i class="fa fa-times text-red deleteImg" data-model="Contact" data-column="background_image" data-id="{{$common_content->id}}"></i></a>
                                    </div>
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
