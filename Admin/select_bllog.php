

<?php
@session_start() ; 

if  (@$_SESSION['type']=='Admin')
{
include "conn.php" ;
	include "Header.php";
	
	@session_start() ;
//if (isset($_SESSION['username'])) 
//		header('location:login.php');

	
	if ($con) 
	{
		$sql="select * from  bllog " ;
		$result=mysqli_query($con,$sql) ;
		$count=mysqli_affected_rows($con) ;
			echo $count;
			
			
			
			echo "<div style='margin-top: 50px;'>
				 <div class='container'>
				<div class='text-primary' style='padding: 5px 0px 5px 0px; margin-top: -25px;'>
            <h1 class='text-center'>bllog information  </h1>
        </div>
  
  
  
             <div class='table-responsive'>  
  <table class='table'>
    <thead>
      <tr class='success'>
	  <th>id</th>
        <th>user_id</th>
		<th>type</th>
        <th>tittle</th>
        <th>auther</th>       
	    <th>text</th>
		<th>published at</th>
		<th>update at</th>
		<th>image</th>
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
    .$row['id_p'] ."</td> <td>" 
	  .$row['type'] ."</td> <td>" 
	.$row['title'] ."</td> <td>" 
	.$row['author'] ."</td> <td>" 
	.substr($row['text'],0,100)."</td> <td>" 
	
	.$row['date_p'] ."</td> <td>" 
	
	.$row['date_u'] ."</td> 
	<td>
	  
    
  
      <a  class='thumbnail'>
        <img src='images/".$row['image']."' alt='".$row['title']."' width='84' height='13'>
      </a>
   
   
  
  </td>
	" ;
		
		echo " <td> <a class='btn btn-success'  href='update_bllog.php?id=".$row['id']."'> update </a> </td>" ;
		echo " <td> <a class='btn btn-danger' href='delete_bllog.php?id=".$row['id']."'> Delete </a> </td> </tr>" ;
	}

			echo "  </tbody>
  </table>
</div></div> " ;
			

	
	}
	
	else 
		
	echo " ERROR ON CONNECTION " ;
	
	echo "<a href='add_bllag.php'>   <input type='button' class='btn-default btn-block' value='ADD NEW bllag'> </a>" ;
	//echo "<a href='logout.php'>   <input type='button' class='btn-default btn-block' value='LOGOUT'> </a>" ;
echo"</div></div> </div> ";



include "Footer.php";
}
else 
{
	 echo " <script > alert('HHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHH ') ; </script>	 "  ;
   echo " <script>location.replace('../login.php') </script> " ;
}
?>