<h2>Add Income</h2>

<div id="add_income">

	<?php echo form_open(); ?>
	
		<!-- how should I go about getting in the user id in? -->
		<!-- user id -->
		<div>
		<?php
			$user_id = array(
				'name' => 'inc_user_id',
				'id' => 'inc_user_id',
				'value' => 15,
			);
			echo form_hidden($user_id);
		?>
		</div>
		
		<!-- will need if to determing the value to send in for the trans_type -->
		<!-- Type -->
		<div>
		<!-- probably will need to be hidden -->
		<?php 
			$typeData = array(
				'name' => 'inc_trans_type',
				'id' => 'inc_trans_type',
				'value' => '1',
			);
			echo form_input($typeData);
		?>	
		</div>	
		
		<!-- Date -->
		<div>
		<!-- this needs to be a date select -->
		<?php 
			$dateData = array(
				'name' => 'inc_trans_date',
				'id' => 'inc_trans_date',
			);
			echo form_label('Date:', 'inc_trans_date');
			echo form_input($dateData);
		?>
		</div>
		
		<!-- Amount -->
		<div>
		<?php 
			$amountData = array(
				'name' => 'inc_trans_amount',
				'id' => 'inc_trans_amount',
			);
			echo form_label('Amount:', 'inc_trans_amount');
			echo form_input($amountData);
		?>
		</div>
		
		<!-- Category -->
		<div>
		<!-- this needs to be a dropdown populated from db -->
		<?php 
			$catData = array(
				'name' => 'inc_trans_category',
				'id' => 'inc_trans_category',
			);
			echo form_label('Category:', 'inc_trans_category');
			echo form_input($catData);
		?>
		</div>
		
		<!-- Note -->
		<div>
		<?php 
			$noteData = array (
			  'name' => 'inc_trans_note',
              'id' => 'inc_trans_note',
              'rows' => '8',
              'cols' => '10',
			);
			echo form_label('Note:', 'inc_trans_note');
			echo form_textarea($noteData);
		?>
		</div>	
		
		<div>
		<?php 
			$incReset = array(
				'name' => 'incReset',
				'id' => 'incReset',
				'value' => 'Reset',
			);
			echo form_reset($incReset); 
			
			$addIncData = array(
				'name' => 'incSub',
				'id' => 'incSub',
				'value' => 'Add Income'
			);
			echo form_submit($addIncData);
		?>
		</div>
		
	<?php echo form_close(); ?>

</div>
