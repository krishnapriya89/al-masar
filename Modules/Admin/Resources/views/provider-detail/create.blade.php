@extends('admin::layouts.app')
@section('title', 'Create Provider Detail')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('provider.index') }}">Providers</a></li>
    <li class="breadcrumb-item"><a
            href="{{ route('provider-detail.index', ['provider' => base64_encode($provider->id)]) }}">Provider Details</a>
    </li>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Create Provider Detail: {{ $provider->name }}</h3>
                    <div class="card-tools">
                        <a href="{{ route('provider-detail.index', ['provider' => base64_encode($provider->id)]) }}"
                            class="btn btn-primary btn-sm">
                            <i class="fas fa-list"></i> Provider Details
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- form start -->
    <form method="POST" action="{{ route('provider-detail.store', $provider->id) }}">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="key">Key</label>
                                    <input type="text" class="form-control @error('key') is-invalid @enderror"
                                        id="key" name="key" value="{{ old('key') }}">
                                    @error('key')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="value">Value</label>
                                    <input type="text" class="form-control @error('value') is-invalid @enderror"
                                        id="value" name="value" value="{{ old('value') }}">
                                    @error('value')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
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
                        <button type="submit" class="btn btn-primary" id="submitBtn">Create</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
