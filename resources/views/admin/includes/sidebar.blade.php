<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ asset('/admin/dashboard') }}" class="brand-link">
        <img src="{{ asset('/img/icon-hpc-594x594.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .9">
        <span class="brand-text font-weight-light">HPC Library</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item has-treeview">
                    <a href="{{ url('admin/dashboard') }}" id="home" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-header">Thư viện</li>
                <li class="nav-item">
                    <a href="{{ route('admin.category') }}" id="category" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Thể loại
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="{{ route('admin.major') }}" id="major" class="nav-link">
                        <i class="nav-icon fas fa-tree"></i>
                        <p>
                            Lĩnh vực
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="{{ route('admin.book') }}" id="book" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Sách
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview" id="borrow-pay">
                    <a href="#" id="borrow-pay-link" class="nav-link">
                        <i class="nav-icon fas fa-file-invoice"></i>
                        <p>
                            Mượn - trả
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.borrow_pay') }}" id="borrow" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Phiếu mượn trả
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.order') }}" id="order" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Yêu cầu mượn sách
                                </p>
                                </i>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-header">Tài khoản</li>
                <li class="nav-item has-treeview">
                    <a href="{{ route('admin.student') }}" id="student" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Sinh viên
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="{{ route('admin.staff') }}" id="user" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Nhân viên
                        </p>
                    </a>
                </li>

                @if (Auth::guard('admin')->user()->isSuperAdmin == 1)
                <li class="nav-header">Truy cập sửa đổi</li>
                <li class="nav-item">
                    <a href="{{ route('admin.role') }}" id="role" class="nav-link">
                        <i class="nav-icon far fa-id-badge"></i>
                        <p>
                            Vai trò
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.permission') }}" id="permission" class="nav-link">
                        <i class="nav-icon fas fa-id-badge"></i>
                        <p>
                            Quyền
                        </p>
                    </a>
                </li>
                @endif

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
