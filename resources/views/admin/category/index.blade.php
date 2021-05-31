@extends('admin.master')

@section('title', 'Thể loại')

@section('header', 'Thể loại')

@section('breadcrumb')
<li class="breadcrumb-item active">Thể loại</li>
@endsection

@push('js')
<script>
    $(function(){
        $('#category').addClass('active');
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
                    <h4 class="modal-title">Thêm thể loại</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-add" action="{{ route('admin.store_category') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <input class="form-control" type="text" name="name" id="name"
                                    placeholder="Nhập thể loại" required>
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
                    @can('Thêm thể loại')
                    <button type="button" class="btn btn-xs btn-success" data-toggle="modal" data-target="#modal-add">
                        <i class="fas fa-plus-circle"></i>&nbsp;
                        Thêm mới
                    </button>
                    @endcan

                    <!-- Search -->
                    <div class="card-tools">
                        <form>
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="keyword" class="form-control float-right"
                                    placeholder="Tìm thể loại" value="{{ request()->keyword }}">
                                <div class="input-group-append float-right">
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
                                <th>Thể loại</th>
                                <th>Ngày tạo</th>
                                <th>Ngày sửa</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->created_at }}</td>
                                <td>{{ $category->updated_at }}</td>
                                <td>
                                    {{-- <button type="button" class="btn btn-secondary" data-toggle="modal"
                                        data-target="#modal-edit">Sửa</button> --}}
                                    @can('Sửa thể loại')
                                    <a href="{{ route('admin.edit_category', ['id' => $category->id]) }}"
                                        class="btn btn-sm btn-secondary">
                                        <i class="fas fa-edit"></i>&nbsp;
                                        Sửa
                                    </a>
                                    |
                                    @endcan
                                    @can('Xóa thể loại')
                                    <a href="{{ route('admin.delete_category', ['id' => $category->id]) }}"
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
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
</div>
@endsection
