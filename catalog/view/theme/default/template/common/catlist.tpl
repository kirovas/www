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
            <div class="catalog-box">
						<a href="/bicycles/" id="velo"><span>Велосипеды</span><div></div></a>
						<a href="/accessories/" id="accessoires"><span>Аксессуары</span><div></div></a>
						<a href="/bicycle_parts/" id="velozapchasti"><span>Велозапчасти</span><div></div></a>
						<a href="/simulators/" id="simulatoren"><span>Тренажёры</span><div></div></a>
						<a href="/bicycle_clothes/" id="meloodia"><span>Велоодежда</span><div></div></a>
						<div class="clear"></div>
			</div><!--catalog-box-->
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