



<?php

include "conn.php" ;

include "Header.php";
if ($con)
{
  if (isset($_GET['id'])) 
  {    
      $sql= "select * from users where id=" .$_GET['id'];
	 

	     if($qry=mysqli_query($con,$sql))
	    {
		  if (mysqli_num_rows($qry) )
		   {
			   $user=mysqli_fetch_array($qry) ;
			   $state=$user['active'];
			   if ($state==1)
			    $upQuery="update users set active=0  where id =".$_GET['id'] ;
			else
				 $upQuery="update users set active=1  where id =".$_GET['id'] ;
			  if ($qryuodate=mysqli_query($con,$upQuery)) 
				//  header ('Location:user_info.php') ;
			  	echo " <script>location.replace('user_info.php') </script> " ; 
			  else 
				  echo "error " .mysqli_error($con);
	        }
}
}			
}			 
include "footer.php";

?>
