@extends('admin.master')

@section('title', 'Sửa thể loại')

@section('header', 'Thể loại')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.category') }}">Thể loại</a></li>
<li class="breadcrumb-item active">Sửa</li>
@endsection

@push('js')
<script>
    $(function(){
        $('#category').addClass('active');
    });
</script>
@endpush

@section('content')
<div class="container">
    <div class="card card-warning">
        <div class="card-header">
            <h3 class="card-title">Edit Category</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <form action="{{ route('admin.update_category', ['id' => $category->id]) }}" method="POST" role="form">
                @csrf
                <div class="form-group">
                    <label>Thể loại</label>
                    <input type="text" class="form-control" name="name" value="{{ $category->name }}"
                        placeholder="Tên thể loại" required>
                </div>
                <div class="form-group">
                    <label>Ngày tạo</label>
                    <input id="my-input" class="form-control" type="text" name="created_at"
                        value="{{ $category->created_at }}" disabled>
                </div>
                <div class="form-group">
                    <label>Ngày sửa</label>
                    <input id="my-input" class="form-control" type="text" name="updated_at"
                        value="{{ $category->updated_at }}" disabled>
                </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <a href="{{ route('admin.category') }}" class="btn btn-sm btn-default">
                <i class="fas fa-angle-double-left" aria-hidden="true"></i>&nbsp;
                Thể loại
            </a>
            <button type="submit" class="btn btn-sm btn-primary float-right">
                <i class="fas fa-save"></i>&nbsp;
                Cập nhật
            </button>
        </div>
        </form>
    </div>
</div>
@endsection
