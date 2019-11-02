<?php
@session_start() ; 

if  (@$_SESSION['type']=='Admin')
{
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
			   
			 echo "  <div class='container-fluid content-wrapper'>
    <div class='row'>
        <div class='col-md-6 col-md-offset-3'>
            <div class='card card-container'>
		  
  <h2> <div class='card-header'>update user</div></h2>
  <form class='form-horizontal' role='form'  method=post enctype='multipart/form-data'>
   <div class='form-group'>
      <label class='control-label col-sm-2' for='NAME'>NAME : </label>
      <div class='col-sm-10'>
        <input type='text' name='name' value='".$user['name']."' class='form-control' id='NAME' placeholder='Enter your name'>
      </div>
    </div>
	 <div class='form-group'>
      <label class='control-label col-sm-2' for='NAME'>User_name: </label>
      <div class='col-sm-10'>
        <input type='text' name='user_name' value='".$user['user_name']."' class='form-control' id='NAME' placeholder='Enter your  user_name'>
      </div>
    </div>
    <div class='form-group'>
      <label class='control-label col-sm-2' for='email'>Email:</label>
      <div class='col-sm-10'>
        <input type='email' name='email' value='".$user['email']."' class='form-control' id='email' placeholder='Enter email'>
      </div>
    </div>
	
    <div class='form-group'>
      <label class='control-label col-sm-2' for='pwd'>Password:</label>
      <div class='col-sm-10'>         
        <input type='text'  name='password' value='".md5($user['password'].$user['salt'])."'class='form-control' id='pwd' placeholder='Enter password'>
      </div>
    </div>
	
		<div class='form-group'>
  <label for='ac'>Active :</label>
  <select class='form-control' id='ac' name='active'  value='".$user['active']."'>
     <option value ='1' > Enable</option>
	 <option value ='0' > Disable</option>
  </select>
</div>
	
	<div class='form-group'>
	   
                            <div id='divMobile' class='has-feedback'>
							<label class='control-label col-sm-2' for='mobile'>mobile:</label>
                                <input type='tel' id='mobile' name='mobile' value='".$user['mobile']."' minlength='9' class='form-control input-lg'
                                       placeholder='رقم المحمول' >
                                <i class='fa fa-phone fa-lg form-control-feedback'></i>
                            </div>
                        </div>
			<div class='form-group'>			
		
      نوع المستخدم  : <label><input type='radio' value ='Admin'   name='type'  " ; if ($user['type']=='Admin') echo 'checked' ;    echo" >Admin</label>
    
  
      <label><input type='radio' value ='user'  name='type' " ; if ($user['type']=='user') echo 'checked' ;    echo">  User</label>
 
    </div>
   			
						


  <div class='form-group form-group-lg'>
                            <div id='divProvince' class='has-feedback'>
                                <select id='province' name='provice'  value='".$user['provice']."' class='option-box form-control' title=''>
                                    <option value='Unknown'>المحافضة</option>
                                    <option value='Sanaa'>صنعاء</option>
                                    <option value='Taiz'>تعز</option>
                                    <option value='Aden'>عدن</option>
                                    <option value='Hodidah'>الحديدة</option>
                                    <option value='Ibb'>إب</option>
                                    <option value='Hadramoot'>حضرموت</option>
                                    <option value='Shabuah'>شبوة</option>
                                    <option value='Thamar'>ذمار</option>
									 
                                    <option value='mahweet'>المحويت</option>
                                   
                                </select>
                                <i class='fa fa-home fa-lg form-control-feedback'></i>
                            </div>
                        </div>
	
	
	<div class='form-group'>
      <label class='control-label col-sm-2' for='pwd'>images:</label>
      <div class='col-sm-10'>          
        <input type='file'  name='fname'  class='form-control'id='pwd' >
      </div>
    </div>
  
    <div class='form-group'>        
      <div class='col-sm-offset-2 col-sm-10'>
        <button type='submit' class='btn btn-default' name='sbmt' >Submit</button>
      </div>
    </div>
  </form>
</div>
</div> </div></div>
";
   }
		

$types=array('image/jpeg','image/gif','image/png') ;
if ( isset ($_FILES ) )
{
	  $image = $_FILES['fname'] ['name'] ;
$f_type= $_FILES['fname'] ['type'] ;
$file_tmp= $_FILES['fname'] ['tmp_name'] ;
$size = $_FILES['fname'] ['size'] ;

	if ( in_array($f_type,$types)) 
	{
	if (move_uploaded_file($file_tmp ,'images/'.$image) )	
	{
		echo "sucesss <br> ";
		$image_find=$image;
	
	}
	
		else 
		$image_find=$user['image'];
	}
	else 
		$image_find=$user['image'];
	}

	if ($_POST['provice']=='Unknown')
		   $provice=$user['provice'] ;
	   else
		   $provice=$_POST['provice'];
		  if ( isset($_POST['sbmt']))
		  {
			  $upQuery="update users set name='".strip_tags($_POST['name'])."' ,user_name='".strip_tags($_POST['user_name'])."' ,type='".strip_tags($_POST['type'])."',image='".$image_find."',active=".$_POST['active']." , password='".strip_tags(md5($_POST['password'].$user['salt']))."', provice='".$provice."'  , mobile='".strip_tags($_POST['mobile'])."' ,email='".strip_tags($_POST['email'])."' where id =".$_GET['id'] ;
			  if ($qryuodate=mysqli_query($con,$upQuery)) 
				 // header ('Location:user_info.php') ;
			 	echo " <script>location.replace('user_info.php') </script> " ; 
			  else 
				  echo "error " .mysqli_error($con);
			  
		  }
		  
	    }
	
	
  }
}
else
echo "no connection" ;	


include "footer.php";
}
else 
{
	 echo " <script > alert('HHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHH ') ; </script>	 "  ;
   echo " <script>location.replace('../login.php') </script> " ;
}
?>
