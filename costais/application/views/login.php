<div class="outer">
<div id="login_form">
	
	<h2>Login</h2>
	
	<?php echo form_open('action/login'); ?>
	
		<div>
		<?php 
			$logEmData = array(
				'name' => 'log_email',
				'id' => 'log_email',
			);
			echo form_label('Email:', 'log_email');
			echo form_input($logEmData); 
		?>
		</div>
		
		<div>
		<?php 
			$logPassData = array(
				'name' => 'log_pass',
				'id' => 'log_pass',
			);
			echo form_label('Password:', 'log_pass');
			echo form_password($logPassData); 
		?>
		</div>
		
		<div>
		<?php
			$logPassData = array(
				'name' => 'login_user',
				'id' => 'login_user',
				'value' => 'Login',
			);
			echo form_submit('login_user', 'Login'); 
		?>
		</div>
	
	<?php echo form_close(); ?>
	
</div><!-- login_form -->
</div><!-- outer -->