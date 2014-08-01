<!DOCTYPE html>
<html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>">
<head>
	<meta charset="UTF-8" />
	<title><?php echo $title; if (isset($_GET['page'])) { echo " - ". ((int) $_GET['page'])." ".$text_page;} ?></title>
	<base href="<?php echo $base; ?>" />
	<?php if ($description) { ?>
	<meta name="description" content="<?php echo $description; if (isset($_GET['page'])) { echo " - ". ((int) $_GET['page'])." ".$text_page;} ?>" />
	<?php } ?>
	<?php if ($keywords) { ?>
	<meta name="keywords" content="<?php echo $keywords; ?>" />
	<?php } ?>
	<meta property="og:title" content="<?php echo $title; if (isset($_GET['page'])) { echo " - ". ((int) $_GET['page'])." ".$text_page;} ?>" />
	<meta property="og:type" content="website" />
	<meta property="og:url" content="<?php echo $og_url; ?>" />
	<?php if ($og_image) { ?>
	<meta property="og:image" content="<?php echo $og_image; ?>" />
	<?php } else { ?>
	<meta property="og:image" content="<?php echo $logo; ?>" />
	<?php } ?>
	<meta property="og:site_name" content="<?php echo $name; ?>" />
	<?php if ($icon) { ?>
	<link href="<?php echo $icon; ?>" rel="icon" />
	<?php } ?>
	<link href="http://fonts.googleapis.com/css?family=Open+Sans&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
	<link href="http://fonts.googleapis.com/css?family=Lobster&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
	<!-- OC LINKS -->
	<?php foreach ($links as $link) { ?>
	<link href="<?php echo $link['href']; ?>" rel="<?php echo $link['rel']; ?>" />
	<?php } ?>
	<!-- /OC LINKS -->
	<link href="/catalog/view/theme/default/css/reset.css" rel="stylesheet" type="text/css" />
	<link href="/catalog/view/theme/default/css/style.css" rel="stylesheet" type="text/css" />
	<link href="/catalog/view/theme/default/css/trackbar.css" rel="stylesheet" type="text/css" />
	<link href="/catalog/view/theme/default/fancybox/jquery.fancybox.css" rel="stylesheet" type="text/css" />
	<?php foreach ($styles as $style) { ?>
	<link rel="<?php echo $style['rel']; ?>" type="text/css" href="<?php echo $style['href']; ?>" media="<?php echo $style['media']; ?>" />
	<?php } ?>
	<script type="text/javascript" src="/catalog/view/theme/default/js/jquery-1.8.2.min.js"></script>
	<script type="text/javascript" src="/catalog/view/theme/default/js/jcarousellite_1.0.1.js"></script>
	<script type="text/javascript" src="/catalog/view/theme/default/js/jquery.countdown.js"></script>
	<script type="text/javascript" src="/catalog/view/theme/default/js/shop-script.js"></script>
	<script type="text/javascript" src="/catalog/view/theme/default/js/jquery.cookie.min.js"></script>
	<script type="text/javascript" src="/catalog/view/theme/default/js/jquery.trackbar.js"></script>
	<script type="text/javascript" src="/catalog/view/theme/default/js/TextChange.js"></script>
	<script type="text/javascript" src="/catalog/view/theme/default/fancybox/jquery.fancybox.js"></script>
	<script type="text/javascript" src="/catalog/view/javascript/common.js"></script> <!-- OC JS -->
	<?php foreach ($scripts as $script) { ?>
	<script type="text/javascript" src="<?php echo $script; ?>"></script>
	<?php } ?>

	<?php echo $google_analytics; ?>
</head>

<body>
<div class="header">
    <div id="block-header">
    	<h1 id="logo">
        	<a href="/"><img alt="Bike store" title="Bike store" src="/catalog/view/theme/default/images/logo.png"></a>
        </h1>
        <div class="header-contact">info@bikestore.ru<br> +7 950 000 0000</div>
        <div class="header-call-box">
            <a class="call-form" href="#call-form">Закажите обратный<br> звонок</a>
        </div>
        <ul class="social">
            <li><a title="Мы в Вконтакте" href="#" id="vk">Мы в Вконтакте</a></li>
            <li><a title="Мы в Facebook" href="#" id="facebook">Мы в Facebook</a></li>
            <li><a title="Мы в Livejournal" href="#" id="lj">Мы в Livejournal</a></li>
            <li><a title="Мы в Twitter" href="#" id="twitter">Мы в Twitter</a></li>
        </ul>
        <?php echo $cart; ?>
    </div>
</div><!--header-->
<div id="header-menu">
  <ul>
    <li><a href="/">Главная</a></li>
    <li><a href="/about/">О компании</a></li>
    <li><a href="/index.php?route=common/catlist">Каталог</a></li>
    <li><a href="/payment_and_shipping/">Оплата и доставка</a></li>
    <li><a href="/guarantees/">Гарантии</a></li>
    <li><a href="#">Как сделать заказ</a></li>
    <li><a href="#">Отзывы</a></li>
    <li><a href="#">Оптовым покупателям</a></li>
    <li><a href="/index.php?route=information/contact">Обратная связь</a></li>
  </ul>
</div><!--header-menu-->
<div id="notification"></div>