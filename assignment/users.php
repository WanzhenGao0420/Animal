<!----------------

    Name: Wanzhen Gao
    Date: 2020-11-09
    Description: Only Admin can login this page.

----------------->
<?php
  require 'authenticate.php';
  require 'connection.php';

  $query = "SELECT * FROM users ORDER BY id";
  $statement = $db->prepare($query); 
  $statement->execute(); 
  $users = $statement->fetchAll();
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
    <div id="header"><!-- notification message -->
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
      <div class="pet_post">

        <table>
        	<caption>Users Information</caption>
        	<thead>
        		<tr>
        			<th>Username</th>
        			<th>Email address</th>
        			<th>Details</th>
        		</tr>
        	</thead>
        	<tbody>
        		<?php foreach ($users as $key) :?>
        		<tr>
        			<td><?= $key['username']?></td>
        			<td><?= $key['email']?></td>
        			<td><a href="editUser.php?id=<?= $key['id'] ?>">View</a></td>
        		</tr>
        		<?php endforeach ?>
        	</tbody>
        </table>
        <a href="createuser.php">Add an user</a>
        
      </div>
   
</div>  
      <div id="footer">
          Copywrong 2020 - No Rights Reserved
      </div> <!-- END div id="footer" -->
    </div> <!-- END div id="wrapper" -->
</body>
</html>