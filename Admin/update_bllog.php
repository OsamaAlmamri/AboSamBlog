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
      $sql= "select * from bllog where id=" .$_GET['id'];
	 

	     if($qry=mysqli_query($con,$sql))
	    {
		  if (mysqli_num_rows($qry) )
		   {
			   $bllog=mysqli_fetch_array($qry) ;
			   
			   
			 echo "  <div class='container-fluid content-wrapper'>
    <div class='row'>
        <div class='col-md-6 col-md-offset-3'>
            <div class='card card-container'>
		  
  <h2> <div class='card-header'>update bllog</div></h2>
  <form class='form-horizontal' role='form'  method=post enctype='multipart/form-data'>
  
	  <div class='form-group'>
      <label class='control-label col-sm-2' for='title'>Tittle: </label>
      <div class='col-sm-10'>
        <input type='text' name='title' value='".$bllog['title']."' class='form-control' id='title' placeholder='Enter blagg tittle'>
      </div>
    </div>
	
	<div class='form-group'>			
		
      نوع التدوينة  : <label><input type='radio' value ='sport'   name='type'  " ; if ($bllog['type']=='sport') echo 'checked' ;    echo" >sport</label>
    
  
      <label><input type='radio' value ='bllog '  name='type' " ; if ($bllog['type']=='bllog') echo 'checked' ;    echo">  bllog </label>
	   <label><input type='radio' value ='news'  name='type' " ; if ($bllog['type']=='news') echo 'checked' ;    echo">  news</label>
 
    </div>
   		
		

	
	<div class='form-group'>
  <label for='comment'>Bllag:</label>
  <textarea class='form-control' rows='5'  name='text' value='".$bllog['text']."' id='text'  ></textarea>
</div>
   

<div class='form-group'>
      <label class='control-label col-sm-2' for='pwd'>image:</label>
      <div class='col-sm-10'>          
        <input type='file'  name='fname' value='".$bllog['image']."' class='form-control' id='pwd' >
      </div>
    </div>
  
  
  
    <div class='form-group'>        
      <div class='col-sm-offset-2 col-sm-10'>
        <button type='submit' class='btn btn-default' name='sbmt' >update </button>
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
	  @$image = $_FILES['fname'] ['name'] ;
@$f_type= $_FILES['fname'] ['type'] ;
@$file_tmp= $_FILES['fname'] ['tmp_name'] ;
@$size = $_FILES['fname'] ['size'] ;

	if ( in_array($f_type,$types)) 
	{
	if (move_uploaded_file($file_tmp ,'images/'.$image) )	
	{
		echo "sucesss <br> ";
		$image_find=$image;
	
	}
	else 
		$image_find=$bllog['image'];
	}
	else 
		$image_find=$bllog['image'];
}
	if (@$_POST['text']=="")
		$text=$bllog['text'];
	else
		$text=$_POST['text'];
		   
		  if ( isset($_POST['sbmt']))
		  {
			  $upQuery="update bllog set title='".strip_tags($_POST['title'])."' ,type='".$_POST['type']."',text='".strip_tags($text)."', image='".$image_find."'  where id =".$_GET['id'] ;
			  if ($qryuodate=mysqli_query($con,$upQuery)) 
				//  header ('Location:select_bllog.php') ;
				echo " <script>location.replace('select_bllog.php') </script> " ; 
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
