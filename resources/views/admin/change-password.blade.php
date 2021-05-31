@extends('admin.master')

@section('title', 'Đổi mật khẩu')

@section('header', 'Đổi mật khẩu')

@section('breadcrumb')
{{-- <li class="breadcrumb-item"><a href="{{ route('admin.book') }}">Sách</a></li> --}}
<li class="breadcrumb-item active">Đổi mật khẩu</li>
@endsection

{{-- @push('js')
<script>
    $(function(){
        $('#book').addClass('active');
    });
</script>
@endpush --}}

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-outline card-warning">
                <div class="card-header">
                    <h3 class="card-title">Change Password</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form action="{{ route('admin.update_password') }}" method="POST" role="form">
                        @csrf
                        <!-- text input -->
                        <div class="form-group">
                            <label>Mật khẩu hiện tại</label>
                            <input type="password" class="form-control" name="password"
                                placeholder="Nhập mật khẩu hiện tại">
                        </div>
                        <div class="form-group">
                            <label>Mật khẩu mới</label>
                            <input type="password" class="form-control" name="new_password"
                                placeholder="Nhập mật khẩu mới" required>
                        </div>
                        <div class="form-group">
                            <label>Nhập lại mật khẩu</label>
                            <input type="password" class="form-control" name="re_password"
                                placeholder="Nhập lại mật khẩu mới" required>
                        </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-default">
                        <i class="fa fa-times" aria-hidden="true"></i>&nbsp;
                        Hủy
                    </a>
                    <button type="submit" class="btn btn-primary float-right">
                        <i class="fas fa-save"></i>&nbsp;
                        Cập nhật
                    </button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
