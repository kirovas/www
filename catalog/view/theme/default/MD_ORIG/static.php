<?php	
   define('myeshop', true);
   include("include/db_connect.php");
   include("functions/functions.php");
   session_start();
   include("include/auth_cookie.php");
  
 
 
   
    

	$id = clear_string($_GET["static"]); 

     $static = mysql_query("SELECT * FROM information_description WHERE information_id='$id'",$link);
     
     If (mysql_num_rows($static) > 0)
     {
        $resquery = mysql_fetch_array($static);

     }  



      
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
    
    <meta name="Description" content="<? echo $resquery["title"]; ?>"/>
    <meta name="keywords" content="<? echo $resquery["title"]; ?>" /> 
    
    <link href="css/reset.css" rel="stylesheet" type="text/css" />
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <link href="trackbar/trackbar.css" rel="stylesheet" type="text/css" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans&subset=latin,cyrillic-ext' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Lobster&subset=latin,cyrillic-ext' rel='stylesheet' type='text/css'>
    
    <script type="text/javascript" src="js/jquery-1.8.2.min.js"></script> 
    <script type="text/javascript" src="js/jcarousellite_1.0.1.js"></script> 
    <script type="text/javascript" src="js/shop-script.js"></script>
    <script type="text/javascript" src="js/jquery.cookie.min.js"></script>
    <script type="text/javascript" src="trackbar/jquery.trackbar.js"></script>
    <script type="text/javascript" src="js/TextChange.js"></script>
    
    <link rel="stylesheet" type="text/css" href="fancybox/jquery.fancybox.css" />
    <script type="text/javascript" src="fancybox/jquery.fancybox.js"></script>
    <script type="text/javascript" src="js/jTabs.js"></script>
    
	<title><? echo $resquery["title"]; ?> | Интернет-Магазин Цифровой Техники</title>


<script type="text/javascript">
$(document).ready(function(){
 
    $("ul.tabs").jTabs({content: ".tabs_content", animate: true, effect:"fade"}); 
    $(".image-modal").fancybox(); 
    $(".send-review").fancybox();
	
});	
</script> 
</head>
<body>
<?php	
    include("include/block-header.php");    
?>
<div id="block-body">
	<div class="index-top-block">
		<div class="lc">
			<div class="filter-arrow"></div>
			<?php include("include/block-search.php");?>
			<?php include("include/block-parameter.php");?>
			<?php include("include/block-category.php");?>
			<?php include("include/block-articles.php");?>
			<?php include("include/block-payment.php");?>
		</div>
		<div class="rc">
					<div id="block-breadcrumbs">
					<a href="/">Главная</a> / <span><? echo $resquery["title"]; ?></span>
					</div>
					<h2><? echo $resquery["title"]; ?></h2>
					<?php echo htmlspecialchars_decode($resquery["description"]); ?>


		
		</div>
		<div class="right-column">
			<?php include("include/block-voordelen.php");?>
			<?php include("include/block-shop-feedback.php");?> 
		</div><!--right-column-->
		<div class="clear"></div>
	</div><!--index-top-block-->
</div>
<?php include("include/block-footer.php");?>
<?php include("include/block-popup-window.php");?>




</body>
</html>