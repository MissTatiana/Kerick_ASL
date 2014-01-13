<div id="first">
	<img src="/img/logo.png" />
</div><!-- first -->
<br />
<br />

<div id="second">
	
	<h2>Why Use Costais?</h2>
	
	<p class="left">
		Candy canes topping dessert cheesecake. Tootsie roll tiramisu bonbon. Tiramisu gingerbread lollipop topping 
		jelly-o jelly beans liquorice muffin pudding. Chocolate marshmallow tootsie roll muffin applicake macaroon ice cream 
		lollipop cake. Brownie cotton candy cupcake apple pie bear claw donut candy. Gummi bears candy canes cotton candy 
		tootsie roll jelly beans icing jelly-o. Cookie chocolate topping tootsie roll cotton candy cupcake candy canes toffee halvah. 
		Halvah tiramisu muffin. Biscuit chupa chups gummies cotton candy powder apple pie macaroon. Apple pie donut biscuit chocolate bar gummies topping carrot cake.
	</p>
	
	<p class="right">
		Cupcake ipsum dolor sit amet oat cake marzipan pastry sweet roll. Wafer cupcake donut muffin. 
		Cheesecake macaroon ice cream chupa chups candy chocolate bar bear claw. Muffin dragée cotton 
		candy marshmallow cake carrot cake fruitcake gingerbread. Cake marshmallow tiramisu cookie. Jelly
		beans carrot cake wafer dessert dessert jujubes pie dragée gummies. Chupa chups cookie marshmallow. 
		Jujubes cotton candy jelly halvah caramels candy tootsie roll brownie. Danish halvah cheesecake apple pie. 
		Fruitcake fruitcake jujubes lemon drops powder tart.
	</p>
</div><!-- second -->

<div id="third">
	
	<h2>Sign Up!</h2>
	
	<div id="form">
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
	</div> <!-- form -->
	
	<div id="benifits">
		<ul>
			<li><h4>Benifit one</h4></li>
			<li><h4>Benifit two</h4></li>
			<li><h4>The most important benifit</h4></li>
			<li><h4>Benifit four</h4></li>
		</ul>
	</div>
	
</div>
