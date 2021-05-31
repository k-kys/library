@extends('admin.master')

@section('title', 'Thông tin cá nhân')

@section('header', 'Thông tin cá nhân')

@section('breadcrumb')
<li class="breadcrumb-item active">Thông tin cá nhân</li>
@endsection

@push('style')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endpush

@push('js')
<script src="{{ asset('js/preview-upload-avatar.js') }}"></script>
@endpush

@section('content')
<div class="container-fluid">
    <div class="card card-outline card-warning">
        <div class="card-header">
            <h3 class="card-title">Profile</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('admin.update_profile', ['id' => $profile->id]) }}"
                enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <div class="row justify-content-center">
                        <input type="file" name="image" id="image" accept="image/*" />
                        <div id="preview">
                            <div>
                                <img id="img" src="{{ asset('') }}avatar/resize/thumbnail{{ $profile->image }}"
                                    alt="User profile picture"
                                    onError="this.onerror=null;this.src='{{ url("/img/blank-profile-picture-215x215.png") }}';">
                            </div>
                            <button type="button" class="btn-upload" id="upload-button" aria-labelledby="image"
                                aria-describedby="image">
                                <i class="fas fa-camera"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="">Tên</label>
                    <input id="" class="form-control" type="text" name="name" value="{{ $profile->name }}"
                        placeholder="Nhập tên">
                </div>

                <div class="form-group">
                    <label for="">Email</label>
                    <input id="" class="form-control" type="email" name="email" value="{{ $profile->email }}"
                        placeholder="Nhập email">
                </div>

                {{-- <div class="form-group">
                    <label for="">Avatar</label>
                    <div class="row"> --}}
                {{-- <div class="col-md-6 col-xs-12 text-center">
                            <img src="{{ $profile->avatar }}"
                onError="this.onerror=null;this.src='{{ url("/img/blank-profile-picture-215x215.png") }}';"
                alt="Avatar" title="Avatar">
        </div> --}}
        {{-- <div class="col-md-6 col-xs-12">
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                        <i class="fa fa-picture-o"></i> Choose
                                    </a>
                                </span>
                                <input id="thumbnail" class="form-control" type="text" name="avatar" readonly>
                            </div>
                            <img id="holder" style="margin-top:15px;max-height:100px;">
                        </div> --}}
        {{-- <label for="" class="col-sm-2 col-form-label">Avatar</label>
                    <div class="col-sm-10 text-center">
                        <div class="row align-text-bottom">
                            <div class="col-md-5">
                                <img src="{{ asset('') }}avatar/resize/thumbnail{{ $profile->image }}" alt="Avatar"
        title="Avatar" style="border-radius: 5px;"
        onError="this.onerror=null;this.src='{{ url("/img/blank-profile-picture-215x215.png") }}';">
    </div>

    <div class="col-md-2">
        <input id="avatar" class="form-control-file inputfile" type="file" name="image" onchange="ImagesFileAsURL()">
        <label for="avatar" style="margin-top: 10px;">Chọn ảnh</label>
    </div>
    <div class="col-md-5">
        <div id="displayImg"></div>
    </div>
</div>
</div> --}}
{{-- </div>
        </div> --}}

</div>

<div class="card-footer">
    <a href="{{ route('admin.dashboard') }}" class="btn btn-default"><i class="fa fa-angle-double-left"
            aria-hidden="true"></i>&nbsp;
        Dashboard</a>
    <button type="submit" class="btn btn-primary float-right"><i class="fas fa-save"></i>&nbsp;
        Cập nhật</button>
</div>
</form>
</div>
</div>
@endsection
