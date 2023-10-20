@extends('admin::layouts.app')
@section('title', $method .' '. ucwords(str_replace('_', ' ', $page)) .' CMS')
@section('content')
    <!-- form start -->
    <form method="POST" action="{{ route('auth-page-management.update', $page) }}" enctype="multipart/form-data">
    @csrf
    <!-- /.row -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ $type }} Details</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="image">Image *</label>
                                    <div class="input-group @error('image') is-invalid @enderror">
                                        <input type="file" class="custom-file-input file-preview" id="image"
                                            name="image">
                                        <label class="custom-file-label" for="file">Choose file</label>
                                        <span class="image-size-span" >714 × 854</span>
                                        <div class="pt-3 file-holder"> </div>
                                    </div>
                                    @error('image')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                @if(@$data->image)
                                <div class="form-group">
                                    <div class="image-container">
                                        <img src="{{ Storage::disk('public')->exists($data->image) ? Storage::url($data->image) : asset($data->image) }}"
                                        alt="Uploaded Image" id="uploadedImage" class="uploaded-image">
                                    </div>
                                </div>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="form_title">Form Title</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                           id="form_title" name="form_title" value="{{ old('form_title', @$data->form_title) }}">
                                    @error('form_title')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Meta Details</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="meta_title">Title</label>
                                    <input type="text" class="form-control @error('meta_title') is-invalid @enderror"
                                           id="meta_title" name="meta_title" value="{{ old('meta_title', @$data->meta_title) }}">
                                    @error('meta_title')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="meta_keywords">Keyword</label>
                                    <input type="text" class="form-control @error('meta_keywords') is-invalid @enderror"
                                           id="meta_keywords" name="meta_keywords" value="{{ old('meta_keywords', @$data->meta_keywords) }}">
                                    @error('meta_keywords')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="meta_description">Description</label>
                                    <textarea id="meta_description" name="meta_description"
                                              class="form-control @error('meta_description') is-invalid @enderror">{{ old('meta_description', @$data->meta_description) }}</textarea>
                                    @error('meta_description')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="other_meta_tags">Other</label>
                                    <textarea id="other_meta_tags" name="other_meta_tags"
                                              class="form-control @error('other_meta_tags') is-invalid @enderror">{{ old('other_meta_tags', @$data->other_meta_tags) }}</textarea>
                                    @error('other_meta_tags')
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
                        <input type="hidden" name="id" value="{{ base64_encode(@$data->id) }}" >
                        <button type="submit" class="btn btn-primary" id="submitBtn">{{ $method }}</button>
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
            // $('#sub_title,#meta_description,#other_meta_tags').summernote({
            //     minHeight: 200,
            // });

            $('#file_type').change(function (){
               if($(this).val() == 'Image')
               {
                   $('.image-size-span').show();
                   $('.thumbImageDiv').hide();
               }
               else{
                   $('.image-size-span').hide();
                   $('.thumbImageDiv').show();
               }
            });
        });
    </script>
@endpush
