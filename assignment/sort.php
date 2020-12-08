<!----------------

    Name: Wanzhen Gao
    Date: 2020-10-06
    Description: Show full post page

----------------->
<?php
  require 'connection.php';

  $category_id = $_GET['id'];
  $query = "SELECT * FROM pets WHERE CategoryID = $category_id" ;
  $statement = $db->prepare($query); 
  $statement->execute(); 
  $pets= $statement->fetchAll();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Avaiable Pets</title>
    <link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>
    <div id="wrapper">
        <div id="header">
          <h1><a href="index.php">Available Pets</a></h1>
          <p>Find the pet of your dreams and adopt your new best friend today.</p>
        </div> <!-- END div id="header" -->
        
<ul id="menu">
    <li><a href="index.php" class='active'>Home</a></li>
    <li><a href="category.php" >Categories</a></li>
    <li><a href="admin.php" >Admin</a></li>
</ul> <!-- END div id="menu" -->

  <div id="all_pets">
    <form action="search.php" method="GET">
    <input type="text" placeholder="Search" name="search" aria-label="Search" required>
    <input type="submit" value="Search" name="submit">
  </form>
    <?php foreach ($pets as $key) :?>
      <div class="pet_post">
        <h2><?= $key['Name'] ?></h2>
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