@extends('admin::layouts.app')
@section('title', 'Provider Details')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('provider.index') }}">Providers</a></li>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Provider Details</h3>
                    <div class="card-tools">
                        <a href="{{ route('provider.index') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-list"></i> Providers
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <form action="{{ route('provider-detail.update', $provider->id) }}" method="POST" class="form-horizontal"
                autocomplete="off">
                @csrf
                <div class="card">
                    <div class="card-body">
                        @if ($provider_details->count() > 0)
                            @foreach ($provider_details as $provider_detail)
                                <div class="form-group row">
                                    <label for="{{ $provider_detail->key }}"
                                        class="col-sm-2 col-form-label">{{ ucwords(str_replace('_', ' ', $provider_detail->key)) }}</label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('value.' . $loop->index) is-invalid @enderror"
                                            id="{{ $provider_detail->key }}" name="value[]"
                                            value="{{ old('value.' . $loop->index, $provider_detail->value) }}">
                                        @error('value.' . $loop->index)
                                            <span class="invalid-feedback">The
                                                {{ strtolower(str_replace('_', ' ', $provider_detail->key)) }} field is
                                                required.</span>
                                        @enderror
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="text-center">No data found.</div>
                        @endif
                    </div>
                    @if ($provider_details->count() > 0)
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary" id="submitBtn">Update</button>
                        </div>
                    @endif
                </div>
            </form>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            var options = {
                // buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"]
            };
            initializeDataTable(options);
        });
    </script>
@endpush
