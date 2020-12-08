<!----------------

    Name: Wanzhen Gao
    Date: 2020-10-06
    Description: Update and Delete User as admin.
----------------->
<?php
  require 'authenticate.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Create a new User</title>
    <link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>
  <div id="wrapper">
    <div id="header">
            <h1><a href="index.php">Create a new User</a></h1>
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
    <fieldset>
      <legend>New User</legend>
      <p>
        <label for="username">Username</label>
        <input name="username" id="username" />
      </p>
      <p>
        <label for="email">Email Address</label>
        <input name="email" id="email" />
      </p>
      <p>
        <label for="password">Password</label>
        <input name="password" id="password" />
      </p>
      <p>
        <input type="submit" name="command" value="CreateUser" />
      </p>
    </fieldset>
  </form>
</div>
        <div id="footer">
            Copywrong 2020 - No Rights Reserved
        </div> <!-- END div id="footer" -->
    </div> <!-- END div id="wrapper" -->
</body>
</html>