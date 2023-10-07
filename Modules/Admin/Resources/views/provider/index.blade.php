@extends('admin::layouts.app')
@section('title', 'Providers')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <table id="dataTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>SN</th>
                                <th>Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($providers as $provider)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $provider->name }}</td>
                                    <td>
                                        {{-- <a href="{{ route('provider.edit', base64_encode($provider->id)) }}"
                                            class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top"
                                            data-original-title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a> --}}
                                        <a href="{{ route('provider-detail.index', base64_encode($provider->id)) }}"
                                            class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top"
                                            data-original-title="Provider Details">
                                            <i class="far fa-list-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">No data found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
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
