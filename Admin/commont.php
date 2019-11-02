

<?php
@session_start() ; 

if  (@$_SESSION['type']=='Admin')
{
include "conn.php" ;
	include "Header.php";
	

	if ($con) 
	{
		$sql="select * from  comment" ;
		if($result=mysqli_query($con,$sql) )	
		{
			
			echo "<div style='margin-top: 50px;'>
				 <div class='container'>
				<div class='text-primary' style='padding: 5px 0px 5px 0px; margin-top: -25px;'>
            <h1 class='text-center'>commonts information  </h1>
        </div>
  
           
  <table class='table'>
    <thead>
      <tr class='success'>
	  <th>id</th>
        <th>user_id</th>
        <th>bllog_id</th>
             
	    <th>text</th>
		
		<th>coomont at</th>
		<th>update at</th>
      </tr>
    </thead>
  <tbody> 
	" ;
			$color=0;
			while ( $row=mysqli_fetch_array($result))
{
	$color++;
	if (	$color%2==0 )
		$c='danger';
	else 
		$c='info';
	
		echo "<tr  class='".$c."' > <td>". $row['id'] ."</td> <td>"  
    .$row['user_id'] ."</td> <td>" 
	.$row['bllog_id'] ."</td> <td>" 
	
	.$row['text'] ."</td> <td>" 
	
	.$row['date_p'] ."</td> <td>" 
	
	.$row['date_u'] ."</td> 
	
	" ;
		
	
		echo " <td> <a class='btn btn-success' href='deleteComment.php?id=".$row['id']."'> Delete </a> </td> </tr>" ;
	}

			echo "  </tbody>
  </table>
</div></div></div></div> " ;
			

	
	}
	
	else 
		
	echo " ERROR ON CONNECTION " ;
	
	//echo "<a href='add_bllag.php'>   <input type='button' class='btn-default btn-block' value='ADD NEW bllag'> </a>" ;
	//echo "<a href='logout.php'>   <input type='button' class='btn-default btn-block' value='LOGOUT'> </a>" ;
	
	}



include "Footer.php";
}
else 
{
	 echo " <script > alert('HHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHH ') ; </script>	 "  ;
   echo " <script>location.replace('../login.php') </script> " ;
}
?>