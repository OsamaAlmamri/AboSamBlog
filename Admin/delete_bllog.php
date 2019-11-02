<?php
@session_start() ; 

if  (@$_SESSION['type']=='Admin')
{
include "conn.php" ;

if (isset( $_GET['id']) ) 
{
	   
$sql="delete from bllog where id=".$_GET['id'];
    if ($qry=mysqli_query($con,$sql)) 
	{
				  	echo " <script>location.replace('select_bllog.php') </script> " ; 
		//header ( 'Location:select_bllog.php') ;
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