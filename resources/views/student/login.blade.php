@extends('student.master')

@section('title', 'Đăng nhập')

@push('style')
<link rel="stylesheet" href="{{ asset('css') }}/login.css">
@endpush

@section('content')
<div class="wrapper fadeInDown">
    <div id="formContent">
        <!-- Tabs Titles -->

        <!-- Icon -->
        {{-- <div class="fadeIn first">
            <img src="" id="icon" />
        </div> --}}
        <div>
            <h2>Đăng nhập</h2>
        </div>

        <!-- Login Form -->
        <form>
            <input type="text" class="fadeIn second" name="email" placeholder="Email">
            <input type="password" class="fadeIn third" name="password" placeholder="Mật khẩu">
            <input type="submit" class="fadeIn fourth" value="Đăng nhập">
        </form>

        <!-- Remind Passowrd -->
        <div id="formFooter">
            <a class="underlineHover" href="{{ url('/reset-password') }}">Quên mật khẩu</a>
        </div>

    </div>
</div>
@endsection




{{-- https://bootsnipp.com/snippets/dldxB --}}
