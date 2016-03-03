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
			<h1><a href="http://www.epps.co.id/">Time Report System V.1.0 Beta 5</a></h1>
		</div>
		
        <div>
            <?php echo $this->session->flashdata('message'); ?>
        </div>
        
		<form accept-charset="utf-8" method="post" action="<?php echo base_url()?>login/user/do_login">		
        <fieldset>
			<legend>Log In to </legend>
			<ol>
				<li>
					<label for="email">Staff No:</label>
					<span><input type="text" value="" name="no" maxlength="5" /></span>
				</li>
				
                <li>
					<label for="password">Password:</label>
					<span><input type="password" value="" name="password" /></span>
				</li>
                <!--
				<li>
					<label for="level"></label>
					<div class="float-left">
                        <select name="level" id="level">
                            <option value="P">P (Partner)</option>
                            <option value="M">M (Manager)</option>
                            <option value="AM">AM (Assistant Manager)</option>
                            <option value="S2">S2 (Senior Manager 2)</option>
                            <option value="S1">S1 (Senior Manager 1)</option>
                            <option value="AS">AS (Assistant Senior)</option>
                            <option value="TA">TA (Technical Assistant)</option>
                            <option value="ADM">ADM (Administrator)</option>
                            <option value="HRD">HRD (HRD & GA Manager)</option>
                            <option value="ACC">ACC (Accounting)</option>
                        </select>
                   </div>
				</li>
				-->
				<li>
					<!--<div class="float-right">-->
						<input type="image" src="<?php echo base_url();?>assets/images/bt-login.gif" name="submit">
					<!--</div>-->
				</li>
			</ol>
		</fieldset>
		
		</form>	</div>
</body>
</html>
