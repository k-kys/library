@extends('student.master')

@section('title', 'Đăng nhập')

@push('style')
<link rel="stylesheet" href="{{ asset('css') }}/login.css">
@endpush

@section('content')
<div class="contaiber-fluid">
    <div class="wrapper fadeInDown">
        <div id="formContent">
            <!-- Tabs Titles -->
            <div>
                <h2>Đăng nhập</h2>
            </div>

            <!-- Login Form -->
            <form action="{{ route('login') }}" method="POST" role="form">
                @csrf
                <input type="email" class="fadeIn second" name="email" placeholder="Email" required>
                <input type="password" class="fadeIn third" name="password" placeholder="Mật khẩu" required>
                <input type="submit" class="fadeIn fourth" value="Đăng nhập">
            </form>

            <!-- Remind Passowrd -->
            <div id="formFooter">
                <a class="underlineHover" href="{{ url('/fogot-password') }}">Quên mật khẩu</a>
            </div>

        </div>
    </div>
</div>
@endsection




{{-- https://bootsnipp.com/snippets/dldxB --}}
