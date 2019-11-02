



<!DOCTYPE html>
<html dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="Admin/images/logo2.png">
    <title>Abo Sam Bllog</title>
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/font-awesome.css">
    <link rel="stylesheet" href="css/carousel.css">
    <link rel="stylesheet" href="css/card.css">
    <link rel="stylesheet" href="css/mysheet.css">
</head>
<body>
<?php 
@session_start() ; 




  
echo "
<div id='up'></div>
        <div class='navbar navbar-inverse navbar-fixed-top'>
            <div class='container text-center'>
                <div class='navbar-header'>
                    <button type='button' class='navbar-toggle collapsed' data-toggle='collapse' data-target='#navbarsection' aria-expanded='false' aria-controls='navbar'>
                        <span class='sr-only'>Toggle navigation</span>
                        <span class='icon-bar'></span>
                        <span class='icon-bar'></span>
                        <span class='icon-bar'></span>
                    </button>
                </div>
                <div class='navbar-collapse collapse' id='navbarsection'>
                    <ul class='nav navbar-nav navbar-right'>
                          <li><a href='contact.php'>اتصل بنا</a></li>
          <li><a href='pages.php?type=sport'>رياضة </a></li>                    				
       <li><a href='pages.php?type=bllog'>مدونات </a></li>
       <li><a href='pages.php?type=news'>اخبار </a></li>
               <li><a href='index.php'>الرئيسية </a></li>
			    ";
				if (@$_SESSION['type']=='Admin') 
	echo "  
               <li><a href='Admin/index.php'> Admin </a></li>
         " ;
			  
                 echo"   </ul>
                  
                    ";
					echo"
                   
                        <div class='navbar-collapse collapse' id='navbarsection'>
                    <ul class='nav navbar-nav navbar-left'>
					";
					 if (isset($_SESSION,$_SESSION['username']) )
						 echo"
                                    <li >
                                        <a href='profile.php'>الملف الشخصي <i class='glyphicon glyphicon-user'></i></a></li>
                                    <li  >
                                        <a href='logout.php'> تسجيل خروج <i class='glyphicon glyphicon-log-out'></i></a></li>
                               
					";
					 
						else 
							echo "
                        <li>
                            <a href='register.php'> التسجيل في موقعنا <i class='glyphicon glyphicon-edit'></i>
                            </a></li>
                        <li >
                            <a href='login.php'> تسجيل دخول <i class='glyphicon glyphicon-log-in'></i></a></li>
							
							";
							
							
							
							echo "
                    </ul>
                  
                </div></div>
            </div>
        </div>
		<br><br><br>
		";
		?>