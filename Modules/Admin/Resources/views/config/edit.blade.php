@extends('admin::layouts.app')
@section('title', 'Edit Config')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Config: {{ str_replace('_', ' ', Str::title($config->key)) }}</h3>
                    <div class="card-tools">
                        <a href="{{ route('config.index') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-list"></i> Config
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- form start -->
    <form method="POST" action="{{ route('config.update', $config->id) }}"
        @if ($config->type == 1) enctype="multipart/form-data" @endif>
        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="hidden" name="type" value="{{ $config->type }}">
                                @if ($config->type == 0)
                                    <div class="form-group">
                                        <label for="value">Value</label>
                                        <input type="text" class="form-control @error('value') is-invalid @enderror"
                                            id="value" name="value" placeholder="Enter Value"
                                            value="{{ old('value', $config->value) }}">
                                        @error('value')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                @elseif ($config->type == 1)
                                    <div class="form-group">
                                        <label for="value">Value</label>
                                        <div class="input-group @error('value') is-invalid @enderror">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="value"
                                                    name="value">

                                                <label class="custom-file-label" for="value">Choose file</label>
                                            </div>
                                            <div class="input-group-append">
                                                <span class="input-group-text">Upload</span>
                                            </div>
                                        </div>
                                        @error('value')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <div class="image-container">
                                            <img src="{{ Storage::disk('public')->exists($config->value) ? Storage::url($config->value) : asset($config->value) }}"
                                                alt="Uploaded Image" id="uploadedImage" class="uploaded-image">
                                        </div>
                                    </div>
                                @elseif ($config->type == 2)
                                    <div class="form-group">
                                        <label for="value">Value</label>
                                        <input type="color" class="form-control @error('value') is-invalid @enderror"
                                            id="value" name="value" value="{{ old('value', $config->value) }}">
                                        @error('value')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
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
