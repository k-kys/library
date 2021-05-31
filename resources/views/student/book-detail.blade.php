@extends('student.master')

@section('title', 'Chi tiết sách')

@push('style')
<style>
    .buttons_added {
        opacity: 1;
        display: inline-block;
        display: -ms-inline-flexbox;
        display: inline-flex;
        white-space: nowrap;
        vertical-align: top;
    }

    .is-form {
        overflow: hidden;
        position: relative;
        background-color: #f9f9f9;
        height: 2.2rem;
        width: 1.9rem;
        padding: 0;
        text-shadow: 1px 1px 1px #fff;
        border: 1px solid #ddd;
    }

    .is-form:focus,
    .input-text:focus {
        outline: none;
    }

    .is-form.minus {
        border-radius: 4px 0 0 4px;
    }

    .is-form.plus {
        border-radius: 0 4px 4px 0;
    }

    .input-qty {
        background-color: #fff;
        height: 2.2rem;
        text-align: center;
        font-size: 1rem;
        display: inline-block;
        vertical-align: top;
        margin: 0;
        border-top: 1px solid #ddd;
        border-bottom: 1px solid #ddd;
        border-left: 0;
        border-right: 0;
        padding: 0;
    }

    .input-qty::-webkit-outer-spin-button,
    .input-qty::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
</style>
@endpush

@push('js')
<script>
    $('input.input-qty').each(function() {
      var $this = $(this),
        qty = $this.parent().find('.is-form'),
        min = Number($this.attr('min')),
        max = Number($this.attr('max'))
      if (min == 0) {
        var d = 0
      } else d = min
      $(qty).on('click', function() {
        if ($(this).hasClass('minus')) {
          if (d > min) d += -1
        } else if ($(this).hasClass('plus')) {
          var x = Number($this.val()) + 1
          if (x <= max) d += 1
        }
        $this.attr('value', d).val(d)
      })
    })
</script>
@endpush

@section('content')
<div class="container">

    <!-- Default box -->
    <div class="card card-solid">
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-sm-7">
                    {{-- <h3 class="d-inline-block d-sm-none">LOWA Men’s Renegade GTX Mid Hiking Boots Review</h3> --}}
                    <div class="col-12 text-center">
                        <img src="{{ $book->image?asset($book->image):url('img/400x250.png') }}" class="product-image"
                            alt="Product Image" style="max-width: 100%; max-height: 600px">
                    </div>
                    {{-- <div class="col-12 product-image-thumbs">
                        <div class="product-image-thumb active"><img src="../../dist/img/prod-1.jpg"
                                alt="Product Image">
                        </div>
                        <div class="product-image-thumb"><img src="../../dist/img/prod-2.jpg" alt="Product Image"></div>
                        <div class="product-image-thumb"><img src="../../dist/img/prod-3.jpg" alt="Product Image"></div>
                        <div class="product-image-thumb"><img src="../../dist/img/prod-4.jpg" alt="Product Image"></div>
                        <div class="product-image-thumb"><img src="../../dist/img/prod-5.jpg" alt="Product Image"></div>
                    </div> --}}
                </div>

                <div class="col-12 col-sm-5">
                    <form action="{{ route('post_order') }}" method="post">
                        @csrf
                        <input type="hidden" name="book_id" value="{{ $book->id }}">
                        <h2 class="my-3" style="font-family: Lobster; font-size: 50px; color: rgb(255, 95, 21)">
                            {{ $book->name }}</h2>
                        <p>Còn lại: {{ $book->stock_amount?$book->stock_amount:0 }} sách</p>
                        <hr>
                        <h4>Thể loại</h4>
                        <div style="margin:0 10px 0 10px;">
                            @foreach ($book->categories as $category)
                            <span class="badge badge-warning">{{ $category->name }}</span>
                            @endforeach
                        </div>
                        <h4 class="mt-3">Lĩnh vực</h4>
                        <div style="margin:0 10px 0 10px;">
                            @foreach ($book->majors as $major)
                            <span class="badge badge-secondary">{{ $major->name }}</span>
                            @endforeach
                        </div>
                        <hr>
                        <div class="bg-gray py-2 px-3 mt-4">
                            <div class="mb-0">
                                <b>Giá:</b> &nbsp;{{ $book->price?$book->price:0 }} VNĐ
                            </div>
                            <br>

                            @if ($book->stock_amount > 0)
                            <h4 class="mt-0">
                                <small>Số lượng:&nbsp;</small>
                                <div class="buttons_added">
                                    <input class="minus is-form" type="button" value="-">
                                    <input aria-label="quantity" class="input-qty" max="999" min="1" name="number"
                                        type="number" value="1">
                                    <input class="plus is-form" type="button" value="+">
                                </div>
                            </h4>
                            @else
                            <span style="color: red">Sách đã hết.</span>
                            @endif
                        </div>

                        <div class="mt-4">
                            <a href="{{ route('home') }}" class="btn btn-default btn-lg">
                                <i class="fa fa-angle-double-left" aria-hidden="true"></i>
                                Trang chủ
                            </a>
                            @if ($book->stock_amount > 0)
                            <button type="submit" class="btn btn-success btn-lg float-right">
                                <i class="fas fa-cart-plus fa-lg mr-2"></i>
                                Đặt mượn
                            </button>
                            @endif

                        </div>
                    </form>

                    {{-- <div class="mt-4 product-share">
                        <a href="#" class="text-gray">
                            <i class="fab fa-facebook-square fa-2x"></i>
                        </a>
                        <a href="#" class="text-gray">
                            <i class="fab fa-twitter-square fa-2x"></i>
                        </a>
                        <a href="#" class="text-gray">
                            <i class="fas fa-envelope-square fa-2x"></i>
                        </a>
                        <a href="#" class="text-gray">
                            <i class="fas fa-rss-square fa-2x"></i>
                        </a>
                    </div> --}}

                </div>
            </div>
            <div class="row mt-4">
                <nav class="w-100">
                    <div class="nav nav-tabs" id="product-tab" role="tablist">
                        <a class="nav-item nav-link active" id="product-desc-tab" data-toggle="tab" href="#product-desc"
                            role="tab" aria-controls="product-desc" aria-selected="true">Mô tả sách</a>
                        {{-- <a class="nav-item nav-link" id="product-comments-tab" data-toggle="tab"
                            href="#product-comments" role="tab" aria-controls="product-comments"
                            aria-selected="false">Comments</a>
                        <a class="nav-item nav-link" id="product-rating-tab" data-toggle="tab" href="#product-rating"
                            role="tab" aria-controls="product-rating" aria-selected="false">Rating</a> --}}
                    </div>
                </nav>
                <div class="tab-content p-3" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="product-desc" role="tabpanel"
                        aria-labelledby="product-desc-tab">
                        <label name="description">
                            {!! $book->description !!}</label>
                    </div>
                    {{-- <div class="tab-pane fade" id="product-comments" role="tabpanel"
                        aria-labelledby="product-comments-tab">
                        Vivamus rhoncus nisl sed venenatis luctus. Sed condimentum risus ut tortor feugiat laoreet.
                        Suspendisse potenti. Donec et finibus sem, ut commodo lectus. Cras eget neque dignissim,
                        placerat
                        orci interdum, venenatis odio. Nulla turpis elit, consequat eu eros ac, consectetur fringilla
                        urna.
                        Duis gravida ex pulvinar mauris ornare, eget porttitor enim vulputate. Mauris hendrerit, massa
                        nec
                        aliquam cursus, ex elit euismod lorem, vehicula rhoncus nisl dui sit amet eros. Nulla turpis
                        lorem,
                        dignissim a sapien eget, ultrices venenatis dolor. Curabitur vel turpis at magna elementum
                        hendrerit
                        vel id dui. Curabitur a ex ullamcorper, ornare velit vel, tincidunt ipsum. </div>
                    <div class="tab-pane fade" id="product-rating" role="tabpanel" aria-labelledby="product-rating-tab">
                        Cras ut ipsum ornare, aliquam ipsum non, posuere elit. In hac habitasse platea dictumst. Aenean
                        elementum leo augue, id fermentum risus efficitur vel. Nulla iaculis malesuada scelerisque.
                        Praesent
                        vel ipsum felis. Ut molestie, purus aliquam placerat sollicitudin, mi ligula euismod neque, non
                        bibendum nibh neque et erat. Etiam dignissim aliquam ligula, aliquet feugiat nibh rhoncus ut.
                        Aliquam efficitur lacinia lacinia. Morbi ac molestie lectus, vitae hendrerit nisl. Nullam metus
                        odio, malesuada in vehicula at, consectetur nec justo. Quisque suscipit odio velit, at accumsan
                        urna
                        vestibulum a. Proin dictum, urna ut varius consectetur, sapien justo porta lectus, at mollis
                        nisi
                        orci et nulla. Donec pellentesque tortor vel nisl commodo ullamcorper. Donec varius massa at
                        semper
                        posuere. Integer finibus orci vitae vehicula placerat. </div> --}}
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

</div>
@endsection
