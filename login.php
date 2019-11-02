<?php
//session_start() ;


	//header('location:db.php');



include "Admin/conn.php" ;   
include "Header.php";
if(isset($_POST['sbmt'],$_POST['name'],$_POST['password'] ))
{

  $name=strip_tags($_POST['name']);
  $password=strip_tags($_POST['password']);
  $sql="select * from users where user_name='".$name."'";      
    if ($qry=mysqli_query($con,$sql)) 
	{

		  if (mysqli_num_rows($qry) )
		  {
			
		$row=mysqli_fetch_array($qry);
		
		
		$newpass=md5($password.$row['salt']);
	//	$newpass=$password;
		  if ($newpass==$row['password'] )
		  {
		if ($row['active']==1){
              	session_start();
	        	$_SESSION['username']=$row['user_name'];
		        $_SESSION['type']=$row['type'] ;
		        $_SESSION['id']=$row['id'] ;
		        $_SESSION['active']=$row['active'] ;
	
	               echo " <script>location.replace('index.php') </script> " ;
                       }
					   
	        else 
				
                   echo " <script > alert('حسابك غير مفعل حاليا ') ; </script>	 "  ;

		
		}
		
		}
	else 
		echo " <script > alert('كلمة المرور  او اسمالمستخدم خطا ') ; </script>	 "  ;
	
	}		
		else 
			echo "error :".mysqli_error($con);
	
	
	
}




?>



<div class="container-fluid content-wrapper text-center">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="card card-container">
		  
  <h2> <div class="card-header">تسجيل الدخول</div></h2>
  <form class="form-horizontal" role="form" action="#" method=post enctype='multipart/form-data'>
   <div class="form-group">
      <label class="control-label col-sm-2" for="NAME">اسم المستخدم : </label>
      <div class="col-sm-10">
        <input type="text" name='name' class="form-control" id="NAME" placeholder="Enter your name">
      </div>
    </div>
  
	
    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">كلمة المرور:</label>
      <div class="col-sm-10">          
        <input type="password"  name='password' class="form-control" id="pwd" placeholder="Enter password">
      </div>
    </div>
	
      <div class="form-group">
                            <div>
                                <div id="btn-up" class="btn-group">
                                    <button type="reset" id="reset" class="btn btn-default">تفريغ </button>
                                     <button type="submit" class="btn btn-default" name='sbmt' >Submit</button>
                                </div>
                            </div>
                        </div>
  </form>
</div>

<div class="text-center">
 <a class="btn btn-primary btn-block"href="register.php">انشاء حساب جديد</a>
       
</div>
</div>	
</div>
</div>
					
					
       
     
  <?php
   
include "footer.php";
?>