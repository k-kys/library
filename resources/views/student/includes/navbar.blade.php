<nav class="navbar navbar-expand-md navbar-dark bg-primary" style="margin-bottom: 0px; min-height: 56px">
    <a class="navbar-brand" href="#"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04"
        aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExample04">


        <ul class="navbar-nav mr-auto">
            @if (Auth::guard('student')->check())
            @php
            $user = Auth::guard('student')->user();
            @endphp
            <li class="nav-item">
                <a class="nav-link" id="home" href="{{ route('home') }}">Trang chủ</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="borrow" href="{{ route('borrow_pay') }}">Mượn - Trả</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="order" href="{{ route('order') }}">Đặt mượn</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">{{ $user->name }}
                    <img src="{{ $user->image?asset($user->image):'' }}"
                        onError="this.onerror=null;this.src='{{ url('/img/blank-profile-picture-215x215.png') }}';"
                        style="width: 30px; height:30px; margin-top: -10px" class="img-circle">
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdown04">
                    <a class="dropdown-item" href="{{ route('profile') }}">Hồ sơ</a>
                    <a class="dropdown-item" href="{{ url('/change_password') }}">Đổi mật khẩu</a>
                    <a class="dropdown-item" href="{{ route('logout') }}">Đăng xuất</a>
                </div>
            </li>
            @endif
        </ul>

    </div>
</nav>
