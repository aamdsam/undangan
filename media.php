  <?php
  session_start();
  ob_start();
  $_SESSION['query_string']=$_SERVER['QUERY_STRING'];
  if ($_GET['menu']){ 
  	$_SESSION['menu']=$_GET['menu'];
  }
  

include "config/koneksi.php";
include "config/fungsi_indotgl.php";
include "config/library.php";
include "library/check_login.php";
include "library/formatUang.php";
include "config/selisi_waktu.php";
  ?>
<!DOCTYPE html>
<html lang="en">
<!-- Mirrored from nightskyadmin.com/demo/template/dashboard.html by HTTrack Website Copier/3.x [XR&CO'2013], Thu, 12 Sep 2013 02:00:57 GMT -->
<head>
    <meta charset="utf-8">
    <title> FK UNISMUH</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/bootstrap.css" rel="stylesheet">

    
    <link rel="stylesheet" href="css/jquery-ui-1.8.16.custom.css" media="screen"  />

    <link rel="stylesheet" href="css/fullcalendar.css" media="screen"  />
    <link rel="stylesheet" href="css/chosen.css" media="screen"  />
    <link rel="stylesheet" href="css/glisse942e.css?1.css">
    <link rel="stylesheet" href="css/jquery.jgrowl.css">
    <link rel="stylesheet" href="css/demo_table.css" >
    <link rel="stylesheet" href="css/jquery.fancybox63b9.css?v=2.1.4" media="screen" />
    <link rel="stylesheet" href="css/cupertino/jquery.ui.all.css" type="text/css">
    
	<link rel="stylesheet" href="css/icon/font-awesome.css">    
    <link rel="stylesheet" href="css/bootstrap-responsive.css">
    
    <link rel="alternate stylesheet" type="text/css" media="screen" title="green-theme" href="css/color/green.css" />
	<link rel="alternate stylesheet" type="text/css" media="screen" title="red-theme" href="css/color/red.css" />
	<link rel="alternate stylesheet" type="text/css" media="screen" title="blue-theme" href="css/color/blue.css" />
    <link rel="alternate stylesheet" type="text/css" media="screen" title="orange-theme" href="css/color/orange.css" />
    <link rel="alternate stylesheet" type="text/css" media="screen" title="purple-theme" href="css/color/purple.css" />

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

        <script src="js/jquery.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>

    
    <script language="JavaScript">
    function ambil_submenu(a){
      $.ajax({
        type:"GET",
        url:"sub_menu.php",
        data:"aksi=t_sub_menu&mid="+a,
        success:function(data){  
          $("#tempat_submenu").html(data);
        } 
      })
    }

  $(document).ready(function(){   


 })

  
      function MM_openBrWindow(theURL,winName,features) { //v2.0
        window.open(theURL,winName,features);
      }

      function MM_goToURL() { //v3.0
        var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
        for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
      }

	Firefox = navigator.userAgent.indexOf("Firefox") >= 0;
	if(Firefox) document.write("<link rel='stylesheet' href='css/moz.css' type='text/css'>"); 
	</script>
    
    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="http://www.ubiquityhosting.com/error404.php">
    
  </head>

  <body>
    <!--BEGIN HEADER-->
    <div id="header" role="banner">
       <a id="menu-link" class="head-button-link menu-hide" href="#menu"><span>Menu</span></a>
       <!--Logo--><a href="dashboard.html" class="logo"><h1>Night Sky</h1></a><!--Logo END-->
       
       <!--Search-->
       <form class="search" action="#">
         <input type="text" name="q" placeholder="Search...">
       </form>
       <!--Search END-->
       
       <div class="right">
       
       <!--message box-->
         
       <!--message box end-->
       
       <!--notification box-->
         
       <!--notification box end-->
       
       <!--config box-->
         <div class="dropdown left">
          <a class="dropdown-toggle head-button-link config" data-toggle="dropdown" href="#"></a>
          <div class="dropdown-menu pull-right settings-box">
          <div class="triangle-2"></div>
          
            <a href="javascript:chooseStyle('none', 30)" class="settings-link"></a>
            <a href="javascript:chooseStyle('blue-theme', 30)" class="settings-link blue"></a>
            <a href="javascript:chooseStyle('green-theme', 30)" class="settings-link green"></a>
            <a href="javascript:chooseStyle('purple-theme', 30)" class="settings-link purple"></a>
            <a href="javascript:chooseStyle('orange-theme', 30)" class="settings-link yellow"></a>
            <a href="javascript:chooseStyle('red-theme', 30)" class="settings-link red"></a>
            <div class="clearfix"></div>
          </div>
        </div>
       <!--config box end-->
       
       <!--profile box-->
         <div class="dropdown left profile">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            <span class="double-spacer"></span>
            <div class="profile-avatar"><img src="images/avatar.png" alt=""></div>
            <div class="profile-username"><span>Welcome,</span> <?php echo $_SESSION['nama_lengkap_pelamonia'];   ?></div>
            <div class="profile-caret"> <span class="caret"></span></div>
            <span class="double-spacer"></span>
          </a>
          <div class="dropdown-menu pull-right profile-box">
          <div class="triangle-3"></div>
          
            <ul class="profile-navigation">
              <li><a href="#"><i class="icon-user"></i> My Profile</a></li>
              <li><a href="#"><i class="icon-cog"></i> Settings</a></li>
              <li><a href="#"><i class="icon-info-sign"></i> Help</a></li>
              <li><a href="log_out.php?id=<?php echo $_SESSION[userid_pelamonia]; ?>"><i class="icon-off"></i> Logout</a></li>
            </ul>
          </div>
        </div>
        <div class="clearfix"></div>
       <!--profile box end-->
       
       </div>
       
      
    </div>
    <!--END HEADER-->
    
    <div id="wrap">
    
    
    	<!--BEGIN SIDEBAR-->
        <div id="menu" role="navigation">
        
          <ul class="main-menu">

            <?php
            $sql="select * from menu where aktif='Y' and level='$_SESSION[leveluser_pelamonia]' order by no_urut";
            $query=mysql_query($sql);
            while ($r=mysql_fetch_array($query)){
              echo "<li onClick=\"javascript: ambil_submenu('$r[id]')\"><a href='#'><i class='$r[class]'></i> $r[menu]</a></li>";
            }


            ?>
             
          </ul>
          
          <ul class="additional-menu">
            <div id='tempat_submenu'>
               <?php 
       if ($_SESSION['mid']){
          $sql1="select * from sub_menu where id_menu='$_SESSION[mid]' and aktif='Y' and level='$_SESSION[leveluser_pelamonia]'  order by no_urut";        
       }else{ 
          $sql1="select * from sub_menu where id_menu='1' and aktif='Y' and level='$_SESSION[leveluser_pelamonia]' order by no_urut";
       }
          $query1=mysql_query($sql1);
          while ($d1=mysql_fetch_array($query1)){
             echo "<li class=\"active\"><a href=\"$d1[link]\"><i class=\"$d1[i_class]\"></i> $d1[sub_menu]</a></li>";
          }
       
       
             ?>
            
            </div>
          </ul>
          
        
          <div class="clearfix"></div>
          
          
        </div>
        <!--SIDEBAR END-->
    
    	
        <!--BEGIN MAIN CONTENT-->
        <div id="main" role="main">
          <?php
            include "badan/badan.php";
          ?>
        </div>
        <!--MAIN CONTENT END-->
    
    </div>
    <!--/#wrapper-->


    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

   
    <script src="js/bootstrap.min.js"></script>
    <script src="js/google-code-prettify/prettify.js"></script>
   
    <script src="js/jquery.flot.js"></script>
    <script src="js/jquery.flot.pie.js"></script>
    <script src="js/jquery.flot.orderBars.js"></script>
    <script src="js/jquery.flot.resize.js"></script>
    <script src="js/jquery.flot.categories.js"></script>
    <script src="js/graphtable.js"></script>
    <script src="js/fullcalendar.min.js"></script>
    <script src="js/chosen.jquery.min.js"></script>
    <script src="js/autoresize.jquery.min.js"></script>
    <script src="js/jquery.autotab.js"></script>
    <script src="js/jquery.jgrowl_minimized.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/jquery.stepy.min.js"></script>
    <script src="js/jquery.validate.min.js"></script>
    <script src="js/raphael.2.1.0.min.js"></script>
    <script src="js/justgage.1.0.1.min.js"></script>
	<script src="js/glisse.js"></script>
	<script src="js/styleswitcher.js"></script>
	<script src="js/moderniz.js"></script>
    <script src="js/jquery.sparkline.min.js"></script>
    <script src="js/slidernav-min.js"></script>
    <script type="text/javascript" src="js/jquery.fancybox63b9.js?v=2.1.4"></script>


    
	<script>
    Modernizr.load([
        {
         load: [
                'js/main.js'
            ],
            complete: function()
            {
                $.fn.ready(function()
                {
                    window.App.init();
                });
            }
        }
    ]);
    </script>
	<script src="js/application.js"></script>
    
    <!--settings infobox charts-->
    <script src="js/float.settings.infobox.js"></script>


  </body>

<!-- Mirrored from nightskyadmin.com/demo/template/dashboard.html by HTTrack Website Copier/3.x [XR&CO'2013], Thu, 12 Sep 2013 02:02:43 GMT -->
</html>

