<?php
   define('myeshop', true);
   include("include/db_connect.php");
   include("functions/functions.php");
   session_start();
   include("include/auth_cookie.php");

     $id = clear_string($_GET["id"]);
     $action = clear_string($_GET["action"]);

   switch ($action) {

	    case 'clear':
        $clear = mysql_query("DELETE FROM cart WHERE cart_ip = '{$_SERVER['REMOTE_ADDR']}'",$link);
	    break;

        case 'delete':
        $delete = mysql_query("DELETE FROM cart WHERE cart_id = '$id' AND cart_ip = '{$_SERVER['REMOTE_ADDR']}'",$link);
        break;

	}

if (isset($_POST["submitdata"]))
{
if ( $_SESSION['auth'] == 'yes_auth' )
 {

    mysql_query("INSERT INTO orders(order_datetime,order_dostavka,order_fio,order_address,order_phone,order_note,order_email)
						VALUES(
                             NOW(),
                            '".$_POST["order_delivery"]."',
							'".$_SESSION['auth_surname'].' '.$_SESSION['auth_name'].' '.$_SESSION['auth_patronymic']."',
                            '".$_SESSION['auth_address']."',
                            '".$_SESSION['auth_phone']."',
                            '".$_POST['order_note']."',
                            '".$_SESSION['auth_email']."'
						    )",$link);

 }else
 {
$_SESSION["order_delivery"] = $_POST["order_delivery"];
$_SESSION["order_fio"] = $_POST["order_fio"];
$_SESSION["order_email"] = $_POST["order_email"];
$_SESSION["order_phone"] = $_POST["order_phone"];
$_SESSION["order_address"] = $_POST["order_address"];
$_SESSION["order_note"] = $_POST["order_note"];

    mysql_query("INSERT INTO orders(order_datetime,order_dostavka,order_fio,order_address,order_phone,order_note,order_email)
						VALUES(
                             NOW(),
                            '".clear_string($_POST["order_delivery"])."',
							'".clear_string($_POST["order_fio"])."',
                            '".clear_string($_POST["order_address"])."',
                            '".clear_string($_POST["order_phone"])."',
                            '".clear_string($_POST["order_note"])."',
                            '".clear_string($_POST["order_email"])."'
						    )",$link);
 }


 $_SESSION["order_id"] = mysql_insert_id();

$result = mysql_query("SELECT * FROM cart WHERE cart_ip = '{$_SERVER['REMOTE_ADDR']}'",$link);
If (mysql_num_rows($result) > 0)
{
$row = mysql_fetch_array($result);

do{

    mysql_query("INSERT INTO buy_products(buy_id_order,buy_id_product,buy_count_product)
						VALUES(
                            '".$_SESSION["order_id"]."',
							'".$row["cart_id_product"]."',
                            '".$row["cart_count"]."'
						    )",$link);



} while ($row = mysql_fetch_array($result));
}

header("Location: cart.php?action=completion");
}


$result = mysql_query("SELECT * FROM cart,product WHERE cart.cart_ip = '{$_SERVER['REMOTE_ADDR']}' AND product.product_id = cart.cart_id_product",$link);
If (mysql_num_rows($result) > 0)
{
$row = mysql_fetch_array($result);

do
{
$int = $int + ($row["price"] * $row["cart_count"]);
}
 while ($row = mysql_fetch_array($result));


   $itogpricecart = $int;
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

	<title>Корзина Заказов</title>
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
		</div>
		<div class="rc">
					<div id="block-breadcrumbs">
					<a href="/">Главная</a> / <span>Корзина</span>
					</div>
					<div class="basket-box">
					<?php
					$result = mysql_query("SELECT * FROM cart,product,product_description WHERE cart.cart_ip = '{$_SERVER['REMOTE_ADDR']}' AND product.product_id = cart.cart_id_product AND product_description.product_id = cart.cart_id_product",$link);

					If (mysql_num_rows($result) > 0)
					{
					$row = mysql_fetch_array($result);

					   echo '
						<div class="basket-title">
							<div class="column-model">Модель</div>
							<div class="column-size">Размер</div>
							<div class="column-count">Колличество</div>
							<div class="column-price">Стоимость</div>
						</div>
					   ';

					do
					{

					$int = $row["cart_price"] * $row["cart_count"];
					$all_price = $all_price + $int;


					echo '

					<div class="block-list-cart">

					<div class="img-cart">
					<p>'.$row["name"].'<br />'.$row["model"].'</p>
					<img src="'.$row["image"].'"  />
					</div>

					<div class="size-cart">
						<div>XXX</div>
						<a href="#">Изменить</a>
					</div>

					<div class="count-cart">
						<p align="center" iid="'.$row["cart_id"].'" class="count-minus">-</p>
						<input id="input-id'.$row["cart_id"].'" iid="'.$row["cart_id"].'" class="count-input" maxlength="3" type="text" value="'.$row["cart_count"].'" />
						<p align="center" iid="'.$row["cart_id"].'" class="count-plus">+</p>
					</div>

					<div id="tovar'.$row["cart_id"].'" class="price-product"><p price="'.$row["cart_price"].'" >'.group_numerals($int).' руб</p></div>
					<div class="delete-cart"><a  href="cart.php?id='.$row["cart_id"].'&action=delete" ></a></div>

					<div class="clear"></div>
					</div>


					';


					}
					 while ($row = mysql_fetch_array($result));

					 echo '
					 <div class="basket-form">
					 <h2 class="itog-price" align="right">Итого: <strong>'.group_numerals($all_price).' руб</strong></h2>
						<div id="basket-form">
							<h4>Оформление заказа</h4>
													<div id="dialog-basket" class="window-basket">
														<div id="text">
															<form name="feedback-basket" class="form">
															<table width="100%" cellspacing="2" cellpadding="10" border="0">
															  <tbody><tr>
																<td width="230" valign="middle" align="left">ФИО<sup>*</sup></td>
																<td valign="middle" align="left"><input type="text" id="10" name="name" size="50" style="width: 400px;"></td>
															  </tr>
															  <tr>
																<td valign="middle" align="left">Ваш Телефон<sup>*</sup></td>
																<td valign="middle" align="left"><input type="text" id="13" name="telefon" size="50" style="width: 400px;"></td>
															  </tr>
															  <tr>
																<td valign="top" align="left">Адрес доставки<sup>*</sup></td>
																<td valign="middle" align="left">
																	<textarea name="comment" cols="40" rows="1" style="width: 405px;" id="feedback_textarea2"></textarea>
																	<div id="primer">например г. Кемерово, пр. Комсомольский 63, кв. 444</div>
																</td>
															  </tr>
															</tbody></table>
															  <center><input type="submit" value="Оформить заказ"  class="enter"></center>
															</form>
														</div>
													</div>
						</div>
					 </div>
					 ';

					}
					else
					{
						echo '<h3 id="clear-cart" align="center">Корзина пуста</h3>';
					}
					?>
					</div><!--basket-box-->








<!--<?php

  $action = clear_string($_GET["action"]);
  switch ($action) {

	    case 'oneclick':

   echo '
   <div id="block-step">
   <div id="name-step">
   <ul>
   <li><a class="active" >1. Корзина товаров</a></li>
   <li><span>&rarr;</span></li>
   <li><a>2. Контактная информация</a></li>
   <li><span>&rarr;</span></li>
   <li><a>3. Завершение</a></li>
   </ul>
   </div>
   <p>шаг 1 из 3</p>
   <a href="cart.php?action=clear" >Очистить</a>
   </div>
';


$result = mysql_query("SELECT * FROM cart,table_products WHERE cart.cart_ip = '{$_SERVER['REMOTE_ADDR']}' AND table_products.products_id = cart.cart_id_product",$link);

If (mysql_num_rows($result) > 0)
{
$row = mysql_fetch_array($result);

   echo '
   <div id="header-list-cart">
   <div id="head1" >Изображение</div>
   <div id="head2" >Наименование товара</div>
   <div id="head3" >Кол-во</div>
   <div id="head4" >Цена</div>
   </div>
   ';

do
{

$int = $row["cart_price"] * $row["cart_count"];
$all_price = $all_price + $int;

if  (strlen($row["image"]) > 0 && file_exists("./uploads_images/".$row["image"]))
{
$img_path = "http://346071.allsoft.web.hosting-test.net/image/".$row['image']."";
$max_width = 100;
$max_height = 100;
 list($width, $height) = getimagesize($img_path);
$ratioh = $max_height/$height;
$ratiow = $max_width/$width;
$ratio = min($ratioh, $ratiow);

$width = intval($ratio*$width);
$height = intval($ratio*$height);
}else
{
$img_path = "http://346071.allsoft.web.hosting-test.net/image/no_image.jpg";
$width = 120;
$height = 105;
}

echo '

<div class="block-list-cart">

<div class="img-cart">
<p align="center"><img src="'.$img_path.'" width="'.$width.'" height="'.$height.'" /></p>
</div>

<div class="title-cart">
<p><a href="">'.$row["title"].'</a></p>
<p class="cart-mini-features">
'.$row["mini_features"].'
</p>
</div>

<div class="count-cart">
<ul class="input-count-style">

<li>
<p align="center" iid="'.$row["cart_id"].'" class="count-minus">-</p>
</li>

<li>
<p align="center"><input id="input-id'.$row["cart_id"].'" iid="'.$row["cart_id"].'" class="count-input" maxlength="3" type="text" value="'.$row["cart_count"].'" /></p>
</li>

<li>
<p align="center" iid="'.$row["cart_id"].'" class="count-plus">+</p>
</li>

</ul>
</div>

<div id="tovar'.$row["cart_id"].'" class="price-product"><h5><span class="span-count" >'.$row["cart_count"].'</span> x <span>'.$row["cart_price"].'</span></h5><p price="'.$row["cart_price"].'" >'.group_numerals($int).' руб</p></div>
<div class="delete-cart"><a  href="cart.php?id='.$row["cart_id"].'&action=delete" ><img src="/images/bsk_item_del.png" /></a></div>

<div id="bottom-cart-line"></div>
</div>


';


}
 while ($row = mysql_fetch_array($result));

 echo '
 <h2 class="itog-price" align="right">Итого: <strong>'.group_numerals($all_price).'</strong> руб</h2>
 <p align="right" class="button-next" ><a href="cart.php?action=confirm" >Далее</a></p>
 ';

}
else
{
    echo '<h3 id="clear-cart" align="center">Корзина пуста</h3>';
}



	    break;

        case 'confirm':

    echo '
   <div id="block-step">
   <div id="name-step">
   <ul>
   <li><a href="cart.php?action=oneclick" >1. Корзина товаров</a></li>
   <li><span>&rarr;</span></li>
   <li><a class="active" >2. Контактная информация</a></li>
   <li><span>&rarr;</span></li>
   <li><a>3. Завершение</a></li>
   </ul>
   </div>
   <p>шаг 2 из 3</p>

   </div>

   ';


if ($_SESSION['order_delivery'] == "По почте") $chck1 = "checked";
if ($_SESSION['order_delivery'] == "Курьерам") $chck2 = "checked";
if ($_SESSION['order_delivery'] == "Самовывоз") $chck3 = "checked";

 echo '

<h3 class="title-h3" >Способы доставки:</h3>
<form method="post">
<ul id="info-radio">
<li>
<input type="radio" name="order_delivery" class="order_delivery" id="order_delivery1" value="По почте" '.$chck1.'  />
<label class="label_delivery" for="order_delivery1">По почте</label>
</li>
<li>
<input type="radio" name="order_delivery" class="order_delivery" id="order_delivery2" value="Курьерам" '.$chck2.' />
<label class="label_delivery" for="order_delivery2">Курьерам</label>
</li>
<li>
<input type="radio" name="order_delivery" class="order_delivery" id="order_delivery3" value="Самовывоз" '.$chck3.' />
<label class="label_delivery" for="order_delivery3">Самовывоз</label>
</li>
</ul>
<h3 class="title-h3" >Информация для доставки:</h3>
<ul id="info-order">
';
  if ( $_SESSION['auth'] != 'yes_auth' )
{
echo '
<li><label for="order_fio"><span>*</span>ФИО</label><input type="text" name="order_fio" id="order_fio" value="'.$_SESSION["order_fio"].'" /><span class="order_span_style" >Пример: Иванов Иван Иванович</span></li>
<li><label for="order_email"><span>*</span>E-mail</label><input type="text" name="order_email" id="order_email" value="'.$_SESSION["order_email"].'" /><span class="order_span_style" >Пример: ivanov@mail.ru</span></li>
<li><label for="order_phone"><span>*</span>Телефон</label><input type="text" name="order_phone" id="order_phone" value="'.$_SESSION["order_phone"].'" /><span class="order_span_style" >Пример: 8 950 100 12 34</span></li>
<li><label class="order_label_style" for="order_address"><span>*</span>Адрес<br /> доставки</label><input type="text" name="order_address" id="order_address" value="'.$_SESSION["order_address"].'" /><span>Пример: г. Москва,<br /> ул Интузиастов д 18, кв 58</span></li>
';
}
echo '
<li><label class="order_label_style" for="order_note">Примечание</label><textarea name="order_note"  >'.$_SESSION["order_note"].'</textarea><span>Уточните информацию о заказе.<br />  Например, удобное время для звонка<br />  нашего менеджера</span></li>
</ul>
<p align="right" ><input type="submit" name="submitdata" id="confirm-button-next" value="Далее" /></p>
</form>


 ';

        break;

        case 'completion':

    echo '
   <div id="block-step">
   <div id="name-step">
   <ul>
   <li><a href="cart.php?action=oneclick" >1. Корзина товаров</a></li>
   <li><span>&rarr;</span></li>
   <li><a href="cart.php?action=confirm" >2. Контактная информация</a></li>
   <li><span>&rarr;</span></li>
   <li><a class="active" >3. Завершение</a></li>
   </ul>
   </div>
   <p>шаг 3 из 3</p>

   </div>

<h3>Конечная информация:</3>
   ';

if ( $_SESSION['auth'] == 'yes_auth' )
    {
echo '
<ul id="list-info" >
<li><strong>Способ доставки:</strong>'.$_SESSION['order_delivery'].'</li>
<li><strong>Email:</strong>'.$_SESSION['auth_email'].'</li>
<li><strong>ФИО:</strong>'.$_SESSION['auth_surname'].' '.$_SESSION['auth_name'].' '.$_SESSION['auth_patronymic'].'</li>
<li><strong>Адрес доставки:</strong>'.$_SESSION['auth_address'].'</li>
<li><strong>Телефон:</strong>'.$_SESSION['auth_phone'].'</li>
<li><strong>Примечание: </strong>'.$_SESSION['order_note'].'</li>
</ul>

';
   }else
   {
echo '
<ul id="list-info" >
<li><strong>Способ доставки:</strong>'.$_SESSION['order_delivery'].'</li>
<li><strong>Email:</strong>'.$_SESSION['order_email'].'</li>
<li><strong>ФИО:</strong>'.$_SESSION['order_fio'].'</li>
<li><strong>Адрес доставки:</strong>'.$_SESSION['order_address'].'</li>
<li><strong>Телефон:</strong>'.$_SESSION['order_phone'].'</li>
<li><strong>Примечание: </strong>'.$_SESSION['order_note'].'</li>
</ul>

';
}
 echo '
<h2 class="itog-price" align="right">Итого: <strong>'.$itogpricecart.'</strong> руб</h2>
  <p align="right" class="button-next" ><a href="" >Оплатить</a></p>

 ';



        break;

	    default:

   echo '
   <div id="block-step">
   <div id="name-step">
   <ul>
   <li><a class="active" >1. Корзина товаров</a></li>
   <li><span>&rarr;</span></li>
   <li><a>2. Контактная информация</a></li>
   <li><span>&rarr;</span></li>
   <li><a>3. Завершение</a></li>
   </ul>
   </div>
   <p>шаг 1 из 3</p>
   <a href="cart.php?action=clear" >Очистить</a>
   </div>
';


$result = mysql_query("SELECT * FROM cart,table_products WHERE cart.cart_ip = '{$_SERVER['REMOTE_ADDR']}' AND table_products.products_id = cart.cart_id_product",$link);

If (mysql_num_rows($result) > 0)
{
$row = mysql_fetch_array($result);

   echo '
   <div id="header-list-cart">
   <div id="head1" >Изображение</div>
   <div id="head2" >Наименование товара</div>
   <div id="head3" >Кол-во</div>
   <div id="head4" >Цена</div>
   </div>
   ';

do
{

$int = $row["cart_price"] * $row["cart_count"];
$all_price = $all_price + $int;

if  (strlen($row["image"]) > 0 && file_exists("./uploads_images/".$row["image"]))
{
$img_path = './uploads_images/'.$row["image"];
$max_width = 100;
$max_height = 100;
 list($width, $height) = getimagesize($img_path);
$ratioh = $max_height/$height;
$ratiow = $max_width/$width;
$ratio = min($ratioh, $ratiow);

$width = intval($ratio*$width);
$height = intval($ratio*$height);
}else
{
$img_path = "http://346071.allsoft.web.hosting-test.net/image/no_image.jpg";
$width = 120;
$height = 105;
}

echo '

<div class="block-list-cart">

<div class="img-cart">
<p align="center"><img src="'.$img_path.'" width="'.$width.'" height="'.$height.'" /></p>
</div>

<div class="title-cart">
<p><a href="">'.$row["title"].'</a></p>
<p class="cart-mini-features">
'.$row["mini_features"].'
</p>
</div>

<div class="count-cart">
<ul class="input-count-style">

<li>
<p align="center" iid="'.$row["cart_id"].'" class="count-minus">-</p>
</li>

<li>
<p align="center"><input id="input-id'.$row["cart_id"].'" iid="'.$row["cart_id"].'" class="count-input" maxlength="3" type="text" value="'.$row["cart_count"].'" /></p>
</li>

<li>
<p align="center" iid="'.$row["cart_id"].'" class="count-plus">+</p>
</li>

</ul>
</div>

<div id="tovar'.$row["cart_id"].'" class="price-product"><h5><span class="span-count" >'.$row["cart_count"].'</span> x <span>'.$row["cart_price"].'</span></h5><p price="'.$row["cart_price"].'" >'.group_numerals($int).' руб</p></div>
<div class="delete-cart"><a  href="cart.php?id='.$row["cart_id"].'&action=delete" ><img src="/images/bsk_item_del.png" /></a></div>

<div id="bottom-cart-line"></div>
</div>


';


}
 while ($row = mysql_fetch_array($result));

 echo '
 <h2 class="itog-price" align="right">Итого: <strong>'.group_numerals($all_price).'</strong> руб</h2>
 <p align="right" class="button-next" ><a href="cart.php?action=confirm" >Далее</a></p>
 ';

}
else
{
    echo '<h3 id="clear-cart" align="center">Корзина пуста</h3>';
}
        break;

}

?>-->

		</div>
		<div class="right-column">
			<?php include("include/block-voordelen.php");?>
		</div><!--right-column-->
		<div class="clear"></div>
	</div><!--index-top-block-->
</div>
<?php include("include/block-footer.php");?>
<?php include("include/block-popup-window.php");?>

</body>
</html>