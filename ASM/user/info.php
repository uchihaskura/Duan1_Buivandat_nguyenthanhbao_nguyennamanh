<?php
// require_once "../functions.php";
// if (checklogin()==false){  header('Location: login.php'); exit(); }
$page = $_GET['page'] ?? "theloai";
?>
<html>
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>

   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
   
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
   
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

   

   <link rel="stylesheet" href="./main.css">
   <title>Quản trị web tổng hợp</title>
   <style>
      .error-msg {
         width: 100%;
         text-align: center;
         color: rgb(92, 2, 2);
         background: rgba(218, 77, 77, 0.729);
         border-radius: 5px;
         margin: 5px 0;
         font-weight: 600;
      }
   </style>
</head>
<body>
   <!-- Nav tabs -->
   <div class="container">
   <?php require_once "user-menu.php";?>
   <!-- Tab panes -->
   <div class="tab-content">
      <div class="tab-pane active" id="">
      <?php
      // lấy ra danh mục thể loại hiên thị trong select
        require '../config/config.php';
        require '../model/conn.php';
        $msg="";
        $username=$_COOKIE['usr'];
        if($username!=""){
            $h2="CHỈNH SỬA THÔNG TIN";
            $stmt = $conn -> prepare("SELECT * FROM usr WHERE username = '$username'");
            $stmt->execute();
            $user = $stmt->fetch();
        }      
        if(isset($_POST['submit'])){
            $name=$_POST['name']??"";
            $email=$_POST['email']??"";
            $phone=$_POST['phone']??"";
            if (isset($_FILES['img']) && $_FILES['img']['name']!= "") {
                $img=$user[0]."-".$_FILES['img']['name']??"";
                if ($user[3] != "user.png") {
                    $file_delete = "../uploads_user/" . $user[3];
                    unlink("$file_delete");
                }
                $target_dir = "../uploads_user/";
                $target_file = $target_dir . $img;
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                // Check if image file is a actual image or fake image
                if(isset($_POST["submit"])) {
                    $check = getimagesize($_FILES["img"]["tmp_name"]);
                    if($check !== false) {
                        echo "File is an image - " . $check["mime"] . ".";
                        $uploadOk = 1;
                    } else {
                        echo "File is not an image.";
                        $uploadOk = 0;
                    }
                }

                // Check if file already exists
                if (file_exists($target_file)) {
                    echo "Sorry, file already exists.";
                    $uploadOk = 0;
                }

                // Check file size
                if ($_FILES["img"]["size"] > 5000000) {
                    echo "Sorry, your file is too large.";
                    $uploadOk = 0;
                }

                // Allow certain file formats
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif" ) {
                    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    $uploadOk = 0;
                }

                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) {
                    echo "Sorry, your file was not uploaded.";
                // if everything is ok, try to upload file
                } else {
                    if (move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)) {
                    
                    echo "The file ". htmlspecialchars( basename( $_FILES["img"]["name"])). " has been uploaded.";
                    } else {
                    echo "Sorry, there was an error uploading your file.";
                    }
                }
            }else{
                $img=$user['img'];
            }
            if($name!=""){
                if($username==!""){
                    $stmt = $conn -> prepare("UPDATE usr set name = '$name', 
                    img = '$img', email = '$email', SDT = '$phone', update_at = CURRENT_TIMESTAMP WHERE username = '$username'");
                    $stmt->execute();
                    header('Location: user.php?page=info'); 
                    // exit();
                }else{
                    // $stmt = $conn -> prepare("INSERT INTO useruct(name, price, discount, img, id_cate, /*view,*/ create_at, update_at, description)
                    // VALUES ('$name', $price, $discount, '$img', $id_cate, /*$view,*/ CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, '$description')");
                    // $stmt -> execute();
                    // header('Location: admin.php?page=useruct'); /*die()*/;
                }
            }else $msg="Vui lòng nhập đầy đủ thông tin";         
        }
      ?>
      <div class="container m-auto">
      <h2 class="py-2 text-center h4 "><?= $h2 ?></h2>
      <form actionz="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="">Tài Khoản</label>
                <input type="text" name="id" value="<?= $user[0]??"" ?>" disabled class="form-control bg-light" >
            </div>
            <div class="mb-3">
                <label for="">Tên</label>
                <input type="text" name="name" value="<?= $user[2]??"" ?>" required class="form-control bg-light" >
            </div>
            <div class="mb-3">
                <label for="">Email</label>
                <input type="text" name="email" value="<?= $user[4]??"" ?>" required class="form-control bg-light" >
            </div>
            <div class="mb-3">
                <label for="">Số Điện Thoại</label>
                <input type="text" name="phone" value="<?= $user[5]??"" ?>" required class="form-control bg-light" >
            </div>
            <div class="mb-3">
                <label for="img">Hình Ảnh</label>
                <input style="display: <?php if ($id == "") {
                    echo "none";
                }?>;" type="input" name="img" value="<?= $user[3]??"" ?>" disabled class="form-control bg-light" >
                <img width="100px" height="100px" src="../uploads_user/<?= $user[3]??"" ?>" alt="">
                <input type="file" name="img" value="<?= $user[3]??"" ?>" class="form-control bg-light" >
            </div>
            <div class="mb-3">
                <label for="">Ngày Tạo</label>
                <input type="text" value="<?= $user[7]??"" ?>" disabled class="form-control bg-light" >
            </div>
            <div class="mb-3">
                <label for="">Ngày Cập Nhật</label>
                <input type="text" value="<?= $user[8]??"" ?>" disabled class="form-control bg-light" >
            </div>
            <button class="btn btn-success px-4" name="submit">Lưu</button>
            <div class="error-msg"><?= $msg ?></div>
      </form>
      </div>
      </div> <!-- tab-pane -->
   </div>
   </div>
</body>
</html>