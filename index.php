

<?php
@session_start();
include "Admin/conn.php" ;
	include "Header.php";
	
	if ($con) 
	{
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
		
		if (@$_GET['p']=='') 
			$n=1;
		else
			$n=(int)$_GET['p'];
		
		if (isset($_POST['search']))
		{
			
			$where="  where text like '%".mysqli_real_escape_string($con,$_POST['search'])."%'  ";
			$n=1;
		}
		else
			$where="  ";
		/*  للحصول على ids  */
		$sqln="select id from  bllog  ".$where;
		$resultn=mysqli_query($con,$sqln) ;
		$countn=mysqli_affected_rows($con) ;
			 $nofp=ceil($countn/4); 
			$ids=array();
			
			while ( $rown=mysqli_fetch_array($resultn))
			{
			$ids[]=	$rown['id'];
			
			}
				/* نهاية  للحصول على ids  */
			
		$row=array();
		for ($i=0;$i<count($ids) ;$i++ ){
			
		$sql="select * from  bllog  where id = ".(int)$ids[$i] ;
		$result=mysqli_query($con,$sql) ;
		$count=mysqli_affected_rows($con) ;
	$row[]=mysqli_fetch_array($result) ;
	     }	
			if ((@$_POST['search']!=''))
			echo " <p class='h1'> نتائج البحث =  ".$countn." </p> ";
	
	/*  تبع ال pageing */
         $start=(($n-1 )*4) ;
		if ($nofp==($n) )
			$end=$countn;
		else
			$end=($n*4) ;
		
			if ($countn==0)
				$end=$nofp=0;
			
			for ($i=$start;$i<$end;$i++  )
			{
					echo "
        <div class='row'>
                <div class='col-md-12 product-div'>
                    <div class='col-md-6'>
                        <div style='padding: 5px 0px 5px 0px;'>
                            <p class='h1'>".$row[$i]['title']."</p>
                            <p> ".substr(nl2br($row[$i]['text']),0,400)."...</p>
                           <a href='detials.php?id=".$row[$i]['id']."'> <button class='btn btn-primary'>مزيد من التفاصيل</button> </a>

                        </div>
                    </div>
				 <div class='col-md-6'>
                        <img src='Admin/images/".$row[$i]['image']."' class='img-responsive' width=400 height=600 alt='".$row[$i]['image']."'>
                    </div>
                </div>
				 </div>
       ";
	}
			
		  //pageing
			 echo "<div class='container'>
             
             <ul class='pagination pagination-sm'>";
		
		
			for( $i=1 ;$i<=$nofp ; $i++ )
			
         echo "  <li><a href='index.php?p=".$i."'>".$i."</a></li> " ;
        
		
			echo " </ul>
         </div>";  //end pageing
			 
		 
	        if (isset($_POST['search']) )
					if ($countn==0)
						echo  "  <div class='col-md-12' align='center'>
					            <p class='h1'> لا توجد كلمة مطابقة ل ".$_POST['search']." </p>
                              <div style='padding: 10px 5px 5px 0px;'>
                              <a href='index.php'> <button class='btn btn-primary'>رجوع</button> </a>
                              </div>
                           ";
                         
				    else 
						 echo "  <div class='col-md-12' align='center'>
					   
                              <div style='padding: 10px 5px 5px 0px;'>
                              <a href='index.php'> <button class='btn btn-primary'>رجوع</button> </a>
                              </div>
                           ";
						
					
				
	
	}
	
		echo "   </div>
				 </div>";
	
?>





<?php


include "Footer.php";
?>