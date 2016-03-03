<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
	<title><?php echo $title;?> Log In</title>
	<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/login.css" />

</head>
<body>
	<div id="distance"></div>
	<div id="container">
		<div id="top">
			<h1><a href="http://www.epps.co.id/">ADMIN EPPS</a></h1>
		</div>
		
        <div>
            <?php echo $this->session->flashdata('message'); ?>
        </div>
        
		<form accept-charset="utf-8" method="post" action="<?php echo base_url()?>login/admin/do_login">		
        <fieldset>
			<legend>Log In</legend>
			<ol>
				<li>
					<label for="email">Staff No:</label>
					<span><input type="text" value="" name="no" /></span>
				</li>
				<li>
					<label for="password">Password:</label>
					<span><input type="password" value="" name="password" /></span>
				</li>
				<li>
					<div class="float-right">
						<input type="image" src="<?php echo base_url();?>assets/images/bt-login.gif" name="submit">
					</div>
				</li>
			</ol>
		</fieldset>
		
		</form>	</div>
</body>
</html>