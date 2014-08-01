<?php
   define('myeshop', true);
   include("include/db_connect.php");
   include("functions/functions.php");
   session_start();
   include("include/auth_cookie.php");

   $id = clear_string($_GET["id"]);

     /*$seoquery = mysql_query("SELECT seo_words,seo_description FROM table_products WHERE products_id='$id' AND visible='1'",$link);
     if (mysql_num_rows($seoquery) > 0)
     {
        $resquery = mysql_fetch_array($seoquery);
     }
  //OC Original scheme - viewed
  if ($id != $_SESSION['countid']) {
	$querycount = mysql_query("SELECT count FROM table_products WHERE products_id='$id'",$link);
	$resultcount = mysql_fetch_array($querycount);
	$newcount = $resultcount["count"] + 1;
	$update = mysql_query ("UPDATE table_products SET count='$newcount' WHERE products_id='$id'",$link);
  }   */

$_SESSION['countid'] = $id;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />

    <meta name="Description" content="<? echo $resquery["seo_description"]; ?>"/>
    <meta name="keywords" content="<? echo $resquery["seo_words"]; ?>" />

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

	<title>Интернет-Магазин Цифровой Техники</title>



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
					<a href="/">Главная</a> / <span>Каталог</span>
					</div>

					<div class="catalog-box">
						<a href="/view_cat.php?cat=60" id="velo"><span>Велосипеды</span><div></div></a>
						<a href="/view_cat.php?cat=61" id="accessoires"><span>Аксессуары</span><div></div></a>
						<a href="/view_cat.php?cat=62" id="velozapchasti"><span>Велозапчасти</span><div></div></a>
						<a href="/view_cat.php?cat=63" id="simulatoren"><span>Тренажёры</span><div></div></a>
						<a href="/view_cat.php?cat=64" id="meloodia"><span>Велоодежда</span><div></div></a>
						<div class="clear"></div>
					</div><!--catalog-box-->

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