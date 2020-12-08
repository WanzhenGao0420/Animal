<!----------------

    Name: Wanzhen Gao
    Date: 2020-10-06
    Description: Apply for this pet.

----------------->
<?php
  require 'connection.php';
  $pet_id = $_GET['id'];
  $query = "SELECT * FROM pets WHERE AnimalID = $pet_id" ;
  $statement = $db->prepare($query); 
  $statement->execute(); 
  $pets= $statement->fetchAll();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Edit Animal</title>
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
  	<?php foreach ($pets as $key) :?>
      	<div class="pet_post">
        	<h2><?= $key['Name'] ?></h2>
        	<ul id="pets_info">
	          <li>Animal ID: <?= $key['AnimalID'] ?></li>
	          <li>Shelter Location: <?= $key['Location'] ?></li>
	          <li>Age: <?= $key['Age'] ?></li>
	          <li>Sex: <?= $key['Sex'] ?></li>
	          <li>Breed: <?= $key['Breed'] ?></li>
	          <li>About: <?= $key['About'] ?></li>
	          <?php if(empty($key['Image'])) :?>
	        <p></p>
	        <?php else: ?>
	        <li><img src="uploads/<?= substr_replace($key['Image'], "_medium", -4, 0) ?>" alt="<?= substr_replace($key['Image'], "_medium", -4, 0) ?>" class="pets"></li>
	      	<?php endif ?>
	        </ul>
	<form action="process_post.php" method="post">
    <fieldset>
      <legend>Apply <?= $key['Name'] ?>-<?= $key['AnimalID'] ?></legend>
      <p>
      	<label for="Comment">Comment</label>
        <textarea  name="Comment" id="Comment"></textarea>
        <input type="hidden" name="AnimalID" value="<?= $key['AnimalID']?>" />
      </p>
      <p>
      	<input type="text" name="cap"><img src="captcha.php">
      </p>
     

      	<input type="hidden" name="comment_id" value="<?= $key['comment_id']?>" />
        <input type="submit" name="command" value="Apply" />
      
    </fieldset>
  </form>
     	</div>
	<?php endforeach ?>
	
</div>
        <div id="footer">
            Copywrong 2020 - No Rights Reserved
        </div> <!-- END div id="footer" -->
    </div> <!-- END div id="wrapper" -->
</body>
</html>
