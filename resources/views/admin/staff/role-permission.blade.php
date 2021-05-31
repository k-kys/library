@extends('admin.master')

@section('title', 'Phần quyền')

@section('header', 'Nhân viên')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.staff') }}">Nhân viên</a></li>
<li class="breadcrumb-item active">Phân quyền</li>
@endsection

@push('js')
<script>
    $(function(){
        $('#user').addClass('active');
    });
</script>
@endpush

@section('content')
<div class="container">
    <div class="card card-warning">
        <div class="card-header">
            <h3 class="card-title">Edit Staff</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <form action="{{ route('admin.update_role_permission_staff', ['id' => $staff->id]) }}" method="POST"
                role="form" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Tên</label>
                    <input type="text" class="form-control" name="isbn" value="{{ $staff->name }}"
                        placeholder="Tên nhân viên" disabled>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label for="role_id">Vai trò</label>
                            @php
                            $roleIds = $staff->roles->pluck('id')->toArray();
                            @endphp
                            <select name="role_id[]" id="role_id" class="form-control select2"
                                data-placeholder="Chọn vai trò" multiple>
                                @foreach ($roles as $role)
                                <option {{ in_array($role->id, $roleIds)?'selected':'' }} value="{{ $role->id }}">
                                    {{ $role->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label for="permission_id">Quyền</label>
                            @php
                            $permissionIds = $staff->permissions->pluck('id')->toArray();
                            @endphp
                            <select name="permission_id[]" id="permission_id" class="form-control select2"
                                data-placeholder="Chọn quyền" multiple>
                                @foreach ($permissions as $permission)
                                <option {{ in_array($permission->id, $permissionIds)?'selected':'' }}
                                    value="{{ $permission->id }}">
                                    {{ $permission->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <a href="{{ route('admin.staff') }}" class="btn btn-sm btn-default">
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
