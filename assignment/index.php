<!----------------

    Name: Wanzhen Gao
    Date: 2020-11-09
    Description: Display home page

----------------->
<?php

  require 'connection.php';

  if(!isset($_GET['order']))
  {
    $order = "AnimalID";
  }
  else{
    $order = $_GET['order'];
  }
  $query = "SELECT * FROM pets ORDER BY $order";
  $statement = $db->prepare($query); 
  $statement->execute(); 
  $pets = $statement->fetchAll();

  session_start(); 

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
    <title>Available Pets</title>
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

    
            <h1><a href="index.php">Available Pets</a></h1>
            <p>Find the pet of your dreams and adopt your new best friend today.</p>
        </div> <!-- END div id="header" -->
        
<ul id="menu">
    <li><a href="index.php" class='active'>Home</a></li>
    <li><a href="category.php" >Categories</a></li>
    <li><a href="admin.php" >Admin</a></li>
</ul> <!-- END div id="menu" -->
<div id="all_pets">
<ul id="sort">
  <li><a href="index.php?order=Name">Sort by Name</a></li>
  <li><a href="index.php?order=AnimalID">AnimalID</a></li>
  <li><a href="index.php?order=Location">Location</a></li>
</ul>
<form action="search.php" method="GET">
    <input type="text" placeholder="Search" name="search" aria-label="Search" required>
    <input type="submit" value="Search" name="submit">
  </form>
	<?php foreach ($pets as $key) :?>
      <div class="pet_post">
        <h2><a href="show.php?id=<?= $key['AnimalID'] ?>"><?= $key['Name']?></a></h2>
        <?php if(empty($key['Image'])) :?>
        <p></p>
        <?php else: ?>
        <img src="uploads/<?= substr_replace($key['Image'], "_medium", -4, 0) ?>" alt="<?= substr_replace($key['Image'], "_medium", -4, 0) ?>" class="pets">
      <?php endif ?>
        <ul class="pets_info">
          <li>Animal ID: <?= $key['AnimalID'] ?></li>
          <li>Shelter Location: <?= $key['Location'] ?></li>
          <li>Age: <?= $key['Age'] ?></li>
          <li>Sex: <?= $key['Sex'] ?></li>
          <li>Breed: <?= $key['Breed'] ?></li>
        </ul>
        <div class='pet_content'>
            <a href="show.php?id=<?= $key['AnimalID'] ?>">View Details</a>
        </div>
      </div>
    <?php endforeach ?>
   
</div>  
      <div id="footer">
          Copywrong 2020 - No Rights Reserved
      </div> <!-- END div id="footer" -->
    </div> <!-- END div id="wrapper" -->
</body>
</html>