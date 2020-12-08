<!----------------

    Name: Wanzhen Gao
    Date: 2020-10-06
    Description: Authenticated User Stories

----------------->
<?php 

  define('ADMIN_LOGIN','wanzhen'); 
  define('ADMIN_PASSWORD','gao'); 

  if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW']) 
      || ($_SERVER['PHP_AUTH_USER'] != ADMIN_LOGIN) 
      || ($_SERVER['PHP_AUTH_PW'] != ADMIN_PASSWORD)) { 
    header('HTTP/1.1 401 Unauthorized'); 
	header('WWW-Authenticate: Basic realm="Our Blog"');
    exit("Access Denied: Username and password required."); 
  } 
   
?>
