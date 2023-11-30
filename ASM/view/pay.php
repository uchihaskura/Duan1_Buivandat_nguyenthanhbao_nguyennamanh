
<?php
if ($_SESSION['cart'] != []) {
    if (isset($_POST['pay_button']) ) {
        if ($_SESSION['cart'] != []) {
            if (isset($_COOKIE['usr'])) {
                echo "<script> window.location.href='index.php?page=pay';</script>";
            }else{
                echo "<div class='alert alert-warning'>
                    <strong></strong>Đăng nhập để thanh toán.
                    </div>";
                echo "<div class='alert alert-warning'>
                <strong></strong><a style='color: #254525;' href='index.php?page=login&page_return'>ĐĂNG NHẬP NGAY</a>
                </div>";
            }
            echo "<div class='alert alert-warning'>
            <strong></strong>Không có sản phẩm để thanh toán.
            </div>";
        }else{
            echo "<div class='alert alert-warning'>
            <strong></strong>Không có sản phẩm để thanh toán.
            </div>";
        }
    }
    if (isset($_COOKIE['usr'])) {
        $stmt = $conn -> prepare("SELECT * FROM usr WHERE username = ? /*and pass = ?*/");
        $stmt -> bindParam(1,$_COOKIE['usr']);
        // $stmt -> bindParam(2,$pwd);
        $stmt -> execute();
        $user = $stmt -> fetch();
    }else{
        // echo "<script> window.location.href='index.php?page=cart';</script>";
    }
}else{
    echo "<div class='alert alert-warning'>
    <strong></strong>Không có sản phẩm để thanh toán.
    </div>";
    header("location: index.php?page=cart");
}
?>
<html>
<style>
    .main-banner {
        background: #255C45;
        height: 100px;
        animation: none;
    }
    .banner-info{
        display: none;
    }

</style>
</html>
<section class="about py-5">
        <div class="container pb-lg-3">
            <h3 class="tittle text-center">Thanh Toán</h3>
            <div class="row" <?php if ($_SESSION['cart'] == []) {echo 'style="display: none;"';}?>>
                <div class="container__cart" >
                    <div class="container__cart__first">
                        <div class="container__cart__first__DSSP">
                            <table>
                                <thead>
                                    <tr >
                                        <th>Hình ảnh</th>
                                        <th >Sản Phẩm</th>
                                        <!-- <th id="hidden">Giá</th> -->
                                        <!-- <th >Số Lượng</th> -->
                                        <th id="hidden">Tạm Tính</th>
                                        <!-- <th>Xóa</th> -->
                                        
                                    </tr>
                                </thead>
                                    <!-- Ranh Gioi -->
                                <tbody >
                                    <?php
                                        if (isset($_SESSION['cart'])) {
                                            $prod_total =0;
                                            $i=0;
                                            foreach ($_SESSION['cart'] as $value) {
                                                $tamtinh = (int)$value[3]*(int)$value[4];
                                                $prod_total += $tamtinh; 
                                                echo "<tr>
                                                    <td>
                                                        <a href='index.php?page=product&id_prod=$value[0]' style='width: 100%; height: 100%;'></a>
                                                        <img src='uploads_product/$value[2]' style='width: 70px; height: 70px;' alt=''>
                                                    </td>
                                                    <td>
                                                        <a href='index.php?page=product&id_prod=$value[0]'>$value[1]</a>
                                                        <p style='width=100%;'>".number_format((int)$value[3], 0, "," , ".")." * $value[4]</p>
                                                    </td>
                                                    <td id='hidden'>
                                                        ".number_format($tamtinh, 0, "," , ".")."
                                                    </td>
                                                </tr>";
                                                $i++;
                                            };
                                        }
                                        // echo $i;
                                        
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- Ranh Gioi -->
                        <div class="container__cart__first__pay">
                            <div class="Tong">
                                <div>
                                    Tổng:
                                </div>
                                <div id="congTienShip">
                                    <?php if (isset($prod_total)) {
                                        echo number_format($prod_total, 0, "," , ".");
                                    }?>
                                </div>
                            </div>
                            <div class="Tien__Hanh_Thanh__Toan" style="border: none; margin-top: 10px;">
                                <form action="model/pay_process.php" method="post">
                                <input type="hidden" name="id_user" value="<?=$user[0]??""?>">
                                <input type="text" name="name_user" placeholder="Họ và tên" required="" value="<?=$user[2]??""?>">
                                <input type="email" class="email" name="email" placeholder="Email" required="" value="<?=$user[4]??""?>">
                                <input type="tel" name="SDT" placeholder="Số điện thoại" required="" value="<?=$user[5]??""?>">
                                <select class="form-select form-select-sm mb-3" id="city" name="city" aria-label=".form-select-sm" required="">
                                    <option value="" selected>Chọn tỉnh thành</option>           
                                </select>

                                <select class="form-select form-select-sm mb-3" id="district" name="district" aria-label=".form-select-sm" required="">
                                    <option value="" selected>Chọn quận huyện</option>
                                </select>

                                <select class="form-select form-select-sm" id="ward" name="ward" aria-label=".form-select-sm" required="">
                                    <option value="" selected>Chọn phường xã</option>
                                </select>
                                <input type="text" name="address" placeholder="Địa chỉ" required="">
                                <textarea name="note" placeholder="Ghi chú về đơn hàng, ví dụ: thời gian hay chỉ dẫn địa điểm giao hàng chi tiết"></textarea>
                                    <button name="order_button" type="submit">Đặt Hàng</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
<script>
    var citis = document.getElementById("city");
    var districts = document.getElementById("district");
    var wards = document.getElementById("ward");
    var Parameter = {
    url: "https://raw.githubusercontent.com/kenzouno1/DiaGioiHanhChinhVN/master/data.json", 
    method: "GET", 
    responseType: "application/json", 
    };
    var promise = axios(Parameter);
    promise.then(function (result) {
    renderCity(result.data);
    });

    function renderCity(data) {
    for (const x of data) {
        citis.options[citis.options.length] = new Option(x.Name, x.Id);
    }
    citis.onchange = function () {
        district.length = 1;
        ward.length = 1;
        if(this.value != ""){
        const result = data.filter(n => n.Id === this.value);

        for (const k of result[0].Districts) {
            district.options[district.options.length] = new Option(k.Name, k.Id);
        }
        }
    };
    district.onchange = function () {
        ward.length = 1;
        const dataCity = data.filter((n) => n.Id === citis.value);
        if (this.value != "") {
        const dataWards = dataCity[0].Districts.filter(n => n.Id === this.value)[0].Wards;

        for (const w of dataWards) {
            wards.options[wards.options.length] = new Option(w.Name, w.Id);
        }
        }
    };
    }
</script>