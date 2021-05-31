@extends('admin.master')

@section('title', 'Sửa vai trò')

@section('header', 'Vai trò')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.role') }}">Vai trò</a></li>
<li class="breadcrumb-item active">Sửa</li>
@endsection

@push('js')
<script>
    $(function(){
        $('#role').addClass('active');
    });
</script>
@endpush

@section('content')
<div class="container">
    <div class="card card-warning">
        <div class="card-header">
            <h3 class="card-title">Edit Role</h3>
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('admin.update_role', ['id' => $role->id]) }}">
                @csrf
                <div class="form-group">
                    <label for="">Tên vai trò</label>
                    <input type="text" class="form-control" name="name" value="{{ $role->name }}"
                        placeholder="Nhập tên quyền truy cập" required>
                </div>
                <div class="form-group">
                    <label for="">Quyền</label>
                    @php
                    $permissionIds = $role->permissions->pluck('id')->toArray();
                    @endphp
                    <select name="permission_id[]" class="form-control select2" data-placeholder="Chọn quyền" multiple
                        required>
                        @foreach ($permissions as $permission)
                        <option {{ in_array($permission->id, $permissionIds)?'selected':'' }}
                            value="{{ $permission->id }}">{{ $permission->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Ngày tạo</label>
                    <input id="" class="form-control" type="text" value="{{ $role->updated_at }}" disabled>
                </div>
                <div class="form-group">
                    <label for="">Ngày cập nhật</label>
                    <input id="" class="form-control" type="text" value="{{ $role->updated_at }}" disabled>
                </div>
        </div>
        <div class="card-footer">
            <a href="{{ route('admin.role') }}" class="btn btn-sm btn-default">
                <i class="fa fa-angle-double-left" aria-hidden="true"></i>&nbsp;
                Quay lại
            </a>
            <button type="submit" class="btn btn-sm btn-primary float-right">
                <i class="fas fa-save"></i>&nbsp;
                Lưu
            </button>
        </div>
        </form>
    </div>
</div>
@endsection
