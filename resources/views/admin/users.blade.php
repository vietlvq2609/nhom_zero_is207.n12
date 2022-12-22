<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Management User - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link rel="stylesheet" href="/assets/css/style.css">
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.html">Zero Food</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Admin</div>
                        <a class="nav-link" href="{{route('admin.dashboard')}}">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Trang chủ
                        </a>
                        <div class="sb-sidenav-menu-heading">Quản lý</div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            Danh mục
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{ route('adminUser')}}">Người dùng</a>
                                <a class="nav-link" href="{{ route('adminProduct')}}">Sản phẩm</a>
                                <a class="nav-link" href="{{ route('adminOrder') }}">Đơn hàng</a>
                                <a class="nav-link" href="{{ route('adminShop')}}">Hóa đơn</a>
                            </nav>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Quản lý người dùng</h1>
                    <div class="card mb-4">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6">
                                    <i class="fas fa-table me-1"></i>
                                    Danh sách người dùng
                                </div>
                                <div class="col-md 6">
                                    <a href="{{route('createUser')}}" class="btn btn-primary float-end">Thêm</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="dataTable-table" id="datatablesUser">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Tên</th>
                                        <th>Avatar</th>
                                        <th>Email</th>
                                        <th>Số điện thoại</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i=0; foreach($users as $user): $i++ ?>
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td> <img width="300px" src="{{ $user->avatar }}" alt="{{ $user->name }}"></td>
                                        <td>{{ $user->email_address }}</td>
                                        <td>{{ $user->phone_number }}</td>
                                        <td>
                                            <a href="/admin/editUser/{{$user->id}}" class="btn btn-info">Sửa</a>
                                            <a href="/admin/destroyUser/{{$user->id}}" class="btn btn-danger">Xóa</a>
                                        </td>
                                    </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>

</html>