<?php 

include "Admin/conn.php" ;

include "Header.php";

if(@$_POST['send']){
    $name = mysqli_real_escape_string($con,strip_tags($_POST['name']));
    $email = mysqli_real_escape_string($con,strip_tags($_POST['email']));
    $subject = mysqli_real_escape_string($con,strip_tags($_POST['subject']));
    $content = mysqli_real_escape_string($con,strip_tags(addslashes($_POST['content'])));
    $contactErrors = array();
    
    if(empty($name) || empty($email) || empty($subject) || empty($content)){
       $contactErrors[] = "All Fields Are Requierd"; 
    }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $contactErrors[] = "This is not Email";
    }  else {
        $contact_sql = "INSERT INTO contact (name,email,subject,content,type) 
                                     VALUES ('$name','$email','$subject','$content','user')";
        $contact_query = mysqli_query($con,$contact_sql) or die(mysqli_error());
        
    }
}


                        if(@$contact_query)
                            echo '<h2 class="success">Message send  successfully<h2>';
				          
                        
                        if(@$contactErrors){
                            foreach ($contactErrors as $error){
                                echo '<h2 class="error">'.$error.'</h2>';
                            }
                        }
                        
 ?>
		
		
	
		
		
		
	
	<div class='content-wrapper container text-center'>
    <div class='card card-container'>
        <h4>رأيك يهمنا </h4>
        <form id='contactForm' action='#' method='post'>
            <div class='form-group has-feedback'>
                <input type='text' name='name' class='form-control input-lg' placeholder='الأسم'/>
                <i class='fa fa-user fa-lg form-control-feedback'></i>
            </div>
            <div class='form-group has-feedback'>
                <input type='email' name='email' class='form-control input-lg' placeholder='البريد الألكتروني'/>
                <i class='fa fa-envelope fa-lg form-control-feedback'></i>
            </div>
			
			<div class='form-group has-feedback'>
                <input type='text' name='subject' class='form-control input-lg' placeholder='الموضوع'/>
                <i class='fa fa-user fa-lg form-control-feedback'></i>
            </div> 
			
            <div class='form-group has-feedback'>
                <textarea title='message' name='content' rows='10' class='form-control input-lg' placeholder='رسالتك'></textarea>
                <i class='fa fa-comment fa-lg form-control-feedback'></i>
            </div>
            <div class='form-group'>
			 
			<input type="submit" value="إرسال" name="send"  class='btn btn-primary btn-block' />

                   
                
            </div>
            <div id='label' class='bg-danger'></div>
        </form>
    </div>
</div>
		
		
		

	
	<?php include'footer.php';  ?>
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	