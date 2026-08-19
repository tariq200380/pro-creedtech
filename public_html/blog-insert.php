<?php 
require_once __DIR__ . '/includes/auth_guard.php';
require_once __DIR__ . '/includes/db.php';
include ("add-blog.php"); 
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


  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  <link href="assets/css/insert-style.css" rel="stylesheet">
  <link href="assets/css/dashboard.css" rel="stylesheet">
  <style type="text/css">
    div.col-12 > label {color: black; font-weight: bold;}
    div.col-12 > input {
      font: 15px/24px 'Muli', sans-serif; padding: 10px; color: #333; width: 100%; letter-spacing: 1px;
    }
    .col-12{float: left; width: 100%; margin: 20px 0.5%; position: relative;}
    :focus{outline: none;}
    input[type="text"]{}
    .effect-3{border: 0; padding: 7px 0; border-bottom: 1px solid #ccc; height: }
    .effect-3 ~ .focus-border{position: absolute; bottom: 0; left: 0; width: 100%; height: 2px; z-index: 99;}
.effect-3 ~ .focus-border:before, 
.effect-3 ~ .focus-border:after{content: ""; position: absolute; bottom: 0; left: 0; width: 0; height: 100%; background-color: #114AB2; transition: 0.4s;}
.effect-3 ~ .focus-border:after{left: auto; right: 0;}
.effect-3:focus ~ .focus-border:before, 
.effect-3:focus ~ .focus-border:after{width: 50%; transition: 0.4s;}

.action-btn{
  display: inline-block;
  padding: 8px 18px;
  margin: 5px;
  border-radius: 6px;
  border: none;
  background: #4f46e5;
  color: #fff;
  font-size: 14px;
  cursor: pointer;
  transition: 0.3s;
}

.action-btn:hover{
  background:#312e81;
  box-shadow: 0px 4px 10px rgba(0,0,0,0.2);
}

#highlight{
  background:#f59e0b;
}

#highlight:hover{
  background:#b45309;
}

#bold{
  background:#10b981;
}

#bold:hover{
  background:#047857;
}
.btn-group-custom{
  display: flex;
  gap: 8px;
  align-items: center;
  flex-wrap: nowrap;
}

#input_heading{
     display: flex;
    justify-content: flex-start;
    align-items: center;
    gap: 20px;
    text-align: left;
    width: 100%;
    margin-top: 20px;
    color: black;
    font-weight: bold;
}
.radio-group {
    display: flex;
    justify-content: flex-start;
    align-items: center;
    gap: 20px;
    text-align: left;
    width: 100%;
}

.radio-group label {
    display: inline-flex;
    align-items: center;
    margin: 0;
    gap:5px;
}
  </style>

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
        <?php  if (isset($_SESSION['username'])) : ?><a style="margin-right:-4%;"  class="Sign-in" href="edit_panel?logout='1'">LOGOUT</a> <?php endif ?>
        <i class="bi bi-list mobile-nav-toggle"></i>
        
      </nav><!-- .navbar -->
          
    </div>
    
  </header><!-- #header -->

<div class="content">
    <!-- notification message -->
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

    <!-- logged in user information -->
    
</div>


  <main id="main">
   <!-- =======Blog_insert Section ======= --> 
   <section style="background-color: #F1F1F1;">
    

     <div class="panel_icon mt-1" style=""><i id="panel_icon_mobile" style="" class="fa fa-navicon"></i></div>
        <div class="mt-2" id="profile_section_mobile" style="width: 55%;position: fixed;">
         <div class="profile_dashboard_mobile"><h style="color:white;">
           <i style="color: white;" class="fa fa-navicon"></i> <span style="font-size: 1.5rem;">&nbsp Dashboard</span><i style="" class="bi bi-x close_icon"></i></h>
              </div>

            <div class="profile_dashboard_mobile user_dashboard mt-2"><span><i class="fa fa-edit"></i><a href="edit_panel" style="color:white;">&nbsp Edit Panel</a></span></div>

            <div class="machine_mobile mt-2"><a href="blog-insert" style="color:white;">
            <i style="color: white;" class="fa fa-plus-square"></i> &nbsp Insert Blog</a></div>

    

          </div>

  <div class="container-fluid">
      <div class="row" style="backgound:none; border:none;">
        <div class="col-md-2 col-lg-2 mt-2" id="profile_section">
          
             <div class="profile_dashboard user_dashboard"><h style="color:white;">
            <i style="color: white;" class="fa fa-navicon"></i> <span style="font-size: 1.5rem;">&nbsp Dashboard</h></div>

            <div class="profile_dashboard user_dashboard mt-2"><span><i class="fa fa-edit"></i><a href="edit_panel" style="color:white;">&nbsp Edit Panel</a></span></div>

            <div class="machine mt-2"><a href="blog-insert" style="color:white;">
            <i style="color: white;" class="fa fa-plus-square"></i> &nbsp Insert Blog</a></div>

            <?php include __DIR__ . '/includes/admin_sidebar_logout.php'; ?>

        </div>


          <div class="col-md-9 col-lg-9 mt-4 section2" style="">
       
          <br />
          <form class="mt-3" action="blog-insert" method="post" autocomplete="off" enctype="multipart/form-data" style="margin-left: 25px; border:2px solid #ff5733; border-radius: 5px; padding: 10px;">
            <?php echo csrf_field(); ?>
            <fieldset>
            <legend style="text-align: center;">Blog Insert</legend>
           <div class="col-12">
            <label>Heading/ Question</label>
            <input class="effect-3 mt-2" type="text" name="title" id="input_detail" placeholder="Heading" required="">
              <span class="focus-border"></span>
          </div> 
          
            <div class="col-12">
            <label>Blog Image</label>
           <input class="form-control mt-2" type="file" name="image" id="image" required value="" title="Only JPG, JPEG, PNG & GIF files are allowed">
           <span class="focus-border"></span>
         </div>
            <h6 class="mb-2" id="input_heading">Category:</h6>

<div class="radio-group">
    <label><input type="radio" name="category" value="1"> Don't Miss</label>
    <label><input type="radio" name="category" value="3"> Trending</label>
    <label><input type="radio" name="category" value="4"> Stories</label>
    <label><input type="radio" name="category" value="5"> Videos</label>
    <label><input type="radio" name="category" value="6"> Events</label></div>

           <div class="col-12">
            <label>Blog Detail</label>
            
            <div class="btn-group-custom">
         <input class="action-btn" type="button" id="add" value="Add Link">
         <input class="action-btn" type="button" id="bold" value="Bold Text">
         <input class="action-btn" type="button" id="highlight" value="Mark Text">
         </div>

         <textarea class="effect-3 mt-2" id="blog_detail" name="detail" placeholder="Detail" required="" rows="10" cols="100">
        
        </textarea>
              <span class="focus-border"></span>
          </div>
           <center><input style="background: rgb(0,44,255); color:white;" class="form-control mt-2 button" type="submit" name="form_submit"></center>  <br />
           </fieldset>
        </form>
       </div>
      
       
      </div>
     </div>
   </section>
   <!-- =======End Blog_insert Section ======= --> 
  </main><!-- End #main -->
  <br /><br /><br /><br />

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
<script> 
	$("#add").click(function(){
    $("#blog_detail").val(function(i, old){
        return old + ' <a style="color:blue;text-decoration: underline;" href="">Added Text</a>';
    });
});

	$("#bold").click(function(){
    $("#blog_detail").val(function(i, old){
        return old + ' <strong>Bold Text Here</Strong>';
    });
});
	$("#highlight").click(function(){
    $("#blog_detail").val(function(i, old){
        return old + ' <mark style="background:#E1E543;">Highlight Text</mark>';
    });
});
</script>
</body>
</html>