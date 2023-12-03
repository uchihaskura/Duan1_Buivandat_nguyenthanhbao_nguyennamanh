<?php
session_start();
ob_start();

require '../config/config.php';
require 'conn.php';
    if (isset($_POST['order_button'])) {
        $id_user = $_POST['id_user']??"";
        $name_user = $_POST['name_user'];
        $email = $_POST['email'];
        $sdt = $_POST['SDT'];
        if (isset($_POST['city'])) {
            $stmt = $conn -> prepare("SELECT * FROM devvn_tinhthanhpho WHERE matp = ".$_POST['city']."");
            $stmt->execute();
            $adr = $stmt->fetch();
            $city = $adr[1];
        }
        if (isset($_POST['district'])) {
            $stmt = $conn -> prepare("SELECT * FROM devvn_quanhuyen WHERE maqh = ".$_POST['district']."");
            $stmt->execute();
            $adr = $stmt->fetch();
            $district = $adr[1];
        }
        if (isset($_POST['ward'])) {
            $stmt = $conn -> prepare("SELECT * FROM devvn_xaphuongthitran WHERE xaid = ".$_POST['ward']."");
            $stmt->execute();
            $adr = $stmt->fetch();
            $ward = $adr[1];
        }
        $address = $_POST['address'];
        $final_address = $address. ", " .$ward .", " .$district .", " .$city;
        $note = $_POST['note']??"";
        
        $stmt = $conn -> prepare("INSERT INTO orders(id_user, name, email, phone, address, note, order_date, status)
        VALUES ('$id_user', '$name_user', '$email', '$sdt', '$final_address', '$note',  CURRENT_TIMESTAMP, 1)");
        $stmt -> execute();

        $stmt = $conn -> prepare("SELECT id from orders ORDER BY id DESC");
        $stmt -> execute();
        $id_order = $stmt -> fetch();

        if (isset($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $value) {
                $total_money = $value[3]*$value[4];
                $stmt = $conn -> prepare("INSERT INTO order_details(id_order, id_prod, name_prod, price, quantity, total_money)
                VALUES ($id_order[0], $value[0], '$value[1]', $value[3], $value[4], $total_money)");
                $stmt -> execute();
            }
        }

        $_SESSION['cart'] = [];

        $_SESSION['alert'] = 1;

        header('Location: ../index.php?page=thanks'); /*die()*/;

        echo $id_user ."<br>";
        echo $name_user ."<br>";
        echo $email ."<br>";
        echo $sdt ."<br>";
        echo $final_address;
        echo $note ."<br>";
        echo $total_money ."<br>";
    }else{
        echo "Sao k bấm button?";
    }
?>