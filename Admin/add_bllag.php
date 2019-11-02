0+-<?php
include "conn.php" ;   
include "Header.php";
if(isset($_POST['sbmt'],$_POST['name'],$_POST['title']))
{


		$name=strip_tags($_POST['name']);
		$type=strip_tags($_POST['type']);
		$time = date("D- y/m/j  h-i-s ") ;
	
		$title=strip_tags($_POST['title']) ;
		$image=array();
		$f_type=array();
		$file_tmp=array();
		$text=array();
		$image_find=array();
		for ($i=1;$i<=6; $i++)
{
$image[$i] = $_FILES["fname".$i] ['name'] ;
$f_type[$i]= $_FILES["fname".$i] ['type'] ;
$file_tmp[$i]= $_FILES["fname".$i] ['tmp_name'] ;
$text[$i]=strip_tags($_POST["text".$i]);


$types=array('image/jpeg','image/gif','image/png') ;

	
		
			if ( isset ($_FILES ) )
{
	if ( in_array($f_type[$i],$types)) 
	{
		 $check="select * from users where image='".$image[$i]."'";
    if ($qry=mysqli_query($con,$check)) 
	 if (mysqli_num_rows($qry) )
		       $image[$i]=$name.$image[$i];

	if (move_uploaded_file($file_tmp[$i] ,'images/'.$image[$i]) )	
	
		$image_find[$i]=$image[$i] ;
	else 
		$image_find[$i]='';
	}
	
	else{
		echo "the type not allowed " ;
	$image_find[$i]='';
	}
}
	
}
		
		$sql= "insert into bllog (author ,type,text,id_p,title ,image,date_p ,image2,image3,image4,image5,image6,text2,text3,text4,text5,text6) 
		values ('$name','$type','$text[1]' ,1,'$title','$image_find[1]','$time','$image_find[2]','$image_find[3]','$image_find[4]','$image_find[5]',
		'$image_find[6]','$text[2]','$text[3]','$text[4]','$text[5]','$text[6]' ) ";

		if ($qry=mysqli_query($con,$sql) )
		{
						  	echo " <script>location.replace('select_bllog.php') </script> " ; 
		//	header('location:select_bllog.php');
		}else{
			echo "error :".mysqli_error($con);
		}
}


?>



<div class='container-fluid content-wrapper'>
    <div class='row'>
        <div class='col-md-6 col-md-offset-3'>
            <div class='card card-container'>
	
     
 <h2> <div class="card-header">Add Bllog</div></h2>
  <form class="form-horizontal" role="form" action="#" method=post enctype='multipart/form-data'>
   <div class="form-group">
      <label class="control-label col-sm-2" for="title">Tittle of bllag : </label>
      <div class="col-sm-10">
        <input type="text" name='title' class="form-control" id="title" placeholder="Enter blagg tittle">
      </div>
    </div>
	<div class="form-group">
      <label class="control-label col-sm-2" for="NAME">Auoher NAME : </label>
      <div class="col-sm-10">
        <input type="text" name='name' class="form-control" id="NAME" placeholder="auther name">
      </div>
    </div>
		<div class="form-group">
  <label for="sel1">type bllog:</label>
  <select class="form-control" id="sel1" name='type'>
     <option value ="bllog" > bllog </option>
	 <option value ="news" > news </option>
	  <option value ="news" > sports </option>
  </select>
</div>
<?php 
$n=6;
for ($i=1;$i<=$n; $i++)
{
	echo "
	  <div class='form-group'>
       <label for='comment".$i."'>part ". ($i) ." :</label>
      <textarea class='form-control' rows='5'  name='text".$i."' id='comment".$i."'  ></textarea>
      </div>
 
	
	";
	
	echo "	
	   <div class='form-group'>
      <label class='control-label col-sm-2' for='pwd".$i."'>image ".($i) .":</label>
      <div class='col-sm-10'>          
        <input type='file'  name='fname".$i."' class='form-control' id='pwd".$i."' >
      </div>
    </div>
	
	
	"; 
	
}


?>
	
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
