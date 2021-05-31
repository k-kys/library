@extends('admin.master')

@section('title', 'Sửa mượn trả')

@section('header', 'Mượn trả')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.borrow_pay') }}">Mượn trả</a></li>
<li class="breadcrumb-item active">Sửa</li>
@endsection

@push('js')
<script>
    $(function(){
        $('#borrow').addClass('active');
    });
</script>
@endpush

@section('content')
<div class="container">
    <div class="card card-warning">
        <div class="card-header">
            <h3 class="card-title">Edit Borrow Pay</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <form action="{{ route('admin.update_borrow_pay', ['id' => $borrowPay->id]) }}" method="POST" role="form">
                @csrf
                <div class="row">
                    <div class="col-md-8 col-sm-8">
                        <div class="form-group">
                            <label>Mã phiếu mượn</label>
                            <input type="text" class="form-control" name="id" value="{{ $borrowPay->id }}" disabled>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <div class="form-group">
                            <label>Số lượng</label>
                            <input type="number" min="0" class="form-control" name="number"
                                value="{{ $borrowPay->number }}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label>Người mượn</label>
                            <input type="text" class="form-control" name="student"
                                value="{{ $borrowPay->student->name }}" disabled>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label>Sách</label>
                            <input type="text" class="form-control" name="book" value="{{ $borrowPay->book->name }}"
                                disabled>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label>Ngày mượn</label>
                            <input type="text" class="form-control" name="date_borrowed"
                                value="{{ $borrowPay->date_borrowed }}" disabled>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label>Ngày hết hạn</label>
                            <input type="date" class="form-control" name="date_expiration"
                                value="{{ date("Y-m-d", strtotime($borrowPay->date_expiration)) }}">
                        </div>
                    </div>
                </div>


                {{-- <div class="form-group">
                    <label>Ngày trả</label>
                    <input type="date" class="form-control" name="date_returned"
                        value="{{ $borrowPay->date_returned }}">
        </div> --}}
        <div class="row">
            <div class="col-md-4 col-sm-4">
                <div class="form-group">
                    <label>Tình trạng</label>
                    <br>
                    @if ($borrowPay->status == 1)
                    <h4><span class="badge badge-primary">Đã trả</span></h4>
                    @else
                    <h4><span class="badge badge-warning">Chưa trả</span></h4>
                    @endif
                </div>
            </div>
            <div class="col-md-8 col-sm-8">
                <div class="form-group">
                    <label>Tiền phạt</label>
                    <input type="number" class="form-control" step="500" min="0" name="fine"
                        value="{{ $borrowPay->mount_of_fine }}" placeholder="Tiền bị phạt">
                </div>
            </div>
        </div>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        <a href="{{ route('admin.borrow_pay') }}" class="btn btn-sm btn-default">
            <i class="fa fa-angle-double-left" aria-hidden="true"></i>&nbsp;
            Quay lại
        </a>
        @if ($borrowPay->status == 0)
        <button type="submit" class="btn btn-sm btn-primary float-right">
            <i class="fas fa-save"></i>&nbsp;
            Cập nhật
        </button>
        @endif
    </div>
    </form>
</div>
</div>
@endsection
