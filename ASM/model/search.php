<?php
require "../config/config.php";
require "conn.php";

if (isset($_POST["input"])) {
    $input = $_POST["input"];

    $stmt = $conn -> prepare("SELECT * FROM product WHERE name LIKE '%{$input}%'");
    $stmt -> execute();
    while($product = $stmt -> fetch()){
        echo '<a href="index.php?page=product&id_prod='.$product[0].'">
                <img src="uploads_product/'.$product[4].'" alt="">
                <div>
                    <strong>'.$product[1].'</strong>
                    <div class="price">
                        <bdi class="old">'.number_format($product[2], 0, "," , ".").'</bdi>
                        <bdi class="new">'.number_format($product[3], 0, "," , ".").'</bdi>
                    </div>
                </div>
            </a>';
    };
}
?>