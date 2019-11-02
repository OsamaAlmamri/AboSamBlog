


<?php
@session_start() ; 

if  (@$_SESSION['type']=='Admin')
{
//header('location:login.php');
include "conn.php" ;
	include "Header.php";
	
	if ($con) 
	{
		$sql="select * from  bllog " ;
		if($result=mysqli_query($con,$sql) )
		{
				echo "
				<div style='margin-top: 50px;'>
				 <div class='container'>
				<div class='text-primary' style='padding: 5px 0px 5px 0px; margin-top: -25px;'>
            <h1 class='text-center'>احدث المدونات </h1>
        </div>
		";
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
                        <img src='images/".$row['image']."' class='img-responsive' alt='".$row['image']."'>
                    </div>
                </div>
				 </div>
       ";
				
				
	      }

	
	}
	
		echo "   </div>
				 </div>";
	}

include "Footer.php";
}
else 
{
	 echo " <script > alert('HHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHH ') ; </script>	 "  ;
   echo " <script>location.replace('../login.php') </script> " ;
}
?>