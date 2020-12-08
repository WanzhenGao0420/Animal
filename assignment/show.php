<!----------------

    Name: Wanzhen Gao
    Date: 2020-10-06
    Description: Show full pet page

----------------->
<?php
  require 'connection.php';

  $pet_id = $_GET['id'];
  $query = "SELECT * FROM pets WHERE AnimalID = $pet_id" ;
  $statement = $db->prepare($query); 
  $statement->execute(); 
  $pets= $statement->fetchAll();

  $query = "SELECT * FROM comment WHERE AnimalID = $pet_id ORDER BY comment_id DESC" ;
  $statement = $db->prepare($query); 
  $statement->execute(); 
  $comments = $statement->fetchAll();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <?php foreach ($pets as $key) :?>
    <title>Animal--<?= $key['Name'] ?></title>
    <?php endforeach ?>
    <link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>
    <div id="wrapper">
      
        <div id="header">
          <?php foreach ($pets as $key) :?>
            <h1><a href="index.php">Animal--<?= $key['Name'] ?></a></h1>
          <?php endforeach ?>
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
          <div class='pet_content'>
            <a href="apply.php?id=<?= $key['AnimalID'] ?>">Apply</a>
            </div>
            <div class="pet_comment">
          <form action="process_post.php" method="post">
          <fieldset>  
          <?php foreach ($comments as $row) :?>  
          <?php if(!empty($row['Comment'])) :?>
            <p >
              <?= $row['Comment'] ?>      
              
                <input type="hidden" name="comment_id" value="<?= $row['comment_id']?>" />
                <input type="submit" name="command" value="DeleteComment" onclick="return confirm('Are you sure you wish to delete this comment?')"/>
              </p>
           
          <?php endif ?>
          <?php endforeach ?>
        </fieldset>

  </form>
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
