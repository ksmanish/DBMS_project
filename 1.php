<?php

  if(isset($_POST['find'])){

    $searchQ = $_POST['search'];
    //$searchQ = preg_replace("#[^0-9a-z]#i","",$searchQ);

    $connect = mysqli_connect( "localhost", "root", "yash18121998yadav", "new")or die("Could not connect db...¯\_(ツ)_/¯ ");
    //mysql_select_db("new") or die("Could not find...¯\_(ツ)_/¯ ");
    $output = '';
    $query = "SELECT * FROM `DBMSdata` WHERE `Name` LIKE '%$searchQ%' ORDER BY `IMDb Rating` ASC";
    $result = mysqli_query($connect, $query) or die("Could not find...¯\_(ツ)_/¯ ");
    $count = mysqli_num_rows($result);

    if($count == 0){
      $output = 'Could not find...ᕙ(⇀‸↼‶)ᕗ' ;
    }else{
      while($row = mysqli_fetch_array($result)){
        $genre = $row['Genre'];
        $title = $row['Name'];
        $year = $row['Year Of Release'];
        $IMDbRating = $row['IMDb Rating'];
        $imageData = $row['Picture'];


        $imageDisplay = '<img class="NormalImage" src="data:image/jpeg;base64,'.base64_encode( $imageData ).'"/>';
        $output .= '<div>'.$genre.' '.$title.' '.$year.' '.$IMDbRating.' '.$imageDisplay.' </div> ';
        //header("Content-Type: image/jpeg");
        //echo $imageData;
      }
      mysqli_free_result($result);
      mysqli_close($connect);
    }
  }
?>
<html >
<head>
  <title>Search</title>
</head>
<style type="text/css">

    .NormalImage
    {
        max-width:129px;
        max-height:225px;
        background-color: white;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }
    .formI{
      padding: 25px 25px 25px 25px;
      //margin-bottom: 10px;
      //border-style: solid;
      border-width: 5px;
      background-color: #ffa000;
    }
    .formII{
      padding: 25px 25px 25px 25px;
      margin-bottom: 10px;
      //border-style: solid;
      border-width: 5px;
      background-color: #ffc107;
    }
    .searchBar{
      max-width:829px;
      max-height:80px;
    }
</style>
<body style="background-color:#ffe082;">
  <div class="formI">
  <form action="1.php" method="post">
    <input class="searchBar" type="text" name="search" placeholder="Search here for the movies...."/>
    <input type="submit" name="find" value="&#128269;"/>
    </form>
  </div>
  <div class="formII">
  <?php
  echo $output;
  ?>
</div>

</body>
</html>
