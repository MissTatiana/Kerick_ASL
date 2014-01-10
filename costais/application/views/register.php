<div id="reg_form">
	
	<h2>Register</h2>
	
	<?php echo form_open(); ?>
		<div>
			<?php echo form_label('First name:', 'user_first'); ?>
			<?php echo form_input('user_first', set_value('user_first')); ?>
		</div>
		
		<div>
			<?php echo form_label('Last name:', 'user_last'); ?>
			<?php echo form_input('user_last', set_value('user_last')); ?>
		</div>
		
		<div>
			<?php echo form_label('Email Address:', 'user_email'); ?>
			<?php echo form_input('user_email', set_value('user_email')); ?>
		</div>
		
		<div>
			<?php echo form_label('Confirm Email:', 'conf_email'); ?>
			<?php echo form_input('conf_email', set_value('conf_email')); ?>
		</div>
		
		<div>
			<?php echo form_label('Password:', 'user_pass'); ?>
			<?php echo form_input('user_pass', set_value('user_pass')); ?>
		</div>
		
		<div>	
			<?php echo form_label('Confirm Password:', 'conf_pass'); ?>
			<?php echo form_input('conf_pass', set_value('conf_pass')); ?>
		</div>
		
		<div>
			<?php echo form_submit('addUser', 'Register'); ?>
		</div>
	<?php echo form_close(); ?>
</div>