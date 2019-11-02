


<?php
include "Admin/conn.php" ;   
include "Header.php";
if(isset($_POST['sbmt'],$_POST['name'],$_POST['user_name'],$_POST['email'],$_POST['password'],$_POST['province'],$_POST['mobile']))
{

$image = $_FILES['fname'] ['name'] ;
$f_type= $_FILES['fname'] ['type'] ;
$file_tmp= $_FILES['fname'] ['tmp_name'] ;
$size = $_FILES['fname'] ['size'] ;
$types=array('image/jpeg','image/gif','image/png') ;
$name=mysqli_real_escape_string($con, strip_tags($_POST['name']));
		$user_name=mysqli_real_escape_string($con, strip_tags($_POST['user_name']));
		$password=mysqli_real_escape_string($con, strip_tags($_POST['password']));
		$salt=time();
	//	$password=md5($password.$salt);
		$email=mysqli_real_escape_string($con, strip_tags($_POST['email']));
		$time = date("D- y/m/j ") ;
		$province=$_POST['province'] ;
		$mobile=strip_tags($_POST['mobile']) ;
		$age=strip_tags($_POST['age']) ;
		$gender=($_POST['gender']) ;
		
		
		        if(empty($name) || empty($email) || empty($password) || empty($mobile))
                  echo  "All Fields Are Requierd"; 
   // alert("uuuuuuuuuuuuuu");
	               if (strlen($password) <6)
		        	echo "password cannot be less than 6 character " ;

         else  {
		
		     	 $checkuser="select * from users where user_name='".$user_name."'";
                if ($qry=mysqli_query($con,$checkuser)) 
	               if (mysqli_num_rows($qry) )
	                   echo " <script > alert('this user_name is used Please select anther user_name') ; </script>	 "  ;		              
				//  echo "this user_name is used Please select anther user_name " ;
			             
                   else {
			  
		if ( isset ($_FILES ) )
{
	if ( in_array($f_type,$types)) 
	{
		 $check="select * from users where image='".$image."'";
    if ($qry=mysqli_query($con,$check)) 
	 if (mysqli_num_rows($qry) )
		       $image=$name.$image;

	if (move_uploaded_file($file_tmp ,'Admin/images/'.$image) )	
	
		$image_find=$image ;
	else 
		$image_find='';
	}
	
	else{
		echo "the type not allowed " ;
	$image_find='';
	}
	
}
		$password=md5($password.$salt);
		$sql= "insert into users (name ,user_name,password,type,email,mobile,provice ,create_at ,image,active ,salt,gender,age)
		values ('$name','$user_name','$password' ,'user','$email','$mobile','$province','$time','$image_find',0,$salt,'$gender',$age) ";

		if ($qry=mysqli_query($con,$sql) )
		{
				echo " <script>location.replace('login.php') </script> " ; 
			//header('location:login.php');
		}else{
			echo "error :".mysqli_error($con);
		}
}
			   }
}
?>


<div class="container-fluid content-wrapper text-center">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="card card-container">
	
     


  <h2> <div class="card-header">انشاء حساب جديد</div></h2>
  <form class="form-horizontal" role="form" action="#" method=post enctype='multipart/form-data'>
   <div class="form-group">
      <label class="control-label col-sm-2" for="NAME">الاسم كامل : </label>
      <div class="col-sm-10">
        <input type="text" name='name' class="form-control" id="NAME" placeholder="Enter your name">
      </div>
    </div>
	 <div class="form-group">
      <label class="control-label col-sm-2" for="NAME">اسم المستخدم : </label>
      <div class="col-sm-10">
        <input type="text" name='user_name' class="form-control" id="NAME" placeholder="Enter your  user_name">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="email">الايميل:</label>
      <div class="col-sm-10">
        <input type="email" name='email' class="form-control" id="email" placeholder="Enter email">
      </div>
    </div>
	
    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">كلمة المرور:</label>
      <div class="col-sm-10">          
        <input type="password"  name='password' class="form-control" id="pwd" placeholder="Enter password">
      </div>
    </div>
	
		<div class="form-group">
      <label class="control-label col-sm-2" for="age">العمر : </label>
      <div class="col-sm-10">
        <input type="number" name='age' class="form-control" id="age" placeholder="Enter your age">
      </div>
    </div>
	<div class="form-group">
  <label for="ac">الجنس:</label>
  <select class="form-control" id="ac" name='gender'>
     <option value ="male" > ذكر</option>
	 <option value ="female" > انثى</option>
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
                            <div>
                                <div id="btn-up" class="btn-group">
                                    <button type="reset" id="reset" class="btn btn-default">تفريغ </button>
                                     <button type="submit" class="btn btn-default" name='sbmt' >تسجيل</button>
                                </div>
                            </div>
                        </div>
  </form>
</div>
 <div class="text-center">
  <a class="btn btn-primary btn-block" href="login.php">  هل لديك حساب من قبل</a>
       
</div>
</div>
</div>
</div>


 
 

      
       


<?php



include "Footer.php";

?>