@extends('admin.master')

@section('title', 'Trả sách')

@section('header', 'Mượn trả')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.borrow_pay') }}">Mượn trả</a></li>
<li class="breadcrumb-item active">Trả sách</li>
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
            <h3 class="card-title">Return Book</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <form action="{{ route('admin.return_borrow_pay', ['id' => $borrowPay->id]) }}" method="POST" role="form">
                @csrf
                <!-- text input -->
                <div class="form-group">
                    <label>Mã phiếu mượn</label>
                    <input type="text" class="form-control" name="id" value="{{ $borrowPay->id }}" disabled>
                </div>
                <div class="form-group">
                    <label>Người mượn</label>
                    <input type="text" class="form-control" name="student" value="{{ $borrowPay->student->name }}"
                        disabled>
                </div>
                <div class="form-group">
                    <label>Sách</label>
                    <input type="text" class="form-control" name="book" value="{{ $borrowPay->book->name }}" disabled>
                </div>
                <div class="form-group">
                    <label>Số lượng</label>
                    <input type="number" class="form-control" name="number" value="{{ $borrowPay->number }}" disabled>
                </div>
                <div class="form-group">
                    <label>Ngày mượn</label>
                    <input type="text" class="form-control" name="date_borrowed" value="{{ $borrowPay->date_borrowed }}"
                        disabled>
                </div>
                <div class="form-group">
                    <label>Ngày hết hạn</label>
                    <input type="text" class="form-control" name="date_expiration"
                        value="{{ $borrowPay->date_expiration }}" disabled>
                </div>
                <div class="form-group">
                    <label>Ngày trả</label>
                    <input type="date" class="form-control" name="date_returned" value="{{ $borrowPay->date_returned }}"
                        disabled>
                </div>
                <div class="form-group">
                    <label>Tình trạng</label>
                    @if ($borrowPay->status == 1)
                    <span class="badge badge-primary">Đã trả</span>
                    @else
                    <span class="badge badge-warning">Chưa trả</span>
                    @endif
                </div>
                @if ($dueDate > 0)
                <div>
                    <span style="color: red">Đã muộn {{ $dueDate }} ngày.</span>
                    <i style="color: silver">Mỗi ngày trả muộn phạt 10.000 VNĐ.</i>
                </div>
                @endif
                <div class="form-group">
                    <label>Tiền phạt</label>
                    <input type="number" class="form-control" step="0.1" name="fine" value="{{ $fine }}"
                        placeholder="Tiền bị phạt">
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
