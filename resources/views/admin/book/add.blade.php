@extends('admin.master')

@section('title', 'Thêm sách')

@section('header', 'Sách')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.book') }}">Sách</a></li>
<li class="breadcrumb-item active">Thêm</li>
@endsection

@push('style')
<style type="text/css">
    #img {
        background-color: antiquewhite;
        max-height: 600px;
        max-width: 90%;
        border: 2px solid #0af;
        border-radius: 5px;
        transition: background ease-out 200ms;
    }

    #preview {
        position: relative;
    }

    /*hide input*/
    /* input[type="file"]  */
    #image {
        display: none;
    }

    /*button upload customer*/
    .btn-upload {
        /* height: 20%; */
        padding: 4px 8px;
        border-radius: 50%;
        border: none;
        cursor: pointer;
        background-color: #08f;
        box-shadow: 0px 3px 5px -1px rgba(0, 0, 0, 0.2),
            0px 6px 10px 0px rgba(0, 0, 0, 0.14),
            0px 1px 18px 0px rgba(0, 0, 0, 0.12);
        transition: background-color ease-out 120ms;
        position: absolute;
        right: 7%;
        bottom: -2%;
    }

    .btn-upload:hover {
        background-color: #45a;
    }
</style>
@endpush

@push('js')
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script>
    $(function(){
        $('#book').addClass('active');
    });

    // summernote config
    // $('#lfm').filemanager('image');

    $(document).ready(function(){

    // Initialize summernote with LFM button in the popover button group
    // Please note that you can add this button to any other button group you'd like
    $('#summernote-editor').summernote({
            height: 300,
            placeholder: 'Nhập mô tả chi tiết cho sách...',
            toolbar: [
                // [groupName, [list of button]]
                ['style', ['style', 'bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontname', 'fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['height', ['height']],
                ['view', ['fullscreen', 'codeview', 'help']],
            ],
        });
    });
</script>
<script type="text/javascript">
    // UPLOAD PREVIEW
    const UPLOAD_BUTTON = document.getElementById("upload-button");
    // const FILE_INPUT = document.querySelector("input[type=file]");
    const FILE_INPUT = document.getElementById('image');
    const IMG = document.getElementById("img");

    UPLOAD_BUTTON.addEventListener("click", () => FILE_INPUT.click());

    FILE_INPUT.addEventListener("change", event => {
    const file = event.target.files[0];

    const reader = new FileReader();
    reader.readAsDataURL(file);

    reader.onloadend = (e) => {
        IMG.setAttribute("aria-label", file.name);
        IMG.src = e.target.result;
    };
    });

</script>
@endpush


@section('content')
<div class="container">
    <div class="card card-warning">
        <div class="card-header">
            <h3 class="card-title">Add Book</h3>
        </div>

        <div class="card-body">
            <form id="form-add" action="{{ route('admin.store_book') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="isbn">Mã ISBN</label>
                    <input class="form-control" type="text" name="isbn" id="isbn" placeholder="Nhập mã isbn">
                </div>
                <div class="form-group">
                    <label for="name">Tên sách</label>
                    <input class="form-control" type="text" name="name" id="name" placeholder="Nhập tên sách" required>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-12">
                            <label for="summernote-editor">Mô tả</label>
                            <textarea id="summernote-editor" class="form-control" name="description"></textarea>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <label for="category">Thể loại</label>
                            <select name="category_id[]" id="category" class="form-control select2"
                                data-placeholder="Chọn thể loại" multiple required>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-6">
                            <label for="major">Lĩnh vực</label>
                            <select name="major_id[]" id="major" class="form-control select2"
                                data-placeholder="Chọn lĩnh vực" multiple required>
                                @foreach ($majors as $major)
                                <option value="{{ $major->id }}">{{ $major->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <label for="amount">Số lượng</label>
                            <input class="form-control" type="number" min="0" name="amount" id="amount"
                                placeholder="Nhập số lượng" value="0">
                        </div>
                        <div class="col-6">
                            <label for="price">Giá</label>
                            <input class="form-control" type="number" min="0" step="500" name="price" id="price"
                                placeholder="Nhập giá" value="0">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row justify-content-center text-center">
                        <input type="file" name="image" id="image" accept="image/*" />
                        <div id="preview">
                            <div class=" ">
                                <img id="img" src="" alt="Book picture"
                                    onError="this.onerror=null;this.src='{{ url("/img/400x250.png") }}';">
                            </div>
                            <div>
                                <button type="button" class="btn-upload" id="upload-button" aria-labelledby="image"
                                    aria-describedby="image" style="right: 3%">
                                    <i class="fas fa-camera"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
        </div>

        <div class="card-footer">
            <a href="{{ route('admin.book') }}" class="btn btn-sm btn-default">
                <i class="fas fa-angle-double-left" aria-hidden="true"></i>&nbsp;
                Sách
            </a>
            <button type="submit" class="btn btn-sm btn-primary float-right">
                <i class="fas fa-save"></i>&nbsp;
                Lưu
            </button>
        </div>
        </form>
    </div>
</div>
@endsection
