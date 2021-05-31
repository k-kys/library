@extends('admin.master')

@section('title', 'Sửa sinh viên')

@section('header', 'Sinh viên')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.student') }}">Sinh viên</a></li>
<li class="breadcrumb-item active">Sửa</li>
@endsection

@push('js')
<script>
    $(function(){
        $('#student').addClass('active');
    });
</script>
@endpush

@section('content')
<div class="container">
    <div class="card card-warning">
        <div class="card-header">
            <h3 class="card-title">Edit Student</h3>
        </div>
        <div class="card-body">
            <div class="container">
                <form action="{{ route('admin.update_student', ['id' => $student->id]) }}" method="POST" role="form">
                    @csrf

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="name" class="col-sm-1-12 col-form-label">Tên</label>
                                <input type="text" class="form-control" name="name" id="name"
                                    value="{{ $student->name }}" placeholder="Nhập tên sinh viên">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="email" class="col-sm-1-12 col-form-label">Email</label>
                                <input type="text" class="form-control" name="email" id="email"
                                    value="{{ $student->email }}" placeholder="Nhập email">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <label>Ảnh đại diện</label>
                                <br><br>
                                <div class="text-center">
                                    <img src="{{ asset($student->avatar) }}"
                                        onError="this.onerror=null;this.src='{{ url("/img/blank-profile-picture-215x215.png") }}';"
                                        style="width: 60%; margin-top: -8px;" class="elevation-2" alt="Avatar"
                                        title="Ảnh đại diện">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <label>Ngày tạo</label>
                                <input id="my-input" class="form-control" type="text" name="created_at"
                                    value="{{ $student->created_at }}" disabled>
                            </div>
                            <div class="form-group">
                                <label>Ngày sửa</label>
                                <input id="my-input" class="form-control" type="text" name="updated_at"
                                    value="{{ $student->updated_at }}" disabled>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ route('admin.student') }}" class="btn btn-sm btn-default">
                <i class="fa fa-angle-double-left" aria-hidden="true"></i>&nbsp;
                Quay lại
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
