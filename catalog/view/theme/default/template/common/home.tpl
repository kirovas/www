<?php echo $header; ?>

<div id="block-body">
	<div class="index-top-block">
		<div class="lc">
			<div class="filter-arrow"></div>
			<?php echo $column_left_top; ?>
		</div>
		<div class="rc">
			<?php echo $content_top; ?>
			<!--
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
					<img src="/catalog/view/theme/default/images/slider/slide1.jpg" data-thumb="/catalog/view/theme/default/images/slider/slide1.jpg" alt="" title="#htmlcaption" />
					<img src="/catalog/view/theme/default/images/slider/slide2.jpg" data-thumb="/catalog/view/theme/default/images/slider/slide2.jpg" alt="" title="#htmlcaption2" />
				</div>
				<div id="htmlcaption" class="nivo-html-caption">
					<h3>Стильные городские <br />велосипеды</h3>
					<a href="/bicycles/">Смотреть все</a>
				</div>
				<div id="htmlcaption" class="nivo-html-caption">
					<h3>Стильные городские <br />велосипеды</h3>
					<a href="/bicycles/">Смотреть все</a>
				</div>
			</div>
			-->
		</div>
		<div class="right-column">
			<?php echo $column_right_top; ?>
		</div><!--right-column-->
		<div class="clear"></div>
	</div><!--index-top-block-->
</div>


<!-- iD? -->
	<div class="index-bottom-block">
		<div id="block-body">

			<div id="brands-slider-box">
				<div id="index-news-prev"></div>
				<div id="brands-slider">
					<ul>
						<li><img src="/catalog/view/theme/default/images/carousel/agang.jpg" /></li>
						<li><img src="/catalog/view/theme/default/images/carousel/author.jpg" /></li>
						<li><img src="/catalog/view/theme/default/images/carousel/biceco.jpg" /></li>
						<li><img src="/catalog/view/theme/default/images/carousel/giant.jpg" /></li>
						<li><img src="/catalog/view/theme/default/images/carousel/head.jpg" /></li>
						<li><img src="/catalog/view/theme/default/images/carousel/kettler.jpg" /></li>
					</ul>
				</div>
				<div id="index-news-next"></div>
			</div>

			<div class="lc"><?php echo $column_left_bottom; ?></div>

			<div class="rc">
				<div class="index-toval-box">
					<script type="text/javascript" src="/catalog/view/theme/default/js/index-script.js"></script>
					<div class="menu-index-toval-box">
						<a class="active" href="#hit-product">Хиты продаж</a>
						<a href="#new-product">Новинки</a>
						<a href="#korting-product">Скидки</a>
						<div class="clear"></div>
					</div>
					<div class="index-toval-list">
					<div id="hit-product" class="active"><!-- ХИТЫ ПРОДАЖ -->
						<?php echo $featured; ?>
					</div><!--  AND ХИТЫ ПРОДАЖ  hit-product-->

					<div id="new-product"><!-- НОВИНКИ  -->
							  <?php echo $latest; ?>
					</div><!-- AND  НОВИНКИ  new-product-->

					<div id="korting-product"><!-- СКИДКИ -->
                              <?php echo $special; ?>
					</div><!-- AND  СКИДКИ  korting-product-->
					</div>
					</div>
				</div>
				<div class="right-column">

                 <?php echo $column_right_bottom; ?>


				</div><!--right-column-->
			<div class="clear"></div>
			</div>
		</div>
	</div><!--index-bottom-block-->
<?php echo $content_bottom; ?>

<?php echo $footer; ?>