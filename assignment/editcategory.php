<!----------------

    Name: Wanzhen Gao
    Date: 2020-10-06
    Description: Update and Delete Category
----------------->
<?php
  
  require 'connection.php';
  $category_id = $_GET['id'];
  $query ="SELECT * FROM category WHERE CategoryID = $category_id";
  $statement = $db->prepare($query); 
  $statement->execute();
  $category = $statement->fetchAll();

  $qty = "SELECT count(*) FROM pets WHERE CategoryID = $category_id";
  $statement = $db->prepare($qty); 
  $statement->execute(); 
  $row = $statement->fetchAll();
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Edit Category</title>
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
  <form action="process_post.php" method="post">
    <?php foreach($category as $key): ?>
      <?php foreach($row as $value): ?>
    <fieldset>
      <legend>Edit <?= $key['Name']?> Post</legend>
      <p>
        <label for="Name">Name</label>
        <input name="Name" id="Name" value="<?= $key['Name']?>" />
      </p>
      <p>
        <label for="Qty">Qantity of Pets</label>
        <input name="Qty" id="Qty" value="<?= $value['count(*)']?>" />
      </p>
      <p>
        <input type="hidden" name="CategoryID" value="<?= $key['CategoryID']?>" />
        <input type="submit" name="command" value="UpdateCategory" />
        <input type="submit" name="command" value="DeleteCategory" onclick="return confirm('Are you sure you wish to delete this Category?')" />
      </p>
    </fieldset>
    <?php endforeach ?>
    <?php endforeach ?>
  </form>
</div>
        <div id="footer">
            Copywrong 2020 - No Rights Reserved
        </div> <!-- END div id="footer" -->
    </div> <!-- END div id="wrapper" -->
</body>
</html>
