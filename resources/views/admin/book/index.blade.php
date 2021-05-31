@extends('admin.master')

@section('title', 'Sách')

@section('header', 'Sách')

@section('breadcrumb')
<li class="breadcrumb-item active">Sách</li>
@endsection

@push('js')
<script>
    $(function(){
            $('#book').addClass('active');
        });
</script>
@endpush

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    @can('Thêm sách')
                    {{-- <button type="button" class="btn btn-xs btn-success" data-toggle="modal" data-target="#modal-add">
                        <i class="fas fa-plus-circle"></i>&nbsp;
                        Thêm sách
                    </button> --}}
                    <a href="{{ route('admin.add_book') }}" class="btn btn-xs btn-success">
                        <i class="fas fa-plus-circle"></i>&nbsp;
                        Thêm sách
                    </a>
                    @endcan

                    <!-- Search -->
                    <div class="card-tools">
                        <form>
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="keyword" class="form-control float-right"
                                    placeholder="Tìm sách" value="{{ request()->keyword }}">
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
                    <table class="table table-sm table-hover table-head-fixed text-nowrap text-center">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Ảnh</th>
                                <th>ISBN</th>
                                <th>Tên sách</th>
                                <th>Số lượng</th>
                                <th>Số lượng còn lại</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($books as $book)
                            <tr>
                                <td>{{ $book->id }}</td>
                                <td>
                                    <img src="{{ asset($book->image) }}" style="max-height: 80px; margin: 2px;"
                                        class="elevation-2"
                                        onError="this.onerror=null;this.src='{{ url("/img/400x250.png") }}';"
                                        alt="Book image" title="Book Image">
                                </td>
                                <td>{{ $book->isbn }}</td>
                                <td class="text-wrap">{{ $book->name }}</td>
                                <td>{{ $book->amount }}</td>
                                <td>{{ $book->stock_amount }}</td>
                                <td>
                                    @can('Sửa sách')
                                    <a href="{{ route('admin.edit_book', ['id' => $book->id]) }}"
                                        class="btn btn-sm btn-secondary">
                                        <i class="fas fa-edit"></i>&nbsp;
                                        Sửa
                                    </a>
                                    |
                                    @endcan
                                    @can('Xóa sách')
                                    <a href="{{ route('admin.delete_book', ['id' => $book->id]) }}"
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
