<?php echo $header; ?>
<div id="block-body">
	<div class="index-top-block">
		<div class="lc">
			<div class="filter-arrow"></div>
			<?php echo $column_left_top; ?>
			<?php echo $column_left_bottom; ?>
		</div>
		<div class="rc">
			<?php echo $content_top; ?>
			<div id="block-breadcrumbs">
			<?php foreach ($breadcrumbs as $breadcrumb) { ?>
    		<?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    		<?php } ?>
			</div>

			<!-- CATEGORY -->

 <?php if ($thumb || $description) { ?>
  <div class="category-info">
    <?php if ($thumb) { ?>
    <div class="image"><img src="<?php echo $thumb; ?>" alt="<?php echo $heading_title; ?>" /></div>
    <?php } ?>
    <?php if ($description) { ?>
    <?php echo $description; ?>
    <?php } ?>
  </div>
  <?php } ?>
  <div class="clear"></div>
  <!--<h1><?php echo $heading_title; ?></h1>-->

<?php if ($products) { ?>

<div id="block-sorting">
		<ul id="options-list">
			<li>Сортировать по</li>
			<li><a id="select-sort"><?php foreach ($sorts as $sorts_temp) if ($sorts_temp['value'] == $sort . '-' . $order) echo $sorts_temp['text']; ?></a>
				<ul id="sorting-list">
       				<?php foreach ($sorts as $sorts) { ?>
       				<li><a href="<?php echo $sorts['href']; ?>"><?php echo $sorts['text']; ?></a></li>
       				<?php } ?>
				</ul>
			</li>
			<li>Товаров на страницу</li>
			<li><a id="select-pack"><?php echo $limit; ?></a>
				<ul id="pack-list">
					<?php foreach ($limits as $limits) { ?>
        			<li><a href="<?php echo $limits['href']; ?>"><?php echo $limits['text']; ?></a></li>
        			<?php } ?>
				</ul>
			</li>
		</ul>
	<div class="clear"></div>
	<a href="<?php echo $compare; ?>" id="compare-total"><?php echo $text_compare; ?></a>
</div>

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
        <?php } ?></div>
	</div>
    <?php } ?>
	<div class="clear"></div>
<?php echo $pagination; ?>
<?php } ?>


<?php if (!$products) { ?>
<?php echo $text_empty; ?>
<?php } ?>

  			<!-- /CATEGORY -->
  			<?php echo $content_bottom; ?>
		</div>
		<div class="right-column">
			<?php echo $column_right_top; ?>
			<?php echo $column_right_bottom; ?>
		</div><!--right-column-->
		<div class="clear"></div>
	</div><!--index-top-block-->
</div>
<?php echo $footer; ?>