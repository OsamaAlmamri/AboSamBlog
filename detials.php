<?php

include "Header.php";
include "Admin/conn.php" ;
if(isset($_GET,$_GET['id']))	
{
	$previousPage=$_SERVER['HTTP_REFERER'] ;
	$sql="select * from  bllog where id=".$_GET['id'];
		$result=mysqli_query($con,$sql) ;
		$row=mysqli_fetch_array($result) ;
		
		// اذا الخبر يحتوي على صورة واحدة ومقطع واحد
echo " 
                <div class='row'>
                <div class='col-md-12 product-div  text-center'>
				<p class='h1'> ".$row['title']." </p>
				 <div class='col-md-14' align=center>
				 <img src='Admin/images/".$row['image']."' class='img-responsive'>
                    </div>
					
					
					
					
                    <div class='col-md-12'>
                        <div style='padding: 10px 5px 5px 0px;'>
                       <p> ".nl2br($row['text'])."</p>
					     </div>
                    </div>
                   ";
				  
				  
				   	for ($i=2;$i<=6; $i++)  //تبع الخبر الذي يحتوي على اكثر من صورة
				{
				
				echo" <div class='col-md-14' align=center>
				 <img src='Admin/images/";echo $row["image".$i]; echo "' class='img-responsive' class='img-thumbnail' alt =' ' width='404' height='336'>
                    </div>
					
					
					
					
                    <div class='col-md-12'>
                        <div style='padding: 10px 5px 5px 0px;'>
                       <p> "; echo nl2br($row["text".$i]) ; echo "</p>
                         

                        </div>
                    </div>
                   ";
				   }
				   
				   echo"
				     <a href='".$previousPage."'> <button class='btn btn-primary'>رجوع</button> </a>
                </div>
				 </div>
				 
				 
				   <h1>التعليقات</h1>
";


$gid =$_GET['id'];

if(isset($_POST['comm_submit']))
{
    $comm_content =mysqli_real_escape_string($con, trim(nl2br(strip_tags(addslashes($_POST['comm_content'])))));
	
    
    if(empty($comm_content))
         echo  " Comment content can not null";
    
	
	else{
	$d=date();
	$U_id=$_SESSION['id'] ;

        $insertCommData = "INSERT INTO    comment (user_id ,text,bllog_id,date_p)
                                          VALUES($U_id,'$comm_content',$gid,'$d') ";
       $insertCommDataQuery = mysqli_query($con,$insertCommData) or die(mysqli_error());
        
    }
}
}


$getCommData = "SELECT * FROM comment WHERE bllog_id='$gid' ";
$getCommDataQuery = mysqli_query($con,$getCommData) or die(mysqli_error());
$getCommNum = mysqli_num_rows($getCommDataQuery);

echo "<div style='margin-top: 50px;'>
				 <div class='container'>
				<div class='text-primary' style='padding: 5px 0px 5px 0px; margin-top: -25px;'>
				";
if($getCommNum > 0 ){// one or more comment

    while ($getCommDatarow = mysqli_fetch_array($getCommDataQuery))
	{
		
		$sqlI= "select * from users where id=" .$getCommDatarow['user_id'];
	 
//get user image
	     if($qryI=mysqli_query($con,$sqlI))
	    {
		  if (mysqli_num_rows($qryI) )
		   {
			   $user=mysqli_fetch_array($qryI) ;
			 
			
        echo "
            <p class='comm'>
                <img width='80' height='80' src='Admin/images/".$user['image']."' />
               <big> <big class='username'>".$user['name']."</big> </big>
                <h4>".  stripslashes($getCommDatarow['text'])."</h4>
            </p>
    ";
    } }
		   }
}
else{// no comment
    echo 'There isn\'t Comment for this post';
	
	
	echo " </div> </div> </div>  " ;
}
?>
                        <br /><br /><br />
                     <div id="content">
                        
<?php
if(@$insertCommDataQuery){// check if updateing is done
        echo '<h2 class="success"> Comment was added<br /> But waiting management review </h2>';
		
			echo " <script>location.replace('detials.php?id=".$_GET['id']."') </script> " ; 
      
}



if (isset($_SESSION,$_SESSION['username']))
echo "

	
	<div class='content-wrapper container'>
    <div class='card card-container'>
        <h4>تــعــلــيــق</h4>
        <form id='contactForm' action='#' method='post'>

            <div class='form-group has-feedback'>
                <textarea title='message' rows='10' name='comm_content' class='form-control input-lg' placeholder='رسالتك'></textarea>
                <i class='fa fa-comment fa-lg form-control-feedback'></i>
            </div>
            <div class='form-group'>
                <button type='submit' class='btn btn-primary'  name='comm_submit' data-toggle='tooltip' data-placement='left' title='Send'> إرسال
                    <i class=' glyphicon glyphicon-send'></i>
                </button>
            </div>
            <div id='label' class='bg-danger'></div>
        </form>
    </div>
</div>
		
		
		
	
" ; 

 include "Footer.php";
				 
			
?>
				 