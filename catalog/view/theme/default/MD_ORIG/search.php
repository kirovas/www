<?php
   define('myeshop', true);	
   include("include/db_connect.php");
   include("functions/functions.php");
   session_start();
   include("include/auth_cookie.php");
   
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
    
	<title>Поиск - <?php echo $search; ?></title>
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
	
  if (strlen($search) >= 3 && strlen($search) < 150) 
  {    

	$num = 6; // Здесь указываем сколько хотим выводить товаров.
    $page = (int)$_GET['page'];              
    
	$count = mysql_query("SELECT COUNT(*) FROM table_products WHERE title LIKE '%$search%' AND visible = '1'",$link);
    $temp = mysql_fetch_array($count);

	If ($temp[0] > 0)
	{  
	$tempcount = $temp[0];

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

If ($temp[0] > 0)
{
    
 echo '
 
 					<div id="block-breadcrumbs">
					<a href="/">Главная</a> / <span>Поиск</span>
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
    
	
  $result = mysql_query("SELECT * FROM table_products WHERE title LIKE '%$search%' AND visible='1' ORDER BY $sorting $qury_start_num ",$link);  

if (mysql_num_rows($result) > 0)
{
 $row = mysql_fetch_array($result); 
 
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
}    


?>
</ul>


<ul id="block-tovar-list" >

<?php
	
  $result = mysql_query("SELECT * FROM table_products WHERE title LIKE '%$search%' AND visible='1' ORDER BY $sorting $qury_start_num",$link);  

if (mysql_num_rows($result) > 0)
{
 $row = mysql_fetch_array($result); 
 
 do
 {

if  ($row["image"] != "" && file_exists("./uploads_images/".$row["image"]))
{
$img_path = './uploads_images/'.$row["image"];
$max_width = 150; 
$max_height = 150; 
 list($width, $height) = getimagesize($img_path); 
$ratioh = $max_height/$height; 
$ratiow = $max_width/$width; 
$ratio = min($ratioh, $ratiow); 
$width = intval($ratio*$width); 
$height = intval($ratio*$height);    
}else
{
$img_path = "/images/noimages80x70.png";
$width = 80;
$height = 70;
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
}    

echo '</ul>';

if ($page != 1){ $pstr_prev = '<li><a class="pstr-prev" href="search.php?q='.$search.'&?page='.($page - 1).'">&lt;</a></li>';}
if ($page != $total) $pstr_next = '<li><a class="pstr-next" href="search.php?q='.$search.'&page='.($page + 1).'">&gt;</a></li>';


// Формируем ссылки со страницами
if($page - 5 > 0) $page5left = '<li><a href="search.php?q='.$search.'&page='.($page - 5).'">'.($page - 5).'</a></li>';
if($page - 4 > 0) $page4left = '<li><a href="search.php?q='.$search.'&page='.($page - 4).'">'.($page - 4).'</a></li>';
if($page - 3 > 0) $page3left = '<li><a href="search.php?q='.$search.'&page='.($page - 3).'">'.($page - 3).'</a></li>';
if($page - 2 > 0) $page2left = '<li><a href="search.php?q='.$search.'&page='.($page - 2).'">'.($page - 2).'</a></li>';
if($page - 1 > 0) $page1left = '<li><a href="search.php?q='.$search.'&page='.($page - 1).'">'.($page - 1).'</a></li>';

if($page + 5 <= $total) $page5right = '<li><a href="search.php?q='.$search.'&page='.($page + 5).'">'.($page + 5).'</a></li>';
if($page + 4 <= $total) $page4right = '<li><a href="search.php?q='.$search.'&page='.($page + 4).'">'.($page + 4).'</a></li>';
if($page + 3 <= $total) $page3right = '<li><a href="search.php?q='.$search.'&page='.($page + 3).'">'.($page + 3).'</a></li>';
if($page + 2 <= $total) $page2right = '<li><a href="search.php?q='.$search.'&page='.($page + 2).'">'.($page + 2).'</a></li>';
if($page + 1 <= $total) $page1right = '<li><a href="search.php?q='.$search.'&page='.($page + 1).'">'.($page + 1).'</a></li>';


if ($page+5 < $total)
{
    $strtotal = '<li><p class="nav-point">...</p></li><li><a href="search.php?q='.$search.'&page='.$total.'">'.$total.'</a></li>';
}else
{
    $strtotal = ""; 
}

if ($total > 1)
{
    echo '
    <div class="pstrnav">
    <ul>
    ';
    echo $pstr_prev.$page5left.$page4left.$page3left.$page2left.$page1left."<li><a class='pstr-active' href='search.php?q=".$search."&page=".$page."'>".$page."</a></li>".$page1right.$page2right.$page3right.$page4right.$page5right.$strtotal.$pstr_next;
    echo '
    </ul>
    </div>
    ';
}

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

}else
{
    echo "<p>Ничего не найдено!</p>";
}
  }else
  {
     echo "<p>Поисковое значение должно быть от 3 до 150 символов!</p>";
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