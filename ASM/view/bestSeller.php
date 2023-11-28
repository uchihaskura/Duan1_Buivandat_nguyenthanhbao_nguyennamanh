<?php
// session_destroy();
if (isset($_SESSION['cart'])) {
        
}else{
  $_SESSION['cart'] = [];
  
}
if (isset($_POST['add_prod'])) {
  $i = 0;   
  $prod_id = $_POST['prod_id'];
  $prod_name = $_POST['prod_name'];
  $prod_img = $_POST['prod_img'];
  $prod_price = $_POST['prod_price'];
  $prod_quanlity = $_POST['prod_quanlity'];
  // if ($_SESSION['cart'] == null) {
  //     echo "Hello";
  // }
  foreach ($_SESSION['cart'] as $value) {
      if ($value[0] == $_POST['prod_id']) {
          // $prod_quanlity = $_POST['prod_quanlity'] + $value[4];
          // echo $value[0]." Đã tồn tại";
          $prod_quanlity += $value[4];
          array_splice($_SESSION['cart'],$i,1);
          
      }else{
          
          // var_dump($array_cart);
      }
      $i++;
  }

  // echo count($_SESSION['cart']) . "<br>";
  // echo $i. "<br>";
  // var_dump($_SESSION['cart']);

  $array_cart = [$prod_id,$prod_name,$prod_img,$prod_price,$prod_quanlity];

  array_push($_SESSION['cart'], $array_cart);

  echo "<div class='alert alert-success'>
      <strong></strong>Thêm Giỏ Hàng Thành Công.
  </div>";

  // unset($_SESSION['cart']);

  header("location: index.php");

}
?>
<!DOCTYPE html>
<html lang="zxx">
<body>
<section class="about py-5">
    <div class="container pb-lg-3">
        <h3 class="tittle text-center">Xem nhiều nhất</h3>
        <div class="row">
            <div class="container">
                <ul>
                <?php
                    $stmt = $conn -> query("SELECT * FROM product order by view desc limit 8 ");
                    while ($row = $stmt->fetch()) {
                        echo '<li><div class="wrap-content"><div class="container">
                        <img src="uploads_product/'.$row['img'].'" class="img-fluid" alt="">
                        <div class="overlay">
                        <div class = "items"></div>
                        <div class = "items head">
                            <p><a href="index.php?page=product&id_prod='.$row['id'].'">'.$row['name'].'</a></p>
                            <hr>
                        </div>
                        <div class = "items price">
                            <p class="old">'.number_format($row['price'], 0, "," , ".").'</p>
                            <p class="new">'.number_format($row['discount'], 0, "," , ".").'</p>
                        </div>
                        <div class="items cart">
                            <form action="" method="post">
                                <input type="hidden" name="prod_id" value="'.$row['id'].'">
                                <input type="hidden" name="prod_name" value="'.$row['name'].'">
                                <input type="hidden" name="prod_img" value="'.$row['img'].'">
                                <input type="hidden" name="prod_price" value="'.$row['price'].'">
                                <input type="hidden" name="prod_quanlity" value="1">
                                <button type = "submit" class="btn" name="add_prod">
                                    THÊM VÀO GIỎ HÀNG 
                                    <i class = "fa fa-shopping-cart"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    </div></div></li>';
                    };

                ?>
                </ul>
                <button href="#" id="prev"><i class="fa fa-angle-left"></i></button>
                <button href="#" id="next"><i class="fa fa-angle-right"></i></button>
            </div>
        </div>
        <!-- end row -->
    </div>
</section>
<!-- //ab -->
<script>
// Code goes here
// Code goes here
function responsiveSlider() {
  const slider = document.querySelector('.row>.container');
  let sliderWidth = slider.offsetWidth/1.055555555555556;
  const sliderList = document.querySelector('.row>.container>ul');
  let items = sliderList.querySelectorAll('.row>.container>ul>li').length - 6;
  let count = 1;
  
  window.addEventListener('resize', function() {
    sliderWidth = slider.offsetWidth;
  });
  
  function prevSlide() {
    if(count > 1) {
      count = count - 2;
      sliderList.style.left = '-' + count * sliderWidth + 'px';
      count++;
    }else if(count == 1) {
      count = items - 1;
      sliderList.style.left = '-' + count * sliderWidth + 'px';
      count++;
    }
    
  }
  function nextSlide() {
    if(count < items) {
      sliderList.style.left = '-' + count * sliderWidth + 'px';
      count++;
      
    }else if(count == items) {
      sliderList.style.left = '0px';
      count = 1;
      
    }
  }
  prev.addEventListener('click', prevSlide);
  next.addEventListener('click', nextSlide);
  setInterval(function() {
    nextSlide();
  }, 4000);
}

window.onload = function() {
  responsiveSlider();
}
</script>
    