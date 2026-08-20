<?php 
require_once __DIR__ . '/includes/auth_guard.php';
require_once __DIR__ . '/includes/db.php';
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
  <link href="assets/img/mono.webp" rel="icon">
  <link href="assets/img/mono.webp" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Montserrat:300,400,500,700" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

  <!-- Vendor CSS Files -->

  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.min.css" rel="stylesheet">
  <link href="assets/css/insert-style.min.css" rel="stylesheet">
  <link href="assets/css/dashboard.min.css" rel="stylesheet">

</head>

<body>

  <!-- ======= Header ======= -->
    <header id="header" class="fixed-top ">
    <div class="container d-flex align-items-center justify-content-lg-between">

      <h1 class="logo me-auto me-lg-0"><a href="Home"><img src="assets/img/mono.webp"></a></h1>
      

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a class="nav-link" href="Home">Home</a></li>
          <li><a class="nav-link" href="about">About</a></li>
          
          <li class="dropdown"><a href="#"><span>Services</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="software-development">Software Development</a></li>
              <li><a href="database">Database Development</a></li>
              <li><a href="qa">QA & Software Testing</a></li>
              <li><a href="ui-ux">UX Design</a></li>
              
            </ul>
          </li>
          <li><a class="nav-link" href="contact">Contact</a></li>
          <li><a class="nav-link" href="blog">Blog</a></li>
        </ul>
        <a style="margin-right:-4%;" class="Sign-in" href="logout.php">LOGOUT</a>
        <i class="bi bi-list mobile-nav-toggle"></i>
        
      </nav><!-- .navbar -->
          
    </div>
    
  </header><!-- #header -->

<div class="content">
    <?php if (isset($_SESSION['success'])) : ?>
      <div class="error success" >
        <h3>
          <?php 
            echo $_SESSION['success']; 
            unset($_SESSION['success']);
          ?>
        </h3>
      </div>
    <?php endif ?>
</div>

  <main id="main">
   <!-- ======= Dashboard Section ======= --> 
   <section style="background-color: #F1F1F1;">
    
     <div class="panel_icon mt-1"><i id="panel_icon_mobile" class="fa fa-navicon"></i></div>
        <div class="mt-2" id="profile_section_mobile" style="width: 55%;position: fixed;">
         <div class="profile_dashboard_mobile"><h style="color:white;">
           <i style="color: white;" class="fa fa-navicon"></i> <span style="font-size: 1.5rem;">&nbsp Dashboard</span><i class="bi bi-x close_icon"></i></h>
              </div>

            <div class="profile_dashboard_mobile user_dashboard mt-2"><span><i class="fa fa-edit"></i><a href="edit_panel" style="color:white;">&nbsp Edit Panel</a></span></div>

            <div class="profile_dashboard_mobile user_dashboard mt-2"><a href="blog-insert" style="color:white;">
            <i style="color: white;" class="fa fa-plus-square"></i> &nbsp Insert Blog</a></div>

            <div class="profile_dashboard_mobile user_dashboard mt-2"><a href="article-insert" style="color:white;">
            <i style="color: white;" class="fa fa-plus-square"></i> &nbsp Insert article</a></div>

            <div class="profile_dashboard_mobile user_dashboard mt-2"><a href="stories" style="color:white;">
            <i style="color: white;" class="fa fa-edit"></i> &nbsp Stories</a></div>

            <div class="profile_dashboard_mobile user_dashboard mt-2"><a href="Dont_Missing" style="color:white;">
            <i style="color: white;" class="fa fa-edit"></i> &nbsp Don't Miss</a></div>

            <div class="profile_dashboard_mobile user_dashboard mt-2"><a href="trending" style="color:white;">
            <i style="color: white;" class="fa fa-edit"></i> &nbsp Trending</a></div>

            <div class="profile_dashboard_mobile user_dashboard mt-2"><a href="video" style="color:white;">
            <i style="color: white;" class="fa fa-edit"></i> &nbsp Video</a></div>

            <div class="profile_dashboard_mobile user_dashboard mt-2"><a href="events" style="color:white;">
            <i style="color: white;" class="fa fa-edit"></i> &nbsp Events</a></div>

            <div class="profile_dashboard_mobile user_dashboard mt-2"><a href="article" style="color:white;">
            <i style="color: white;" class="fa fa-edit"></i> &nbsp Article</a></div>

        </div>

  <div class="container-fluid">
      <div class="row" style="background:none; border:none;">
        <div class="col-md-2 col-lg-2 mt-2" id="profile_section">
          
             <div class="profile_dashboard user_dashboard"><h style="color:white;">
            <i style="color: white;" class="fa fa-navicon"></i> <span style="font-size: 1.5rem;">&nbsp Dashboard</h></div>

            <div class="profile_dashboard user_dashboard mt-2"><span><i class="fa fa-edit"></i><a href="edit_panel" style="color:white;">&nbsp Edit Panel</a></span></div>

            <div class="profile_dashboard user_dashboard mt-2"><a href="blog-insert" style="color:white;">
            <i style="color: white;" class="fa fa-plus-square"></i> &nbsp Insert Blog</a></div>

            <div class="profile_dashboard user_dashboard mt-2"><a href="article-insert" style="color:white;">
            <i style="color: white;" class="fa fa-plus-square"></i> &nbsp Insert article</a></div>

            <div class="profile_dashboard user_dashboard mt-2"><a href="stories" style="color:white;">
            <i style="color: white;" class="fa fa-edit"></i> &nbsp Stories</a></div>

            <div class="profile_dashboard user_dashboard mt-2"><a href="Dont_Missing" style="color:white;">
            <i style="color: white;" class="fa fa-edit"></i> &nbsp Don't Miss</a></div>

            <div class="profile_dashboard user_dashboard mt-2"><a href="trending" style="color:white;">
            <i style="color: white;" class="fa fa-edit"></i> &nbsp Trending</a></div>

            <div class="profile_dashboard user_dashboard mt-2"><a href="video" style="color:white;">
            <i style="color: white;" class="fa fa-edit"></i> &nbsp Video</a></div>

            <div class="profile_dashboard user_dashboard mt-2"><a href="events" style="color:white;">
            <i style="color: white;" class="fa fa-edit"></i> &nbsp Events</a></div>
    
        </div>

          <div class="col-md-9 col-lg-10 mt-4 section2">
              <h1 class="text-center" style="color: #0B21E1;"><b>Edit Panel</b></h1>
    <div class="container-fluid">      
      <div class="row" style="background:none; border:none;">
                    
              <?php 
              if ($connect instanceof mysqli) {
                $res = mysqli_query($connect, "SELECT * FROM article ORDER by id DESC");
                while ($row = mysqli_fetch_array($res)) {
                  $img = htmlspecialchars($row['blog_image'], ENT_QUOTES, 'UTF-8');
                  $title = htmlspecialchars($row['title'], ENT_QUOTES, 'UTF-8');
                  $id = (int)$row['id'];
                  $csrf = csrf_field();
                  echo '
                  <div class="col-md-4 col-lg-3 mt-4" style="padding:10px; height:285px; border-radius:5px; background:white;box-shadow: 1px 1px 10px 0px lightgray; color:black;">
                   <img src="uploads/'.$img.'" alt="" class="img-responsive" height="170px" width="100%" style="border-radius:5px;">
                   <p style="margin-top:10px; text-align:left; color:black;overflow: hidden; width:100%; height:28px;"><strong><a href="article_detail.php?id='.$id.'">'.$title.'</a></strong></p>
                   <center> 
                   <table style="margin-top:-10px;">
                   <tr>
                   <td style="width:50%;"><div style="padding: 8px; padding-left:40px; margin-top: -10px; width:100%; padding-right:25px; color:white; border-radius: 5px; background-color: #769BF6;"><a style="color:white;" href="article_edit.php?id='.$id.'">Edit</a></div></td>
                   <td><div style="padding: 8px;padding-left:35px; margin-top: -10px; width:100%; padding-right:25px; color:white; border-radius: 5px; background-color: #0E7588;">
                     <form method="POST" action="article_delete.php" style="display:inline;" onsubmit="return confirm(\'Are you sure you want to delete?\');">
                       '.$csrf.'
                       <input type="hidden" name="id" value="'.$id.'">
                       <button type="submit" style="background:none;border:none;color:white;cursor:pointer;padding:0;">Delete</button>
                     </form>
                   </div></td>
                   </tr>
                   </table>
                    </center>
                  </div>
                  ';
                } 
              }
              ?>
        
                </div>
              </div>
            </div>
          </div>
        </div>

      <br />
    <br /><br /><br />  
    </section>
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
<script src="assets/vendor/purecounter/purecounter_vanilla.js" defer></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js" defer></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js" defer></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js" defer></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.min.js" defer></script>
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