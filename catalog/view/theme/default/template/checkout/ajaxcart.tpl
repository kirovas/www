			<?php echo $content_top; ?>
			<div id="block-breadcrumbs">
			<?php foreach ($breadcrumbs as $breadcrumb) { ?>
    		<?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    		<?php } ?>
			</div>
			<!-- CART -->

			<?php if ($attention) { ?>
			<div class="attention"><?php echo $attention; ?><img src="/catalog/view/theme/default/images/close.png" alt="" class="close" /></div>
			<?php } ?>
			<?php if ($success) { ?>
			<div class="success"><?php echo $success; ?><img src="/catalog/view/theme/default/images/close.png" alt="" class="close" /></div>
			<?php } ?>
			<?php if ($error_warning) { ?>
			<div class="warning"><?php echo $error_warning; ?><img src="/catalog/view/theme/default/images/close.png" alt="" class="close" /></div>
			<?php } ?>

			<div id="content">
				<?php echo $content_top; ?>
				<h1><?php echo $heading_title; ?></h1>

				<div class="basket-box">
					<form onsubmit="return false;" action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
						<div class="basket-title">
							<div class="column-model">Модель</div>
							<div class="column-count">Количество</div>
							<div class="column-price">Цена</div>
							<div class="column-total">Сумма</div>
						</div>

						<?php foreach ($products as $product) { ?>
						<div class="block-list-cart">
							<div class="img-cart">
								<p>
									<a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a><br />модель: <?php echo $product['model']; ?>
									<?php if (!$product['stock']) { ?><span class="stock">***</span><?php } ?>
								</p>
								<img src="<?php echo $product['thumb']; ?>"  />
								<div>
									<?php foreach ($product['option'] as $option) { ?> - <small><?php echo $option['name']; ?>: <?php echo $option['value']; ?></small><br /><?php } ?>
								</div>
							</div>

							<div class="count-cart">
								<input class="count-input" type="text" name="quantity[<?php echo $product['key']; ?>]" value="<?php echo $product['quantity']; ?>" size="1" />
								<p align="center" class="count-minus">-</p>
								<p align="center" class="count-plus">+</p>
							</div>

							<div class="price-product"><p><?php echo $product['price']; ?></p></div>
							<div class="price-product"><p><?php echo $product['total']; ?></p></div>
							<div class="delete-cart"><a href="<?php echo $product['remove']; ?>"></a></div>
							<div class="clear"></div>
						</div>
						<?php } ?>
					</form>

					<div class="basket-form">
						<?php $total = $totals[1]; ?>
						<h2 class="itog-price" align="right"><?php echo $total['title']; ?>: <strong><?php echo $total['text']; ?></strong></h2>
						<!--<?php foreach ($totals as $total) { ?>
						<h2 class="itog-price" align="right"><?php echo $total['title']; ?>: <strong><?php echo $total['text']; ?></strong></h2>
						<?php } ?>-->
						<div id="basket-form">
							<h4>Оформление заказа</h4>
							<div id="dialog-basket" class="window-basket">
								<div id="text">
									<form onsubmit="return makeOrder();" name="feedback-basket" class="form" method="post" enctype="multipart/form-data">
										<table width="100%" cellspacing="2" cellpadding="10" border="0"><tbody>
											<tr>
												<td width="230" valign="middle" align="left" id="column-name">ФИО<sup>*</sup></td>
												<td valign="middle" align="left"><input type="text" id="10" name="ordername" size="50" style="width: 400px;"></td>
											</tr>
											<tr>
												<td valign="middle" align="left" id="column-phone">Ваш Телефон<sup>*</sup></td>
												<td valign="middle" align="left"><input type="text" id="13" name="orderphone" size="50" style="width: 400px;"></td>
											</tr>
											<tr>
												<td valign="top" align="left" id="column-address">Адрес доставки<sup>*</sup></td>
												<td valign="middle" align="left">
													<textarea name="orderaddress" cols="40" rows="1" style="width: 405px;" id="feedback_textarea2"></textarea>
													<div id="primer">например г. Кемерово, пр. Комсомольский 63, кв. 444</div>
												</td>
											</tr>
										</tbody></table>
										<center><input id="button-makeorder" type="submit" value="Оформить заказ" class="enter"></center>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div><!--basket-box-->
				<?php echo $content_bottom; ?>
			</div>
			<!-- /CART -->
  			<?php echo $content_bottom; ?>