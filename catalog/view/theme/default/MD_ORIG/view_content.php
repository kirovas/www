<?php	
   define('myeshop', true);
   include("include/db_connect.php");
   include("functions/functions.php");
   session_start();
   include("include/auth_cookie.php");
$sorting = $_GET["sort"];   
 
 
   
    

   $id = clear_string($_GET["id"]); 

     $seoquery = mysql_query("SELECT * FROM product_description WHERE product_id='$id'",$link);
     
     If (mysql_num_rows($seoquery) > 0)
     {
        $resquery = mysql_fetch_array($seoquery);

     }  
     $product_info = mysql_query("SELECT * FROM product WHERE product_id='$id'",$link);
     
     If (mysql_num_rows($product_info) > 0)
     {
        if($product = mysql_fetch_array($product_info))
		{
			$q = mysql_query("SELECT ad.attribute_id, ad.name, pa.text FROM product_attribute as pa, attribute_description as ad WHERE pa.attribute_id = ad.attribute_id AND pa.product_id='".$product['product_id']."'",$link) or die(mysql_error());
			while($r = mysql_fetch_array($q))
			{
				$product['features'][$r['attribute_id']] = $r;
			}
			$q = mysql_query("SELECT p.* FROM product as p, product_related as pr WHERE p.product_id = pr.related_id AND pr.product_id='".$product['product_id']."'",$link) or die(mysql_error());
			while($r = mysql_fetch_array($q))
			{
				$q2 = mysql_query("SELECT image FROM product_image WHERE product_id='".$r['product_id']."' LIMIT 1",$link);
				if($r2 = mysql_fetch_array($q2))
				{
					$r['image'] = $r2['image'];
				}
				$product['related'][] = $r;
			}
		}
     }
     $product_image = mysql_query("SELECT image FROM product_image WHERE product_id='$id'",$link);
     $product_special = mysql_query("SELECT price FROM product_special WHERE product_id='$id'",$link);
     


   
  If ($id != $_SESSION['countid'])
{
$querycount = mysql_query("SELECT count FROM product_description WHERE product_id='$id' ",$link);
$resultcount = mysql_fetch_array($querycount); 

$newcount = $resultcount["count"] + 1;

$update = mysql_query ("UPDATE product_description SET count='$newcount' WHERE product_id='$id'",$link);  
}

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
					<a href="view_cat.php?type=velo">Велосипеды</a> / <span><?php echo $resquery["name"]; ?></span>
					</div>
					
					<div class="product-item">
						<div class="product-item-img">
							<h1><?php echo $resquery["name"]; ?></h1>
							<div class="brand-item">Модель: <b><?php echo $product["model"]; ?></b></div> 
							<div class="big-img-item"><a class="fancybox" href="http://346071.allsoft.web.hosting-test.net/image/<?php echo $product["image"]; ?>" rel="mini_img"><img src="http://346071.allsoft.web.hosting-test.net/image/<?php echo $product["image"]; ?>" /></a></div>
							<?php If (mysql_num_rows($product_image) > 0){ ?>
							<div id="mini-img-slider-box">
							<div id="index-news-prev"></div>
							<div id="mini-img-slider">
							<ul>
							<?php
									while ($insert_product_image = mysql_fetch_array($product_image)){
										echo '<li><a class="fancybox" rel="mini_img" href="http://346071.allsoft.web.hosting-test.net/image/'.$insert_product_image["image"].'">
											<img src="http://346071.allsoft.web.hosting-test.net/image/'.$insert_product_image["image"].'" />
											</a></li>';
									}
							?>
							</ul>
							</div>
							<div id="index-news-next"></div>
							</div>
							<?php  }?>
						</div><!--product-item-img-->
						<div class="product-item-desc">
							<div class="price-box">
								 <?php
								 If (mysql_num_rows($product_special))
								 {
									$insert_product_special = mysql_fetch_array($product_special);
									$skidka = ceil((($insert_product_special['price'] - $product["price"])/$insert_product_special['price'])/100);
									echo '<div class="action-item">-'.$skidka.'%</div><div class="old-price"><span>'.$insert_product_special['price'].'</span> руб</div>';
								 }
								 ?>
								<div class="item-price"><span><?php echo substr($product["price"], 0, strlen($product["price"])-5); ?></span> руб</div>
							</div>
							<div class="size-box">
							<strong>Выбор характеристик:</strong>	<br />
                            	<br />
                                <?
                                $i = 1;
                                    //$product_id = $_GET['id'];
                                    
                                    $q_harater = mysql_query(" 
                                                            SELECT
                                                                *,
                                                                attribute_description.name AS name_h
                                    
                                                        
                                                            FROM 
                                                                product_attribute,
                                                                attribute_description
                                                            WHERE 
                                                                product_attribute.attribute_id  =  attribute_description.attribute_id 
                                                            AND 
                                                                product_attribute.product_id = $id 
                                                            
                                                            ")or die(mysql_error());
                                                           while ($q_harater_r = mysql_fetch_array($q_harater)){


                                                             $pars_text = explode(";", $q_harater_r["text"]);
                                                             
                                                             if (count($pars_text) >1){
                                                              echo 
                                                              $q_harater_r["name_h"].':
                                                              <select class="srelect_har">';   
                                                              foreach($pars_text as $value)
                                                              echo'<option class="options_h">'.$value.'</option>'; 
                                                              echo '</select><br />'; 
                                                             }
                                                             else {
                                                                
                                                              //echo $q_harater_r["name_h"].': <br />'.$q_harater_r["text"].'<br />';
                                                             }
                                                            }
                                       
                                 
                                    
                                                           
                                                          
                                                            
                                                            
                                                        
                                
                                ?>
                               
                                
                                                            
                                    
                                
								<!--<ul>
									<li>
									<input type="radio" value="check1" name="check" id="radio-size1">
									 <label for="radio-size1" class="l_f_d">XS</label><br>
									 </li>
									 <li>
									 <input type="radio" value="check2" name="check" id="radio-size2">
									 <label for="radio-size2" class="l_f_d">L</label><br>
									 </li>
									 <li>
									 <input type="radio" value="check3" name="check" id="radio-size3">
									 <label for="radio-size3" class="l_f_d">S</label>
									 </li>
									 <li>
									 <input type="radio" value="check4" name="check" id="radio-size4">
									 <label for="radio-size4" class="l_f_d">M</label>
									 </li>
									 <li>
									 <input type="radio" value="check5" name="check" id="radio-size5">
									 <label for="radio-size5" class="l_f_d">XL</label>
									 </li>
								</ul>-->
							</div>
							<div class="add-cart-item">
								<a class="add-cart" id="add-cart-view" tid="<?php echo $resquery["product_id"]; ?>" >Положить в корзину</a>
								Или <a class="index-one-clik" tid="<?php echo $resquery["product_id"]; ?>" href="#index-one-clik">заказать в один клик</a>
							</div>
							<div class="call-box-item">
								<div class="call-box-item-title">Возникли вопросы или сложности?</div>
								<div class="call-box-item-content">
									Позвоните нам
									<span>+7 950 000 0000</span>
									<p>Или <a class="call-form" href="#call-form">закажите обратный звонок</a></p>
									
								</div>
							</div>
						</div><!--product-item-desc -->
						<div class="clear"></div>
					</div><!--product-item-->
					<div class="clear"></div>
 

					<div class="menu-index-toval-box">
						<a href="#hit-product" class="active">Описание</a>
						<a href="#new-product">Характеристики</a>
						<a href="#korting-product">Отзывы</a>
						<div class="clear"></div>
					</div>
					<div class="index-toval-list">
						<div id="hit-product" class="active">
							<?php echo htmlspecialchars_decode($resquery["description"]); ?>
						</div>
						<div id="new-product">
						<? foreach($product["features"] as $feature) { ?>
							<ul>
								<li>
									<b><?=$feature['name']?></b>: <?=$feature['text']?>
								</li>
							</ul>
						<? } ?>
						</div>
						<div id="korting-product">
										<p id="link-send-review" ><a class="send-review" href="#send-review" >Написать отзыв</a></p>

										<div class="block-reviews" >
										<p class="author-date" ><strong><?=$row_reviews["name"]?></strong>, <?=$row_reviews["date"]?></p>
										<img src="/images/plus-reviews.png" />
										<p class="textrev" ><?=$row_reviews["good_reviews"]?></p>
										<img src="/images/minus-reviews.png" />
										<p class="textrev" ><?=$row_reviews["bad_reviews"]?></p>

										<p class="text-comment"><?=$row_reviews["comment"]?></p>
										</div>


						</div>
					</div>
					
					



						<div id="send-review" >
						
						<p align="right" id="title-review">Публикация отзыва производится после предварительной модерации.</p>
						
						<ul>
						<li><p align="right"><label id="label-name" >Имя<span>*</span></label><input maxlength="15" type="text"  id="name_review" /></p></li>
						<li><p align="right"><label id="label-good" >Достоинства<span>*</span></label><textarea id="good_review" ></textarea></p></li>    
						<li><p align="right"><label id="label-bad" >Недостатки<span>*</span></label><textarea id="bad_review" ></textarea></p></li>     
						<li><p align="right"><label id="label-comment" >Комментарий</label><textarea id="comment_review" ></textarea></p></li>     
						</ul>
						<p id="reload-img"><img src="/images/loading.gif"/></p> <p id="button-send-review" iid="<?=$id?>" ></p>
						</div>




				
					<div class="ook-kopen">
						<h2>C этим товаром также покупают</h2>

						
                        
                        	<?
                                        //C ЭТИМ ТОВАРОМ ПОКУПАЮТ 
                                      $q_related = mysql_query("

                                                SELECT
                                                        product.*,
                                                        product_description.* 
                                                FROM
                                                        product_description,
                                                        product,
                                                        product_related
                                                        
                                                WHERE 
                                                        product_related.product_id = $id
                                                        AND 
                                                        product_related.related_id = product.product_id
                                                        AND 
                                                        product.product_id = product_description.product_id

                                                                            ",$link)or die(mysql_error());
                                                        
                                                          
                                        while ($row_related = mysql_fetch_array($q_related)){
                                          
                                        // print_r($row_related); 
                                          
                                          
                                        
                                        
                                        
                                        
                                        
                                        echo '
                                        
                                            	<div class="index-product-item" >
								<ul class="hover-index-menu">
									<li>
										<a class="index-desc" href="view_content.php?id='.$row_related['product_id'].'"><img src="images/index-desc.png" /><br />Описание</a>
									</li>
									<li>
										<a class="index-vergelijk" href="#"><img src="images/index-vergelijk.png" /><br />Сравнить</a>
									</li>
									<li>
										<a class="index-one-clik" href="#index-one-clik" tid="'.$row_related['product_id'].'" ><img src="images/index-one-clik.png" /><br />Заказать в<br /> один клик</a>
									</li>
									<li>
										<a class="index-add-basket add-cart" tid="'.$row_related['product_id'].'" ><img src="images/index-add-basket.png" /><br />Добавить в<br /> корзину</a>
									</li>  
								</ul>
								<div class="index-product-img">
									<img src="http://346071.allsoft.web.hosting-test.net/image/'.$row_related['image'].'" title="'.$row_related["title"].'" />
								</div>
								<div class="title">'.$row_related["name"].'</div>
								<div class="index-product-price"><strong>'.group_numerals($row_related["price"]).'</strong> руб.</div>
							</div>
                                        
                                        '; 
                                        
                                  }
                    
                    
                    ?>
                        
                        
                        
                        
                        
                        
						
							
						<div class="clear"></div>
					</div><!--ook-kopen-->

		
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