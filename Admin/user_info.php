

<?php
@session_start() ; 

if  (@$_SESSION['type']=='Admin')
{

include "conn.php" ;
	include "Header.php";
	
	if ($con) 
	{
		$sql="select * from  users " ;
		$result=mysqli_query($con,$sql) ;
		$count=mysqli_affected_rows($con) ;
			echo $count;

			echo "
			<div style='margin-top: 50px;'>
				 <div class='container'>
				<div class='text-primary' style='padding: 5px 0px 5px 0px; margin-top: -25px;'>
            <h1 class='text-center'>users information  </h1>
        </div>
  
  
  
         <div class='table-responsive'>   
  <table class='table' >
    <thead>
      <tr class='success'>
	 	  <th>id</th>
        <th>name</th>
		<th>user_name</th>
        <th>password </th>
        <th>Email</th>
		<th>mobile</th>
		<th>provice</th>
		  <th>type</th>
		  <th>active</th>
		<th>created</th>
		<th>updated</th>
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

			echo "<tr   class='".$c."' >
			<td>". $row['id'] ."</td> <td>"  
    .$row['name'] ."</td> <td>" 
	.$row['user_name'] ."</td> <td>" 
	.md5($row['password'].$row['salt'] )."</td> <td>" 
	.$row['email'] ."</td> <td>" 
	.$row['mobile'] ."</td> <td>" 
	.$row['provice'] ."</td> <td>" 
	.$row['type'] ."</td> <td>" 
	.$row['active'] ."</td> <td>" 
	.$row['create_at'] ."</td> <td>" 
	
	.$row['update_at'] ."</td> 
	<td>
	  
    
  
      <a  class='thumbnail'>
        <img src='images/".$row['image']."' alt='".$row['name']."' width='60' height='60'>
      </a>
   
   
  
  </td>
  
	" ;
	if($row['active']==1)
		echo " <td  > <a class='btn btn-primary  ' href='active_user.php?id=".$row['id']."'> Diable </a> </td>";
     else
     echo " <td > <a class='btn btn-primary  ' href='active_user.php?id=".$row['id']."'> Enable </a> </td>";	

 
		echo " <td  > <a  class='btn btn-success ' href='update.php?id=".$row['id']."'> Edit </a> </td>" ;
		echo " <td  > <a  class=' btn btn-danger ' href='delete.php?id=".$row['id']."'> Delete </a> </td> </tr>" ;
	}

			echo "  </tbody>
  </table>
</div>
</div> " ;
			
}
	
	else 
		
	echo " ERROR ON CONNECTION " ;
	  echo" <div class='card card-container ' >
		<div    class='col-md-8 col-md-offset-4' >
		";
			


echo " </div></div></div>" ;

	echo "<a href='add.php'>   <input type='button' class='btn btn-default btn-block' value='ADD NEW Users'> </a>" ;
	echo "<a href='logout.php'>   <input type='button' class='btn btn-default btn-block' value='LOGOUT'> </a>" ;
echo "</div>" ;
echo "</div> ";

include "Footer.php";

}
else 
{
	 echo " <script > alert('HHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHH ') ; </script>	 "  ;
   echo " <script>location.replace('../login.php') </script> " ;
}
?>