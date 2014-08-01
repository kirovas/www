<div class="slider-wrapper theme-default">
	<div id="slider<?php echo $module; ?>" class="nivoSlider" style="width: <?php echo $width; ?>px; height: <?php echo $height; ?>px;">
		<?php $banneri = 0; foreach ($banners as $banner) { ?>
		<img src="<?php echo $banner['image']; ?>" data-thumb="<?php echo $banner['image']; ?>" alt="" title="#htmlcaption<?php echo $module.$banneri; ?>" />
		<?php $banneri++; } ?>
	</div>
	<?php $banneri = 0; foreach ($banners as $banner) { ?>
	<div id="htmlcaption<?php echo $module.$banneri; ?>" class="nivo-html-caption">
		<h3><?php echo $banner['title']; ?></h3>
		<a href="<?php echo $banner['link']; ?>">Смотреть все</a>
	</div>
	<?php $banneri++; } ?>
</div>

<script type="text/javascript">
$(window).load(function() {
	$('#slider<?php echo $module; ?>').nivoSlider({
		prevText: 'Назад',
		nextText: 'Вперёд',
		directionNavHide : true,
		controlNavThumbs: true,
		directionNav: true,
		controlNav: false
	});
});
</script>