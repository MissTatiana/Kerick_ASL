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
		<div class="user_first">
			<?php echo form_label('First name:', 'user_first'); ?>
			<?php echo form_input('user_first', set_value('user_first')); ?>
		</div>
		
		<div>
			<?php echo form_label('Last name:', 'user_last'); ?>
			<?php echo form_input('user_last', set_value('user_last')); ?>
		</div>
		
		<div class="user_email">
			<?php echo form_label('Email Address:', 'user_email'); ?>
			<?php echo form_input('user_email', set_value('user_email')); ?>
		</div>
		
		<div>
			<?php echo form_label('Confirm Email:', 'conf_email'); ?>
			<?php echo form_input('conf_email', set_value('conf_email')); ?>
		</div>
		
		<div class="user_pass">
			<?php echo form_label('Password:', 'user_pass'); ?>
			<?php echo form_password('user_pass', set_value('user_pass')); ?>
		</div>
		
		<div>	
			<?php echo form_label('Confirm Password:', 'conf_pass'); ?>
			<?php echo form_password('conf_pass', set_value('conf_pass')); ?>
		</div>
		
		<div id="landing_reg">
			<?php echo form_submit('addUser', 'Register'); ?>
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
