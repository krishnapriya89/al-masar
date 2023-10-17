
@extends('admin::layouts.app')
@section('title', 'Create State')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('state.index', base64_encode($country->id)) }}">{{ $country->title }}</a></li>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Create State</h3>
                    <div class="card-tools">
                        <a href="{{ route('state.index', base64_encode($country->id)) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-list"></i> {{ $country->title }} - States
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- form start -->
    <form method="POST" action="{{ route('state.store') }}" enctype="multipart/form-data">
    @csrf
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
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                           id="title" name="title" value="{{ old('title') }}">
                                    @error('title')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="code">Code</label>
                                    <input type="text" class="form-control @error('code') is-invalid @enderror"
                                           id="code" name="code" value="{{ old('code') }}">
                                    @error('code')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
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
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="free_zone">Free Zone</label>
                                    <select class="form-control @error('free_zone') is-invalid @enderror" id="free_zone"
                                            name="free_zone">
                                        <option value="1" {{ old('free_zone') == '1' ? 'selected' : '' }}>Yes</option>
                                        <option value="0" {{ old('free_zone') == '0' ? 'selected' : '' }}>No</option>
                                    </select>
                                    @error('free_zone')
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
                        <input type="hidden" name="country_id" value="{{ base64_encode($country->id) }}">
                        <button type="submit" class="btn btn-primary" id="submitBtn">Create</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
