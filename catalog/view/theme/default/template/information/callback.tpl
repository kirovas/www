<div id="call-form">
	<h4>Заказ обратного звонка</h4>
	<div id="dialog" class="window">
		<div id="text" class="callback-mustbeid">
			<form class="form-callback">
				<table width="100%" cellspacing="2" cellpadding="2" border="0"><tbody>
					<tr>
						<td width="120" valign="middle" align="left">Ваше Имя<sup>*</sup></td>
						<td valign="middle" align="left"><input type="text" id="10" name="name" size="50" style="width: 400px;"></td>
					</tr>
					<tr>
						<td valign="middle" align="left">Ваш Телефон<sup>*</sup></td>
						<td valign="middle" align="left"><input type="text" id="13" name="phone" size="50" style="width: 400px;"></td>
					</tr>
					<tr>
						<td valign="middle" align="left">Cообщение</td>
						<td valign="middle" align="left"><textarea name="message" cols="40" rows="1" style="width: 405px;" id="feedback_textarea2"></textarea></td>
                    </tr>
                    <tr>
                    	<td valign="middle" align="left"><?php echo $entry_captcha; ?></td>
                    	<td valign="middle" align="left">
                    		<input type="text" name="captcha" value="<?php echo $captcha; ?>" />
                    		<img src="index.php?route=information/contact/captcha" alt="" />
                    	</td>
                    </tr>
                </tbody></table>
                <center><input type="submit" value="Отправить" id="button-callback" class="enter"></center>
      		</form>
        </div>
	</div>
</div><!--call-form-->