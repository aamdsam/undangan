<?php
error_reporting(0);
session_start();
if ($_SESSION['login_pelamonia'] == 1){
  header("location: media.php");
}
?>
<!DOCTYPE html>
<html lang="en"  class="body-error">
<!-- Mirrored from nightskyadmin.com/demo/template/index.html by HTTrack Website Copier/3.x [XR&CO'2013], Thu, 12 Sep 2013 02:04:20 GMT -->
<head>
    <meta charset="utf-8">
    <title>FK UNISMUH </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="css/login.css" rel="stylesheet">
    <link href="css/bootstrap.css" rel="stylesheet">


	<link rel="stylesheet" href="css/icon/font-awesome.css">    
    <link rel="stylesheet" href="css/bootstrap-responsive.css">
	
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="http://nightskyadmin.com/images/icons/favicon.ico">
    
  </head>

  <body>

        <div id="wrapper">
            <div id="login" class="animate form position">
                <form action="cek_login.php" class="form-login" method="post"> 
                    <div class="content-login">
                    <div class="header">Account Login</div>
                    
                    <div class="inputs">
                        <input name="username" type="text" placeholder="Username" />
                        <input name="password" type="password"  placeholder="Password" />
                    </div>
                    

                    <div class="clear"></div>
                    <div class="button-login"><input type="submit" class="" value="Sign In"></div>
                    </div>
                    
                    <div class="footer-login">
                     
                     <div class="clear"></div>
                    </div>
                   
                </form>

            </div>
     
             
    </div>  
    
   
    
    

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery.min.js"></script>


  </body>

<!-- Mirrored from nightskyadmin.com/demo/template/index.html by HTTrack Website Copier/3.x [XR&CO'2013], Thu, 12 Sep 2013 02:04:20 GMT -->
</html>

