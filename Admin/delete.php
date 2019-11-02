<?php
include "conn.php" ;
@session_start() ; 

if  (@$_SESSION['type']=='Admin')
{
if (isset( $_GET['id']) ) 
{
	   
$sql="delete from users where id=".$_GET['id'];
    if ($qry=mysqli_query($con,$sql)) 
	{
					  	echo " <script>location.replace('user_info.php') </script> " ; 
		//header ( 'Location:user_info.php') ;
	}		
	else 
		echo "error" .mysqli_error($con) ;
	
	
	
	}

	else 
{
	 echo " <script > alert('HHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHH ') ; </script>	 "  ;
   echo " <script>location.replace('../login.php') </script> " ;
}
}
?>