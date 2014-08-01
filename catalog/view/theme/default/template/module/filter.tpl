<div id="block-parameter">
<ul id="type_filter">
      <?php foreach ($filter_groups as $filter_group) { ?>
      <li id="filter-group<?php echo $filter_group['filter_group_id']; ?>"><a href="#"><?php echo $filter_group['name']; ?></a>
        <ul>
          <?php foreach ($filter_group['filter'] as $filter) { ?>
          <li>
            <input type="checkbox" value="<?php echo $filter['filter_id']; ?>" id="filter<?php echo $filter['filter_id']; ?>" <?php if (in_array($filter['filter_id'], $filter_category)) { echo ' checked="checked" '; } ?> />
            <label for="filter<?php echo $filter['filter_id']; ?>"><?php echo $filter['name']; ?></label>
          </li>
          <?php } ?>
        </ul>
      </li>
      <img class="filter_s_b" src="/catalog/view/theme/default/images/filter_s_b.jpg" />
      <?php } ?>
</ul>
      	<div id="blocktrackbar"></div>
      	<br />
      	<center><img class="filter_s_b" src="/catalog/view/theme/default/images/filter_s_b.jpg" /><a id="button-param-search">ПОДОБРАТЬ</a></center>
</div>

<script type="text/javascript"><!--
$('#button-param-search').bind('click', function() {
	filter = [];

	$('#block-parameter input[type=\'checkbox\']:checked').each(function(element) {
		filter.push(this.value);
	});

	location = '<?php echo $action; ?>&filter=' + filter.join(',') + '&minprice=' + $("#minprice").val() + '&maxprice=' + $("#maxprice").val();
});
//--></script>

<!-- Filter -->
<script type="text/javascript">
$(document).ready(function() {
	    $('#blocktrackbar').trackbar({
	onMove : function() {
		$("#minprice").val(this.leftValue);
		$("#maxprice").val(this.rightValue);
	},
	width : 185,
	leftLimit : 1000,
	leftValue : <?php echo $leftvalue; ?>,
	rightLimit : 50000,
	rightValue : <?php echo $rightvalue; ?>,
	roundUp : 1000
});
});
</script>
<span id="minprice" style="display:none;"></span>
<span id="maxprice" style="display:none;"></span>

<!-- /Filter -->