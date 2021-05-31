@extends('student.master')

@section('title', 'Đổi mật khẩu')

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
            <h2>Đổi mật khẩu</h2>
        </div>
        @php
        $id = Auth::guard('student')->id();
        @endphp
        <form action="{{ route('update_password', ['id' => $id]) }}" method="POST">
            @csrf
            <input type="password" class="fadeIn second" name="password" placeholder="Mật khẩu hiện tại" required>
            <input type="password" class="fadeIn third" name="new_password" placeholder="Mật khẩu mới" required>
            <input type="password" class="fadeIn third" name="re_password" placeholder="Nhập lại mật khẩu mới" required>
            <input type="submit" class="fadeIn fourth" value="Đổi">
        </form>

        <div id="formFooter">
            <a class="underlineHover" href="{{ route('home') }}">Trang chủ</a>
        </div>

    </div>
</div>
@endsection

{{-- https://bootsnipp.com/snippets/dldxB --}}
