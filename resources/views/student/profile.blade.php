@extends('student.master')

@section('title', 'Hồ sơ')

@push('style')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endpush

@push('js')
<script src="{{ asset('js/preview-upload-avatar.js') }}"></script>
@endpush

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title text-center">Hồ sơ</h3>
                </div><!-- /.card-header -->
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="settings">
                            <form action="{{ route('update', ['id' => $profile->id]) }}" method="POST" role="form"
                                class="form-horizontal" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <div class="row justify-content-center">
                                        <input type="file" name="image" id="image" accept="image/*" />
                                        <div id="preview">
                                            <div>
                                                <img id="img"
                                                    src="{{ asset('') }}avatar/resize/thumbnail{{ $profile->image }}"
                                                    alt="User profile picture"
                                                    onError="this.onerror=null;this.src='{{ url("/img/blank-profile-picture-215x215.png") }}';">
                                            </div>
                                            <button type="button" class="btn-upload" id="upload-button"
                                                aria-labelledby="image" aria-describedby="image">
                                                <i class="fas fa-camera"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-2 col-form-label">Tên</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputName" name="name"
                                            placeholder="Name" value="{{ $profile->name }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" id="inputEmail" name="email"
                                            placeholder="Email" value="{{ $profile->email }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-2 col-form-label">Trạng thái</label>
                                    <div class="col-sm-10">
                                        @if ($profile->status == 1)
                                        <span class="badge badge-primary">Active</span>
                                        @else
                                        <span class="badge badge-warning">Blocked</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-2 col-form-label">Ngày tạo</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" value="{{ $profile->created_at }}"
                                            disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-2 col-form-label">Ngày cập nhật cuối
                                        cùng</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" value="{{ $profile->updated_at }}"
                                            disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10">
                                        <button type="submit" class="btn btn-danger">Cập nhật</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div><!-- /.card-body -->
            </div>
        </div>
    </div>
</div>
@endsection
