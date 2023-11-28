<!DOCTYPE php>
<php lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, php, theme, front-end, ui kit, web">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="img/icons/icon-48x48.png" />

	<link rel="canonical" href="https://demo-basic.adminkit.io/pages-blank.php" />

	<title>Blank Page | AdminKit Demo</title>

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

		

			<footer class="footer">
				<div class="container-fluid">
					<div class="row text-muted">
						<div class="container">
    <h2 class="py-2 text-center h4 ">QUẢN LÝ BÌNH LUẬN</h2>
    <table class="table table-hover table-bordered">
    <thead  class="thead-dark" >
        
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Tên Sản Phẩm</th>
            <th>Nội Dung</th>
            <th>Ngày Đăng </th>
            <th>Ngày Chỉnh Sửa </th>
			<th></th>
			<th></th>
        </tr>
        
    </thead>
    <tbody>
    <?php
        require '../config/config.php';
        require '../model/conn.php';
        $stmt = $conn ->prepare("SELECT cmt.id, content, id_prod, id_user, cmt.create_at, cmt.update_at, product.name 
        FROM cmt join product on cmt.id_prod = product.id"); 
        $stmt -> execute();
        while($cmt = $stmt->fetch()){
            echo "<tr>
                <td>$cmt[0]</td>
                <td>$cmt[3]</td>
                <td><a href='../index.php?page=product&id_prod=$cmt[2]'>$cmt[6]</a></td>
                <td>$cmt[1]</td>
                <td>$cmt[4]</td>
                <td>$cmt[5]</td>
                <td style='width:60px'><a href='./orders-add.php?id=$cmt[0]'><button class='btn btn-warning'>Sửa</button></a></td>
                <td style='width:60px'><button class='btn btn-danger' onclick='deleteCT($cmt[0])'>Xóa</button></td>
            </tr>";
        }
    ?>
    </tbody>
</table>
</div>
						
					</div>
				</div>
			</footer>
		</div>
	</div>

	<script src="js/app.js"></script>

</body>

</php>