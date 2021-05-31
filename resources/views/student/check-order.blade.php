@extends('student.master')

@section('title', 'Đặt mượn')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title text-center">
                Đặt mượn
            </h3>
        </div>
        <div class="card-body">
            <form action="{{ route('post_order') }}" method="post" role="form">
                @csrf
                <div class="form-group">
                    <label for="">Sách</label>
                    <input id="" class="form-control" type="text" name="book" value="{{ $book->name }}" readonly>
                    <input type="text" hidden name="book_id" value="{{ $book->id }}">
                </div>
                <div class="form-group">
                    <label for="">Số lượng</label>
                    <input id="" class="form-control" type="number" name="number" value="{{ $number }}"
                        placeholder="{{ $number }}">
                </div>
        </div>
        <div class="card-footer">
            <a href="{{ route('book_detail', [$book->id]) }}" class="btn btn-secondary"><i
                    class="fas fa-angle-double-left"></i>&nbsp;
                Quay lại</a>
            <button type="submit" class="btn btn-success float-right"><i class="fas fa-paper-plane"></i>&nbsp;
                Gửi</button>
        </div>
        </form>
    </div>
</div>
@endsection
