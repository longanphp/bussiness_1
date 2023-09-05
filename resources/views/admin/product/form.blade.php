@extends('admin.layouts.admin')

@section('title')
    {{ __('Sản phẩm') }}
@endsection
@section('css-after')
@endsection

@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i>{{ !empty($product->name) ?  __('Sửa sản phẩm') : __('Tạo mới sản phẩm') }}</h1>
            <p>{{ __('Thông tin sản phẩm') }}</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">{{ !empty($product->name) ? __('Sửa sản phẩm') : __('Tạo mới sản phẩm') }}</a></li>
        </ul>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-5">
            <div class="tile">
                <div class="d-flex justify-content-between">
                    <h3 class="tile-title">{{ !empty($product->name) ?  __('Sửa sản phẩm') : __('Tạo sản phẩm') }}</h3>
                </div>
                <form id="handle-product" action="{{ route('admin.products.handle') }}" method="POST" data-redirect="{{ route('admin.products.index') }}" enctype="multipart/form-data">
                    @if(!empty($product))
                        <input name="id" value="{{ $product->id ?? '' }}" type="hidden">
                    @endif
                    <div class="row mb-4">
                        <div class="col-12">
                            <label>{{ __('Tên sản phẩm:') }}</label>
                            <input name="name" value="{{ $product->name ?? '' }}" class="form-control" type="text" placeholder="Nhập tên sản phẩm">
                            <div class="error-message error_name"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label>{{ __('Ảnh sản phẩm:') }}</label>
                            <div class="avatar-upload">
                                <div class="avatar-edit">
                                    <input name="avatar" class="d-none" type='file' id="image-upload"
                                           accept=".png,.jpg,.jpeg"/>
                                    <label for="image-upload">
                                        <div class="btn btn-primary icon-btn">
                                            <i class="fa fa-plus"></i>{{ __('Chọn file') }}
                                        </div>
                                    </label>
                                </div>
                                <div class="avatar-preview mt-2 mb-1">
                                    <img class="profile-user-img img-responsive img-circle object-fit-cover {{ !empty($product->avatar) ?: 'd-none' }}"
                                         height="150" width="150" id="image-preview" alt="User profile picture" src="{{ $product->avatar ?? '' }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 row error-message error_avatar"></div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-12">
                            <label>{{ __('Danh mục sản phẩm:') }}</label>
                            <select name="category_id" class="select2-multiple form-control" >
                                <option value="">{{ __('Chọn danh mục') }}</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ handleSelected($category->id, $product->category_id ?? null) }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <div class="error-message error_category_id"></div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-12">
                            <label>{{ __('Thương hiệu sản phẩm:') }}</label>
                            <select name="brand_id" class="select2-multiple form-control" >
                                <option value="">{{ __('Chọn nhãn hiệu') }}</option>
                                @foreach($brands as $brand)
                                    <option value="{{ $brand->id }}" {{ handleSelected($brand->id, $product->brand_id ?? null) }}>{{ $brand->name }}</option>
                                @endforeach
                            </select>
                            <div class="error-message error_brand_id"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label>{{ __('Ảnh phụ:') }}</label>
                            <div class="avatar-upload">
                                <div class="avatar-edit">
                                    <input name="sub_image[]" multiple="" data-max_length="4" id="image-upload-multiple"
                                           class="d-none upload_multiple" type='file' accept=".png,.jpg,.jpeg"/>
                                    <label for="image-upload-multiple">
                                        <div class="btn btn-primary icon-btn">
                                            <i class="fa fa-plus"></i>{{ __('Chọn file') }}
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 row upload__img-wrap">
                            @if(!empty($product->sub_image))
                                @foreach($product->sub_image as $subImage)
                                    <div class="upload__img-box">
                                        <div style="background-image: url('{{ $subImage['url'] }}')" data-number="0" data-file="download (6).jpeg" class="img-bg">
                                            <div class="upload__img-close remove-sub-image" data-sub_image_remove="{{ $subImage['id'] }}"></div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="col-12 row error-message error_sub_image"></div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-12">
                            <label>{{ __('Giới thiệu sản phẩm:') }}</label>
                            <textarea class="form-control" rows="3" name="introduce">
                                {{ $product->introduce ?? '' }}
                            </textarea>
                            <div class="error-message error_introduce"></div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-12">
                            <label>{{ __('Mô tả sản phẩm:') }}</label>
                            <textarea class="ckeditor form-control" rows="5" name="description">
                                {{ $product->description ?? '' }}
                            </textarea>
                            <div class="error-message error_description"></div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-12">
                            <label>{{ __('Giá sản phẩm:') }}</label>
                            <input name="price" value="{{ formatCurrency($product->price ?? '') }}" class="form-control" type="text" placeholder="Nhập giá sản phẩm">
                            <div class="error-message error_price"></div>
                        </div>
                    </div>
                    <div class="row mb-4 storehouse-area">
                        @if(!empty($product->storehouses) && $product->storehouses->count())
                            @foreach($product->storehouses as $key => $storehouse)
                                @include('admin.product.storehouse', [
                                    'index' => $key + 1,
                                    'name' => $storehouse->name,
                                    'quantity' => $storehouse->quantity
                                ])
                            @endforeach
                        @else
                            @include('admin.product.storehouse', ['index' => 1])
                        @endif
                    </div>
                    <div class="row mb-10">
                        <div class="col-md-12">
                            <button class="btn btn-primary" type="submit">
                                <i class="fa fa-fw fa-lg fa-check-circle"></i> {{ __('Lưu') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script-after')
    <script src="{{ asset('admin_assets/js/product.js') }}" type="module"></script>
@endsection
