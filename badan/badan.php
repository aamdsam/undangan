 <div class="block" style="text-align:left"><br />
<?php
if ($_GET['module']){
	$module=$_GET['module'];
	include "badan/$module.php";
}else{
   if ($_GET['menu']){
   $menu=$_GET['menu'];
   include "badan/$menu.php";
   }else{ 
      if ($_SESSION['leveluser_pelamonia']=='1') {
         include "home.php";
      }else{
         include "home_user.php";
      }
      
   }
}
?>

               
   <!--BEGIN FOOTER-->
   <div class="footer">
      <div class="left">Copyright &copy; 2014</div>
      <div class="right"><a href="#">Flash Computer</a></div>
      <div class="clearfix"></div>
   </div>
   <!--BEGIN FOOTER END-->
  
<div class="clearfix"></div> 
 </div><!--end .block-->