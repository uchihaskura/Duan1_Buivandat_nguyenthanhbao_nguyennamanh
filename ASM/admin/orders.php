<div class="container">
    <h2 class="py-2 text-center h4 ">QUẢN LÝ ĐƠN HÀNG</h2>
    <table class="table table-hover table-bordered">
    <thead  class="thead-dark" >
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Tên</th>
            <th>Email</th>
            <th>Số Điện Thoại</th>
            <th>Địa Chỉ</th>
            <th>Ghi Chú</th>
            <th>Ngày Đặt</th>
            <th>Tổng Tiền</th>
            <th>Trạng Thái</th>
            <th colspan="2"><a class="btn btn-success" href="./orders-add.php">Thêm Mới</a></th>
        </tr>
        
    </thead>
    <tbody>
    <?php
        require '../config/config.php';
        require '../model/conn.php';
        $stmt = $conn ->prepare("SELECT * FROM orders 
        join (SELECT id_order, sum(total_money) as total_money from order_details GROUP BY id_order) as order_details 
        where orders.id = order_details.id_order ORDER BY orders.id"); 
        $stmt -> execute();
        while($order = $stmt->fetch()){
            if ($order[8] == 1) {
                $order[8] = "Chưa Giao Hàng";
            }else if ($order[8] == 2) {
                $order[8] = "Đã Giao Hàng";
            }
            echo "<tr>
                <td>$order[0]</td>
                <td>$order[1]</td>
                <td>$order[2]</td>
                <td>$order[3]</td>
                <td>$order[4]</td>
                <td>$order[5]</td>
                <td>$order[6]</td>
                <td>$order[7]</td>
                <td>".number_format($order[10], 0, "," , ".")."</td>
                <td>$order[8]</td>
                <td style='width:60px'><a href='./orders-add.php?id=$order[0]'><button class='btn btn-warning'>Sửa</button></a></td>
                <td style='width:60px'><button class='btn btn-danger' onclick='deleteCT($order[0])'>Xóa</button></td>
            </tr>";
        }
    ?>
    </tbody>
</table>
</div>