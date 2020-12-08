<!----------------

    Name: Wanzhen Gao
    Date: 2020-10-06
    Description: Post Create, Update and Delete

----------------->
<?php
	require 'connection.php';
	require 'authenticate.php';
	require 'image.php';

	if (!empty($_POST['command'])) {
		if($_POST['command'] == "Create"){
			if(isset($_FILES['Image']['name']))
			{
				$Image  	= $_FILES['Image']['name'];
				$filename              = $_FILES['Image']['name'];
        		$temporary_file_path  = $_FILES['Image']['tmp_name'];
        		$new_file_path        = file_upload_path($filename);

        		if (file_is_a_valid($temporary_file_path, $new_file_path)) {    
            		move_uploaded_file($temporary_file_path, $new_file_path);
            		$medium_substr = '.';
            		$medium_attachment = '_medium';
            		$medium_image = str_replace($medium_substr, $medium_attachment.$medium_substr, $new_file_path);

            		$Image = new \Gumlet\ImageResize($new_file_path);
            		$Image->resizeToShortSide(5);
            		$Image->save($medium_image);
        			}
			}

			$Name  		= filter_input(INPUT_POST, 'Name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        	$Location  	= filter_input(INPUT_POST, 'Location', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        	$Age  		= filter_input(INPUT_POST, 'Age', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        	$Sex  		= filter_input(INPUT_POST, 'Sex', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        	$Breed  	= filter_input(INPUT_POST, 'Breed', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        	$About  	= filter_input(INPUT_POST, 'About', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        	$CategoryID = filter_input(INPUT_POST, 'CategoryID', FILTER_SANITIZE_NUMBER_INT);


        	if(empty($Name) || empty($Location) || empty($Age) || empty($Sex) || empty($Breed)){
        		exit("The input at least need 1 character in length."); 
        	}else{

        	$query 		= "INSERT INTO pets (Name, Age, Sex, Breed, Location, About, CategoryID, Image) VALUES(:Name, :Age, :Sex, :Breed, :Location, :About, :CategoryID, :Image)";
		    $statement 	= $db->prepare($query);

		    
		    $statement->bindValue(':Name', $Name); 
	        $statement->bindValue(':Age', $Age);
	        $statement->bindValue(':Sex', $Sex);
	        $statement->bindValue(':Breed', $Breed);
	        $statement->bindValue(':Location', $Location);
	        $statement->bindValue(':About', $About);
	        $statement->bindValue(':CategoryID', $CategoryID);
	        $statement->bindValue(':Image', $Image);

		    $statement->execute();
		    $insert_id 	= $db->lastInsertId();
		    header('Location: admin.php');
        	}
		}
	    else if( $_POST['command'] == "Update"){

	    	if(isset($_FILES['Image']['name']))
			{
				$Image  			  = $_FILES['Image']['name'];
				$filename             = $_FILES['Image']['name'];
        		$temporary_file_path  = $_FILES['Image']['tmp_name'];
        		$new_file_path        = file_upload_path($filename);

        		if (file_is_a_valid($temporary_file_path, $new_file_path)) {    
            		move_uploaded_file($temporary_file_path, $new_file_path);
            		$medium_substr = '.';
            		$medium_attachment = '_medium';
            		$medium_image = str_replace($medium_substr, $medium_attachment.$medium_substr, $new_file_path);

            		$Image = new \Gumlet\ImageResize($new_file_path);
            		$Image->resizeToShortSide(5);
            		$Image->save($medium_image);
        			}
			}
        
        	if($_POST['command'] == "DeleteImage")
        	{
        			$Image = "";
        	}
	        $Name  		= filter_input(INPUT_POST, 'Name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        	$Location  	= filter_input(INPUT_POST, 'Location', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        	$Age  		= filter_input(INPUT_POST, 'Age', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        	$Sex  		= filter_input(INPUT_POST, 'Sex', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        	$Breed  	= filter_input(INPUT_POST, 'Breed', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        	$About  	= filter_input(INPUT_POST, 'About', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	        $AnimalID 	= filter_input(INPUT_POST, 'AnimalID', FILTER_SANITIZE_NUMBER_INT);

        	$query 		= "UPDATE pets SET Name = :Name, Location = :Location, Age = :Age, Sex = :Sex, Breed = :Breed, About = :About, Image = :Image WHERE AnimalID = :AnimalID";
		    $statement 	= $db->prepare($query);

		    $statement->bindValue(':Name', $Name); 
	        $statement->bindValue(':Location', $Location);
	        $statement->bindValue(':Age', $Age);
	        $statement->bindValue(':Sex', $Sex);
	        $statement->bindValue(':Breed', $Breed);
	        $statement->bindValue(':About', $About);
	        $statement->bindValue(':Image', $Image);
	        $statement->bindValue(':AnimalID', $AnimalID, PDO::PARAM_INT);
	        
	        $statement->execute();
	        header("location:admin.php");
    	}
    	else if( $_POST['command'] == "Delete"){
        
	        $AnimalID      	= filter_input(INPUT_POST, 'AnimalID', FILTER_SANITIZE_NUMBER_INT);
	        
	        $query 		= "DELETE FROM pets WHERE AnimalID = :AnimalID";
	        $statement 	= $db->prepare($query);

	        $statement->bindValue(':AnimalID', $AnimalID, PDO::PARAM_INT);
	        
	        $statement->execute();
	        header("location:admin.php");
    	}
    	else if( $_POST['command'] == "CreateCategory"){
    		$Name  		= filter_input(INPUT_POST, 'Name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        	$Qty  		= filter_input(INPUT_POST, 'Qty', FILTER_SANITIZE_NUMBER_INT);

        	if(empty($Name)){
        		exit("The input at least need 1 character in length."); 
        	}else{

        	$query 		= "INSERT INTO category (Name, Qty) VALUES(:Name, :Qty)";
		    $statement 	= $db->prepare($query);

		    $statement->bindValue(':Name', $Name); 
	        $statement->bindValue(':Qty', $Qty);

	        $statement->execute();
		    $insert_id 	= $db->lastInsertId();
		    header('Location: category.php');
			}
    	}
    	else if( $_POST['command'] == "UpdateCategory"){
        
	        $Name  		= filter_input(INPUT_POST, 'Name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        	$Qty  		= filter_input(INPUT_POST, 'Qty', FILTER_SANITIZE_NUMBER_INT);
        	$CategoryID = filter_input(INPUT_POST, 'CategoryID', FILTER_SANITIZE_NUMBER_INT);

        	$query 		= "UPDATE category SET Name = :Name, Qty = :Qty WHERE CategoryID = :CategoryID";
		    $statement 	= $db->prepare($query);

		    $statement->bindValue(':Name', $Name); 
	        $statement->bindValue(':Qty', $Qty);
	        $statement->bindValue(':CategoryID', $CategoryID, PDO::PARAM_INT);
	        
	        $statement->execute();
	        header("location: category.php");
	    	
    	}
    	else if( $_POST['command'] == "DeleteCategory"){
        
	        $CategoryID = filter_input(INPUT_POST, 'CategoryID', FILTER_SANITIZE_NUMBER_INT);
	        
	        $query 		= "DELETE FROM category WHERE CategoryID = :CategoryID";
	        $statement 	= $db->prepare($query);

	        $statement->bindValue(':CategoryID', $CategoryID, PDO::PARAM_INT);
	        
	        header("location:category.php");
    	}
    	else if($_POST['command'] == "CreateUser"){
    		$username  		= filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        	$email  		= filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        	$pass  			= filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        	$password 		= password_hash($pass, PASSWORD_DEFAULT);

        	if(empty($username) || empty($email) || empty($password)){
        		exit("The input at least need 1 character in length."); 
        	}else{

        	$query 		= "INSERT INTO users (username, email, password) VALUES(:username, :email, :password)";
		    $statement 	= $db->prepare($query);

		    $statement->bindValue(':username', $username); 
	        $statement->bindValue(':email', $email);
	        $statement->bindValue(':password', $password);

	        $statement->execute();
		    $insert_id 	= $db->lastInsertId();
	        header("location: users.php");
	    	}
    	}
    	else if($_POST['command'] == "UpdateUser"){
    		$username  		= filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        	$email  		= filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        	$id 			= filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

        	$query 		= "UPDATE users SET username = :username, email = :email WHERE id = :id";
		    $statement 	= $db->prepare($query);

		    $statement->bindValue(':username', $username); 
	        $statement->bindValue(':email', $email);
	        $statement->bindValue(':id', $id, PDO::PARAM_INT);
	        
	        $statement->execute();
	        header("location: users.php");
    	}
    	else if($_POST['command'] == "DeleteUser"){
    		$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
	        
	        $query 		= "DELETE FROM users WHERE id = :id";
	        $statement 	= $db->prepare($query);

	        $statement->bindValue(':id', $id, PDO::PARAM_INT);
	        
	        $statement->execute();
	        header("location:users.php");
    	}
    	else if( $_POST['command'] == "Apply"){
    		session_start();
    		$code = $_SESSION['cap_code'];
    		$user = $_POST['cap'];
  			if($code !== $user){
  				echo '<script>alert("Invalid captcha code")</script>';
  				exit;
  			}
  			
    		$Comment  	= filter_input(INPUT_POST, 'Comment', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    		$AnimalID 	= filter_input(INPUT_POST, 'AnimalID', FILTER_SANITIZE_NUMBER_INT);

        	
        	$query 		= "INSERT INTO comment (Comment, AnimalID) VALUES(:Comment, :AnimalID)";;
		    $statement 	= $db->prepare($query);

		    
			$statement->bindValue(':Comment', $Comment);
	        $statement->bindValue(':AnimalID', $AnimalID, PDO::PARAM_INT);
	        
	        $statement->execute();
		    $insert_id 	= $db->lastInsertId();
		    header('Location: index.php');

		    
    	}
    	else if( $_POST['command'] == "DeleteComment"){
    		$comment_id = filter_input(INPUT_POST, 'comment_id', FILTER_SANITIZE_NUMBER_INT);

    		$query 		= "DELETE FROM comment WHERE comment_id = :comment_id";
	        $statement 	= $db->prepare($query);

	        $statement->bindValue(':comment_id', $comment_id, PDO::PARAM_INT);
	        
	        $statement->execute();
	        header("location:index.php");
    	}
	}

?>
