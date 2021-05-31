@extends('admin.master')

@section('title', 'Yêu cầu mượn sách')

@section('header', 'Mượn trả')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.borrow_pay') }}">Mượn trả</a></li>
<li class="breadcrumb-item active">Yêu cầu mượn</li>
@endsection

@push('style')
<style>
    .h2 {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 70vh;
        border: 1px solid rgb(59, 167, 175);
        border-radius: 10px;
        text-align: center;
        opacity: 0.3;
    }

    .h2 h2 {
        padding: 0 10px 0 10px;
    }
</style>
@endpush

@push('js')
<script>
    $(function(){
        $('#borrow-pay').addClass('menu-open');
        $('#borrow-pay-link').addClass('active');
        $('#order').addClass('active');
    });
</script>
@endpush

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            @if (count($orders) > 0)
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Orders table</h3>

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
                                <th>Ngày đặt mượn</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->student_name }}</td>
                                <td>{{ $item->book_name }}</td>
                                <td>{{ $item->number }}</td>
                                <td>{{ $item->created_at }}
                                </td>
                                <td>
                                    <a href="{{ route('admin.accept_order', ['order_id' => $item->id]) }}"
                                        class="btn btn-sm btn-success">
                                        <i class="fas fa-check" aria-hidden="true"></i>&nbsp;
                                        Chấp nhận
                                    </a>
                                    |
                                    <a href="{{ route('admin.refuse_order', ['order_id' => $item->id]) }}"
                                        class="btn btn-sm btn-warning">
                                        <i class="fas fa-times" aria-hidden="true"></i>&nbsp;
                                        Từ chối
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @else
            <div class="h2">
                <h2>Chưa có yêu cầu mượn sách ...</h2>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
