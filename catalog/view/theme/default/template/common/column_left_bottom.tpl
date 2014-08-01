<!-- categories -->
<div id="block-category">
	<ul>
		<li class="title-velo-block">
			<div class="main-menu-title-block" id="title-velo-block">Велосипеды<a id="index1" rel="vizible"></a></div>
			<ul class="category-section">
			<?php foreach ($categories[62]["children"] as $category) { ?>
				<li><a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a></li>
			<?php }	?>
				<li><a href="/bicycles/">Все велосипеды</a></li>
			</ul>
		</li>
		<li>
			<div class="main-menu-title-block" id="title-accessoires-block">Аксессуары<a id="index2" ></a></div>
			<ul class="category-section">
			<?php foreach ($categories[59]["children"] as $category) { ?>
				<li><a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a></li>
			<?php }	?>
				<li><a href="/accessories/">Все аксессуары</a></li>
			</ul>
		</li>
		<li>
			<div class="main-menu-title-block" id="title-onderdelen-block">Велозапчасти<a id="index3" ></a></div>
			<ul class="category-section" style="display:none;">
			<?php foreach ($categories[60]["children"] as $category) { ?>
				<li><a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a></li>
			<?php }	?>
				<li><a href="/bicycle_parts/" >Все Велозапчасти</a></li>
			</ul>
		</li>
		<li>
			<div class="main-menu-title-block" id="title-kleding-block">Велоодежда<a id="index4" ></a></div>
			<ul class="category-section" style="display:none;">
			<?php foreach ($categories[61]["children"] as $category) { ?>
				<li><a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a></li>
			<?php }	?>
				<li><a href="/bycicle_clothes/">Вся Велоодежда</a></li>
			</ul>
		</li>
		<li>
			<div class="main-menu-title-block" id="title-simulatoren-block">Тренажёры<a id="index5" ></a></div>
			<ul class="category-section" style="display:none;">
			<?php foreach ($categories[63]["children"] as $category) { ?>
				<li><a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a></li>
			<?php }	?>
				<li><a href="/simulators/">Все тренажёры</a></li>
			</ul>
		</li>
	</ul>
</div>
			<!-- /categories -->

				<div class="articles-block">
					<h3>Как выбрать <span>велосипед</span></h3>
					<ul>
						<li><a href="#">Какой-то прекрасный совет здесь</a></li>
						<li><a href="#">Еще замечательный один совет</a></li>
					</ul>
					<a class="all-articles">Посмотреть все</a>
					<div class="clear"></div>
				</div><!--articles-block-->
				<div class="payment-block">
					<h3>Мы принимаем <br />к оплате</h3>
					<ul>
						<li><a href="#"><img src="/catalog/view/theme/default/images/paypal.jpg" /></a></li>
						<li><a href="#"><img src="/catalog/view/theme/default/images/mastercard.jpg" /></a></li>
						<li><a href="#"><img src="/catalog/view/theme/default/images/yandex.jpg" /></a></li>
						<li><a href="#"><img src="/catalog/view/theme/default/images/webmoney.jpg" /></a></li>
						<li><a href="#"><img src="/catalog/view/theme/default/images/visa.jpg" /></a></li>
						<li><a href="#"><img src="/catalog/view/theme/default/images/qiwi.jpg" /></a></li>
					</ul>
					<div class="clear"></div>
				</div><!--payment-block-->

<?php /*if ($modules) {*/ ?>
<!--<div id="column-left">-->
  <?php /*foreach ($modules as $module) {
   echo $module;
   }*/ ?>
<!--</div>-->
<?php /*}*/ ?>
