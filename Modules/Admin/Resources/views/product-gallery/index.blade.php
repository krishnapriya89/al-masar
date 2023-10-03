
@extends('admin::layouts.app')
@section('title',  'Product Gallery')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('product.index') }}">Products</a></li>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><strong>{{ $product->title }}</strong> Product Gallery </h3>
                    <div class="card-tools">
                        <a href="{{ route('product-gallery.create', base64_encode($product->id)) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Create
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <table id="dataTable" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>SN</th>
                            <th>File</th>
                            <th>Sort Order</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($product->gallery as $gallery)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                @if ($gallery->file_type == 'Image')
                                    <td><img src="{{ Storage::url($gallery->file) }}" class="rounded"
                                             alt="{{ $gallery->title }}"  height="100" >
                                    </td>
                                @else
                                    <td>
                                        <video controls="" controlslist="nodownload" preload="none" height="80"
                                               onclick="this.play()" src="{{ Storage::url($gallery->file) }}">
                                        </video>
                                    </td>
                                @endif
                                <td>{{ $gallery->sort_order }}</td>
                                <td>{!! $gallery->status == 1
                                        ? '<span class="badge bg-success">Active</span>'
                                        : '<span class="badge bg-danger">Inactive</span>' !!}</td>
                                <td>
                                    <a href="{{ route('product-gallery.edit', ['product' => $gallery->product_id, 'gallery' => base64_encode($gallery->id)]) }}"
                                       class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top"
                                       data-original-title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('product-gallery.destroy', ['product' => $gallery->product_id, 'gallery' => $gallery->id]) }}"
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
