
@extends('admin::layouts.app')
@section('title', $country->title .' - States')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $country->title }} - States</h3>
                    <div class="card-tools">
                        <a href="{{ route('state.create', base64_encode($country->id)) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Create
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <table id="dataTable" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>SN</th>
                            <th>Title</th>
                            <th>Code</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($states as $state)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $state->title }}</td>
                                <td>{{ $state->code }}</td>
                                <td>{!! $state->status == 1
                                        ? '<span class="badge bg-success">Active</span>'
                                        : '<span class="badge bg-danger">Inactive</span>' !!}</td>
                                <td>
                                    <a href="{{ route('state.edit', base64_encode($state->id)) }}"
                                       class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top"
                                       data-original-title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('state.destroy', $state->id) }}"
                                          method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm delete-btn"
                                                data-toggle="tooltip" data-placement="top" data-original-title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No data found.</td>
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
