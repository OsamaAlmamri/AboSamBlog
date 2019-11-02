

<?php
session_start();
//header('location:login.php');
include "Admin/conn.php" ;


	include "Header.php";
	

	
	
	if ($con) 
	{
		
	$sql="select * from  bllog where type='".$_GET['type']."'";
		//$sql="select * from  bllog where type='news'" ;
		$result=mysqli_query($con,$sql) ;
		$count=mysqli_affected_rows($con) ;
		if ($count==0)
			echo "<h1 class='text-center'> ليس هناك اخبار حاليا </h1>";
			
				echo "
			<div style='margin-top: 50px;'>
				 <div class='container text-center'>
				
		    
				<div class='text-primary' style='padding: 5px 0px 5px 0px; margin-top: -25px;'>
				 <div class=' navbar-left search'>
				         <form  action='#' method='post'>
				  <div class='form-group has-feedback'>
                
                <input type='text' value='' name='search' placeholder='search...'>
        
			<input type='submit' value='بحث' name='send'  class='btn btn-primary' />

            </div>
			</form>
			</div>
		</div>
        
        </div>
		";
			if (isset($_POST['search']))
		{
			$where=" and text like '%".mysqli_real_escape_string($con,$_POST['search'])."%'";
			
		}
		else
			$where="";
		$sql="select * from  bllog where type='".$_GET['type']."' ".$where;
		$result=mysqli_query($con,$sql) ;
		$count=mysqli_affected_rows($con) ;
			//echo $count;
			if ((@$_POST['search']!=''))
			echo " <p class='h1'> نتائج البحث =  ".$count." </p> ";
		
			
			while ( $row=mysqli_fetch_array($result))
			{
				
			echo "
        <div class='row'>
                <div class='col-md-12 product-div'>
                    <div class='col-md-6'>
                        <div style='padding: 5px 0px 5px 0px;'>
                            <p class='h1'>".$row['title']."</p>
                            <p> ".substr(nl2br($row['text']),0,400)."</p>
                           <a href='detials.php?id=".$row['id']."'> <button class='btn btn-primary'>مزيد من التفاصيل</button> </a>

                        </div>
                    </div>
				 <div class='col-md-6'>
                        <img src='Admin/images/".$row['image']."' class='img-responsive' width=400 height=600  alt='".$row['image']."'>
                    </div>
                </div>
				 </div>
       ";
				
				
	      }
		  if (isset($_POST['search']) )
					if ($count>0)
                          echo "  <div class='col-md-12' align='center'>
					   
                              <div style='padding: 10px 5px 5px 0px;'>
                              <a href='pages.php?type=".$_GET['type']."'> <button class='btn btn-primary'>رجوع</button> </a>
                              </div>
                           ";
				    else 
						echo  "  <div class='col-md-12' align='center'>
					            <p class='h1'> لا توجد كلمة مطابقة ل ".$_POST['search']." </p>
                              <div style='padding: 10px 5px 5px 0px;'>
                              <a href='pages.php?type=".$_GET['type']."'> <button class='btn btn-primary'>رجوع</button> </a>
                              </div>
                           ";

	
	}
	
		echo "   </div>
				 </div>";
	
?>





<?php


include "Footer.php";
?>