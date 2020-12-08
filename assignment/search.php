<?php
	require 'connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Search</title>
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
</ul> <!-- END div id="menu" -->
<div id="all_pets">
  <?php
  $button = $_GET ['submit'];
  $search = $_GET ['search'];
    // connect to database
 $con=mysqli_connect('localhost','serveruser','gorgonzola7!','serverside');


    $sql ="SELECT * FROM pets WHERE Name LIKE '%" . $search . "%'";

    $run = mysqli_query($con,$sql);
    $foundnum = mysqli_num_rows($run);


    if ($foundnum==0)
    {
      echo "We were unable to find a product with a search term of '<b>$search</b>'.";
    }
    else{
      echo "<h1><strong> $foundnum Results Found for \"" .$search."\" </strong></h1>";      

      // get num of results stored in database
      $sql = "SELECT * FROM pets WHERE Name LIKE '%" . $search . "%'";
      $getquery = mysqli_query($con,$sql);

      while($runrows = mysqli_fetch_array($getquery))
      {
      	$imageName = substr_replace($runrows['Image'], "_medium", -4, 0);
        echo "<h5>Name: ". $runrows["Name"] ."</h5>";
        if(!empty($runrows["Image"]))
        {
        	echo '<img src="uploads/'.$imageName.'"/>';
        }
        echo "<h5>AnimalID: ". $runrows["AnimalID"] ."</h5>";
        echo "<h5>Location: ". $runrows["Location"] ."</h5>";
        echo "<h5>Age: ". $runrows["Age"] ."</h5>";
        echo "<h5>Sex: ". $runrows["Sex"] ."</h5>";
        echo "<h5>Breed: ". $runrows["Breed"] ."</h5>";
        echo "-------------------------------------------------------------------------------------------------------";
        }}

    mysqli_close($con);
?>
</div>  
      <div id="footer">
          Copywrong 2020 - No Rights Reserved
      </div> <!-- END div id="footer" -->
</div> <!-- END div id="wrapper" -->
</body>
</html>