@extends('admin::layouts.app')
@section('title', 'Edit Tax Management')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Tax Management </h3>
                </div>
            </div>
        </div>
    </div>
    <!-- form start -->
    <form method="POST" action="{{ route('site-settings.update',$tax_management->id)}}">
        @csrf
        
        <!-- /.row -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Edit Details</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tax_name">Tax Name</label>
                                    <input type="text" class="form-control @error('tax_name') is-invalid @enderror"
                                        id="tax_name" name="tax_name" value="{{ old('tax_name',$tax_management->tax_name) }}">
                                    @error('tax_name')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tax_percentage">Tax Percentage</label>
                                    <input type="text" class="form-control @error('tax_percentage') is-invalid @enderror"
                                        id="tax_percentage" name="tax_percentage" value="{{ old('tax_percentage',$tax_management->tax_percentage) }}">
                                    @error('tax_percentage')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tax_amount">Tax Amount</label>
                                    <input type="text" class="form-control @error('tax_amount') is-invalid @enderror"
                                        id="tax_amount" name="tax_amount" value="{{ old('tax_amount',$tax_management->tax_amount) }}">
                                    @error('tax_amount')
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
