@extends('student.master')

@section('title', 'Mượn - trả')


@section('content')
<div class="row border border-default">



    <div class="text-center p-2 col-md-12 border-top">
        <h2 class="lead">Thông tin mượn - trả</h2>
    </div>


    <div class="bg-secondary text-white p-2 mb-3 col-3 text-center d-none d-sm-block">
        <p>GATEWAY</p>
    </div>
    <div class="bg-secondary text-white p-2 mb-3 col-3 text-center d-block d-sm-none small">
        <p>GATE</p>
    </div>
    <div class="bg-secondary text-white p-2 mb-3 col-3 text-center d-none d-sm-block">
        <p>INSIDE</p>
    </div>
    <div class="bg-secondary text-white p-2 mb-3 col-3 text-center d-block d-sm-none small">
        <p>INS</p>
    </div>
    <div class="bg-secondary text-white p-2 mb-3 col-3 text-center d-none d-sm-block">
        <p>BALCONY</p>
    </div>
    <div class="bg-secondary text-white p-2 mb-3 col-3 text-center d-block d-sm-none small">
        <p>BAL</p>
    </div>
    <div class="bg-secondary text-white p-2 mb-3 col-3 text-center d-none d-sm-block">
        <p>MINI-SUITE</p>
    </div>
    <div class="bg-secondary text-white p-2 mb-3 col-3 text-center d-block d-sm-none small">
        <p>SUI</p>
    </div>


    <div class="py-2 col-3 text-center d-none d-sm-block small">
        <p>price from</p>
    </div>
    <div class="py-2 col-3 text-center d-block d-sm-none small">
        <p>from</p>
    </div>
    <div class="py-2 odd col-3 text-center">
        <del>$X,XXX</del>
    </div>
    <div class="py-2even col-3 text-center">
        <del>$X,XXX</del>
    </div>
    <div class="py-2 odd col-3 text-center">
        <del>$X,XXX</del>
    </div>


    <div class="py-2 col-3 text-center d-none d-sm-block gateway">
        <p>Vancouver</p>
    </div>
    <div class="py-2 col-3 text-center d-block d-sm-none">
        <p>YVR</p>
    </div>
    <div class="py-2 odd col-3 text-center">
        <p class="mark text-danger lead font-weight-bold">$X,XXX</p>
    </div>
    <div class="py-2 even col-3 text-center">
        <p class="mark text-danger lead font-weight-bold">$X,XXX</p>
    </div>
    <div class="py-2 odd col-3 text-center">
        <p class="mark text-danger lead font-weight-bold">$X,XXX</p>
    </div>


    <div class="py-2 col-3 text-center d-none d-sm-block gateway">
        <p>Toronto</p>
    </div>
    <div class="py-2 col-3 text-center d-block d-sm-none">
        <p>YYZ</p>
    </div>
    <div class="py-2 odd col-3 text-center">
        <p class="mark text-danger lead font-weight-bold">$X,XXX</p>
    </div>
    <div class="py-2 even col-3 text-center">
        <p class="mark text-danger lead font-weight-bold">$X,XXX</p>
    </div>
    <div class="py-2 odd col-3 text-center">
        <p class="mark text-danger lead font-weight-bold">$X,XXX</p>
    </div>


    <div class="py-3 col-3 text-center d-none d-sm-block">
        <p>savings<br> <small>per couple</small></p>
    </div>
    <div class="py-3 col-3 text-center d-block d-sm-none small">
        <p>savings<br> <small>per couple</small></p>
    </div>
    <div class="py-3 odd col-3 text-center">
        <p class="text-secondary">$X,XXX</p>
    </div>
    <div class="py-3 even col-3 text-center">
        <p class="text-secondary">$X,XXX</p>
    </div>
    <div class="py-3 odd col-3 text-center">
        <p class="text-secondary">$X,XXX</p>
    </div>


    <div class="text-center border py-4 col-md text-secondary">
        <p>[Het]</p>
    </div>

</div>

@endsection




{{-- https://bootsnipp.com/snippets/BxAoB --}}
