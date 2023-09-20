@extends('admin::layouts.app')
@section('title', 'Config')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <table id="dataTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>SN</th>
                                <th>Key</th>
                                <th>Value</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($config as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ str_replace('_', ' ', Str::title($data->key)) }}</td>
                                    @if ($data->type == 0)
                                        <td>{{ $data->value }}</td>
                                    @elseif ($data->type == 1)
                                        <td>
                                            <img src="{{ Storage::disk('public')->exists($data->value) ? Storage::url($data->value) : asset($data->value) }}"
                                                class="rounded" alt="logo" width="40">
                                        </td>
                                    @elseif ($data->type == 2)
                                        <td>
                                            <span class="fa-stack fa-lg">
                                                <i class="fas fa-circle fa-stack-2x"
                                                    style="color: {{ $data->value }};"></i>
                                                <i class="fas fa-circle fa-stack-1x"
                                                    style="color: {{ $data->value }};"></i>
                                            </span>
                                        </td>
                                    @endif
                                    <td>
                                        <a href="{{ route('config.edit', base64_encode($data->id)) }}"
                                            class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top"
                                            data-original-title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">No data found.</td>
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
