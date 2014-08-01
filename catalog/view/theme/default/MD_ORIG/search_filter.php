<?php
   define('myeshop', true);
   include("include/db_connect.php");
   include("functions/functions.php");
   session_start();
   include("include/auth_cookie.php");
   $cat = clear_string($_GET["cat"]);
   $type = clear_string($_GET["type"]);
$search = clear_string($_GET["q"]);

$sorting = $_GET["sort"];

switch ($sorting)
{
    case 'price-asc';
    $sorting = 'price ASC';
    $sort_name = 'От дешевых к дорогим';
    break;

    case 'price-desc';
    $sorting = 'price DESC';
    $sort_name = 'От дорогих к дешевым';
    break;

    case 'popular';
    $sorting = 'count DESC';
    $sort_name = 'Популярное';
    break;

    case 'news';
    $sorting = 'datetime DESC';
    $sort_name = 'Новинки';
    break;

    case 'brand';
    $sorting = 'brand';
    $sort_name = 'Новинки';
    break;

    default:
    $sorting = 'products_id DESC';
    $sort_name = 'Нет сортировки';
    break;
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <link href="css/reset.css" rel="stylesheet" type="text/css" />
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <link href="trackbar/trackbar.css" rel="stylesheet" type="text/css" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans&subset=latin,cyrillic-ext' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Lobster&subset=latin,cyrillic-ext' rel='stylesheet' type='text/css'>

    <script type="text/javascript" src="/js/jquery-1.8.2.min.js"></script>
    <script type="text/javascript" src="/js/jcarousellite_1.0.1.js"></script>
    <script type="text/javascript" src="/js/shop-script.js"></script>
    <script type="text/javascript" src="/js/jquery.cookie.min.js"></script>
    <script type="text/javascript" src="/trackbar/jquery.trackbar.js"></script>
    <script type="text/javascript" src="/js/TextChange.js"></script>

    <link rel="stylesheet" type="text/css" href="fancybox/jquery.fancybox.css" />
    <script type="text/javascript" src="fancybox/jquery.fancybox.js"></script>
    <script type="text/javascript" src="js/jTabs.js"></script>

	<title>Поиск по параметрам</title>
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



<?php


  if ($_GET["brand"])
  {
      $check_brand = implode(',',$_GET["brand"]);
  }

  $start_price = (int)$_GET["start_price"];
  $end_price = (int)$_GET["end_price"];


  if (!empty($check_brand) OR !empty($end_price))
  {

    if (!empty($check_brand)) $query_brand = " AND brand_id IN($check_brand)";
    if (!empty($end_price)) $query_price = " AND price BETWEEN $start_price AND $end_price";


  }



  $result = mysql_query("SELECT * FROM table_products WHERE status='1' $query_brand $query_price ORDER BY products_id DESC",$link);

if (mysql_num_rows($result) > 0)
{
 $row = mysql_fetch_array($result);

 echo '
					<div id="block-breadcrumbs">
					<a href="/">Главная</a> / <span>Подбор товара</span>
					<div class="clear"></div>
					<div class="total-product">Товары: 40 из 238</div>
					<div class="top-navigation">
					<span>1</span>
					<a href="#">2</a>
					<a href="#">3</a>
					<a href="#">…</a>
					<a href="#">следующая</a>
					</div>
					<div class="clear"></div>

 <div id="block-sorting">
<ul id="options-list">
<li>Сортировать по</li>
<li><a id="select-sort">'.$sort_name.'</a>
	<ul id="sorting-list">
		<li><a href="view_cat.php?'.$catlink.'type='.$type.'&sort=price-asc" >От дешевых к дорогим</a></li>
		<li><a href="view_cat.php?'.$catlink.'type='.$type.'&sort=price-desc" >От дорогих к дешевым</a></li>
		<li><a href="view_cat.php?'.$catlink.'type='.$type.'&sort=popular" >Популярное</a></li>
		<li><a href="view_cat.php?'.$catlink.'type='.$type.'&sort=news" >Новинки</a></li>
		<li><a href="view_cat.php?'.$catlink.'type='.$type.'&sort=brand" >От А до Я</a></li>
	</ul>
</li>
<li>Бренды</li>
<li><a id="select-sort">'.$sort_name.'</a>
	<ul id="sorting-list">
		<li><a href="view_cat.php?'.$catlink.'type='.$type.'&sort=price-asc" >От дешевых к дорогим</a></li>
		<li><a href="view_cat.php?'.$catlink.'type='.$type.'&sort=price-desc" >От дорогих к дешевым</a></li>
		<li><a href="view_cat.php?'.$catlink.'type='.$type.'&sort=popular" >Популярное</a></li>
		<li><a href="view_cat.php?'.$catlink.'type='.$type.'&sort=news" >Новинки</a></li>
		<li><a href="view_cat.php?'.$catlink.'type='.$type.'&sort=brand" >От А до Я</a></li>
	</ul>
</li>
<li>Показывать по</li>
<li><a id="select-sort">'.$sort_name.'</a>
	<ul id="sorting-list">
		<li><a href="view_cat.php?'.$catlink.'type='.$type.'&sort=price-asc" >От дешевых к дорогим</a></li>
		<li><a href="view_cat.php?'.$catlink.'type='.$type.'&sort=price-desc" >От дорогих к дешевым</a></li>
		<li><a href="view_cat.php?'.$catlink.'type='.$type.'&sort=popular" >Популярное</a></li>
		<li><a href="view_cat.php?'.$catlink.'type='.$type.'&sort=news" >Новинки</a></li>
		<li><a href="view_cat.php?'.$catlink.'type='.$type.'&sort=brand" >От А до Я</a></li>
	</ul>
</li>
</ul>
<div class="clear"></div>
</div>


					</div>


 ';


 do
 {

if  ($row["image"] != "" && file_exists("./uploads_images/".$row["image"]))
{
$img_path = './uploads_images/'.$row["image"];
$max_width = 200;
$max_height = 200;
 list($width, $height) = getimagesize($img_path);
$ratioh = $max_height/$height;
$ratiow = $max_width/$width;
$ratio = min($ratioh, $ratiow);
$width = intval($ratio*$width);
$height = intval($ratio*$height);
}else
{
$img_path = "/images/no-image.png";
$width = 110;
$height = 200;
}

  echo '

							  <div class="index-product-item" >
									<ul class="hover-index-menu">
										<li>
											<a class="index-desc" href="view_content.php?id='.$row["products_id"].'"><img src="images/index-desc.png" /><br />Описание</a>
										</li>
										<li>
											<a class="index-vergelijk" href="#"><img src="images/index-vergelijk.png" /><br />Сравнить</a>
										</li>
										<li>
											<a class="index-one-clik" href="#index-one-clik" tid="'.$row["products_id"].'" ><img src="images/index-one-clik.png" /><br />Заказать в<br /> один клик</a>
										</li>
										<li>
											<a class="index-add-basket add-cart" tid="'.$row["products_id"].'" ><img src="images/index-add-basket.png" /><br />Добавить в<br /> корзину</a>
										</li>
									</ul>
								<div class="index-product-img">
									<img src="'.$img_path.'" title="'.$row["title"].'" />
								</div>
								<div class="title">'.$row["title"].'</div>
								<div class="index-product-price"><strong>'.group_numerals($row["price"]).'</strong> руб.</div>



							  </div>

  ';


 }
    while ($row = mysql_fetch_array($result));

echo '
 					<div class="clear"></div>
					<div id="bottom-navigation">
 <div id="block-sorting">
<ul id="options-list">
<li>Сортировать по</li>
<li><a id="select-sort">'.$sort_name.'</a>
	<ul id="sorting-list">
		<li><a href="view_cat.php?'.$catlink.'type='.$type.'&sort=price-asc" >От дешевых к дорогим</a></li>
		<li><a href="view_cat.php?'.$catlink.'type='.$type.'&sort=price-desc" >От дорогих к дешевым</a></li>
		<li><a href="view_cat.php?'.$catlink.'type='.$type.'&sort=popular" >Популярное</a></li>
		<li><a href="view_cat.php?'.$catlink.'type='.$type.'&sort=news" >Новинки</a></li>
		<li><a href="view_cat.php?'.$catlink.'type='.$type.'&sort=brand" >От А до Я</a></li>
	</ul>
</li>
<li>Бренды</li>
<li><a id="select-sort">'.$sort_name.'</a>
	<ul id="sorting-list">
		<li><a href="view_cat.php?'.$catlink.'type='.$type.'&sort=price-asc" >От дешевых к дорогим</a></li>
		<li><a href="view_cat.php?'.$catlink.'type='.$type.'&sort=price-desc" >От дорогих к дешевым</a></li>
		<li><a href="view_cat.php?'.$catlink.'type='.$type.'&sort=popular" >Популярное</a></li>
		<li><a href="view_cat.php?'.$catlink.'type='.$type.'&sort=news" >Новинки</a></li>
		<li><a href="view_cat.php?'.$catlink.'type='.$type.'&sort=brand" >От А до Я</a></li>
	</ul>
</li>
<li>Показывать по</li>
<li><a id="select-sort">'.$sort_name.'</a>
	<ul id="sorting-list">
		<li><a href="view_cat.php?'.$catlink.'type='.$type.'&sort=price-asc" >От дешевых к дорогим</a></li>
		<li><a href="view_cat.php?'.$catlink.'type='.$type.'&sort=price-desc" >От дорогих к дешевым</a></li>
		<li><a href="view_cat.php?'.$catlink.'type='.$type.'&sort=popular" >Популярное</a></li>
		<li><a href="view_cat.php?'.$catlink.'type='.$type.'&sort=news" >Новинки</a></li>
		<li><a href="view_cat.php?'.$catlink.'type='.$type.'&sort=brand" >От А до Я</a></li>
	</ul>
</li>
</ul>
<div class="clear"></div>
</div>
					<div class="total-product">Товары: 40 из 238</div>
					<div class="top-navigation">
					<span>1</span>
					<a href="#">2</a>
					<a href="#">3</a>
					<a href="#">…</a>
					<a href="#">следующая</a>
					</div>
					<div class="clear"></div>


					</div>



 ';

?>
</ul>



<?php


}else
{
    echo '<h3>Категория не доступна или не создана!</3>';
}


?>



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