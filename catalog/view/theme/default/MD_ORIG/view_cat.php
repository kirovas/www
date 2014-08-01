<?php
   define('myeshop', true);
   include("include/db_connect.php");
   include("functions/functions.php");
   session_start();
   include("include/auth_cookie.php");
   $cat = (int)clear_string($_GET["cat"]);
   $type = clear_string($_GET["type"]);

   $sorting = $_GET["sort"];

switch ($sorting) {
    case 'price-asc':
    $sort_code = $sorting;
    $sorting = 'price ASC';
    $sort_name = 'От дешевых к дорогим';
    break;

    case 'price-desc':
    $sort_code = $sorting;
    $sorting = 'price DESC';
    $sort_name = 'От дорогих к дешевым';
    break;

    case 'popular':
    $sort_code = $sorting;
    $sorting = 'viewed DESC';
    $sort_name = 'Популярное';
    break;

    case 'news':
    $sort_code = $sorting;
    $sorting = 'date_added DESC';
    $sort_name = 'Новинки';
    break;

    case 'brand':
    $sort_code = $sorting;
    $sorting = 'model DESC';
    $sort_name = 'От А до Я';
    break;

    default:
    $sort_code = "";
    $sorting = 'product_id DESC';
    $sort_name = 'Нет сортировки';
    break;
}

//O__O. Shame on me. It's quick code though.
switch ((int)$_GET['pack']) {
	case 6:
	$pack = 6;
	break;
	case 9:
	$pack = 9;
	break;
	case 12:
	$pack = 12;
	break;
	case 18:
	$pack = 18;
	break;
	case 36:
	$pack = 36;
	break;
	default:
	$pack = 12;
	break;
}

//Filter input begin
//TODO: Security check for GET arrays and string. Before TODO: NOPE! Security violation!!
$filter_start_price = (isset($_GET['start_price'])) ? (int)$_GET['start_price'] : NULL;
$filter_end_price = (isset($_GET['end_price'])) ? (int)$_GET['end_price'] : NULL;
$filter_sex = (isset($_GET['check'])) ? $_GET['check'] : NULL;
$filter_brand = (isset($_GET['brand']) && is_array($_GET['brand'])) ? $_GET['brand'] : NULL;
$filter_places = (isset($_GET['places']) && is_array($_GET['places'])) ? $_GET['places'] : NULL;
$filter_brakes = (isset($_GET['brakes']) && is_array($_GET['brakes'])) ? $_GET['brakes'] : NULL;
$filter_query = "";
//Filter input end

if ($filter_start_price) {
	$filter_query .= " AND p.price >= ".$filter_start_price;
}
if ($filter_start_price) {
	$filter_query .= " AND p.price <= ".$filter_end_price;
}
if ($filter_sex) {
	switch ($filter_sex) {
		case 'check1':
			$filter_query .= " AND a.text LIKE '%Мужской%'";
		break;
		case 'check2':
			$filter_query .= " AND a.text LIKE '%Женский%'";
		break;
		case 'check3':
			$filter_query .= " AND a.text LIKE '%Детский%'";
		break;
	}
}
if ($filter_brand) {
	$filter_query .= " AND p.manufacturer_id IN (".implode(', ',$filter_brand).")";
}
if ($filter_places) {
	$filter_query .= " AND (";
	foreach ($_GET['places'] as $place) {
		$filter_query .= "a.text LIKE '%".$place."%' OR";
	}
	$filter_query = substr($filter_query, 0, -3);
	$filter_query .= ")";
}
if ($filter_brakes) {
	$filter_query .= " AND (";
	foreach ($_GET['brakes'] as $brake) {
		$filter_query .= "a.text LIKE '%".$brake."%' OR";
	}
	$filter_query = substr($filter_query, 0, -3);
	$filter_query .= ")";
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

	<title>Интернет-Магазин Цифровой Техники</title>
</head>
<body>
<?php
    include("include/block-header.php");
?>
<!--<pre>
<?php
var_dump($_GET);
?>
</pre> -->
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


/*if (!empty($cat) && !empty($type)) {
     $querycat = "AND p.manufacturer_id='$cat' AND c.category='$type'";
     $catlink = "cat=$cat&";
} else {
    if (!empty($type))
    {
       $querycat = "AND c.category_id='$type'";
    }else
    {
       $querycat = "";
    }

    if (!empty($cat))
    {
       $catlink = "cat=$cat&";
    }else
    {
       $catlink = "";
    }
}*/

$num = $pack; // Здесь указываем сколько хотим выводить товаров.
$page = (int)$_GET['page'];

$count = mysql_fetch_row(mysql_query("SELECT COUNT(DISTINCT p.product_id) FROM `product` as p, `product_to_category` as c, `product_attribute` as a WHERE p.product_id = c.product_id AND p.product_id=a.product_id AND p.status='1' AND c.category_id = ".$cat." $filter_query ORDER BY p.$sorting",$link));
$count = $count[0];

$parentid = mysql_fetch_assoc(mysql_query("SELECT `parent_id` FROM `category` WHERE `category_id`='$cat'"));
$parentid = $parentid["parent_id"];

if ($parentid == 0) {
	$catname = mysql_fetch_assoc(mysql_query("SELECT `name` FROM `category_description` WHERE `category_id` = '$cat'"));
	$catname = $catname["name"];

	$subcatname = "Все ".$catname;

	$categorycount = mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM `product` as p INNER JOIN `product_to_category` as c WHERE p.product_id = c.product_id AND p.status='1' AND c.category_id='".$cat."'"));
	$categorycount = $categorycount[0];
} else {
	$catname = mysql_fetch_assoc(mysql_query("SELECT `name` FROM `category_description` WHERE `category_id` = '".$parentid."'"));
	$catname = $catname["name"];

	$subcatname = mysql_fetch_assoc(mysql_query("SELECT `name` FROM `category_description` WHERE `category_id` = '$cat'"));
	$subcatname = $subcatname["name"];

	$categorycount = mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM `product` as p INNER JOIN `product_to_category` as c WHERE p.product_id = c.product_id AND p.status='1' AND c.category_id='".$parentid."'"));
	$categorycount = $categorycount[0];
}

if ($count > 0) {
	$tempcount = $count;
    // Находим общее число страниц
	$total = (($tempcount - 1) / $num) + 1;
	$total =  intval($total);

	$page = intval($page);

	if(empty($page) or $page < 0) $page = 1;
	if($page > $total) $page = $total;

	// Вычисляем начиная с какого номера
    // следует выводить товары
	$start = $page * $num - $num;
	$qury_start_num = " LIMIT $start, $num";
}

$result = mysql_query("SELECT DISTINCT p.* FROM `product` as p, `product_to_category` as c, `product_attribute` as a WHERE p.product_id = c.product_id AND p.product_id=a.product_id AND p.status='1' AND c.category_id = ".$cat." $filter_query ORDER BY p.$sorting $qury_start_num",$link) or die(mysql_error());

if (mysql_num_rows($result) > 0) {
	echo '<div id="block-breadcrumbs">';
	if ($parentid == 0) {
		echo '<a href="view_cat.php?cat='.$cat.'">'.$catname.'</a> / <span>'.$subcatname.'</span>';
	} else {
		echo '<a href="view_cat.php?cat='.$parentid.'">'.$catname.'</a> / <span>'.$subcatname.'</span>';
	}
echo '
	<div class="clear"></div>
	<div class="total-product">Товары: '.$count.' из '.$categorycount.'</div>
	<!--<div class="top-navigation">
		<span>1</span>
		<a href="#">2</a>
		<a href="#">3</a>
		<a href="#">…</a>
		<a href="#">следующая</a>
	</div>-->
	<div class="clear"></div>
	<div id="block-sorting">
		<ul id="options-list">
			<li>Сортировать по</li>
			<li><a id="select-sort">'.$sort_name.'</a>
				<ul id="sorting-list">
					<li><a href="view_cat.php?cat='.$cat.'&sort=price-asc&pack='.$pack.'" >От дешевых к дорогим</a></li>
					<li><a href="view_cat.php?cat='.$cat.'&sort=price-desc&pack='.$pack.'" >От дорогих к дешевым</a></li>
					<li><a href="view_cat.php?cat='.$cat.'&sort=popular&pack='.$pack.'" >Популярное</a></li>
					<li><a href="view_cat.php?cat='.$cat.'&sort=news&pack='.$pack.'" >Новинки</a></li>
					<li><a href="view_cat.php?cat='.$cat.'&sort=brand&pack='.$pack.'" >От А до Я</a></li>
				</ul>
			</li>
			<li>Товаров на страницу</li>
			<li><a id="select-pack">'.$pack.'</a>
				<ul id="pack-list">
					<li><a href="view_cat.php?cat='.$cat.'&sort='.$sort_code.'&pack=6" >6</a></li>
					<li><a href="view_cat.php?cat='.$cat.'&sort='.$sort_code.'&pack=9" >9</a></li>
					<li><a href="view_cat.php?cat='.$cat.'&sort='.$sort_code.'&pack=12" >12</a></li>
					<li><a href="view_cat.php?cat='.$cat.'&sort='.$sort_code.'&pack=18" >18</a></li>
					<li><a href="view_cat.php?cat='.$cat.'&sort='.$sort_code.'&pack=36" >36</a></li>
				</ul>
			</li>
		</ul>
	<div class="clear"></div>
	</div>
</div>
';

	while ($row = mysql_fetch_array($result)) {
		$q = mysql_query("SELECT image FROM product WHERE product_id='".$row['product_id']."'",$link);
		if($r = mysql_fetch_array($q)) {
			$row['image'] = $r['image'];
		}
		//if($row["image"] != "" && file_exists($_SERVER['DOCUMENT_ROOT']."/image/".$row["image"]))
		if($row["image"] != "") {
			/*
			$img_path = './image/'.$row["image"];
			$max_width = 200;
			$max_height = 200;
 			list($width, $height) = getimagesize($img_path);
			$ratioh = $max_height/$height;
			$ratiow = $max_width/$width;
			$ratio = min($ratioh, $ratiow);
			$width = intval($ratio*$width);
			$height = intval($ratio*$height);
			*/
			$img_path = 'http://346071.allsoft.web.hosting-test.net/image/'.$row['image'];
			$width = 110;
			$height = 200;
		} else {
			$img_path = "/images/no-image.png";
			$width = 110;
			$height = 200;
		}
		echo '
<div class="index-product-item" >
	<ul class="hover-index-menu">
		<li>
			<a class="index-desc" href="view_content.php?id='.$row["product_id"].'"><img src="images/index-desc.png" /><br />Описание</a>
		</li>
		<li>
			<a class="index-vergelijk" href="#"><img src="images/index-vergelijk.png" /><br />Сравнить</a>
		</li>
		<li>
			<a class="index-one-clik" href="#index-one-clik" tid="'.$row["product_id"].'" ><img src="images/index-one-clik.png" /><br />Заказать в<br /> один клик</a>
		</li>
		<li>
			<a class="index-add-basket add-cart" tid="'.$row["product_id"].'" ><img src="images/index-add-basket.png" /><br />Добавить в<br /> корзину</a>
		</li>
	</ul>
	<div class="index-product-img"><img src="'.$img_path.'" title="'.$row["model"].'" /></div>
	<div class="title">'.$row["model"].'</div>
	<div class="index-product-price"><strong>'.substr($row["price"], 0, strlen($row["price"])-2).'</strong> руб.</div>
</div>';
	}
} else {
	echo '<h3>Нет товаров в данной категории!</3>';
}

if ($page != 1){ $pstr_prev = '<li><a class="pstr-prev" href="view_cat.php?cat='.$cat.'&sort='.$sort_code.'&pack='.$pack.'&page='.($page - 1).'">&lt;</a></li>';}
if ($page != $total) $pstr_next = '<li><a class="pstr-next" href="view_cat.php?cat='.$cat.'&sort='.$sort_code.'&pack='.$pack.'&page='.($page + 1).'">&gt;</a></li>';

// Формируем ссылки со страницами
if($page - 5 > 0) $page5left = '<li><a href="view_cat.php?cat='.$cat.'&sort='.$sort_code.'&pack='.$pack.'&page='.($page - 5).'">'.($page - 5).'</a></li>';
if($page - 4 > 0) $page4left = '<li><a href="view_cat.php?cat='.$cat.'&sort='.$sort_code.'&pack='.$pack.'&page='.($page - 4).'">'.($page - 4).'</a></li>';
if($page - 3 > 0) $page3left = '<li><a href="view_cat.php?cat='.$cat.'&sort='.$sort_code.'&pack='.$pack.'&page='.($page - 3).'">'.($page - 3).'</a></li>';
if($page - 2 > 0) $page2left = '<li><a href="view_cat.php?cat='.$cat.'&sort='.$sort_code.'&pack='.$pack.'&page='.($page - 2).'">'.($page - 2).'</a></li>';
if($page - 1 > 0) $page1left = '<li><a href="view_cat.php?cat='.$cat.'&sort='.$sort_code.'&pack='.$pack.'&page='.($page - 1).'">'.($page - 1).'</a></li>';

if($page + 5 <= $total) $page5right = '<li><a href="view_cat.php?cat='.$cat.'&sort='.$sort_code.'&pack='.$pack.'&page='.($page + 5).'">'.($page + 5).'</a></li>';
if($page + 4 <= $total) $page4right = '<li><a href="view_cat.php?cat='.$cat.'&sort='.$sort_code.'&pack='.$pack.'&page='.($page + 4).'">'.($page + 4).'</a></li>';
if($page + 3 <= $total) $page3right = '<li><a href="view_cat.php?cat='.$cat.'&sort='.$sort_code.'&pack='.$pack.'&page='.($page + 3).'">'.($page + 3).'</a></li>';
if($page + 2 <= $total) $page2right = '<li><a href="view_cat.php?cat='.$cat.'&sort='.$sort_code.'&pack='.$pack.'&page='.($page + 2).'">'.($page + 2).'</a></li>';
if($page + 1 <= $total) $page1right = '<li><a href="view_cat.php?cat='.$cat.'&sort='.$sort_code.'&pack='.$pack.'&page='.($page + 1).'">'.($page + 1).'</a></li>';


if ($page+5 < $total) {
    $strtotal = '<li><p class="nav-point">...</p></li><li><a href="view_cat.php?cat='.$cat.'&sort='.$sort_code.'&pack='.$pack.'&page='.$total.'">'.$total.'</a></li>';
} else {
    $strtotal = "";
}

if ($total > 1) {
    echo '<div class="pstrnav"><ul>';
    echo $pstr_prev.$page5left.$page4left.$page3left.$page2left.$page1left."<li><a class='pstr-active' href='view_cat.php?cat=".$cat.'&sort='.$sort_code.'&pack='.$pack."&page=".$page."'>".$page."</a></li>".$page1right.$page2right.$page3right.$page4right.$page5right.$strtotal.$pstr_next;
    echo '</ul></div>';
}

/*echo '
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
 ';  */

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