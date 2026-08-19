<?php 
require_once __DIR__ . '/includes/auth_guard.php';
require_once __DIR__ . '/includes/db.php';

$id = (int)($_GET['id'] ?? 0);
$error = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_submit'])) { 
    $title  = trim($_POST['title'] ?? '');
    $detail = trim($_POST['detail'] ?? '');

    $folder = __DIR__ . "/uploads/";
    $image_file = $_FILES['image']['name'] ?? '';
    $file = $_FILES['image']['tmp_name'] ?? '';
    $imageFileType = strtolower(pathinfo($image_file, PATHINFO_EXTENSION));

    $allowed_types = ["jpg", "jpeg", "png", "gif", "webp"];

    if (!empty($file)) {
        if ($_FILES["image"]["size"] > 5242880) {
            $error[] = 'Image is too large. Upload less than 5 MB.';
        }
        if (!in_array($imageFileType, $allowed_types)) {
            $error[] = 'Only JPG, JPEG, PNG, GIF, and WEBP files are allowed.';
        }
    }

    if (empty($error)) {
        if (!empty($file)) {
            $stmtOld = mysqli_prepare($connect, "SELECT `blog_image` FROM `blog` WHERE `id` = ? LIMIT 1");
            if ($stmtOld) {
                mysqli_stmt_bind_param($stmtOld, "i", $id);
                mysqli_stmt_execute($stmtOld);
                $resOld = mysqli_stmt_get_result($stmtOld);
                if ($rowOld = mysqli_fetch_assoc($resOld)) {
                    $deleteimage = $rowOld['blog_image'];
                    if (!empty($deleteimage) && file_exists($folder . $deleteimage)) {
                        @unlink($folder . $deleteimage);
                    }
                }
                mysqli_stmt_close($stmtOld);
            }

            $newImageName = 'blog_' . bin2hex(random_bytes(8)) . '.' . $imageFileType;
            move_uploaded_file($file, $folder . $newImageName);

            $stmtUp = mysqli_prepare($connect, "UPDATE `blog` SET `blog_image` = ?, `title` = ?, `detail` = ? WHERE `id` = ?");
            if ($stmtUp) {
                mysqli_stmt_bind_param($stmtUp, "sssi", $newImageName, $title, $detail, $id);
                mysqli_stmt_execute($stmtUp);
                mysqli_stmt_close($stmtUp);
            }
        } else {
            $stmtUp = mysqli_prepare($connect, "UPDATE `blog` SET `title` = ?, `detail` = ? WHERE `id` = ?");
            if ($stmtUp) {
                mysqli_stmt_bind_param($stmtUp, "ssi", $title, $detail, $id);
                mysqli_stmt_execute($stmtUp);
                mysqli_stmt_close($stmtUp);
            }
        }
        header("Location: edit_panel.php?updated=1");
        exit;
    }
}
?>

// Fetch the existing blog entry
$image = '';
$title = '';
$detail = '';
if ($connect instanceof mysqli) {
    $stmtFetch = mysqli_prepare($connect, "SELECT * FROM `blog` WHERE `id` = ? LIMIT 1");
    if ($stmtFetch) {
        mysqli_stmt_bind_param($stmtFetch, "i", $id);
        mysqli_stmt_execute($stmtFetch);
        $resFetch = mysqli_stmt_get_result($stmtFetch);
        if ($rowFetch = mysqli_fetch_assoc($resFetch)) {
            $image  = $rowFetch['blog_image'];
            $title  = $rowFetch['title'];
            $detail = $rowFetch['detail'];
        }
        mysqli_stmt_close($stmtFetch);
    }
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>CreedTech</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/mono.png" rel="icon">
  <link href="assets/img/mono.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Montserrat:300,400,500,700" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel=”stylesheet” href=”https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css” />

  <!-- Vendor CSS Files -->

  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  <link href="assets/css/insert-style.css" rel="stylesheet">
  <link href="assets/css/dashboard.css" rel="stylesheet">

</head>

<body>

  <!-- ======= Header ======= -->
    <header id="header" class="fixed-top ">
    <div class="container d-flex align-items-center justify-content-lg-between">

      <h1 class="logo me-auto me-lg-0"><a href="Home"><img src="assets/img/mono.webp"></a></h1>
      

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a class="nav-link active" href="Home">Home</a></li>
          <li><a class="nav-link" href="about">About</a></li>
          <li><a class="nav-link" href="services">Services</a></li>
          <li><a class="nav-link" href="portfolio">Portfolio</a></li>
          <li><a class="nav-link" href="contact">Contact</a></li>
          <li><a class="nav-link" href="blog">Blog</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->
        <a style="margin-right:-4%;" class="Sign-in" href="logout.php">LOGOUT</a>
        <i class="bi bi-list mobile-nav-toggle"></i>
        
      </nav><!-- .navbar -->
          
    </div>
    
  </header><!-- #header -->
  <!-- #header -->
<section>
<div class="content">
    <?php if (!empty($error)) : ?>
      <div class="error" style="color:red;padding:10px;">
        <?php foreach ($error as $err) echo htmlspecialchars($err, ENT_QUOTES, 'UTF-8') . '<br>'; ?>
      </div>
    <?php endif ?>
</div>
   
  <br />
  <h2 style="background: #CBCBCB; text-align: center;"><?php echo htmlspecialchars($title, ENT_QUOTES, 'UTF-8');?> </h2><br />
  <form action="" method="POST" enctype="multipart/form-data">
  <?php echo csrf_field(); ?>
  <div class="container" style="">

    <div class="row">
     
     <div class="col-md-3 col-lg-3 col-xl-3">
      
    <img style="box-shadow: 5px 10px 18px #EFF6F4; border-radius: 5px;" src="uploads/<?php echo $image;?>" height="200" width="100%"><br><br>
        
    <input type="file" name="image" class="form-control"><br>
    </div>



 
</div>

</center>
  <div class="row">

      <div class="col-md-4 col-lg-4 col-xl-3" style="border: 1px solid #fa6800;">
      <label class="mt-3" style="font-weight: bold; float: left; color:#131e91;">Heading:</label>
      <input class="form-control mt-3" type="text" name="title" id = "title" value="<?php echo $title;?>">
  

   </div>
            

   <div class="col-md-7 col-lg-7 col-xl-7" style="border: 1px solid #fa6800; margin-left: 10px;">
      <label class="mt-3" style="font-weight: bold; float: left; color:#131e91;">Blog Detail:</label>
    
    <textarea class="form-control mt-3" name="detail" id = "detail" rows="4" cols="50">
      <?php  echo $row['detail']?>
      </textarea>
  </div>
  <br /><br /><br />
  <center><button name="update_submit" class="btn-primary mt-4" style="padding:8px;">Update </button></center>


</form>
</section>
<br /><br /><br />
<!-- ======= Footer ======= -->
  <footer id="footer" class="footer_index">
  

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>CreedTech</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        Designed by <a href="">Creed Tech</a>
      </div>
    </div>
  </footer><!-- End Footer -->
<script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

  <script type="text/javascript">
  $(document).ready(function(){
  $(".panel_icon").click(function(){
    $("#profile_section_mobile").slideToggle("slow");
  });
});
</script>
<script type="text/javascript">
  $(document).ready(function(){
  $(".close_icon").click(function(){
    $("#profile_section_mobile").slideToggle("slow");
  });
});
</script>
</body>
</html>
