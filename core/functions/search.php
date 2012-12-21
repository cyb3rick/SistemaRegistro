 <?php 
  require('core/database/connect.php');
  $search =$_POST['Search'];
?>

<?php
  
 /*Searches for businesses */
 
 $K = $_POST['Search'];
 $terms = explode(" ", $K);
 $query; 
 $query2;
 $query3;
 
  $query = "SELECT * FROM Businesses WHERE ";
 $i =0;
  foreach ($terms as $each){
    $i++;

    if ($i == 1){ 

      $user = mysql_query("SELECT *  FROM Users Where first_name LIKE '%$each%' ");
      $r2 = mysql_fetch_assoc($user);
      $numrow = mysql_num_rows($user);

        if ($numrow > 0){
        $each = $r2['username'];
      }

      $category = mysql_query("SELECT * FROM Categories WHERE name LIKE '%$each%' ");
      $r3 = mysql_fetch_assoc($category);
      $numrow2 = mysql_num_rows($category);

       if ($numrow2 > 0){
          $each = $r3['category_id'];
      }

  
      $query .= "name LIKE '%$each%' OR username LIKE '%$each%' OR phone LIKE '%$each%' OR city LIKE '%$each%' ";
    }

    else { 
        $user = mysql_query("SELECT *  FROM Users Where first_name LIKE '%$each%' ");
      $r2 = mysql_fetch_assoc($user);
      $numrow = mysql_num_rows($user);

        if ($numrow > 0){
        $each = $r2['username'];
      }

      $category = mysql_query("SELECT * FROM Categories WHERE name LIKE '%$each%' ");
      $r3 = mysql_fetch_assoc($category);
      $numrow2 = mysql_num_rows($category);

       if ($numrow2 > 0){
          $each = $r3['category_id'];
      }

     $query .= " OR name  LIKE '%$each%' OR username LIKE '%$each%' OR phone LIKE '%$each%' OR city LIKE '%$each%'  ";
    }
  }

  /* Searches for the weekly specials */
  $query2 = "SELECT * FROM Weekly_sales WHERE ";
  $i =0;

   foreach ($terms as $each){
    $i++;

   if ($i == 1){ 

    $bname = mysql_query("SELECT * FROM Businesses WHERE name LIKE '%$each%' ");
    $r2 = mysql_fetch_assoc($bname);
    $nr = mysql_num_rows($bname);
    

    if ($nr > 0){
      $each = $r2['business_id'];
    }

  
      $query2 .= "title LIKE '%$each%' OR business_id LIKE '%$each%' ";
    }

   else{ 
  
      $query2 .= "OR title LIKE '%$each%' OR business_id LIKE '%$each%' ";
    }
  }

  /* Searches for the weekly specials */
  $query3 = "SELECT * FROM Daily_sales WHERE ";
  $i =0;

   foreach ($terms as $each){
    $i++;

   if ($i == 1){ 
    $bname = mysql_query("SELECT * FROM Businesses WHERE name LIKE '%$each%' ");
    $r3 = mysql_fetch_assoc($bname);
    $nr2 = mysql_num_rows($bname);
    

    if ($nr2 > 0){
      $each = $r3['business_id'];
    }

  
      $query3 .= "title LIKE '%$each%' OR business_id LIKE '%$each%' ";
    }

   else{ 
  
      $query3 .= "OR title LIKE '%$each%' OR business_id LIKE '%$each%' ";
    }
  }
 

?>

