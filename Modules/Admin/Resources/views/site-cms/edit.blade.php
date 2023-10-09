@extends('admin::layouts.app')
@section('title', 'Edit Site Common Content')
@push('css')

    <link rel=" stylesheet" href="{{ asset('backend/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

@endpush
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
    <form method="POST" action="{{ route('site-common-cms.update', $common_content->id) }}" enctype="multipart/form-data">
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
                                    <label for="header_note">Header Note</label>
                                    <input type="text" class="form-control @error('header_note') is-invalid @enderror"
                                        id="header_note" name="header_note"
                                        value="{{ old('header_note', @$common_content->header_note) }}">
                                    @error('header_note')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="header_phone_number">Header Phone Number</label>
                                    <input type="text"
                                        class="form-control @error('header_phone_number') is-invalid @enderror"
                                        id="banner_title" name="header_phone_number"
                                        value="{{ old('title', @$common_content->header_phone_number) }}">
                                    @error('header_phone_number')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="footer_description">Footer Description</label>
                                    <textarea name="footer_description" id="footer_description"
                                        class="form-control @error('footer_description') is-invalid @enderror">{{ old('footer_description', @$common_content->footer_description) }}</textarea>
                                    @error('footer_description')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="enquiry_receive_email">Enquiry Recieve Email</label>
                                    <input type="text"
                                        class="form-control @error('enquiry_receive_email') is-invalid @enderror"
                                        id="enquiry_receive_email" name="enquiry_receive_email"
                                        value="{{ old('enquiry_receive_email', @$common_content->enquiry_receive_email) }}">
                                    @error('enquiry_receive_email')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                        id="phone" name="phone" value="{{ old('phone', @$common_content->phone) }}">
                                    @error('phone')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control @error('email') is-invalid @enderror"
                                        id="email" name="email" value="{{ old('email', @$common_content->email) }}">
                                    @error('email')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="copy_right">Copy Right</label>
                                    <input type="text" class="form-control @error('copy_right') is-invalid @enderror"
                                        id="copy_right" name="copy_right"
                                        value="{{ old('copy_right', @$common_content->copy_right) }}">
                                    @error('copy_right')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <textarea name="address" id="address" class="form-control @error('address') is-invalid @enderror">{{ old('address', @$common_content->address) }}</textarea>
                                    @error('address')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="instagram_link">Instagram Link</label>
                                    <input type="string" class="form-control @error('instagram_link') is-invalid @enderror"
                                        id="instagram_link" name="instagram_link"
                                        value="{{ old('instagram_link', @$common_content->instagram_link) }}">
                                    @error('instagram_link')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="twitter_link">Twitter Link</label>
                                    <input type="text" class="form-control @error('twitter_link') is-invalid @enderror"
                                        id="twitter_link" name="twitter_link"
                                        value="{{ old('twitter_link', @$common_content->twitter_link) }}">
                                    @error('twitter_link')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="facebook_link">Facebook Link</label>
                                    <input type="string"
                                        class="form-control @error('facebook_link') is-invalid @enderror"
                                        id="facebook_link" name="facebook_link"
                                        value="{{ old('facebook_link', @$common_content->facebook_link) }}">
                                    @error('facebook_link')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="linkedIn_link">LikedIn Link</label>
                                    <input type="string"
                                        class="form-control @error('linkedIn_link') is-invalid @enderror"
                                        id="linkedIn_link" name="linkedIn_link"
                                        value="{{ old('linkedIn_link', @$common_content->linkedIn_link) }}">
                                    @error('linkedIn_link')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="menu_category">Categories</label>
                                <select name="menu_category[]" id="menu_category" class="form-control select2" multiple>
                                    <option value="">Please Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{$category->id}}" @if(in_array($category->id, $common_content->menu_category)) selected @endif>{{ $category->title }}</option>
                                    @endforeach
                                </select>
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
                                    <label for="payment_image">Payment Image</label>
                                    <div class="input-group @error('payment_image') is-invalid @enderror">
                                        <input type="file" class="custom-file-input file-preview" id="payment_image"
                                            name="payment_image">
                                        <label class="custom-file-label" for="file">Choose file</label>
                                        182 x 37
                                        <div class="pt-3 file-holder"> </div>
                                    </div>
                                    @error('image')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-12 image-container-div">
                                    @if ($common_content->payment_image != '' || $common_content->payment_image != null)
                                        <div class="form-group" style="display:inline-block;margin-right:10px;">
                                            <div class="image-container">
                                                <img src="{{ Storage::disk('public')->exists($common_content->payment_image) ? Storage::url($common_content->payment_image) : asset($common_content->payment_image) }}"
                                                    alt="Uploaded Image" id="uploadedImage" class="uploaded-image">

                                            </div>
                                        </div>
                                        <div style="display:inline-block;">
                                            <a href="javascript:void(0)"><i class="fa fa-times text-red deleteImg"
                                                    data-model="SiteCommonContent" data-column="payment_image"
                                                    data-id="{{ $common_content->id }}"></i></a>
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
 <!-- Select2 -->
 <script src="{{ asset('backend/plugins/select2/js/select2.full.min.js') }}"></script>
    <script>

        $(document).ready(function() {
            // Summernote
            $('#footer_description').summernote({
                minHeight: 200,
            });

            $(".select2").select2({
        });

        });
    </script>
@endpush
