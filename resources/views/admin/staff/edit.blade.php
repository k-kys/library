@extends('admin.master')

@section('title', 'Sửa nhân viên')

@section('header', 'Nhân viên')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.staff') }}">Nhân viên</a></li>
<li class="breadcrumb-item active">Sửa</li>
@endsection

@push('js')
<script>
    $(function(){
        $('#user').addClass('active');
    });
</script>
@endpush

@section('content')
<div class="container-fuid">
    <div class="card card-warning">
        <div class="card-header">
            <h3 class="card-title">Edit Staff</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <form action="{{ route('admin.update_staff', ['id' => $staff->id]) }}" method="POST" role="form"
                enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label>Tên</label>
                            <input type="text" class="form-control" name="name" value="{{ $staff->name }}"
                                placeholder="Tên nhân viên">
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label>Email</label>
                            <input class="form-control" type="text" name="email" value="{{ $staff->email }}"
                                placeholder="Email">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label>Ảnh đại diện</label>
                            <br><br>
                            <div class="text-center">
                                <img src="{{ asset($staff->avatar) }}"
                                    onError="this.onerror=null;this.src='{{ url("/img/blank-profile-picture-215x215.png") }}';"
                                    style="width: 60%; margin-top: -8px;" class="elevation-2"
                                    alt="Ảnh hiện tại của sách" title="Ảnh hiện tại">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label>Ngày tạo</label>
                            <input id="my-input" class="form-control" type="text" name="created_at"
                                value="{{ $staff->created_at }}" disabled>
                        </div>
                        <div class="form-group">
                            <label>Ngày sửa</label>
                            <input id="my-input" class="form-control" type="text" name="updated_at"
                                value="{{ $staff->updated_at }}" disabled>
                        </div>
                    </div>
                </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <a href="{{ route('admin.staff') }}" class="btn btn-sm btn-default">
                <i class="fa fa-angle-double-left" aria-hidden="true"></i>&nbsp;
                Nhân viên
            </a>
            <button type="submit" class="btn btn-sm btn-primary float-right">
                <i class="fas fa-save"></i>&nbsp;
                Cập nhật
            </button>
        </div>
        </form>
    </div>
</div>
@endsection
