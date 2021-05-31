@extends('admin.master')

@section('title', 'Vai trò')

@section('header', 'Vai trò')

@section('breadcrumb')
<li class="breadcrumb-item active">Vai trò</li>
@endsection

@push('js')
<script>
    $(function(){
        $('#role').addClass('active');
    });
</script>
@endpush

@section('content')
<div class="container-fluid">

    <!-- modal add -->
    <div class="modal fade" id="modal-add">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Thêm vai trò</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('admin.store_role') }}">
                        @csrf
                        <div class="form-group">
                            <label for="">Tên vai trò</label>
                            <input type="text" class="form-control" name="name" placeholder="Nhập tên quyền truy cập"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="">Quyền</label>
                            <select name="permission_id[]" class="form-control select2" data-placeholder="Chọn quyền"
                                multiple required>
                                @foreach ($permissions as $permission)
                                <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                                @endforeach
                            </select>
                        </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Lưu</button>
                </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <button type="button" class="btn btn-xs btn-success" data-toggle="modal" data-target="#modal-add">
                        <i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;
                        Thêm mới
                    </button>

                    <!-- Search -->
                    <div class="card-tools">
                        <form>
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="keyword" class="form-control float-right"
                                    placeholder="Tìm vai trò" value="{{ request()->keyword }}">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /Search> -->
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0" style="height: 70vh;">
                    <table class="table table-hover table-head-fixed text-nowrap text-center">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->name }}</td>
                                <td>
                                    {{-- <button class="btn btn-primary">Xem</button> --}}
                                    <a href="{{ route('admin.edit_role', ['id' => $item->id]) }}"
                                        class="btn btn-sm btn-secondary">
                                        <i class="fas fa-edit"></i>&nbsp;
                                        Sửa
                                    </a>
                                    |
                                    <a href="{{ route('admin.delete_role', ['id' => $item->id]) }}"
                                        class="btn btn-sm btn-warning btn-delete">
                                        <i class="fas fa-trash-alt"></i>&nbsp;
                                        Xóa
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
</div>
@endsection
