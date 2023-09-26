@extends('admin::layouts.app')
@section('title', 'Edit About Us Common Content')
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
    <form method="POST" action="{{ route('about-us.update',$common_content->id)}}" enctype="multipart/form-data">
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
                                    <label for="banner_title">Banner Title</label>
                                    <input type="text" class="form-control @error('banner_title') is-invalid @enderror"
                                           id="banner_title" name="banner_title" value="{{ old('title',@$common_content->banner_title) }}">
                                    @error('banner_title')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="banner_description">Banner Description</label>
                                    <textarea name="banner_description" id="banner_description" class="form-control @error('banner_description') is-invalid @enderror">{{old('banner_description',@$common_content->banner_description)}}</textarea>
                                    @error('banner_description')
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
                                    <label for="description">Description</label>
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
                                    <label for="home_page_button_name">Home Page Button Name</label>
                                    <input type="text" class="form-control @error('home_page_button_name') is-invalid @enderror"
                                           id="home_page_button_name" name="home_page_button_name" value="{{ old('home_page_button_name',@$common_content->home_page_button_name) }}">
                                    @error('home_page_button_name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="home_page_button_link">Home Page Button Link</label>
                                    <input type="text" class="form-control @error('home_page_button_link') is-invalid @enderror"
                                           id="home_page_button_link" name="home_page_button_link" value="{{ old('home_page_button_link',@$common_content->home_page_button_link) }}">
                                    @error('home_page_button_link')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="section_one_value_one">Section One Value One</label>
                                    <input type="number" min="0" class="form-control @error('section_one_value_one') is-invalid @enderror"
                                           id="section_one_value_one" name="section_one_value_one" value="{{ old('section_one_value_one',@$common_content->section_one_value_one) }}">
                                    @error('section_one_value_one')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="section_one_title_one">Section One Title One</label>
                                    <input type="text" class="form-control @error('section_one_title_one') is-invalid @enderror"
                                           id="section_one_title_one" name="section_one_title_one" value="{{ old('section_one_title_one',@$common_content->section_one_title_one) }}">
                                    @error('section_one_title_one')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="section_one_value_two">Section One Value Two</label>
                                    <input type="number" min="0"class="form-control @error('section_one_value_two') is-invalid @enderror"
                                           id="section_one_value_two" name="section_one_value_two" value="{{ old('section_one_value_two',@$common_content->section_one_value_two) }}">
                                    @error('section_one_value_two')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="section_one_title_two">Section One Title Two</label>
                                    <input type="text" class="form-control @error('section_one_title_two') is-invalid @enderror"
                                           id="section_one_title_two" name="section_one_title_two" value="{{ old('section_one_title_two',@$common_content->section_one_title_two) }}">
                                    @error('section_one_title_two')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="section_one_value_three">Section One Value Three</label>
                                    <input type="number" min="0" class="form-control @error('section_one_value_three') is-invalid @enderror"
                                           id="section_one_value_three" name="section_one_value_three" value="{{ old('section_one_value_three',@$common_content->section_one_value_three) }}">
                                    @error('section_one_value_three')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="section_one_title_three">Section One Title Three</label>
                                    <input type="text" class="form-control @error('section_one_title_three') is-invalid @enderror"
                                           id="section_one_title_three" name="section_one_title_three" value="{{ old('section_one_title_three',@$common_content->section_one_title_three) }}">
                                    @error('section_one_title_three')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="section_one_value_four">Section One Value Four</label>
                                    <input type="number" min="0" class="form-control @error('section_one_value_four') is-invalid @enderror"
                                           id="section_one_value_four" name="section_one_value_four" value="{{ old('section_one_value_four',@$common_content->section_one_value_four) }}">
                                    @error('section_one_value_four')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="section_one_title_four">Section One Title Four</label>
                                    <input type="text" class="form-control @error('section_one_title_four') is-invalid @enderror"
                                           id="section_one_title_four" name="section_one_title_four" value="{{ old('section_one_title_four',@$common_content->section_one_title_four) }}">
                                    @error('section_one_title_four')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="mission_title">Mission Title</label>
                                    <input type="text" class="form-control @error('mission_title') is-invalid @enderror"
                                           id="mission_title" name="mission_title" value="{{ old('mission_title',@$common_content->mission_title) }}">
                                    @error('mission_title')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="mission_description">Mission Description</label>
                                    <textarea name="mission_description" id="mission_description" class="form-control @error('mission_description') is-invalid @enderror">{{old('mission_description',@$common_content->mission_description)}}</textarea>
                                    @error('mission_description')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="vision_title">Vision Title</label>
                                    <input type="text" class="form-control @error('vision_title') is-invalid @enderror"
                                           id="vision_title" name="vision_title" value="{{ old('vision_title',@$common_content->vision_title) }}">
                                    @error('vision_title')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="vision_description">Vision Description</label>
                                    <textarea name="vision_description" id="vision_description" class="form-control @error('vision_description') is-invalid @enderror">{{old('vision_description',@$common_content->vision_description)}}</textarea>
                                    @error('vision_description')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="values_title">Values Title</label>
                                    <input type="text" class="form-control @error('values_title') is-invalid @enderror"
                                           id="values_title" name="values_title" value="{{ old('values_title',@$common_content->values_title) }}">
                                    @error('values_title')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="values_description">Values Description</label>
                                    <textarea name="values_description" id="values_description" class="form-control @error('values_description') is-invalid @enderror">{{old('values_description',@$common_content->values_description)}}</textarea>
                                    @error('values_description')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="meta_title">Meta Title</label>
                                    <input type="text" class="form-control @error('meta_title') is-invalid @enderror"
                                           id="meta_title" name="meta_title" value="{{ old('meta_title',@$common_content->meta_title) }}">
                                    @error('meta_title')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="meta_keywords">Meta Keywords</label>
                                    <input type="text" class="form-control @error('meta_keywords') is-invalid @enderror"
                                           id="meta_keywords" name="meta_keywords" value="{{ old('meta_keywords',@$common_content->meta_keywords) }}">
                                    @error('meta_title')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="meta_description">Meta Description</label>
                                    <textarea name="meta_description" id="meta_description" class="form-control @error('meta_description') is-invalid @enderror">{{old('meta_description',@$common_content->meta_description)}}</textarea>
                                    @error('meta_description')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="other_meta_tags">Other Meta Tags</label>
                                    <textarea name="other_meta_tags" id="other_meta_tags" class="form-control @error('other_meta_tags') is-invalid @enderror">{{old('other_meta_tags',@$common_content->other_meta_tags)}}</textarea>
                                    @error('other_meta_tags')
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
                                        468 x 372
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
                                        <a href="javascript:void(0)"><i class="fa fa-times text-red deleteImg" data-model="AboutUs" data-column="image" data-id="{{$common_content->id}}"></i></a>
                                    </div> --}}
                                @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Upload Banner Image</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="banner_image">Banner Image</label>
                                    <div class="input-group @error('banner_image') is-invalid @enderror">
                                            <input type="file" class="custom-file-input file-preview" id="banner_image"
                                                   name="banner_image">
                                            <label class="custom-file-label" for="file">Choose file</label>
                                       1920 x 435
                                        <div class="pt-3 file-holder"> </div>
                                    </div>
                                    @error('banner_image')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-12 image-container-div">
                                    @if($common_content->banner_image != '' || $common_content->banner_image != NULL)
                                    <div class="form-group" style="display:inline-block;margin-right:10px;">
                                        <div class="image-container">
                                            <img src="{{ Storage::disk('public')->exists($common_content->banner_image) ? Storage::url($common_content->banner_image) : asset($common_content->banner_image) }}"
                                                 alt="Uploaded Image" id="uploadedImage" class="uploaded-image">

                                        </div>
                                    </div>
                                    {{-- <div style="display:inline-block;">
                                        <a href="javascript:void(0)"><i class="fa fa-times text-red deleteImg" data-model="AboutUs" data-column="banner_image" data-id="{{$common_content->id}}"></i></a>
                                    </div> --}}
                                @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Upload Mission Background Image</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="mission_bg_image">Mission Background Image</label>
                                    <div class="input-group @error('mission_bg_image') is-invalid @enderror">
                                            <input type="file" class="custom-file-input file-preview" id="mission_bg_image"
                                                   name="mission_bg_image">
                                            <label class="custom-file-label" for="file">Choose file</label>
                                        800 x 450
                                        <div class="pt-3 file-holder"> </div>
                                    </div>
                                    @error('mission_bg_image')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-12 image-container-div">
                                    @if($common_content->mission_bg_image != '' || $common_content->mission_bg_image != NULL)
                                    <div class="form-group" style="display:inline-block;margin-right:10px;">
                                        <div class="image-container">
                                            <img src="{{ Storage::disk('public')->exists($common_content->mission_bg_image) ? Storage::url($common_content->mission_bg_image) : asset($common_content->mission_bg_image) }}"
                                                 alt="Uploaded Image" id="uploadedImage" class="uploaded-image">

                                        </div>
                                    </div>
                                    {{-- <div style="display:inline-block;">
                                        <a href="javascript:void(0)"><i class="fa fa-times text-red deleteImg" data-model="AboutUs" data-column="mission_bg_image" data-id="{{$common_content->id}}"></i></a>
                                    </div> --}}
                                @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Upload Vision Background Image</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="vision_bg_image">Vision Background Image</label>
                                    <div class="input-group @error('vision_bg_image') is-invalid @enderror">
                                            <input type="file" class="custom-file-input file-preview" id="vision_bg_image"
                                                   name="vision_bg_image">
                                            <label class="custom-file-label" for="file">Choose file</label>
                                        800 x 450
                                        <div class="pt-3 file-holder"> </div>
                                    </div>
                                    @error('vision_bg_image')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-12 image-container-div">
                                    @if($common_content->vision_bg_image != '' || $common_content->vision_bg_image != NULL)
                                    <div class="form-group" style="display:inline-block;margin-right:10px;">
                                        <div class="image-container">
                                            <img src="{{ Storage::disk('public')->exists($common_content->vision_bg_image) ? Storage::url($common_content->vision_bg_image) : asset($common_content->vision_bg_image) }}"
                                                 alt="Uploaded Image" id="uploadedImage" class="uploaded-image">

                                        </div>
                                    </div>
                                    {{-- <div style="display:inline-block;">
                                        <a href="javascript:void(0)"><i class="fa fa-times text-red deleteImg" data-model="AboutUs" data-column="vision_bg_image" data-id="{{$common_content->id}}"></i></a>
                                    </div> --}}
                                @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Upload Values Background Image</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="values_bg_image">Values Background Image</label>
                                    <div class="input-group @error('values_bg_image') is-invalid @enderror">
                                            <input type="file" class="custom-file-input file-preview" id="values_bg_image"
                                                   name="values_bg_image">
                                            <label class="custom-file-label" for="file">Choose file</label>
                                       549 x549
                                        <div class="pt-3 file-holder"> </div>
                                    </div>
                                    @error('values_bg_image')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-12 image-container-div">
                                    @if($common_content->values_bg_image != '' || $common_content->values_bg_image != NULL)
                                    <div class="form-group" style="display:inline-block;margin-right:10px;">
                                        <div class="image-container">
                                            <img src="{{ Storage::disk('public')->exists($common_content->values_bg_image) ? Storage::url($common_content->values_bg_image) : asset($common_content->values_bg_image) }}"
                                                 alt="Uploaded Image" id="uploadedImage" class="uploaded-image">

                                        </div>
                                    </div>
                                    {{-- <div style="display:inline-block;">
                                        <a href="javascript:void(0)"><i class="fa fa-times text-red deleteImg" data-model="AboutUs" data-column="values_bg_image" data-id="{{$common_content->id}}"></i></a>
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
            $('#banner_description,#description,#mission_description,#vision_description,#values_description').summernote({
                minHeight: 200,
            });
        });
    </script>
@endpush
