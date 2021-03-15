<nav class="navbar navbar-expand-md navbar-dark bg-primary" style="margin-bottom: 20px">
    <a class="navbar-brand" href="#"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04"
        aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExample04">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="{{ url('/home') }}">Trang chủ <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/borrow') }}">Mượn - Trả</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown04" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">Username</a>
                <div class="dropdown-menu" aria-labelledby="dropdown04">
                    <a class="dropdown-item" href="{{ url('/profile') }}">Hồ sơ</a>
                    <a class="dropdown-item" href="{{ url('/change-password') }}">Đổi mật khẩu</a>
                    <a class="dropdown-item" href="#">Đăng xuất</a>
                </div>
            </li>
        </ul>
    </div>
</nav>
