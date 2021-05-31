@extends('student.master')

@section('title', 'Quên mật khẩu')

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
            <h2>Quên mật khẩu</h2>
        </div>

        <!-- Login Form -->
        <form>
            <input type="email" class="fadeIn second" name="email" placeholder="Email">
            <input type="submit" class="fadeIn fourth" value="Gửi">
        </form>

        <!-- Remind Passowrd -->
        <div id="formFooter">
            <a class="underlineHover" href="{{ url('/login') }}">Đăng nhập</a>
        </div>

    </div>
</div>
@endsection




{{-- https://bootsnipp.com/snippets/dldxB --}}
