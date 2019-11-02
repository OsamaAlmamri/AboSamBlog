
<?php
session_start();
session_destroy();
	echo " <script>location.replace('login.php') </script> " ; 
//header('location:login.php');

?>
