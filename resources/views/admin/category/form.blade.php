@extends('admin.layouts.admin')

@section('title')
    {{ __('Danh mục sản phẩm') }}
@endsection
@section('css-after')
@endsection

@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i>{{ !empty($category->name) ?  __('Sửa danh mục') : __('Tạo mới danh mục') }}</h1>
            <p>{{ __('Thông tin Danh mục sản phẩm') }}</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">{{ !empty($category->name) ? __('Sửa danh mục') : __('Tạo mới danh mục') }}</a></li>
        </ul>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-5">
            <div class="tile">
                <div class="d-flex justify-content-between">
                    <h3 class="tile-title">{{ !empty($category->name) ?  __('Sửa danh mục') : __('Tạo danh mục') }}</h3>
                </div>
                <form id="handle-category" action="{{ route('admin.categories.handle') }}" method="POST" data-redirect="{{ route('admin.categories.index') }}">
                    @if(!empty($category))
                        <input name="id" value="{{ $category->id ?? '' }}" type="hidden">
                    @endif
                    <div class="row mb-4">
                        <div class="col-12">
                            <label>Tên danh mục:</label>
                            <input name="name" value="{{ $category->name ?? '' }}" class="form-control" type="text">
                            <div class="error-message error_name"></div>
                        </div>
                    </div>
                    <div class="row mb-10">
                        <div class="col-md-12">
                            <button class="btn btn-primary" type="submit">
                                <i class="fa fa-fw fa-lg fa-check-circle"></i> Lưu
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script-after')
    <script src="{{ asset('admin_assets/js/category.js') }}" type="module"></script>
@endsection
