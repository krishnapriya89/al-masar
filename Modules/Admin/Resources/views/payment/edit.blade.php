

@extends('admin::layouts.app')
@section('title', 'Edit Payment Method')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Payment Method</h3>
                    <div class="card-tools">
                        <a href="{{ route('payment.index') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-list"></i>Payment Methods
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- form start -->
    <form method="POST" action="{{ route('payment.update', $payment->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
    <!-- /.row -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Add Details</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="image">Image</label>
                                    <div class="input-group @error('image') is-invalid @enderror">
                                        <input type="file" class="custom-file-input file-preview" id="image"
                                               name="image">
                                        <label class="custom-file-label" for="file">Choose file</label>
                                        <div class="pt-3 file-holder"> </div>
                                    </div>
                                    @error('image')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-12 image-container-div">
                                    @if($payment->image != '' || $payment->image != NULL)
                                    <div class="form-group" style="display:inline-block;margin-right:10px;">
                                        <div class="image-container">
                                            <img src="{{ Storage::disk('public')->exists($payment->image) ? Storage::url($payment->image) : asset($payment->image) }}"
                                                 alt="Uploaded Image" id="uploadedImage" class="uploaded-image">

                                        </div>
                                    </div>
                                    <div style="display:inline-block;">
                                        <a href="javascript:void(0)"><i class="fa fa-times text-red deleteImg" data-model="Payment" data-column="image" data-id="{{$payment->id}}"></i></a>
                                    </div>

                                @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control" id="title" name="title" value="{{$payment->title}}" {!!($payment->title=='Bank Transfer')?'readonly':''!!}>
                                </div>

                                @error('title')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="descripton">Description</label>
                                <textarea name="description" id="description" >{{$payment->description}}</textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sort_order">Sort Order</label>
                                    <input type="number" class="form-control @error('sort_order') is-invalid @enderror"
                                           id="sort_order" name="sort_order" value="{{ old('sort_order', $payment->sort_order) }}">
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
                                        <option value="1" {{ old('status', $payment->status) == '1' ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ old('status', $payment->status) == '0' ? 'selected' : '' }}>Inactive</option>
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
