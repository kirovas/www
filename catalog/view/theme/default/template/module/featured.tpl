<?php foreach ($products as $product) { ?>
<div class="index-product-item" >
	<ul class="hover-index-menu">
		<li><a class="index-desc" href="<?php echo $product['href']; ?>"><img src="/catalog/view/theme/default/images/index-desc.png" /><br />Описание</a></li>
		<li><a class="index-vergelijk" onclick="addToCompare('<?php echo $product['product_id']; ?>');"><img src="/catalog/view/theme/default/images/index-vergelijk.png" /><br />Сравнить</a></li>
		<li><a class="index-one-clik" href="#index-one-clik" tid="'.$row["product_id"].'" ><img src="/catalog/view/theme/default/images/index-one-clik.png" /><br />Заказать в<br /> один клик</a></li>
		<li><a class="index-add-basket" onclick="addToCart('<?php echo $product['product_id']; ?>');" ><img src="/catalog/view/theme/default/images/index-add-basket.png" /><br />Добавить в<br /> корзину</a></li>
	</ul>
	<div class="index-product-img"><img src="<?php echo $product['thumb']; ?>" title="<?php echo $product['name']; ?>" /></div>
	<div class="title"><?php echo $product['name']; ?></div>
	<div class="index-product-price">
		<?php if (!$product['special']) { ?>
        <?php echo $product['price']; ?>
        <?php } else { ?>
        <span class="price-old"><?php echo $product['price']; ?></span> <span class="price-new"><?php echo $product['special']; ?></span>
        <?php } ?>
  	</div>
</div>
<?php } ?>

<!--<div class="box">
  <div class="box-heading"><?php echo $heading_title; ?></div>
  <div class="box-content">
    <div class="box-product">
      <?php foreach ($products as $product) { ?>
      <div>
        <?php if ($product['thumb']) { ?>
        <div class="image"><a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" /></a></div>
        <?php } ?>
        <div class="name"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></div>
        <?php if ($product['price']) { ?>
        <div class="price">
          <?php if (!$product['special']) { ?>
          <?php echo $product['price']; ?>
          <?php } else { ?>
          <span class="price-old"><?php echo $product['price']; ?></span> <span class="price-new"><?php echo $product['special']; ?></span>
          <?php } ?>
        </div>
        <?php } ?>
        <?php if ($product['rating']) { ?>
        <div class="rating"><img src="catalog/view/theme/default/image/stars-<?php echo $product['rating']; ?>.png" alt="<?php echo $product['reviews']; ?>" /></div>
        <?php } ?>
        <div class="cart"><input type="button" value="<?php echo $button_cart; ?>" onclick="addToCart('<?php echo $product['product_id']; ?>');" class="button" /></div>
      </div>
      <?php } ?>
    </div>
  </div>
</div>-->