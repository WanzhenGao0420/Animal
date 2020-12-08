<!----------------

    Name: Wanzhen Gao
    Date: 2020-10-06
    Description: Update and Delete User as admin.
----------------->
<?php
  
  require 'connection.php';
  $user_id = $_GET['id'];
  $query ="SELECT * FROM users WHERE id = $user_id";
  $statement = $db->prepare($query); 
  $statement->execute();
  $user = $statement->fetchAll();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Edit User</title>
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
    <li><a href="create.php" >Create New Animal</a></li>
    <li><a href="users.php">Registered Users</a></li>
</ul> <!-- END div id="menu" -->
<div id="all_pets">
  <form action="process_post.php" method="post">
    <?php foreach($user as $key): ?>
    <fieldset>
      <legend>Edit <?= $key['username']?> Post</legend>
      <p>
        <label for="username">Username</label>
        <input name="username" id="username" value="<?= $key['username']?>" />
      </p>
      <p>
        <label for="email">Email address</label>
        <input name="email" id="email" value="<?= $key['email']?>" />
      </p>
      <p>
        <input type="hidden" name="id" value="<?= $key['id']?>" />
        <input type="submit" name="command" value="UpdateUser" />
        <input type="submit" name="command" value="DeleteUser" onclick="return confirm('Are you sure you wish to delete this user?')" />
      </p>
    </fieldset>
    <?php endforeach ?>
  </form>
</div>
        <div id="footer">
            Copywrong 2020 - No Rights Reserved
        </div> <!-- END div id="footer" -->
    </div> <!-- END div id="wrapper" -->
</body>
</html>