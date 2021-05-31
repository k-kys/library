<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/4.3.1/cerulean/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css') }}/style.scss">
</head>

{{-- <form action="{{ route('saveImage') }}" enctype="multipart/form-data" method="POST">
{{ csrf_field() }}
<input type="file" name="image_path" required="true">
<br />
<input type="submit" value="upload">
</form> --}}


{{-- <div class="container">
    <div class="form-upload">
        <div class="form-upload__preview"></div>
        <div class="form-upload__field">
            <label for="upload" class="form-upload__title">Upload</label>
            <input type="file" class="form-upload__control js-form-upload-control" id="upload" multiple>
            <button class="btn btn-dark btn-clear ml-3">Clear</button>
        </div>
    </div>
</div> --}}
<form runat="server">
    <input type='file' id="imgInp" />
    <img id="blah" src="#" alt="your image" />
</form>

<body>
    <script>
        function readURL(input) {
        if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
        $('#blah').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
        }

        $("#imgInp").change(function() {
        readURL(this);
        });
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
        (function( $ ) {
            $.fn.attachmentUploader = function() {
                const uploadControl = $(this).find('.js-form-upload-control');
                const btnClear = $(this).find('.btn-clear');
                $(uploadControl).on('change', function(e) {
                    const preview = $(this).closest('.form-upload').children('.form-upload__preview');
                    const files = e.target.files;

                    function previewUpload(file) {
                        if ( /\.(jpe?g|png|gif)$/i.test(file.name) ) {
                            var reader = new FileReader();
                            reader.addEventListener('load', function () {
                                const html =
                                '<div class=\"form-upload__item\">' +
                                    '<div class="form-upload__item-thumbnail" style="background-image: url(' + this.result + ')"></div>' +
                                    '<p class="form-upload__item-name">' + file.name + '</p>' +
                                    '</div>';
                                preview.append( html );
                                btnClear.show()
                            }, false);
                            reader.readAsDataURL(file);
                        } else {
                            alert('Please upload image only');
                            uploadControl.val('');
                        }
                    }

                    [].forEach.call(files, previewUpload);

                    btnClear.on('click', function() {
                        $('.form-upload__item').remove();
                        uploadControl.val('');
                        $(this).hide()
                    })
                })
            }
        })( jQuery )

    $('.form-upload').attachmentUploader();

    </script>

    {{-- <script>
        function readURL(input,img)
    	{
    		if(input.files && input.files[0])
    		{
    			var reader = new FileReader();

    			reader.onload = function (e)
    			{
    				$(img).attr('src', e.target.result);
    			}
    			reader.readAsDataURL(input.files[0]);
    		}
    	};

    	function browserURL(path,path2)
    	{
    		$(path).change(function()
    		{
    			readURL(this,path2);
    		});
    	};

    	browserURL("#imgInp","#imgId");
    </script> --}}
</body>

</html>
