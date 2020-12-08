<!----------------

    Name: Wanzhen Gao
    Date: 2020-11-09
    Description: Connect mysql 

----------------->
<?php
    define('DB_DSN','mysql:host=localhost;dbname=serverside');
    define('DB_USER','serveruser');
    define('DB_PASS','gorgonzola7!');     
    
	try {
        $db = new PDO(DB_DSN, DB_USER, DB_PASS);
    } catch (PDOException $e) {
        print "Error: " . $e->getMessage();
        exit(); // Force execution to stop on errors.
    }
?>