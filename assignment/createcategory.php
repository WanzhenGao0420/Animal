<!----------------

    Name: Wanzhen Gao
    Date: 2020-10-06
    Description: Create new category

----------------->
<?php
	require 'authenticate.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Create a new Category</title>
    <link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>
    <div id="wrapper">
        <div id="header">
            <h1><a href="create.php">Create a new Category</a></h1>
        </div> <!-- END div id="header" -->
<ul id="menu">
    <li><a href="index.php" class='active'>Home</a></li>
    <li><a href="category.php" >Categories</a></li>
    <li><a href="admin.php" >Admin</a></li>
    <li><a href="create.php" >Create New Category</a></li>
</ul> <!-- END div id="menu" -->
<div id="all_pets">
  <form action="process_post.php" method="post">
    <fieldset>
      <legend>New Category</legend>
      <p>
        <label for="Name">Name</label>
        <input name="Name" id="Name" />
      </p>

      <p>
        <label for="Qty">Qantity of Pets</label>
        <input name="Qty" id="Qty" />
      </p>
      <p>
        <input type="submit" name="command" value="CreateCategory" />
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