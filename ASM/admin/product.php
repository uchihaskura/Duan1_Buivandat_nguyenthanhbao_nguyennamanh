<div class="container">
    <h2 class="py-2 text-center h4 ">QUẢN LÝ SẢN PHẨM</h2>
    <table class="table table-hover table-bordered">
    <thead  class="thead-dark" >
        <tr>
            <th>ID</th>
            <th>Tên</th>
            <th>Giá</th>
            <th>Giảm Giá</th>
            <th>Hình ảnh</th>
            <th>Mô Tả</th>
            <th>Lượt Xem</th>
            <th>Tên Loại</th>
            <th>Ngày Tạo</th>
            <th>Ngày Cập Nhật</th>
            <th colspan="2">
            <a class="btn btn-success" href="./product-add.php">Thêm Mới</a>
            </th>
        </tr>
        
    </thead>
    <tbody>
    <?php
        require '../config/config.php';
        require '../model/conn.php';
        $stmt = $conn -> query("SELECT * FROM product join categories where product.id_cate = categories.id order by product.id"); 
        while($prod = $stmt->fetch()){
            echo "<tr>
                <td>$prod[0]</td>
                <td>$prod[1]</td>
                <td>".number_format($prod["price"], 0, "," , ".")."</td>
                <td>".number_format($prod["discount"], 0, "," , ".")."</td>
                <td><img src='../uploads_product/$prod[img]' style='width: 70px; height: 70px;' alt=''></td>
                <td></td>
                <td>$prod[view]</td>
                <td>$prod[11]</td>
                <td>$prod[create_at]</td>
                <td>$prod[update_at]</td>
                <td style='width:60px'><a href='./product-add.php?id=$prod[0]'><button class='btn btn-warning'>Sửa</button></a></td>
                <td style='width:60px'><button class='btn btn-danger' onclick='deleteCT($prod[0])'>Xóa</button></td>
            </tr>";
        }
    ?>
    </tbody>
</table>
</div>