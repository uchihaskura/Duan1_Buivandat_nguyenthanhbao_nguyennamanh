<!DOCTYPE php>
<php lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
        <meta name="author" content="AdminKit">
        <meta name="keywords"
            content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, php, theme, front-end, ui kit, web">

        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link rel="shortcut icon" href="img/icons/icon-48x48.png" />

        <link rel="canonical" href="https://demo-basic.adminkit.io/pages-blank.php" />

        <title>ADMIN TB STORE</title>

        <link href="../assets/css/app.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    </head>

    <body>
        <div class="wrapper">
        <nav id="sidebar" class="sidebar js-sidebar">
                <div class="sidebar-content js-simplebar">
                    <a class="sidebar-brand" href="admin.php">
                        <span class="align-middle">ADMIN TB STORE</span>
                    </a>
                    <li class="sidebar-item active">
                        <a class="sidebar-link" href="admin.php">
                            <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Bảng Điều
                                Khiển</span>
                        </a>
                    </li>

                    <ul class="sidebar-nav">
                        <li class="sidebar-header">
                            Quản Lý
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link" href="categories.php">
                                <i class="align-middle" data-feather="book"></i> <span class="align-middle">Quản Lý Loại
                                    Hàng </span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link" href="product.php">
                                <i class="align-middle" data-feather="book"></i> <span class="align-middle">Quản Lý
                                    Sản Phẩm</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="orders.php">
                                <i class="align-middle" data-feather="book"></i> <span class="align-middle">Quản Lý 
                                    Đơn Hàng</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="cmt.php">
                                <i class="align-middle" data-feather="book"></i> <span class="align-middle">Quản Lý 
                                    Bình Luận</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link" href="pages-sign-up.php">
                                <i class="align-middle" data-feather="user-plus"></i> <span class="align-middle">Sign
                                    In</span>
                            </a>
                        </li>


            </nav>

            <div class="main">
                <main class="content">
                    <div class="container-fluid p-0">

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="container">
                                        </div>
                                        <h2 class="py-2 text-center h4 ">QUẢN LÝ LOẠI HÀNG</h2>
                                        <table class="table table-hover table-bordered">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Tên Loại</th>
                                                    <th colspan="2">
                                                        <a class="btn btn-success" href="./categories-add.php">Thêm
                                                            Mới</a>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
        require '../config/config.php';
        require '../model/conn.php';
        $stmt = $conn -> query("SELECT * FROM categories"); 
        while($cate = $stmt->fetch()){
            // if($item['lang']=='vi') $lang='Vietnamse'; else $lang='English';
            // $anHien= $item['AnHien']?"Đang hiện":'Đang ẩn';
            echo "<tr>
                <td>$cate[id]</td>
                <td>$cate[name]</td>
                <td style='width:60px'><a href='./categories-add.php?id=$cate[id]'><button class='btn btn-warning'>Sửa</button></a></td>
                <td style='width:60px'><button class='btn btn-danger' onclick='deleteCT($cate[id])'>Xóa</button></td>
            </tr>";
        }
            
        
    ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="card-body">
                                </div>
                            </div>
                        </div>
                    </div>

            </div>
            </main>

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row text-muted">


                    </div>
                </div>
            </footer>
        </div>
        </div>

        <script src="js/app.js"></script>

    </body>

</php>