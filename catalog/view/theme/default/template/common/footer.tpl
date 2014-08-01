<!-- footer -->
<div id="footer">
	<div id="block-footer">
		<div id="footer-phone">
			<h4>Служба поддержки</h4>
			<h3>8 (800) 123-45-67</h3>
			<p>Режим работы:<br />Будние дни: с 9:00 до 18:00<br />Суббота, Воскресенье - выходные</p>
		</div>
		<div class="footer-logo">
			<h4><a href="/"><img alt="Bike store" title="Bike store" src="/catalog/view/theme/default/images/footer-logo.png"></a></h4>
			<p>Рассказать о сайте</p>
<script type="text/javascript">
(function() {
	if (window.pluso)if (typeof window.pluso.start == "function") return;
	var d = document, s = d.createElement('script'), g = 'getElementsByTagName';
    s.type = 'text/javascript'; s.charset='UTF-8'; s.async = true;
    s.src = ('https:' == window.location.protocol ? 'https' : 'http')  + '://share.pluso.ru/pluso-like.js';
    var h=d[g]('head')[0] || d[g]('body')[0];
    h.appendChild(s);
})();
</script>
			<div class="pluso" data-options="small,square,line,horizontal,nocounter,theme=08" data-services="vkontakte,odnoklassniki,facebook,twitter,google,moimir,email,print" data-background="#ebebeb"></div>
		</div>
		<div class="footer-list">
			<p>Сервис и Помощь</p>
			<ul>
				<li><a href="#">Как сделать заказ</a></li>
				<li><a href="#">Способы оплаты</a></li>
				<li><a href="#">Возврат</a></li>
				<li><a href="#">Публичная оферта</a></li>
			</ul>
		</div>
		<div class="footer-list">
			<p>О Компании:</p>
			<ul>
				<li><a href="#">О нас</a></li>
				<li><a href="#">Вакансии</a></li>
				<li><a href="#">Партнерам</a></li>
				<li><a href="#">Контакты</a></li>
			</ul>
		</div>
		<div class="footer-list">
			<p>Навигация</p>
			<ul>
				<li><a href="/">Главная страница</a></li>
				<li><a href="#">Обратная связь</a></li>
			</ul>
		</div>
	</div>
</div>
<!-- /footer -->

<div id="index-one-clik">
	<h4>Ваши данные</h4>
	<div id="dialog" class="window">
		<div id="text">
			<form name="feedback" class="form">
				<table width="100%" cellspacing="2" cellpadding="2" border="0"><tbody>
					<tr>
						<td width="120" valign="middle" align="left">Ваше Имя<sup>*</sup></td>
						<td valign="middle" align="left"><input type="text" id="10" name="name" size="50" style="width: 400px;"></td>
					</tr>
                    <tr>
                        <td valign="middle" align="left">Ваш Телефон<sup>*</sup></td>
                        <td valign="middle" align="left"><input type="text" id="13" name="telefon" size="50" style="width: 400px;"></td>
                    </tr>
                    <tr>
                        <td valign="middle" align="left">Адрес доставки<sup>*</sup></td>
                        <td valign="middle" align="left"><textarea name="comment" cols="40" rows="1" style="width: 405px;" id="feedback_textarea2"></textarea></td>
                    </tr>
                </tbody></table>
                <center><input type="submit" value="Заказать" id="uslugi_submit" class="enter"></center>
     		</form>
     	</div>
     </div>
</div><!--index-one-clik-->

<?php echo $callback; ?>

</body>
</html>