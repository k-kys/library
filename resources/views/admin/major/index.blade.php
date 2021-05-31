@extends('admin.master')

@section('title', 'Lĩnh vực')

@section('header', 'Lĩnh vực')

@section('breadcrumb')
<li class="breadcrumb-item active">Lĩnh vực</li>
@endsection

@push('js')
<script>
    $(function(){
        $('#major').addClass('active');
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
                    <h4 class="modal-title">Thêm lĩnh vực</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-add" action="{{ route('admin.store_major') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <input class="form-control" type="text" name="name" id="name"
                                    placeholder="Nhập lĩnh vực" required>
                            </div>
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
                    @can('Thêm lĩnh vực')
                    <button type="button" class="btn btn-xs btn-success" data-toggle="modal" data-target="#modal-add">
                        <i class="fas fa-plus-circle" aria-hidden="true"></i>&nbsp;
                        Thêm mới
                    </button>
                    @endcan

                    <!-- Search -->
                    <div class="card-tools">
                        <form>
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="keyword" class="form-control float-right"
                                    placeholder="Tìm lĩnh vực" value="{{ request()->keyword }}">
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
                                <th>Lĩnh vực</th>
                                <th>Ngày tạo</th>
                                <th>Ngày sửa</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($majors as $major)
                            <tr>
                                <td>{{ $major->id }}</td>
                                <td>{{ $major->name }}</td>
                                <td>{{ $major->created_at }}</td>
                                <td>{{ $major->updated_at }}</td>
                                <td>
                                    @can('Sửa lĩnh vực')
                                    <a href="{{ route('admin.edit_major', ['id' => $major->id]) }}"
                                        class="btn btn-sm btn-secondary">
                                        <i class="fas fa-edit"></i>&nbsp;
                                        Sửa
                                    </a>
                                    |
                                    @endcan
                                    @can('Xóa lĩnh vực')
                                    <a href="{{ route('admin.delete_major', ['id' => $major->id]) }}"
                                        class="btn btn-sm btn-warning btn-delete">
                                        <i class="fas fa-trash-alt"></i>&nbsp;
                                        Xóa
                                    </a>
                                    @endcan
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
</div>
@endsection
