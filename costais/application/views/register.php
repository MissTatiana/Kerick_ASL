<div class="outer">
<div id="reg_form">
	
	<h2>Register</h2>
	
	<?php echo validation_errors(); ?>
	<?php echo form_open(); ?>
		
		<!-- First name -->
		<div id="firstName">
		<?php 
			$firstData = array(
				'name' => 'user_first',
				'id' => 'user_first',
			);
			echo form_label('First name:', 'user_first');
			echo form_input($firstData);
		?>
		</div>
		
		<!-- last name -->
		<div>
		<?php
			$lastData = array(
				'name' => 'user_last',
				'id' => 'user_last',
			); 
			echo form_label('Last name:', 'user_last');
			echo form_input($lastData); 
		?>
		</div>
		
		<div id="email">
		<?php
			$emailData = array(
				'name' => 'user_email',
				'id' => 'user_email',
			);
			echo form_label('Email Address:', 'user_email');
			echo form_input($emailData); 
		?>
		</div>
		
		<div>
		<?php 
			$emailConfData = array(
				'name' => 'conf_email',
				'id' => 'conf_email',
			);
			echo form_label('Confirm Email:', 'conf_email');
			echo form_input($emailConfData); 
		?>
		</div>
		
		<div id="password">
		<?php 
			$passwordData = array(
				'name' => 'user_pass',
				'id' => 'user_pass',
			);
			echo form_label('Password:', 'user_pass');
			echo form_password($passwordData); 
		?>
		</div>
		
		<div>	
		<?php 
			$passwordConfData = array(
				'name' => 'conf_pass',
				'id' => 'conf_pass',
			);
			echo form_label('Confirm Password:', 'conf_pass');
			echo form_password($passwordConfData); 
		?>
		</div>
		
		<div>
		<?php 
			$regData = array(
				'name' => 'regSub',
				'id' => 'regSub',
				'value' => 'Register',
			);
			echo form_submit($regData); 
		?>
		</div>
		<?php echo form_close(); ?>
</div><!-- reg_form -->
</div><!-- outer -->