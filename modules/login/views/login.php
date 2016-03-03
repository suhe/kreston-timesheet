<?php echo $_SERVER['REMOTE_ADDR']; ?>
<form accept-charset="utf-8" method="post" action="<?php echo base_url();?>login/user/do_login">		
<fieldset>
			<legend>Log In</legend>
			<ol>
				<li>
					<label for="email">Staff No</label>
					<span><input type="text" value="" name="no" /></span>
				</li>
				<li>
					<label for="password">Password:</label>
					<span><input type="password" value="" name="password" /></span>
				</li>
				<li>
					<div class="float-right">
						<input type="image" src="{$base_url}images/bt-login.gif" name="submit">
					</div>
				</li>
			</ol>
		</fieldset>		
</form>