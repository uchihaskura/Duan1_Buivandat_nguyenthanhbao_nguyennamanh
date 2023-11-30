<div class="container">
    <h2 class="py-2 text-center h4 ">QUẢN LÝ ĐƠN HÀNG</h2>
    <table class="table table-hover table-bordered">
    <thead  class="thead-dark" >
        <tr>
            <th>ID</th>
            <th>Tên</th>
            <th>Email</th>
            <th>Số Điện Thoại</th>
            <th>Địa Chỉ</th>
            <th>Ghi Chú</th>
            <th>Ngày Đặt</th>
            <th>Tổng Tiền</th>
            <th>Trạng Thái</th>
            <th>Chi Tiết</th>
        </tr>
        
    </thead>
    <tbody>
    <?php
        require '../config/config.php';
        require '../model/conn.php';
        if (isset($_COOKIE['usr'])) {
            $id_user = "and id_user = " . "'".$_COOKIE['usr']."'";
        }
        $stmt = $conn ->prepare("SELECT * FROM orders 
        join (SELECT id_order, sum(total_money) as total_money from order_details GROUP BY id_order) as order_details 
        where orders.id = order_details.id_order $id_user ORDER BY orders.id"); 
        $stmt -> execute();
        while($order = $stmt->fetch()){
            if ($order[8] == 1) {
                $order[8] = "Chưa Giao Hàng";
            }else if ($order[8] == 2) {
                $order[8] = "Đã Giao Hàng";
            }
            echo "<tr>
                <td>$order[0]</td>
                <td>$order[2]</td>
                <td>$order[3]</td>
                <td>$order[4]</td>
                <td>$order[5]</td>
                <td>$order[6]</td>
                <td>$order[7]</td>
                <td>".number_format($order[10], 0, "," , ".")."</td>
                <td>$order[8]</td>
                <td style='width:60px'><a href='user.php?page=order_details&id_order=$order[0]'><button class='btn btn-warning'>Xem Chi Tiết</button></a></td>
            </tr>";
        }
    ?>
    </tbody>
</table>
</div>