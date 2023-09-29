@extends('admin::layouts.app')
@section('title', '404 - Page Not Found')
@section('content')
    <div class="error-page">
        <h2 class="headline primary-color">404</h2>

        <div class="error-content">
            <h3><i class="fas fa-exclamation-triangle primary-color"></i> Oops! Page not found.</h3>

            <p>
                We could not find the page you were looking for.
                Meanwhile, you may <a href="{{ route('admin.dashboard') }}">return to dashboard</a> or try using the search form.
            </p>
        </div>
    </div>
@endsection
