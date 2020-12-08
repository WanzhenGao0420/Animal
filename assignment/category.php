<!----------------

    Name: Wanzhen Gao
    Date: 2020-11-09
    Description: Animals category

----------------->
<?php
  require 'connection.php';
  $query = "SELECT * FROM category";
  $statement = $db->prepare($query); 
  $statement->execute(); 
  $category = $statement->fetchAll();



  session_start(); 

  if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
  }
  if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: index.php");
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Pets Category</title>
    <link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>
    <div id="wrapper">
    <ul id="usernav">
              <li><a href="register.php">Register</a></li>
              <li>
                <?php  if (isset($_SESSION['username'])) : ?>
                  <?= $_SESSION['username']; ?>
                <?php else : ?>
                  <a href="login.php">LogIn</a>
                <?php endif ?>
              </li>
              <li><a href="index.php?logout='1'" >logout</a></li>
        </ul>
        <div id="header"><!-- notification message -->
    <?php if (isset($_SESSION['success'])) : ?>
      <div class="error success" >
        <h3>
          <?php 
            // echo $_SESSION['success']; 
            unset($_SESSION['success']);
          ?>
        </h3>
      </div>
    <?php endif ?>
            <h1><a href="index.php">Pets Category</a></h1>
            <p>Find the pet of your dreams and adopt your new best friend today.</p>
        </div> <!-- END div id="header" -->
<ul id="menu">
    <li><a href="index.php" class='active'>Home</a></li>
    <li><a href="category.php" >Categories</a></li>
    <li><a href="admin.php" >Admin</a></li>
    <li><a href="createcategory.php" >Create New Category</a></li>
</ul> <!-- END div id="menu" -->
<div id="all_pets">

	<?php foreach ($category as $key) :?>
      <div class="pet_post">
        <ul id="pets_info">
          <li><a href="sort.php?id=<?= $key['CategoryID'] ?>"><?= $key['Name'] ?> (<?= $key['Qty']?>)</a> <a href="editcategory.php?id=<?= $key['CategoryID'] ?>">edit</a></li> 
        </ul>
      </div>
    <?php endforeach ?>


</div>  
      <div id="footer">
          Copywrong 2020 - No Rights Reserved
      </div> <!-- END div id="footer" -->
    </div> <!-- END div id="wrapper" -->
</body>
</html>