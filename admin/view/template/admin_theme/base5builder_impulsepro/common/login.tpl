<?php echo $header; ?>
<div id="content" class="login">
	<div id="logo">
		<a href="./">
			<img src="view/image/admin_theme/base5builder_impulsepro/logo.png">
		</a>
	</div>
	<form class="form-signin" action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
		<div class="form-signin-heading">
			<div class="login-header-image">
				<img src="view/image/admin_theme/base5builder_impulsepro/icon-customers-large.png" alt="" />
			</div>
			<h2><?php echo $text_login; ?></h2>
			<div class="clearfix"></div>
		</div>
		<?php if ($success) { ?>
		<div class="alert alert-success"><?php echo $success; ?></div>
		<?php } ?>
		<?php if ($error_warning) { ?>
		<div class="alert alert-error">
			<button data-dismiss="alert" class="close" type="button">×</button>
			<?php echo $error_warning; ?>
		</div>
		<?php } ?>
		<div class="form-signin-body clearfix">
			<div class="form-signin-body-left">
				<label for="username"><?php echo $entry_username; ?></label>
				<input type="text" name="username" id="username" class="input-block-level" placeholder="Username" value="<?php echo $username; ?>">
				<label for="password"><?php echo $entry_password; ?></label>
				<input type="password" id="password" name="password" class="input-block-level" placeholder="Password" value="<?php echo $password; ?>">
				<a href="<?php echo $forgotten; ?>"><?php echo $text_forgotten; ?></a>
				<?php if ($redirect) { ?>
				<input type="hidden" name="redirect" value="<?php echo $redirect; ?>" />
				<?php } ?>
			</div>
			<div class="form-signin-body-right">
				<input class="btn btn-large btn-primary" value="<?php echo $button_login; ?>" type="button">
			</div>
		</div>

	</form>
	<div class="footer-info copyright">
		<div class="footer-info-opencart"><?php echo $text_footer; ?></div>
	</div>
</div>
<?php echo $footer; ?>