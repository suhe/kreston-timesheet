<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US">
<head>
	<title><?php echo $title; ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel='stylesheet' id='login-css'  href='<?php echo base_url();?>templates/login/css/login.css' type='text/css' media='all' />
<link rel='stylesheet' id='colors-fresh-css'  href='<?php echo base_url();?>templates/login/css/colors-fresh.css' type='text/css' media='all' />
<meta name='robots' content='noindex,nofollow' />
</head>
<body class="login">
<div id="login">

<form name="loginform" id="loginform" action="<?php echo base_url().'login/user/do_login'; ?>" method="post">

	<p>
		<label>Staff No<br />
		<input type="text" name="no" id="user_login" class="input" value="" size="20" tabindex="10" /></label>
	</p>
	<p>
		<label>Password<br />
		<input type="password" name="password" id="user_pass" class="input" value="" size="20" tabindex="20" /></label>
	</p>

	<p class="forgetmenot"><label><input name="rememberme" type="checkbox" id="rememberme" value="forever" tabindex="90" /> Remember Me</label></p>
	<p class="submit">
		<input type="submit" name="login" id="wp-submit" class="button-primary" value="Log In" tabindex="100" />
		
	</p>
</form>

<p id="nav">

<a href="<?php echo (isset($_SERVER['HTTPS']) ? 'https://' : 'http://').$_SERVER['HTTP_HOST']; ?>" title="Password Lost and Found">KAP Hendrawinata Eddy & Siddharta</a>
</p>
</div>
<p id="backtoblog"><a href="#" title="Version 2">&larr; Time Report System V.2</a></p>
</body>
</html>
