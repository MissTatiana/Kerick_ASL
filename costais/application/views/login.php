<div id="login_form">
	
	<h2>Login</h2>
	
	<?php echo form_open(); ?>
	
		<div>
			<?php echo form_label('Email:', 'log_email'); ?>
			<?php echo form_input('log_email', set_value('log_email')); ?>
		</div>
		
		<div>
			<?php echo form_label('Password:', 'log_pass'); ?>
			<?php echo form_password('log_pass', set_value('log_pass')); ?>
		</div>
		
		<div>
			<?php echo form_submit('login_user', 'Login'); ?>
		</div>
	
	<?php echo form_close(); ?>
	
</div><!-- login_form -->
