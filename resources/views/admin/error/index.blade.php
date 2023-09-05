@extends('admin.layouts.admin')

@section('title')
    {{ __('Trang lỗi') }}
@endsection
@section('css-after')
@endsection

@section('content')
    <div class="page-error tile">
        <h1><i class="fa fa-exclamation-circle"></i> {{ __('Đã xảy ra lỗi hệ thống') }}</h1>
        <p>{{ __('Vui lòng quay lại sau.') }}</p>
        <p><a class="btn btn-primary" href="{{ route('admin.dashboard.index') }}">{{ __('Trang chủ') }}</a></p>
    </div>
@endsection

