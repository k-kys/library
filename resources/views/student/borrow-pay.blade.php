@extends('student.master')

@section('title', 'Mượn - trả')

@push('style')
<link rel="stylesheet" href="{{ asset('css') }}/home.css">
@endpush

@push('js')
<script>
    $(function(){
    $('#borrow').addClass('active');
    });
</script>
@endpush

@section('content')
<div class="container">

    <div class="row">
        <div class="text-center p-2 col-md-12">
            <h2>Thông tin mượn - trả</h2>
        </div>
    </div>

    <!-- Search -->
    <div class="row">
        <div class="col">
            <div class="search">
                <div class="form-group has-search">
                    <form>
                        <span class="fa fa-search form-control-feedback"></span>
                        <input type="text" class="form-control" name="keyword" placeholder="Nhập tên sách cần tìm"
                            value="{{ request()->keyword }}">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr class="table-warning">
                        <th scope="col">ID</th>
                        <th scope="col">Tên sách</th>
                        <th scope="col">Số lượng</th>
                        <th scope="col">Ngày mượn</th>
                        <th scope="col">Ngày hết hạn</th>
                        <th scope="col">Ngày trả</th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col">Tiền phạt</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($borrowPay as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->number }}</td>
                        <td>{{ $item->date_borrowed }}</td>
                        <td>{{ $item->date_expiration }}</td>
                        <td>{{ $item->date_returned }}</td>
                        <td>
                            @if ($item->status == 1)
                            <span class="badge badge-primary">Đã trả</span>
                            @else
                            <span class="badge badge-warning">Chưa trả</span>
                            @endif
                        </td>
                        <td>{{ $item->amount_of_fine }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="8">{{ $borrowPay->links() }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection

{{-- https://bootsnipp.com/snippets/BxAoB --}}
