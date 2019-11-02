

<?php
include "Admin/conn.php" ;
include "header.php";
$id=$_SESSION['id'];
//$id=28;
 if (isset($_GET['state'])) 
  {    
echo $_GET['state'];
 
echo $id;

if ($_GET['state']=='email' )
	$t='email';
else if ($_GET['state']=='age' or $_GET['state']=='mobile' )
	$t='number';
else if ($_GET['state']=='image' )
	$t='file';
else if ($_GET['state']=='password' )
	$t='password';
else 
	$t='text';
		 echo " 
	   <div class='container-fluid content-wrapper text-center'>
    <div class='row'>
        <div class='col-md-6 col-md-offset-3'>
            <div class='card card-container'>
		  
  <h2> <div class='card-header'>update ".$_GET['state']."</div></h2>
  <form class='form-horizontal' role='form'  method=post enctype='multipart/form-data'>
  
	  <div class='form-group'>
      <label class='control-label col-sm-3' for='title'>القيمة الجديدة : </label>
      <div class='col-sm-9'>
        <input type='".$t."' name='new'  class='form-control' id='new' placeholder='Enter your ".$_GET['state']."'>
      </div>
	   </div>
	   <div class='form-group'>        
      <div class='col-sm-offset-2 col-sm-10'>
        <button type='submit' class='btn btn-default' name='sbmt' >تعديل</button>
      </div>
    </div>
	
	    </div>
		 </div>
		  </div>
		   </div>
		    </div>
			";
	  
	  
	  
	   if ( isset($_POST['sbmt']))
		  {
			  
			  
			 $new=mysqli_real_escape_string($con,$_POST['new']) ;
			  $types=array('image/jpeg','image/gif','image/png') ;
if ( isset ($_FILES ) )
{
	  $image = $_FILES['new'] ['name'] ;
$f_type= $_FILES['new'] ['type'] ;
$file_tmp= $_FILES['new'] ['tmp_name'] ;
$size = $_FILES['new'] ['size'] ;

	if ( in_array($f_type,$types)) 
	{
	if (move_uploaded_file($file_tmp ,'Admin/images/'.$image) )	
	{
		echo "sucesss <br> ";
		$new=$image;
	
	}
	else 
		$new='propic.png';
	}
	else 
		$image_find='propic.png';
}
   if ($t=='password')
   {
			   $sql="select * from users where id=".$_SESSION['id'];        
    if ($qry=mysqli_query($con,$sql)) 
	{

		  if (mysqli_num_rows($qry) )
		  {
			
		$row=mysqli_fetch_array($qry);
		
		
		 $new=md5($_POST['new'].$row['salt']);
		
		  }	
	}
	}
			  $upQuery="update users set ".$_GET['state']." ='".$new."' where id=" .$id;
			  if ($qryuodate=mysqli_query($con,$upQuery)) 
				 		echo " <script>location.replace('profile.php') </script> " ; 
			//header('location:profile.php');
		 
			  else 
				  echo "error " .mysqli_error($con);
			  
		  }

  
  }


	
?>


