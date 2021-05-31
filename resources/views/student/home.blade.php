@extends('student.master')

@section('title', 'Trang chủ')

@push('style')
<link rel="stylesheet" href="{{ asset('css') }}/home.css">
@endpush

@push('js')
<script>
    $(function(){
    $('#home').addClass('active');
    });
</script>
@endpush

@section('content')
<div class="container">

    <!-- Widgets -->
    {{-- https://www.bootdey.com/snippets/view/bs4-card-widget --}}
    <div class="row justify-content-center">
        <div class="col-md-12 ">
            <div class="row ">
                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                    <div class="card l-bg-cherry">
                        <div class="card-statistic-3 p-4">
                            <div class="card-icon card-icon-large"><i class="fas fa-shopping-cart"></i></div>
                            <div class="mb-4">
                                <h5 class="card-title mb-0">Tổng sách mượn</h5>
                            </div>
                            <div class="row align-items-center mb-2 d-flex">
                                <div class="col-8">
                                    <h2 class="d-flex align-items-center mb-0">
                                        {{ $totalBook }}
                                    </h2>
                                </div>
                                {{-- <div class="col-4 text-right">
                                    <span>12.5% <i class="fa fa-arrow-up"></i></span>
                                </div> --}}
                            </div>
                            <div class="progress mt-1 " data-height="8" style="height: 8px;">
                                <div class="progress-bar l-bg-cyan" role="progressbar" data-width="25%"
                                    aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                    <div class="card l-bg-blue-dark">
                        <div class="card-statistic-3 p-4">
                            <div class="card-icon card-icon-large"><i class="fas fa-users"></i></div>
                            <div class="mb-4">
                                <h5 class="card-title mb-0">Sách đã trả</h5>
                            </div>
                            <div class="row align-items-center mb-2 d-flex">
                                <div class="col-8">
                                    <h2 class="d-flex align-items-center mb-0">
                                        {{ $paidBook }}
                                    </h2>
                                </div>
                                {{-- <div class="col-4 text-right">
                                    <span>9.23% <i class="fa fa-arrow-up"></i></span>
                                </div> --}}
                            </div>
                            <div class="progress mt-1 " data-height="8" style="height: 8px;">
                                <div class="progress-bar l-bg-green" role="progressbar" data-width="25%"
                                    aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                    <div class="card l-bg-green-dark">
                        <div class="card-statistic-3 p-4">
                            <div class="card-icon card-icon-large"><i class="fas fa-ticket-alt"></i></div>
                            <div class="mb-4">
                                <h5 class="card-title mb-0">Sách đang mượn</h5>
                            </div>
                            <div class="row align-items-center mb-2 d-flex">
                                <div class="col-8">
                                    <h2 class="d-flex align-items-center mb-0">
                                        {{ $unpaidBook }}
                                    </h2>
                                </div>
                                {{-- <div class="col-4 text-right">
                                    <span>10% <i class="fa fa-arrow-up"></i></span>
                                </div> --}}
                            </div>
                            <div class="progress mt-1 " data-height="8" style="height: 8px;">
                                <div class="progress-bar l-bg-orange" role="progressbar" data-width="25%"
                                    aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                    <div class="card l-bg-orange-dark">
                        <div class="card-statistic-3 p-4">
                            <div class="card-icon card-icon-large"><i class="fas fa-dollar-sign"></i></div>
                            <div class="mb-4">
                                <h5 class="card-title mb-0">Số lần phạt</h5>
                            </div>
                            <div class="row align-items-center mb-2 d-flex">
                                <div class="col-8">
                                    <h2 class="d-flex align-items-center mb-0">
                                        {{ $numberOfPenalties }}
                                    </h2>
                                </div>
                                {{-- <div class="col-4 text-right">
                                    <span>2.5% <i class="fa fa-arrow-up"></i></span>
                                </div> --}}
                            </div>
                            <div class="progress mt-1 " data-height="8" style="height: 8px;">
                                <div class="progress-bar l-bg-cyan" role="progressbar" data-width="25%"
                                    aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Search -->
    <div class="row">
        <div class="col">
            <div class="search">
                <div class="form-group has-search">
                    <form>
                        <span class="fa fa-search form-control-feedback"></span>
                        <input type="text" class="form-control" name="keyword" placeholder="Tên sách..."
                            value="{{ request()->keyword }}">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Page Heading -->
    <div class="row">
        @foreach ($books as $book)
        <div class="col-lg-3 mb-4">
            <div class="card h-100 card-book">

                @if ($book->stock_amount == 0)
                <a href="{{ route('book_detail', ['book_id' => $book->id]) }}">
                    <img class="card-img-top img-book-disable" src="{{ asset($book->image) }}" alt=""
                        onError="this.onerror=null;this.src='{{ url("/img/400x250.png") }}';">
                </a>
                <span class="book-label">Hết</span>
                @else
                <a href="{{ route('book_detail', ['book_id' => $book->id]) }}">
                    <img class="card-img-top img-book" src="{{ asset($book->image) }}" alt=""
                        onError="this.onerror=null;this.src='{{ url("/img/400x250.png") }}';">
                </a>
                @endif

                <div class="card-body">
                    <div class="card-title ">
                        <h5 class="text-one-line text-center" style="font-family: Lobster;">
                            <a href="{{ route('book_detail', ['book_id' => $book->id]) }}" class="text-decoration-none">
                                {{ $book->name }}
                            </a>
                        </h5>
                    </div>
                    {{-- <p class="card-text text-two-line">{{ $book->description }}</p> --}}
                    <div class="row">
                        <div class="col-xs-12 col-md-12">
                            <p style="opacity: 0.3">
                                Còn {{ ($book->stock_amount)?($book->stock_amount):'0' }} quyển
                            </p>
                        </div>
                        {{-- <div class="col-xs-12 col-md-6"> --}}
                        {{-- <a class="btn btn-sm btn-success float-right"
                                href="{{ route('check_order', ['book_id' => $book->id]) }}">
                        <i class="fa fa-cart-plus" aria-hidden="true"></i>&nbsp;
                        Đặt mượn</a> --}}
                        {{-- <p class="float-right" style="opacity: 0.6">
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                ... lượt mượn
                            </p> --}}
                        {{-- </div> --}}
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <!-- /.row -->

    <div class="pagination m-0 justify-content-center">
        {{ $books->links() }}
    </div>
</div>
@endsection
