<?php
include "conn.php" ;   
include "Header.php";
if(isset($_POST['sbmt'],$_POST['name'],$_POST['user_name'],$_POST['email'],$_POST['password'],$_POST['province'],$_POST['mobile'])){
$name=($_POST['name']);

$image = $_FILES['fname'] ['name'] ;
$f_type= $_FILES['fname'] ['type'] ;
$file_tmp= $_FILES['fname'] ['tmp_name'] ;
$size = $_FILES['fname'] ['size'] ;
$types=array('image/jpeg','image/gif','image/png') ;

	
			$password=strip_tags($_POST['password']);
		$salt=time();
		$password=md5($password.$salt);
		$type=$_POST['type'];
		$email=strip_tags($_POST['email']);
		$time = date("D- y/m/j ") ;
		$province=$_POST['province'] ;
		$mobile=strip_tags($_POST['mobile']) ;
		$active=strip_tags($_POST['active']) ;
		$age=strip_tags($_POST['age']) ;
		$gender=($_POST['gender']) ;
		$user_name=strip_tags($_POST['name']);
		
	  if(empty($name) || empty($email) || empty($password) || empty($mobile))
                  echo  "All Fields Are Requierd"; 
	               if (strlen($password) <6)
		        	echo "password cannot be less than 6 character " ;

         else  {
		
		     	 $checkuser="select * from users where user_name='".$user_name."'";
                if ($qry=mysqli_query($con,$checkuser)) 
	               if (mysqli_num_rows($qry) )
	                   echo " <script > alert('this user_name is used Please select anther user_name') ; </script>	 "  ;		              
		
		else {
			  
		
		if ( isset ($_FILES ) )
{
	if ( in_array($f_type,$types)) 
	{
		 $check="select * from users where image='".$image."'";
    if ($qry=mysqli_query($con,$check)) 
	 if (mysqli_num_rows($qry) )
		       $image=$name.$image;

	if (move_uploaded_file($file_tmp ,'images/'.$image) )	
	
		$image_find=$image ;
	else 
		$image_find='user.png';
	}
	
	else{
		echo "the type not allowed " ;
	$image_find='user.png';
	}
	
}

		$sql= "insert into users (name ,user_name,password,type,email,mobile,provice ,create_at ,image ,active,gender,age,salt) values ('$name','$user_name','$password' ,'$type','$email','$mobile','$province','$time','$image_find',$active,'$gender',$age,$salt) ";

		if ($qry=mysqli_query($con,$sql) )
		{
					echo " <script>location.replace('user_info.php') </script> " ;
		//	header('location:user_info.php');
		}else{
			echo "error :".mysqli_error($con);
		}
}
}
		  }

?>



<div class="container-fluid content-wrapper">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="card card-container">
		  
  <h2> <div class="card-header">ADD USER </div></h2>


  <form class="form-horizontal" role="form" action="#" method=post enctype='multipart/form-data'>
   <div class="form-group">
      <label class="control-label col-sm-2" for="NAME">NAME : </label>
      <div class="col-sm-10">
        <input type="text" name='name' class="form-control" id="NAME" placeholder="Enter your name">
      </div>
    </div>
		 <div class="form-group">
      <label class="control-label col-sm-2" for="NAME">User_name: </label>
      <div class="col-sm-10">
        <input type="text" name='user_name' class="form-control" id="NAME" placeholder="Enter your  user_name">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="email">Email:</label>
      <div class="col-sm-10">
        <input type="email" name='email' class="form-control" id="email" placeholder="Enter email">
      </div>
    </div>
	
    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Password:</label>
      <div class="col-sm-10">          
        <input type="password"  name='password' class="form-control" id="pwd" placeholder="Enter password">
      </div>
    </div>
	<div class="form-group">
      <label class="control-label col-sm-2" for="age">Age : </label>
      <div class="col-sm-10">
        <input type="number" name='age' class="form-control" id="age" placeholder="Enter your age">
      </div>
    </div>
	<div class="form-group">
  <label for="ac">Gender:</label>
  <select class="form-control" id="ac" name='gender'>
     <option value ="male" > male</option>
	 <option value ="female" > female</option>
  </select>
</div>
	<div class="form-group">
  <label for="sel1">User type:</label>
  <select class="form-control" id="sel1" name='type'>
     <option value ="Admin" > admin </option>
	 <option value ="User" > user </option>
  </select>
</div>
	<div class="form-group">
  <label for="ac">Active :</label>
  <select class="form-control" id="ac" name='active'>
     <option value ="1" > Enable</option>
	 <option value ="0" > Disable</option>
  </select>
</div>


 <div class="form-group">
                            <div id="divMobile" class="has-feedback">
                                <input type="tel" id="mobile" name="mobile" minlength="9" class="form-control input-lg"
                                       placeholder="رقم المحمول" >
                                <i class="fa fa-phone fa-lg form-control-feedback"></i>
                            </div>
                        </div>

  <div class="form-group form-group-lg">
                            <div id="divProvince" class="has-feedback">
                                <select id="province" name="province" class="option-box form-control" title="">
                                    <option value="Unknown">المحافضة</option>
                                    <option value="Sanaa">صنعاء</option>
                                    <option value="Taiz">تعز</option>
                                    <option value="Aden">عدن</option>
                                    <option value="Hodidah">الحديدة</option>
                                    <option value="Ibb">إب</option>
                                    <option value="Hadramoot">حضرموت</option>
                                    <option value="Shabuah">شبوة</option>
                                    <option value="Thamar">ذمار</option>
									 
                                    <option value="mahweet">المحويت</option>
                                   
                                </select>
                                <i class="fa fa-home fa-lg form-control-feedback"></i>
                            </div>
                        </div>

<div class="form-group">
      <label class="control-label col-sm-2" for="pwd">images:</label>
      <div class="col-sm-10">          
        <input type="file"  name='fname' class="form-control" id="pwd" >
      </div>
    </div>
  
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-default" name='sbmt' >Submit</button>
      </div>
    </div>
  </form>
</div>



</div>
</div>
</div>
<?php



include "Footer.php";
?>
