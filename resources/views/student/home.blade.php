@extends('student.master')

@section('title', 'Trang chủ')

@push('style')
<link rel="stylesheet" href="{{ asset('css') }}/home.css">
@endpush

@push('js')
<script>
    $(document).ready(function() {
        $('#list').click(function(event){
            event.preventDefault();
            $('#products .item').addClass('list-group-item');
        });
        $('#grid').click(function(event){
            event.preventDefault();
            $('#products .item').removeClass('list-group-item');
            $('#products.item').addClass('grid-group-item');
        });
    });
</script>
@endpush

@section('content')
<div class="container">

    <!-- Widgets -->
    {{-- https://www.bootdey.com/snippets/view/bs4-card-widget --}}
    <div class="row justify-content-center">
        <div class="col-md-10 ">
            <div class="row ">
                <div class="col-xl-3 col-lg-6">
                    <div class="card l-bg-cherry">
                        <div class="card-statistic-3 p-4">
                            <div class="card-icon card-icon-large"><i class="fas fa-shopping-cart"></i></div>
                            <div class="mb-4">
                                <h5 class="card-title mb-0">New Orders</h5>
                            </div>
                            <div class="row align-items-center mb-2 d-flex">
                                <div class="col-8">
                                    <h2 class="d-flex align-items-center mb-0">
                                        3,243
                                    </h2>
                                </div>
                                <div class="col-4 text-right">
                                    <span>12.5% <i class="fa fa-arrow-up"></i></span>
                                </div>
                            </div>
                            <div class="progress mt-1 " data-height="8" style="height: 8px;">
                                <div class="progress-bar l-bg-cyan" role="progressbar" data-width="25%"
                                    aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card l-bg-blue-dark">
                        <div class="card-statistic-3 p-4">
                            <div class="card-icon card-icon-large"><i class="fas fa-users"></i></div>
                            <div class="mb-4">
                                <h5 class="card-title mb-0">Customers</h5>
                            </div>
                            <div class="row align-items-center mb-2 d-flex">
                                <div class="col-8">
                                    <h2 class="d-flex align-items-center mb-0">
                                        15.07k
                                    </h2>
                                </div>
                                <div class="col-4 text-right">
                                    <span>9.23% <i class="fa fa-arrow-up"></i></span>
                                </div>
                            </div>
                            <div class="progress mt-1 " data-height="8" style="height: 8px;">
                                <div class="progress-bar l-bg-green" role="progressbar" data-width="25%"
                                    aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card l-bg-green-dark">
                        <div class="card-statistic-3 p-4">
                            <div class="card-icon card-icon-large"><i class="fas fa-ticket-alt"></i></div>
                            <div class="mb-4">
                                <h5 class="card-title mb-0">Ticket Resolved</h5>
                            </div>
                            <div class="row align-items-center mb-2 d-flex">
                                <div class="col-8">
                                    <h2 class="d-flex align-items-center mb-0">
                                        578
                                    </h2>
                                </div>
                                <div class="col-4 text-right">
                                    <span>10% <i class="fa fa-arrow-up"></i></span>
                                </div>
                            </div>
                            <div class="progress mt-1 " data-height="8" style="height: 8px;">
                                <div class="progress-bar l-bg-orange" role="progressbar" data-width="25%"
                                    aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card l-bg-orange-dark">
                        <div class="card-statistic-3 p-4">
                            <div class="card-icon card-icon-large"><i class="fas fa-dollar-sign"></i></div>
                            <div class="mb-4">
                                <h5 class="card-title mb-0">Revenue Today</h5>
                            </div>
                            <div class="row align-items-center mb-2 d-flex">
                                <div class="col-8">
                                    <h2 class="d-flex align-items-center mb-0">
                                        $11.61k
                                    </h2>
                                </div>
                                <div class="col-4 text-right">
                                    <span>2.5% <i class="fa fa-arrow-up"></i></span>
                                </div>
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
                    <span class="fa fa-search form-control-feedback"></span>
                    <input type="text" class="form-control" placeholder="Search">
                </div>
            </div>
        </div>
    </div>

    <!-- Grid View -->
    {{-- https://bootsnipp.com/snippets/M515A --}}
    <div class="row">
        <div class="col-lg-12 my-3">
            <div class="pull-right">
                <div class="btn-group">
                    <button class="btn btn-info" id="list">
                        List View
                    </button>
                    <button class="btn btn-danger" id="grid">
                        Grid View
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div id="products" class="row view-group">
        <div class="item col-xs-4 col-lg-4">
            <div class="thumbnail card">
                <div class="img-event">
                    <img class="group list-group-image img-fluid" src="http://placehold.it/400x250/000/fff" alt="" />
                </div>
                <div class="caption card-body">
                    <h4 class="group card-title inner list-group-item-heading">
                        Product title</h4>
                    <p class="group inner list-group-item-text">
                        Product description... Lorem ipsum dolor sit amet, consectetuer adipiscing elit,
                        sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
                    <div class="row">
                        <div class="col-xs-12 col-md-6">
                            <p class="lead">
                                $21.000</p>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <a class="btn btn-success" href="http://www.jquery2dotnet.com">Add to cart</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="item col-xs-4 col-lg-4">
            <div class="thumbnail card">
                <div class="img-event">
                    <img class="group list-group-image img-fluid" src="http://placehold.it/400x250/000/fff" alt="" />
                </div>
                <div class="caption card-body">
                    <h4 class="group card-title inner list-group-item-heading">
                        Product title</h4>
                    <p class="group inner list-group-item-text">
                        Product description... Lorem ipsum dolor sit amet, consectetuer adipiscing elit,
                        sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
                    <div class="row">
                        <div class="col-xs-12 col-md-6">
                            <p class="lead">
                                $21.000</p>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <a class="btn btn-success" href="http://www.jquery2dotnet.com">Add to cart</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="item col-xs-4 col-lg-4">
            <div class="thumbnail card">
                <div class="img-event">
                    <img class="group list-group-image img-fluid" src="http://placehold.it/400x250/000/fff" alt="" />
                </div>
                <div class="caption card-body">
                    <h4 class="group card-title inner list-group-item-heading">
                        Product title</h4>
                    <p class="group inner list-group-item-text">
                        Product description... Lorem ipsum dolor sit amet, consectetuer adipiscing elit,
                        sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
                    <div class="row">
                        <div class="col-xs-12 col-md-6">
                            <p class="lead">
                                $21.000</p>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <a class="btn btn-success" href="http://www.jquery2dotnet.com">Add to cart</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="item col-xs-4 col-lg-4">
            <div class="thumbnail card">
                <div class="img-event">
                    <img class="group list-group-image img-fluid" src="http://placehold.it/400x250/000/fff" alt="" />
                </div>
                <div class="caption card-body">
                    <h4 class="group card-title inner list-group-item-heading">
                        Product title</h4>
                    <p class="group inner list-group-item-text">
                        Product description... Lorem ipsum dolor sit amet, consectetuer adipiscing elit,
                        sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
                    <div class="row">
                        <div class="col-xs-12 col-md-6">
                            <p class="lead">
                                $21.000</p>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <a class="btn btn-success" href="http://www.jquery2dotnet.com">Add to cart</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="item col-xs-4 col-lg-4">
            <div class="thumbnail card">
                <div class="img-event">
                    <img class="group list-group-image img-fluid" src="http://placehold.it/400x250/000/fff" alt="" />
                </div>
                <div class="caption card-body">
                    <h4 class="group card-title inner list-group-item-heading">
                        Product title</h4>
                    <p class="group inner list-group-item-text">
                        Product description... Lorem ipsum dolor sit amet, consectetuer adipiscing elit,
                        sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
                    <div class="row">
                        <div class="col-xs-12 col-md-6">
                            <p class="lead">
                                $21.000</p>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <a class="btn btn-success" href="http://www.jquery2dotnet.com">Add to cart</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="item col-xs-4 col-lg-4">
            <div class="thumbnail card">
                <div class="img-event">
                    <img class="group list-group-image img-fluid" src="http://placehold.it/400x250/000/fff" alt="" />
                </div>
                <div class="caption card-body">
                    <h4 class="group card-title inner list-group-item-heading">
                        Product title</h4>
                    <p class="group inner list-group-item-text">
                        Product description... Lorem ipsum dolor sit amet, consectetuer adipiscing elit,
                        sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
                    <div class="row">
                        <div class="col-xs-12 col-md-6">
                            <p class="lead">
                                $21.000</p>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <a class="btn btn-success" href="http://www.jquery2dotnet.com">Add to cart</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
