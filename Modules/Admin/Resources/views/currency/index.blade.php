@extends('admin::layouts.app')
@section('title', 'Currencies')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Currencies</h3>
                    <div class="card-tools">
                        <a href="{{ route('currency.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Create
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <table id="dataTable" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>SN</th>
                            <th>Code</th>
                            <th>Symbol</th>
                            <th>Rate</th>
                            <th>Sort Order</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($currencies as $currency)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $currency->currencyCode->code }}</td>
                                <td>{{ $currency->symbol }}</td>
                                <td>{{ $currency->rate }}</td>
                                <td>{{ $currency->sort_order }}</td>
                                <td>{!! $currency->status == 1
                                        ? '<span class="badge bg-success">Active</span>'
                                        : '<span class="badge bg-danger">Inactive</span>' !!}</td>
                                <td>
                                    <a href="{{ route('currency.edit', base64_encode($currency->id)) }}"
                                       class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top"
                                       data-original-title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">No data found.</td>
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
