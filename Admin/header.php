



<!DOCTYPE html>
<html dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="images/logo2.png">
    <title>Abo Sam Bllog</title>
    <link rel="stylesheet" href="../css/animate.css">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/font-awesome.css">
    <link rel="stylesheet" href="../css/carousel.css">
    <link rel="stylesheet" href="../css/card.css">
    <link rel="stylesheet" href="../css/mysheet.css">
</head>
<body>
<?php 
@session_start() ; 



       

if  (@$_SESSION['type']=='Admin')
echo "
<div id='up'></div>
        <div class='navbar navbar-inverse navbar-fixed-top'>
            <div class='container'>
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
                         
                                				

                         <li><a href='commont.php'>التعليقات</a></li>
                     
						     <li><a href='select_bllog.php'>المدونات</a></li>
              <li><a href='user_info.php'>المستخدمين </a></li>		

						       
             
			    <li><a href='../index.php'>صفحة المستخدمين  </a></li>
         
			  
                    </ul>
                  
                    
                   
                        <ul class='nav navbar-nav'> 
                            <li class='dropdown '>
                                <a href='' class='dropdown-toggle' data-toggle='dropdown'>
                                   المزيد <i class='fa fa-caret-down'></i></a>
                                <ul class='dropdown-menu'>
";
 if (isset($_SESSION,$_SESSION['username']) )
                    echo "                                   
								   <li >
                                        <a href='../profile.php'>الملف الشخصي <i class='glyphicon glyphicon-user'></i></a></li>
                                    <li  >
                                        <a href='../logout.php'> تسجيل خروج <i class='glyphicon glyphicon-log-out'></i></a></li>
                               ";
			
							echo"
                    </ul>
                  
                </div>
            </div>
        </div>
		<br><br><br>
		";
	
		?>