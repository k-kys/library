@extends('admin.master')

@section('title', 'Dashboard')

@section('header', 'Dashboard')


@push('js')
<script>
    $(function(){
        $('#home').addClass('active');
    });
</script>
@endpush

@section('content')
<div class="container-fluid">
    <!-- Info boxes -->
    <div class="row">

        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Tổng sách</span>
                    <span class="info-box-number">{{ $totalAmount }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Sách còn lại</span>
                    <span class="info-box-number">{{ $totalStockAmount }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix hidden-md-up"></div>

        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Tổng phiếu mượn</span>
                    <span class="info-box-number">{{ $totalBorrow }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->

        {{-- <div class="col-12 col-sm-6 col-md-2">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Đang mượn</span>
                    <span class="info-box-number">{{ $borrowing }}</span>
    </div>
    <!-- /.info-box-content -->
</div>
<!-- /.info-box -->
</div>
<!-- /.col --> --}}

<div class="col-12 col-sm-6 col-md-3">
    <div class="info-box mb-3">
        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
        <div class="info-box-content">
            <span class="info-box-text">Tổng sinh viên</span>
            <span class="info-box-number">{{ $totalStudent }}</span>
        </div>
        <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
</div>
<!-- /.col -->

{{-- <div class="col-12 col-sm-6 col-md-2">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">SV bị khoá</span>
                    <span class="info-box-number">{{ $studentBlock }}</span>
</div>
<!-- /.info-box-content -->
</div>
<!-- /.info-box -->
</div>
<!-- /.col --> --}}

</div>
<!-- /.row -->



@if (count($orders) > 0)
<div class="row">
    <div class="col-12">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><b>Yêu cầu mượn sách</b></h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip"
                        title="Remove">
                        <i class="fas fa-times"></i></button>
                </div>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-head-fixed text-nowrap">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Người mượn</th>
                            <th>Sách</th>
                            <th>Số lượng</th>
                            <th>Ngày tạo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->student_name }}</td>
                            <td>{{ $item->book_name }}</td>
                            <td>{{ $item->number }}</td>
                            <td>{{ $item->created_at }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer text-center">
                <a href="{{ route('admin.order') }}">Xem tất cả</a>
            </div>
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->
    </div>
</div>
@endif

<div class="row">

    <div class="col-md-7">
        <!-- TABLE: LATEST BORROWS -->
        <div class="card">
            <div class="card-header border-transparent">
                <h3 class="card-title"><b>Phiếu mượn gần đây</b></h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <div class="table-responsive table-hover text-center">
                    <table class="table m-0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Người mượn</th>
                                <th>Sách</th>
                                <th>Số lượng</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($recentBorrows as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->student_name }}</td>
                                <td>{{ $item->book_name }}</td>
                                <td>{{ $item->number }}</td>
                                <td>
                                    @if ($item->status == 1)
                                    <span class="badge badge-primary">Đã trả</span>
                                    @else
                                    <div class="badge badge-warning">Đang mượn</div>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix text-center">
                <a href="{{ route('admin.borrow_pay') }}">Xem tất cả</a>
                {{-- <a href="javascript:void(0)" class="btn btn-sm btn-info float-left">Place New Order</a>
                    <a href="javascript:void(0)" class="btn btn-sm btn-secondary float-right">View All Orders</a> --}}
            </div>
            <!-- /.card-footer -->
        </div>
        <!-- /.card -->

        <!-- TABLE: LATEST RETURNED -->
        <div class="card">
            <div class="card-header border-transparent">
                <h3 class="card-title"><b>Phiếu đã trả gần đây</b></h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <div class="table-responsive table-hover text-center">
                    <table class="table m-0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Người mượn</th>
                                <th>Sách</th>
                                <th>Số lượng</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($recentReturned as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->student_name }}</td>
                                <td>{{ $item->book_name }}</td>
                                <td>{{ $item->number }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix text-center">
                <a href="{{ route('admin.borrow_pay') }}">Xem tất cả</a>
                {{-- <a href="javascript:void(0)" class="btn btn-sm btn-info float-left">Place New Order</a>
                            <a href="javascript:void(0)" class="btn btn-sm btn-secondary float-right">View All Orders</a> --}}
            </div>
            <!-- /.card-footer -->
        </div>
        <!-- /.card -->
    </div>

    <div class="col-md-5">
        <!-- PRODUCT LIST -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><b>Sách đã thêm gần đây</b></h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <ul class="products-list product-list-in-card pl-2 pr-2">
                    @foreach ($newBook as $item)
                    <li class="item">
                        <div class="product-img">
                            <img src="{{ $item->image }}"
                                onError="this.onerror=null;this.src='{{ url('/img/default-150x150.png') }}';"
                                alt="Product Image" class="img-size-50">
                        </div>
                        <div class="product-info">
                            <a href="{{ route('admin.edit_book', ['id' => $item->id]) }}" class="product-title">
                                <h5><b>{{ $item->name }}</b></h5>
                            </a>
                            <span class="product-description">
                                <h5>
                                    <span class="badge badge-secondary ">{{ ($item->amount)?:0 }}
                                        quyển</span>
                                    &nbsp;
                                    <span class="badge badge-danger ">{{ ($item->price)?:0 }} vnd</span>
                                </h5>
                            </span>
                        </div>
                    </li>
                    <!-- /.item -->
                    @endforeach
                </ul>
            </div>
            <!-- /.card-body -->
            <div class="card-footer text-center">
                <a href="{{ route('admin.book') }}" class="uppercase">Xem tất cả</a>
            </div>
            <!-- /.card-footer -->
        </div>
        <!-- /.card -->

        {{-- <div class="col-md-6"> --}}
        <!-- USERS LIST -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><b>Sinh viên đăng ký gần đây</b></h3>

                <div class="card-tools">
                    {{-- <span class="badge badge-danger">8 New Members</span> --}}
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <ul class="users-list clearfix">
                    {{-- {{ asset('adminlte-v3') }}/dist/img/user1-128x128.jpg --}}
                    @foreach ($studentRegisterRecent as $item)
                    <li>
                        <img src="{{ asset($item->image) }}"
                            onError="this.onerror=null;this.src='{{ url("/img/blank-profile-picture-215x215.png") }}';"
                            alt="User Image">
                        <a class="users-list-name"
                            href="{{ route('admin.edit_student', ['id' => $item->id]) }}">{{ $item->name }}</a>
                        <span class="users-list-date">{{ $item->created_at }}</span>
                    </li>
                    @endforeach
                </ul>
                <!-- /.users-list -->
            </div>
            <!-- /.card-body -->
            <div class="card-footer text-center">
                <a href="{{ route('admin.student') }}">Xem tất cả</a>
            </div>
            <!-- /.card-footer -->
        </div>
        <!--/.card -->
        {{-- </div> --}}
    </div>
</div>
</div>
<!-- /.col -->
</div>
@endsection
