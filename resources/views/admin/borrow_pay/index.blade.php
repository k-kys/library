@extends('admin.master')

@section('title', 'Mượn trả')

@section('header', 'Mượn trả')

@section('breadcrumb')
<li class="breadcrumb-item active">Mượn trả</li>
@endsection

@push('js')
<script>
    $(function(){
        $('#borrow-pay').addClass('menu-open');
        $('#borrow-pay-link').addClass('active');
        $('#borrow').addClass('active');
    });
</script>
<script>
    $(document).ready(function () {
        // LoadData();
        $('body').on('click','.btn-view', function () {
            var id = $(this).data('id');
            GetDataById(id);
        });
    });

    function GetDataById(id) {
        $.ajax({
            type: "GET",
            url: route('admin.show_borrow_pay', [id]),
            success: function (response) {
                $('#id').html(response.id);
                $('#student').html(response.student_name);
                $('#book').html(response.book_name);
                $('#number').html(response.number);
                $('#date_borrowed').html(response.date_borrowed);
                $('#date_expiration').html(response.date_expiration);
                $('#date_returned').html(response.date_returned);
                $('#status').html(response.status);
                $('#fine').html(response.fine);
                // hiện lên màn hình
                $('#modal-view').modal('show');
            }
        });
    }
</script>
@endpush

@section('content')
<div class="container-fluid">

    <!-- modal add -->
    <div class="modal fade" id="modal-add">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Thêm phiếu mượn</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-add" action="{{ route('admin.store_borrow_pay') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <div class="row">
                                <div class="col-6">
                                    <label>Người mượn</label>
                                    <select name="student_id" class="form-control select2"
                                        data-placeholder="Chọn sinh viên" required>
                                        @foreach ($students as $student)
                                        @if ($student->status == 1)
                                        <option value="{{ $student->id }}">{{ $student->name }}</option>
                                        @else
                                        <option value="{{ $student->id }}" disabled>{{ $student->name }}
                                        </option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label>Sách</label>
                                    <select name="book_id" class="form-control select2" data-placeholder="Chọn sách"
                                        required>
                                        @foreach ($books as $book)
                                        @if ($book->stock_amount > 0)
                                        <option value="{{ $book->id }}">{{ $book->name }}</option>
                                        @else
                                        <option value="{{ $book->id }}" disabled>{{ $book->name }}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="number">Số lượng</label>
                            <input id="number" class="form-control" type="number" name="number" value="1" required>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-6">
                                    <label for="date_borrowed">Ngày mượn</label>
                                    <input id="date_borrowed" class="form-control" type="date" name="date_borrowed"
                                        value="{{ $dateBorrowed }}" disabled>
                                </div>
                                <div class="col-6">
                                    <label for="date_expiration">Ngày hết hạn</label>
                                    <input id="date_expiration" class="form-control" type="date" name="date_expiration"
                                        value="<?= date('Y-m-d', strtotime($dateBorrowed.' + 30 days')); ?>">
                                </div>
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
</div>


<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                @can('Thêm phiếu mượn')
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
                                placeholder="Tìm người mượn, sách mượn" value="{{ request()->keyword }}">
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
                            <th>Người mượn</th>
                            <th>Sách</th>
                            <th>Số lượng</th>
                            <th>Tình trạng</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($borrowPays as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->student_name }}</td>
                            <td>{{ $item->book_name }}</td>
                            <td>{{ $item->number }}</td>
                            <td>
                                @if ($item->status == 1)
                                <span class="badge badge-primary">Đã trả</span>
                                @else
                                <span class="badge badge-warning">Chưa trả</span>
                                @endif
                            </td>
                            <td>

                                {{-- <button type="button" class="btn btn-primary btn-view" data-id="{{ $item->id }}"
                                data-toggle="modal" data-target="#modal-view">Chi
                                tiết</button> --}}
                                {{-- <div class="float-right"> --}}
                                @can('Trả sách')
                                @if ($item->status == 0)
                                <a href="{{ route('admin.return_borrow_pay', ['id' => $item->id]) }}"
                                    class=" btn btn-sm btn-danger">
                                    <i class="fas fa-exchange-alt"></i>&nbsp;
                                    Trả sách
                                </a>
                                |
                                @endif
                                @endcan

                                {{-- </div> --}}
                                @can('Sửa phiếu mượn')
                                <a href="{{ route('admin.edit_borrow_pay', ['id' => $item->id]) }}"
                                    class=" btn btn-sm btn-secondary">
                                    <i class="fas fa-edit"></i>&nbsp;
                                    Sửa
                                </a>
                                |
                                @endcan
                                @can('Xóa phiếu mượn')
                                <a href="{{ route('admin.delete_borrow_pay', ['id' => $item->id]) }}"
                                    class=" btn btn-sm btn-warning btn-delete">
                                    <i class="fas fa-trash-alt"></i>&nbsp;
                                    Xóa
                                </a>
                                @endcan
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- modal view -->
                <div class="modal fade" id="modal-view">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Thông tin phiếu mượn</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    ID phiếu mượn: &nbsp;
                                    <i id="id"></i>
                                </div>
                                <div class="form-group">
                                    Người mượn: &nbsp;
                                    <i id="student"></i>
                                </div>
                                <div class="form-group">
                                    Sách: &nbsp;
                                    <i id="book"></i>
                                </div>
                                <div class="form-group">
                                    Số lượng: &nbsp;
                                    <i id="number"></i>
                                </div>
                                <div class="form-group">
                                    Ngày mượn: &nbsp;
                                    <i id="date_borrowed"></i>
                                </div>
                                <div class="form-group">
                                    Ngày hết hạn: &nbsp;
                                    <i id="date_expiration"></i>
                                </div>
                                <div class="form-group">
                                    Ngày trả: &nbsp;
                                    <i id="date_returned"></i>
                                </div>
                                <div class="form-group">
                                    Tình trạng: &nbsp;
                                    <i id="status"></i>
                                </div>
                                <div class="form-group">
                                    Tiền phạt: &nbsp;
                                    <i id="fine"></i>
                                </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                                {{-- <button type="submit" class="btn btn-primary">Lưu</button> --}}
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
</div>
@endsection
