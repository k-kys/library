@extends('admin.master')

@section('title', 'Quyền')

@section('header', 'Quyền')

@section('breadcrumb')
<li class="breadcrumb-item active">Quyền</li>
@endsection

@push('js')
<script>
    $(function(){
        $('#permission').addClass('active');
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
                    <h4 class="modal-title">Thêm quyền</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('admin.store_permission') }}">
                        @csrf
                        <div class="form-group">
                            <label for="">Tên</label>
                            <input type="text" class="form-control" name="name" aria-describedby="helpId"
                                placeholder="Nhập tên quyền truy cập">
                            <small id="helpId" class="form-text text-muted">Help text</small>
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
                                    placeholder="Tìm quyền" value="{{ request()->keyword }}">
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
                            @foreach ($permissions as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->name }}</td>
                                <td>
                                    <a href="{{ route('admin.delete_permission', ['id' => $item->id]) }}"
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
