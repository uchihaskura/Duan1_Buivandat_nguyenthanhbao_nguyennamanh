<?php
    // var_dump($_SESSION['cart']);
    if(isset($_POST['minus'])){
        $stt = $_POST['stt'];
        $qty = $_POST['qty'];
        if ($qty>1) {
            $_SESSION['cart'][$stt][4] = $qty-1;
        }else{
            array_splice($_SESSION['cart'],$stt,1);
            
            header("location: index.php?page=cart");
        }
    }
    if(isset($_POST['plus'])){
        $stt = $_POST['stt'];
        $qty = $_POST['qty'];
        $_SESSION['cart'][$stt][4] = $qty+1;
    }
    // if(isset($_POST['delete_prod'])){
    //     $stt = $_POST['stt'];
    //     // array_splice($_SESSION['cart'],$stt,1);
    //     // header("location: index.php?page=cart");
    // }
    // if(isset($_POST['qty'])){
    //     $stt = $_POST['stt'];
    //     $qty = $_POST['qty'];
    //     if ($qty>1) {
    //         $_SESSION['cart'][$stt][4] = $qty;
    //     }else{
    //         array_splice($_SESSION['cart'],$stt,1);
    //     }
    // }
    if (isset($_SESSION['alert'])) {
        if ($_SESSION['alert'] == 1) {
            echo "<div class='alert alert-success'>
            <strong></strong>Thanh Toán Thành Công.
            </div>";
            $_SESSION['alert'] = 0;
        }
    }
    
    if (isset($_POST['pay_button']) ) {
        if ($_SESSION['cart'] != []) {
            echo "<script> window.location.href='index.php?page=pay';</script>";

            //Kiểm Tra Đăng Nhập
            // if (isset($_COOKIE['usr'])) {
            //     echo "<script> window.location.href='index.php?page=pay';</script>";
            // }else{
            //     echo "<div class='alert alert-warning'>
            //         <strong></strong>Đăng nhập để thanh toán.
            //         </div>";
            //     echo "<div class='alert alert-warning'>
            //     <strong></strong><a style='color: #254525;' href='view/login.php?page_return'>ĐĂNG NHẬP NGAY</a>
            //     </div>";
            // }
            
        }else{
            echo "<div class='alert alert-warning'>
            <strong></strong>Không có sản phẩm để thanh toán.
            </div>";
        }
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
            <h3 class="tittle text-center">Cảm Ơn Bạn Đã Mua Hàng</h3>
            <div class="container">
                <div class="container__cart" >
                    <div class="">
                        
                        <!-- Ranh Gioi -->
                        <div class="container__cart__first__pay">
                            <div class="Tien__Hanh_Thanh__Toan" style="border: none; margin-top: 10px;">
                                <form action="index.php" method="post">
                                    <button class="pay_button" type="submit">TIẾP TỤC MUA HÀNG</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>