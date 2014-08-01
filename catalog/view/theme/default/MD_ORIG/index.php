<?php
   define('myeshop', true);
   include("include/db_connect.php");
   include("functions/functions.php");
   session_start();
   include("include/auth_cookie.php");

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

<body>
<?php include("include/block-header.php");?>
<div id="block-body">
	<div class="index-top-block">
		<div class="lc">
			<div class="filter-arrow"></div>
			<?php include("include/block-search.php");?>
			<?php include("include/block-parameter.php");?>


		</div>
		<div class="rc">
			<script type="text/javascript">
			$(window).load(function() {
				$('#slider').nivoSlider({
					prevText: 'Назад',
					nextText: 'Вперёд',
					directionNavHide : true,
					controlNavThumbs: true,
					directionNav: true,
					controlNav: false
				});
			});
			</script>
			<div class="slider-wrapper theme-default">
				<div id="slider" class="nivoSlider">
					<img src="/images/slider/slide1.jpg" data-thumb="/images/slider/slide1.jpg" alt="" title="#htmlcaption" />
					<img src="/images/slider/slide2.jpg" data-thumb="/images/slider/slide2.jpg" alt="" title="#htmlcaption2" />
				</div>
				<div id="htmlcaption" class="nivo-html-caption">
					<h3>Стильные городские <br />велосипеды</h3>
					<a href="#">Смотреть все</a>
				</div>
				<div id="htmlcaption" class="nivo-html-caption">
					<h3>Стильные городские <br />велосипеды</h3>
					<a href="#">Смотреть все</a>
				</div>
			</div><!--slider-->
		</div>
		<div class="right-column">
			<?php include("include/block-voordelen.php");?>
		</div><!--right-column-->
		<div class="clear"></div>
	</div><!--index-top-block-->
</div>

	<div class="index-bottom-block">
		<div id="block-body">

			<div id="brands-slider-box">
			<div id="index-news-prev"></div>
			<div id="brands-slider">
			<ul>
				<li><img src="images/carousel/agang.jpg" /></li>
				<li><img src="images/carousel/author.jpg" /></li>
				<li><img src="images/carousel/biceco.jpg" /></li>
				<li><img src="images/carousel/giant.jpg" /></li>
				<li><img src="images/carousel/head.jpg" /></li>
				<li><img src="images/carousel/kettler.jpg" /></li>
			</ul>
			</div>
			<div id="index-news-next"></div>
			</div>

			<div class="lc">
				<?php include("include/block-category.php");?>
				<?php include("include/block-articles.php");?>
				<?php include("include/block-payment.php");?>

			</div>

			<div class="rc">
				<div class="index-toval-box">
					<script type="text/javascript" src="/js/index-script.js"></script>
					<div class="menu-index-toval-box">
						<a class="active" href="#hit-product">Хиты продаж</a>
						<a href="#new-product">Новинки</a>
						<a href="#korting-product">Скидки</a>
						<div class="clear"></div>
					</div>
					<div class="index-toval-list">
					<div id="hit-product" class="active"><!-- ХИТЫ ПРОДАЖ -->

							<?php
								$num = 18; // Здесь указываем сколько хотим выводить товаров.
								$page = (int)$_GET['page'];

								$count = mysql_query("SELECT COUNT(*) FROM product_description,product WHERE visible = '1'",$link);
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



							   $result1 = mysql_query("
                                                        SELECT
                                                        *,
                                                         product_description.product_id AS t1,
                                                         product.product_id  AS t2,
                                                         product_option.product_id AS t3,
                                                         product_description.name AS name

                                                        FROM
                                                                  product_description,
                                                                  product,
                                                                  product_option
                                                        WHERE
                                                                  product_description.product_id = product.product_id
                                                        AND
                                                                  product_option.option_value = 1
                                                        AND
                                                                  product_description.product_id = product_option.product_id
                                                        AND       product.status = 1


                                                                  "

                                                        ,$link)or die(mysql_error());




								if (mysql_num_rows($result1) > 0)
							{
							 $row1 = mysql_fetch_array($result1);

							 do
							 {

							if  ($row1["image"] != "")
							{
							$img_path =$row1["image"];
							$max_width = 240;
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
							$width = 240;
							$height = 200;
							}

							 // Количество отзывов
							$query_reviews = mysql_query("SELECT * FROM product_description ",$link)or die(mysql_error());
							$count_reviews = mysql_num_rows($query_reviews);


							  echo '

							  <div class="index-product-item" >
									<ul class="hover-index-menu">
										<li>
											<a class="index-desc" href="view_content.php?id='.$row1["t1"].'"><img src="images/index-desc.png" /><br />Описание</a>
										</li>
										<li>
											<a class="index-vergelijk" href="#"><img src="images/index-vergelijk.png" /><br />Сравнить</a>
										</li>
										<li>
											<a class="index-one-clik" href="#index-one-clik" tid="'.$row1["t1"].'" ><img src="images/index-one-clik.png" /><br />Заказать в<br /> один клик</a>
										</li>
										<li>
											<a class="index-add-basket add-cart" tid="'.$row1["t1"].'" ><img src="images/index-add-basket.png" /><br />Добавить в<br /> корзину</a>
										</li>
									</ul>
								<div class="index-product-img">
									<img src="'.$img_path.'" title="'.$row1["title"].'" />
								</div>
								<div class="title">'.$row1["name"].'</div>
								<div class="index-product-price"><strong>'.group_numerals($row1["price"]).'</strong> руб.</div>



							  </div>
							  ';


							 }
								while ($row1 = mysql_fetch_array($result1));
							}
								if ($page != 1){ $pstr_prev = '<li><a class="pstr-prev" href="index.php?page='.($page - 1).'">&lt;</a></li>';}
								if ($page != $total) $pstr_next = '<li><a class="pstr-next" href="index.php?page='.($page + 1).'">&gt;</a></li>';


								// Формируем ссылки со страницами
								if($page - 5 > 0) $page5left = '<li><a href="index.php?page='.($page - 5).'">'.($page - 5).'</a></li>';
								if($page - 4 > 0) $page4left = '<li><a href="index.php?page='.($page - 4).'">'.($page - 4).'</a></li>';
								if($page - 3 > 0) $page3left = '<li><a href="index.php?page='.($page - 3).'">'.($page - 3).'</a></li>';
								if($page - 2 > 0) $page2left = '<li><a href="index.php?page='.($page - 2).'">'.($page - 2).'</a></li>';
								if($page - 1 > 0) $page1left = '<li><a href="index.php?page='.($page - 1).'">'.($page - 1).'</a></li>';

								if($page + 5 <= $total) $page5right = '<li><a href="index.php?page='.($page + 5).'">'.($page + 5).'</a></li>';
								if($page + 4 <= $total) $page4right = '<li><a href="index.php?page='.($page + 4).'">'.($page + 4).'</a></li>';
								if($page + 3 <= $total) $page3right = '<li><a href="index.php?page='.($page + 3).'">'.($page + 3).'</a></li>';
								if($page + 2 <= $total) $page2right = '<li><a href="index.php?page='.($page + 2).'">'.($page + 2).'</a></li>';
								if($page + 1 <= $total) $page1right = '<li><a href="index.php?page='.($page + 1).'">'.($page + 1).'</a></li>';


								if ($page+5 < $total)
								{
									$strtotal = '<li><p class="nav-point">...</p></li><li><a href="index.php?page='.$total.'">'.$total.'</a></li>';
								}else
								{
									$strtotal = "";
								}

								if ($total > 1)
								{
									echo '
									<div class="pstrnav">
									<center>
									<ul>
									';
									echo $pstr_prev.$page5left.$page4left.$page3left.$page2left.$page1left."<li><a class='pstr-active' href='index.php?page=".$page."'>".$page."</a></li>".$page1right.$page2right.$page3right.$page4right.$page5right.$strtotal.$pstr_next;
									echo '
									</ul>
									</center>
									</div>
									';
								}
							?>
					</div><!--  AND ХИТЫ ПРОДАЖ  hit-product-->

					<div id="new-product"><!-- НОВИНКИ  -->
							<?php
								$num = 18; // Здесь указываем сколько хотим выводить товаров.
								$page = (int)$_GET['page'];

								$count = mysql_query("SELECT COUNT(*) FROM table_products WHERE visible = '1'",$link);
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



							  $result2 = mysql_query("
                                                        SELECT
                                                        *,
                                                         product_description.product_id AS t1,
                                                         product.product_id  AS t2,
                                                         product_option.product_id AS t3,
                                                         product_description.name AS name

                                                        FROM
                                                                  product_description,
                                                                  product,
                                                                  product_option
                                                        WHERE
                                                                  product_description.product_id = product.product_id
                                                        AND
                                                                  product_option.option_value = 2
                                                        AND
                                                                  product_description.product_id = product_option.product_id
                                                        AND       product.status = 1
                                                                  "

                                                        ,$link)or die(mysql_error());

							if (mysql_num_rows($result2) > 0)
							{
							 $row2 = mysql_fetch_array($result2);

							 do
							 {

							if  ($row2["image"] != "")
							{
							$img_path =$row2["image"];
							$max_width = 240;
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
							$width = 240;
							$height = 200;
							}

							 // Количество отзывов
							$query_reviews = mysql_query("SELECT * FROM product_description ",$link)or die(mysql_error());
							$count_reviews = mysql_num_rows($query_reviews);

							  //print_r($row2);
							 echo '

							  <div class="index-product-item" >
									<ul class="hover-index-menu">
										<li>
											<a class="index-desc" href="view_content.php?id='.$row2["t1"].'"><img src="images/index-desc.png" /><br />Описание</a>
										</li>
										<li>
											<a class="index-vergelijk" href="#"><img src="images/index-vergelijk.png" /><br />Сравнить</a>
										</li>
										<li>
											<a class="index-one-clik" href="#index-one-clik" tid="'.$row2["t1"].'" ><img src="images/index-one-clik.png" /><br />Заказать в<br /> один клик</a>
										</li>
										<li>
											<a class="index-add-basket add-cart" tid="'.$row2["t1"].'" ><img src="images/index-add-basket.png" /><br />Добавить в<br /> корзину</a>
										</li>
									</ul>
								<div class="index-product-img">
									<img src="'.$img_path.'" title="'.$row2["name"].'" />
								</div>
								<div class="title">'.$row2["name"].'</div>
								<div class="index-product-price"><strong>'.group_numerals($row2["price"]).'</strong> руб.</div>



							  </div>
							  ';


							 }
								while ($row2 = mysql_fetch_array($result2));
							}
								if ($page != 1){ $pstr_prev = '<li><a class="pstr-prev" href="index.php?page='.($page - 1).'">&lt;</a></li>';}
								if ($page != $total) $pstr_next = '<li><a class="pstr-next" href="index.php?page='.($page + 1).'">&gt;</a></li>';


								// Формируем ссылки со страницами
								if($page - 5 > 0) $page5left = '<li><a href="index.php?page='.($page - 5).'">'.($page - 5).'</a></li>';
								if($page - 4 > 0) $page4left = '<li><a href="index.php?page='.($page - 4).'">'.($page - 4).'</a></li>';
								if($page - 3 > 0) $page3left = '<li><a href="index.php?page='.($page - 3).'">'.($page - 3).'</a></li>';
								if($page - 2 > 0) $page2left = '<li><a href="index.php?page='.($page - 2).'">'.($page - 2).'</a></li>';
								if($page - 1 > 0) $page1left = '<li><a href="index.php?page='.($page - 1).'">'.($page - 1).'</a></li>';

								if($page + 5 <= $total) $page5right = '<li><a href="index.php?page='.($page + 5).'">'.($page + 5).'</a></li>';
								if($page + 4 <= $total) $page4right = '<li><a href="index.php?page='.($page + 4).'">'.($page + 4).'</a></li>';
								if($page + 3 <= $total) $page3right = '<li><a href="index.php?page='.($page + 3).'">'.($page + 3).'</a></li>';
								if($page + 2 <= $total) $page2right = '<li><a href="index.php?page='.($page + 2).'">'.($page + 2).'</a></li>';
								if($page + 1 <= $total) $page1right = '<li><a href="index.php?page='.($page + 1).'">'.($page + 1).'</a></li>';


								if ($page+5 < $total)
								{
									$strtotal = '<li><p class="nav-point">...</p></li><li><a href="index.php?page='.$total.'">'.$total.'</a></li>';
								}else
								{
									$strtotal = "";
								}

								if ($total > 1)
								{
									echo '
									<div class="pstrnav">
									<center>
									<ul>
									';
									echo $pstr_prev.$page5left.$page4left.$page3left.$page2left.$page1left."<li><a class='pstr-active' href='index.php?page=".$page."'>".$page."</a></li>".$page1right.$page2right.$page3right.$page4right.$page5right.$strtotal.$pstr_next;
									echo '
									</ul>
									</center>
									</div>
									';
								}
							?>
					</div><!-- AND  НОВИНКИ  new-product-->

					<div id="korting-product"><!-- СКИДКИ -->

							<?php
								$num = 18; // Здесь указываем сколько хотим выводить товаров.
								$page = (int)$_GET['page'];

								$count = mysql_query("SELECT COUNT(*) FROM table_products WHERE visible = '1'",$link);
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



							  $result3 = mysql_query("
                                                        SELECT
                                                        *,
                                                         product_description.product_id AS t1,
                                                         product.product_id  AS t2,
                                                         product_option.product_id AS t3,
                                                         product_description.name AS name

                                                        FROM
                                                                  product_description,
                                                                  product,
                                                                  product_option
                                                        WHERE
                                                                  product_description.product_id = product.product_id
                                                        AND
                                                                  product_option.option_value = 3
                                                        AND
                                                                  product_description.product_id = product_option.product_id
                                                        AND       product.status = 1
                                                                  "

                                                        ,$link)or die(mysql_error());

							if (mysql_num_rows($result3) > 0)
							{
							 $row3 = mysql_fetch_array($result3);

							 do
							 {

							if  ($row3["image"] != "")
							{
							$img_path =$row3["image"];
							$max_width = 240;
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
							$width = 240;
							$height = 200;
							}

							 // Количество отзывов
							$query_reviews = mysql_query("SELECT * FROM product_description ",$link)or die(mysql_error());
							$count_reviews = mysql_num_rows($query_reviews);


							  echo '

							  <div class="index-product-item" >
									<ul class="hover-index-menu">
										<li>
											<a class="index-desc" href="view_content.php?id='.$row3["t1"].'"><img src="images/index-desc.png" /><br />Описание</a>
										</li>
										<li>
											<a class="index-vergelijk" href="#"><img src="images/index-vergelijk.png" /><br />Сравнить</a>
										</li>
										<li>
											<a class="index-one-clik" href="#index-one-clik" tid="'.$row3["t1"].'" ><img src="images/index-one-clik.png" /><br />Заказать в<br /> один клик</a>
										</li>
										<li>
											<a class="index-add-basket add-cart" tid="'.$row3["t1"].'" ><img src="images/index-add-basket.png" /><br />Добавить в<br /> корзину</a>
										</li>
									</ul>
								<div class="index-product-img">
									<img src="'.$img_path.'" title="'.$row3["title"].'" />
								</div>
								<div class="title">'.$row3["name"].'</div>
								<div class="index-product-price"><strong>'.group_numerals($row3["price"]).'</strong> руб.</div>



							  </div>
							  ';


							 }
								while ($row = mysql_fetch_array($result3));
							}
								if ($page != 1){ $pstr_prev = '<li><a class="pstr-prev" href="index.php?page='.($page - 1).'">&lt;</a></li>';}
								if ($page != $total) $pstr_next = '<li><a class="pstr-next" href="index.php?page='.($page + 1).'">&gt;</a></li>';


								// Формируем ссылки со страницами
								if($page - 5 > 0) $page5left = '<li><a href="index.php?page='.($page - 5).'">'.($page - 5).'</a></li>';
								if($page - 4 > 0) $page4left = '<li><a href="index.php?page='.($page - 4).'">'.($page - 4).'</a></li>';
								if($page - 3 > 0) $page3left = '<li><a href="index.php?page='.($page - 3).'">'.($page - 3).'</a></li>';
								if($page - 2 > 0) $page2left = '<li><a href="index.php?page='.($page - 2).'">'.($page - 2).'</a></li>';
								if($page - 1 > 0) $page1left = '<li><a href="index.php?page='.($page - 1).'">'.($page - 1).'</a></li>';

								if($page + 5 <= $total) $page5right = '<li><a href="index.php?page='.($page + 5).'">'.($page + 5).'</a></li>';
								if($page + 4 <= $total) $page4right = '<li><a href="index.php?page='.($page + 4).'">'.($page + 4).'</a></li>';
								if($page + 3 <= $total) $page3right = '<li><a href="index.php?page='.($page + 3).'">'.($page + 3).'</a></li>';
								if($page + 2 <= $total) $page2right = '<li><a href="index.php?page='.($page + 2).'">'.($page + 2).'</a></li>';
								if($page + 1 <= $total) $page1right = '<li><a href="index.php?page='.($page + 1).'">'.($page + 1).'</a></li>';


								if ($page+5 < $total)
								{
									$strtotal = '<li><p class="nav-point">...</p></li><li><a href="index.php?page='.$total.'">'.$total.'</a></li>';
								}else
								{
									$strtotal = "";
								}

								if ($total > 1)
								{
									echo '
									<div class="pstrnav">
									<center>
									<ul>
									';
									echo $pstr_prev.$page5left.$page4left.$page3left.$page2left.$page1left."<li><a class='pstr-active' href='index.php?page=".$page."'>".$page."</a></li>".$page1right.$page2right.$page3right.$page4right.$page5right.$strtotal.$pstr_next;
									echo '
									</ul>
									</center>
									</div>
									';
								}
							?>
					</div><!-- AND  СКИДКИ  korting-product-->
					</div>
					</div>
				</div>
				<div class="right-column">

					<div class="action-block">
						<h3>До конца акции осталось</h3>
						<script>
						  $(function(){
							$(".digits").countdown({
							  image: "images/digits.png",
							  format: "hh:mm:ss",
							  endTime: new Date(2013, 12, 2)
							});
						  });
						</script>
						<div class="digits"></div>
						<img src="images/action/action.png" />
						<div class="clear"></div>
					</div><!--action-block-->

					<div class="banners-block">
						<a href="#"><img src="images/banners/index-banner1.png" /></a>
						<a href="#"><img src="images/banners/index-banner2.png" /></a>
					</div><!--banners-dlock-->

					<?php include("include/block-shop-feedback.php");?>

				</div><!--right-column-->
			<div class="clear"></div>
			</div>
		</div>
	</div><!--index-bottom-block-->

<?php include("include/block-footer.php");?>
<?php include("include/block-popup-window.php");?>

</body>
</html>