
@extends('admin::layouts.app')
@section('title', 'Edit Currency')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Currency</h3>
                    <div class="card-tools">
                        <a href="{{ route('currency.index') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-list"></i> Currencies
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- form start -->
    <form method="POST" action="{{ route('currency.update',$currency->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
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
                                    <label for="code">Code</label>
                                    <select id="code" name="code" class="form-control select2 @error('code') is-invalid @enderror">
                                        <option value="" selected disabled>Select Code</option>
                                        @foreach ($currency_codes as $currency_code)
                                            <option value="{{ $currency_code->id }}" @selected(old('code',$currency->code_id) == $currency_code->id)>{{ $currency_code->code }}</option>
                                        @endforeach
                                    </select>
                                    @error('code')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="symbol">Symbol</label>
                                    <input type="text" class="form-control @error('symbol') is-invalid @enderror"
                                           id="symbol" name="symbol" value="{{ old('symbol',@$currency->symbol) }}">
                                    @error('symbol')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="rate">Rate</label>
                                    <input type="text" class="form-control @error('rate') is-invalid @enderror"
                                           id="rate" name="rate" value="{{ old('rate',@$currency->rate) }}">
                                    @error('rate')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sort_order">Sort Order</label>
                                    <input type="number" class="form-control @error('sort_order') is-invalid @enderror"
                                           id="sort_order" name="sort_order" value="{{ old('sort_order',@$currency->sort_order) }}">
                                    @error('sort_order')
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
                                        <option value="1" {{ old('status',@$currency->status) == '1' ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ old('status',@$currency->status) == '0' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                    @error('status')
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
