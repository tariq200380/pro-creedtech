<?php 
require_once __DIR__ . '/includes/auth_guard.php';
require_once __DIR__ . '/includes/db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>CreedTech - Stories Dashboard</title>
  <link href="assets/img/mono.png" rel="icon">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">
  <link href="assets/css/insert-style.css" rel="stylesheet">
  <link href="assets/css/dashboard.css" rel="stylesheet">
</head>
<body>
  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center justify-content-lg-between">
      <h1 class="logo me-auto me-lg-0"><a href="Home"><img src="assets/img/mono.webp"></a></h1>
      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a class="nav-link" href="Home">Home</a></li>
          <li><a class="nav-link" href="edit_panel">Dashboard</a></li>
        </ul>
        <a style="margin-right:-4%;" class="Sign-in" href="logout.php">LOGOUT</a>
      </nav>
    </div>
  </header>
  <section style="background-color: #F1F1F1; margin-top: 80px; min-height: 80vh;">
    <div class="container">
      <h1 class="text-center" style="color: #0B21E1; margin-bottom: 30px;"><b>Stories Management</b></h1>
      <div class="row">
        <?php 
        if ($connect instanceof mysqli) {
          $res = mysqli_query($connect, "SELECT * FROM `stories` ORDER by id DESC");
          if ($res) {
            while ($row = mysqli_fetch_assoc($res)) {
              $img = htmlspecialchars($row['blog_image'] ?? '', ENT_QUOTES, 'UTF-8');
              $title = htmlspecialchars($row['title'] ?? '', ENT_QUOTES, 'UTF-8');
              $id = (int)$row['id'];
              $csrf = csrf_field();
              echo '
              <div class="col-md-4 col-lg-3 mt-4" style="padding:10px; border-radius:5px; background:white; box-shadow: 1px 1px 10px 0px lightgray;">
                <img src="uploads/'.$img.'" alt="" class="img-responsive" height="170px" width="100%" style="border-radius:5px; object-fit:cover;">
                <p style="margin-top:10px; font-weight:bold; height:40px; overflow:hidden;">'.$title.'</p>
                <div class="d-flex justify-content-between mt-3">
                  <a href="stories_edit.php?id='.$id.'" class="btn btn-sm btn-primary" style="width:48%;">Edit</a>
                  <form method="POST" action="stories_delete.php" style="width:48%; display:inline;" onsubmit="return confirm(\'Are you sure you want to delete?\');">
                    '.$csrf.'
                    <input type="hidden" name="id" value="'.$id.'">
                    <button type="submit" class="btn btn-sm btn-danger w-100">Delete</button>
                  </form>
                </div>
              </div>';
            }
          }
        }
        ?>
      </div>
    </div>
  </section>
</body>
</html>