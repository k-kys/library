@extends('admin.master')

@section('title', 'Sửa sách')

@section('header', 'Sách')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.book') }}">Sách</a></li>
<li class="breadcrumb-item active">Sửa</li>
@endsection

@push('style')
<style type="text/css">
    #img {
        background-color: antiquewhite;
        max-height: 700px;
        max-width: 100%;
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
        right: -2%;
        bottom: -2%;
        z-index: 1;
    }

    .btn-upload:hover {
        background-color: #45a;
    }

    .btn-remove {
        z-index: 1;
        left: 0;
        padding: 0px 3px;
        border-radius: 2px;
        border: none;
        cursor: pointer;
        background-color: #e4ff00;
        box-shadow: 0px 3px 5px -1px rgba(0, 0, 0, 0.2),
            0px 6px 10px 0px rgba(0, 0, 0, 0.14),
            0px 1px 18px 0px rgba(0, 0, 0, 0.12);
        transition: background-color ease-out 120ms;
        position: absolute;
        bottom: 1px;
        left: 1px;
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

    // // Define function to open filemanager window
    // var lfm = function(options, cb) {
    // var route_prefix = (options && options.prefix) ? options.prefix : '/laravel-filemanager';
    // window.open(route_prefix + '?type=' + options.type || 'file', 'FileManager', 'width=900,height=600');
    // window.SetUrl = cb;
    // };

    // // Define LFM summernote button
    // var LFMButton = function(context) {
    // var ui = $.summernote.ui;
    // var button = ui.button({
    // contents: '<i class="note-icon-picture"></i> ',
    // tooltip: 'Chèn ảnh với filemanager',
    // click: function() {

    // lfm({type: 'image', prefix: '/laravel-filemanager'}, function(lfmItems, path) {
    // lfmItems.forEach(function (lfmItem) {
    // context.invoke('insertImage', lfmItem.url);
    // });
    // });

    // }
    // });
    // return button.render();
    // };

    // Initialize summernote with LFM button in the popover button group
    // Please note that you can add this button to any other button group you'd like
    // $('#summernote-editor').summernote();
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

            // button close
            // var buttonRemove = `<button type="button" class="btn-remove" id="remove-button">
            // <i class="fa fa-times"></i>
            // </button>`;
            // $(buttonRemove).insertBefore('#upload-button');

            // remove img cũ, thay vào img mặc đính -> path == null (chưa được)
            // $("#remove-button").click(function(){
            //     IMG.remove();
                // var img = `<img id="img" src="#" onError="this.onerror=null;this.src='{{ url("/img/400x250.png") }}';">`;
                // $('#img').replaceWith(img);
                // $('#div-img').append(img);
            //     $(this).remove();
            // });
        };
    });

</script>
@endpush

@section('content')
<div class="container">
    <div class="card card-warning">
        <div class="card-header">
            <h3 class="card-title">Edit Book</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <form action="{{ route('admin.update_book', ['id' => $book->id]) }}" method="POST" role="form"
                enctype="multipart/form-data">
                @csrf
                <!-- text input -->
                <div class="form-group">
                    <div class="row">
                        <div class="col-4">
                            <label>Mã ISBN</label>
                            <input type="text" class="form-control" name="isbn" value="{{ $book->isbn }}"
                                placeholder="ISBN">
                        </div>
                        <div class="col-8">
                            <label>Tên sách</label>
                            <input type="text" class="form-control" name="name" value="{{ $book->name }}"
                                placeholder="Tên sách" required>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="summernote-editor">Mô tả</label>
                    <textarea id="summernote-editor" class="form-control"
                        name="description">{{ $book->description }}</textarea>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label for="category_id">Thể loại</label>
                            @php
                            $categoryIds = $book->categories->pluck('id')->toArray();
                            @endphp
                            <select name="category_id[]" id="category_id" class="form-control select2"
                                data-placeholder="Chọn thể loại" multiple required>
                                @foreach ($categories as $category)
                                <option {{ in_array($category->id, $categoryIds)?'selected':'' }}
                                    value="{{ $category->id }}">
                                    {{ $category->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label for="major_id">Lĩnh vực</label>
                            @php
                            $majorIds = $book->majors->pluck('id')->toArray();
                            @endphp
                            <select name="major_id[]" id="major_id" class="form-control select2"
                                data-placeholder="Chọn lĩnh vực" multiple required>
                                @foreach ($majors as $major)
                                <option {{ in_array($major->id, $majorIds)?'selected':'' }} value="{{ $major->id }}">
                                    {{ $major->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 col-sm-3">
                        <div class="form-group">
                            <label>Giá</label>
                            <input id="my-input" class="form-control" type="number" step="500" name="price"
                                value="{{ $book->price }}" placeholder="Giá">
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3">
                        <div class="form-group">
                            <label>Số lượng</label>
                            <input id="my-input" class="form-control" type="number" name="amount"
                                value="{{ $book->amount }}" placeholder="Số lượng" disabled>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3">
                        <div class="form-group">
                            <label>Số lượng còn lại</label>
                            <input id="my-input" class="form-control" type="number" name="stock_amount"
                                value="{{ $book->stock_amount }}" placeholder="Số lượng còn lại" disabled>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3">
                        <div class="form-group">
                            <label>Thêm sách</label>
                            <input id="my-input" class="form-control" type="number" name="add_amount"
                                placeholder="Nhập số sách bổ sung thêm">
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <div class="row justify-content-center">
                                <input type="file" name="image" id="image" accept="image/*" />
                                <div id="preview">
                                    <div id="div-img">
                                        <img id="img" src="{{ asset($book->image) }}"
                                            onError="this.onerror=null;this.src='{{ url("/img/400x250.png") }}';">
                                    </div>
                                    <button type="button" class="btn-upload" id="upload-button" aria-labelledby="image"
                                        aria-describedby="image">
                                        <i class="fas fa-camera"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label>Ngày tạo</label>
                            <input id="my-input" class="form-control" type="text" name="created_at"
                                value="{{ $book->created_at }}" disabled>
                        </div>
                        <div class="form-group">
                            <label>Ngày sửa</label>
                            <input id="my-input" class="form-control" type="text" name="updated_at"
                                value="{{ $book->updated_at }}" disabled>
                        </div>
                    </div>
                </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <a href="{{ route('admin.book') }}" class="btn btn-sm btn-default">
                <i class="fas fa-angle-double-left" aria-hidden="true"></i>&nbsp;
                Sách
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
