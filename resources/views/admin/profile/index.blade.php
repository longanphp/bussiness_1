@extends('admin.layouts.admin')

@section('title')
    Hồ sơ
@endsection
@section('css-after')
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_assets/css/profile.css') }}">
@endsection

@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i> Hồ sơ</h1>
            <p>Thông tin hồ sơ của bạn</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">Hồ sơ</a></li>
        </ul>
    </div>
    <div class="row user justify-content-center">
        <div class="col-md-3">
            <div class="tile p-0">
                <ul class="nav flex-column nav-tabs user-tabs">
                    <li class="nav-item"><a class="nav-link active" href="#user-info" data-toggle="tab">Thông tin cá
                            nhân</a></li>
                    <li class="nav-item"><a class="nav-link" href="#password-change" data-toggle="tab">Đổi mật khẩu</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-md-9">
            <div class="tab-content">
                <div class="tab-pane active col-md-8" id="user-info">
                    <div class="tile user-settings">
                        <h4 class="line-head">Thông tin cá nhân</h4>
                        <form id="update-profile" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="box box-primary">
                                        <div class="box-body box-profile">
                                            <div>
                                                <div class="avatar-upload">
                                                    <div class="avatar-edit">
                                                        <input name="avatar" type='file' id="image-upload"
                                                               accept=".png,.jpg,.jpeg"/>
                                                        <label for="image-upload"></label>
                                                    </div>
                                                    <div class="avatar-preview">
                                                        <img class="profile-user-img img-responsive img-circle"
                                                             id="image-preview"
                                                             src="{{ $admin_composer->avatar }}"
                                                             alt="User profile picture">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="mb-4">
                                        <label>Họ:</label>
                                        <input name="first_name" value="{{ $admin_composer->first_name ?? null }}" class="form-control" type="text"
                                               placeholder="nhập vào họ...">
                                        <div class="error-message error_first_name"></div>
                                    </div>
                                    <div class="mb-4">
                                        <label>Tên:</label>
                                        <input name="last_name" value="{{ $admin_composer->last_name ?? null }}" class="form-control" type="text"
                                               placeholder="nhập vào tên...">
                                        <div class="error-message error_last_name"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="error-message error_avatar"></div>
                            <div class="row">
                                <div class="clearfix"></div>
                                <div class="col-md-12 mb-4">
                                    <label>Số điện thoại:</label>
                                    <input name="phone" value="{{ $admin_composer->phone ?? null }}" class="form-control" type="number"
                                           placeholder="nhập vào số điện thoại...">
                                    <div class="error-message error_phone"></div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-12 mb-4">
                                    <label>Địa chỉ:</label>
                                    <input name="address" value="{{ $admin_composer->address ?? null }}" class="form-control" type="text"
                                           placeholder="nhập vào số địa chỉ...">
                                    <div class="error-message error_address"></div>
                                </div>
                            </div>
                            <div class="row mb-10">
                                <div class="col-md-12">
                                    <button class="btn btn-primary" type="submit">
                                        <i class="fa fa-fw fa-lg fa-check-circle"></i> Lưu thông tin
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="tab-pane fade col-md-6" id="password-change">
                    <div class="tile user-settings">
                        <h4 class="line-head">Đổi mật khẩu</h4>
                        <form id="update-password" action="{{ route('admin.password.update') }}" method="POST" data-reset="true">
                            <div class="row mb-4">
                                <div class="col-12">
                                    <label>Mật khẩu cũ:</label>
                                    <input name="current_password" class="form-control" type="password">
                                    <div class="error-message error_current_password"></div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-12">
                                    <label>Mật khẩu mới:</label>
                                    <input name="password" class="form-control" type="password">
                                    <div class="error-message error_password"></div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-12">
                                    <label>Xác nhận mật khẩu mới:</label>
                                    <input name="password_confirmation" class="form-control" type="password">
                                    <div class="error-message error_password_confirmation"></div>
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
        </div>
    </div>
@endsection

@section('script-after')
    <script src="{{ asset('admin_assets/js/profile.js') }}" type="module"></script>
@endsection
