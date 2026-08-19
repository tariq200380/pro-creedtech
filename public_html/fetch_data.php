<?php


include('database_connection.php');
 $query = "
  SELECT * FROM article WHERE product_status = '1' ORDER BY id DESC";
  
if(isset($_POST["action"]))
{
 

if(isset($_POST["category"]))
 {
  $category_filter =implode("','", $_POST['category']);
  $query .= "
   AND product_category IN('".$category_filter."')
  ";
 }

      $result = mysqli_query($connect, $query); 
      $output='';
      if(mysqli_num_rows($result) > 0)  
      {  
           while($row = mysqli_fetch_array($result))  
           {   
      $output .= '
          

    <div class="main_blog mt-3">
      <img src="uploads/' . $row['blog_image'] . '" alt="' . $row['title'] . '">
      <a href="article_detail?id='.$row['id'].'"><h6 class="mt-3">' . $row['title'] . '</h6></a>
    </div>

    <br />
   ';
  }
 }

else
{
  $output = '<h3>No Data Found</h3>';
 }
 echo $output;
 
}
 
?>

