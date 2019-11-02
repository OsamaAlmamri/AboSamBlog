<?php

session_start();
include "header.php";

include "Admin/conn.php" ;
	
		$sql="select * from  users where  id='".$_SESSION['id']."'";
		$qry=mysqli_query($con,$sql) ;
		if (mysqli_num_rows($qry) )
		$row=mysqli_fetch_array($qry);

	$newpass=md5($row['password'].$row['salt']);
	
	
	
	
	
	echo " <div class='container content-wrapper  text-center'>
    <div class='fb-profile'> ";
	echo " <img align='right' class='fb-image-lg' src='Admin/images/pic.jpg' /> 

        
        <img align='right' class='fb-image-profile img-thumbnail' src='Admin/images/".$row['image']." ' />
     
	</div>
    <div class='fb-profile-text' style='margin-bottom:100px;'>
        <h1> ".$row['name'] ."
        <a href='editProfile.php?state=name' class='btn btn-info btn-lg'>
          <span class='glyphicon glyphicon-pencil'></span>  تعديل الاسم
        </a>
        </h1>
		
    </div>
	<a href='editProfile.php?state=image' class='btn btn-info btn-lg'>
          <span class='glyphicon glyphicon-pencil'></span> تعديل الصورة الشخصية
        </a>
</div>
<div class='container'>
 
    <div class='panel panel-primary'>
        <div class='panel-heading'>
           <div class='panel-body'>
                <ul type='none'>
				  <li> <big>  User_name  : </big>  ".$row['user_name']."
        <a href='editProfile.php?state=user_name' class='btn btn-info btn-lg'>
          <span class='glyphicon glyphicon-pencil'></span> تعديل
        </a>
        </li>
		
                    <li> <big>  Email : </big>  ".$row['email']."
        <a href='editProfile.php?state=email' class='btn btn-info btn-lg'>
          <span class='glyphicon glyphicon-pencil'></span> تعديل
        </a>
        </li>
		
		<li> <big>  Password : </big>  ".$newpass."
        <a href='editProfile.php?state=password' class='btn btn-info btn-lg'>
          <span class='glyphicon glyphicon-pencil'></span> تعديل
        </a>
        </li>
		<li> <big>  Mobile : </big>  ".$row['mobile']."
        <a href='editProfile.php?state=mobile' class='btn btn-info btn-lg'>
          <span class='glyphicon glyphicon-pencil'></span> تعديل
        </a>
        </li>
		<li> <big>  Age: </big>  ".$row['age']."
        <a href='editProfile.php?state=age' class='btn btn-info btn-lg'>
          <span class='glyphicon glyphicon-pencil'></span> تعديل
        </a>
        </li>

					
                </ul>
            </div>
        </div>
        
    </div>
   
   
</div>
";
	
	
	
?>












<?php
include "footer.php";
?>