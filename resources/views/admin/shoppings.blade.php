<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Management Product - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link rel="stylesheet" href="/assets/css/style.css">
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="{{route('admin.dashboard')}}">Zero Food</a>
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
                    <h1 class="mt-4">Quản lý hóa đơn</h1>
                    
                    <div style="margin: 16px 0;" class="fill">
                        <label for="date1">Từ ngày</label>
                        <input style="margin-right: 20px" type="date" id="date1" name="date1">
                        <label for="date2">Đến ngày</label>
                        <input style="margin-right: 20px;" type="date" id="date2" name="date2">
                        <label for="price">Giá hóa đơn</label>
                        <input type="text" name="price" id="price">
                        <button style="float:right; margin-top: -8px;" class="btn btn-primary">Lọc</button>
                    </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Danh sách hóa đơn
                        </div>
                        <div class="card-body">
                            <table class="dataTable-table" id="datatablesProduct">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Tên khách hàng</th>
                                        <th>Phương thức thanh toán</th>
                                        <th>Địa điểm nhận hàng</th>
                                        <th>Phương thức vận chuyển</th>
                                        <th>Trạng thái</th>
                                        <th>Ngày</th>
                                        <th>Tổng giá</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=0;
                                    foreach($shoppings as $shopping): $i++?>
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $shopping->name_user }}</td>
                                        <td>{{ $shopping->name_type }}</td>
                                        <td>{{ $shopping->shipping_address }}</td>
                                        <td>{{ $shopping->name_method }}</td>
                                        <td style="width: 150px;">{{ $shopping->name_status }} 
                                            <a href="/admin/editStatus/{id}" class="btn btn-info">Sửa</a>
                                        </td>
                                        <td>{{ $shopping->order_date }}</td>
                                        <td>{{ $shopping->order_total }}</td>
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