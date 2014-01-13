<h2>Add Income</h2>

<div id="add_income">

	<?php echo form_open(); ?>
	
		<!-- how should I go about getting in the user id in? -->
		<!-- user id -->
		<div>
		<?php
			$user_id = array(
				'name' => 'user_id',
				'id' => 'user_id',
				//'value' => user_id,
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
				'name' => 'trans_type',
				'id' => 'trans_type',
				'value' => 'income',
			);
			echo form_input($typeData);
		?>	
		</div>	
		
		<!-- Date -->
		<div>
		<!-- this needs to be a date select -->
		<?php 
			$dateData = array(
				'name' => 'trans_date',
				'id' => 'trans_date',
			);
			echo form_label('Date:', 'trans_date');
			echo form_input($dateData);
		?>
		</div>
		
		<!-- Amount -->
		<div>
		<?php 
			$amountData = array(
				'name' => 'trans_amount',
				'id' => 'trans_amount',
			);
			echo form_label('Amount:', 'trans_amount');
			echo form_input($amountData);
		?>
		</div>
		
		<!-- Category -->
		<div>
		<!-- this needs to be a dropdown populated from db -->
		<?php 
			$catData = array(
				'name' => 'trans_category',
				'id' => 'trans_category',
			);
			echo form_label('Category:', 'trans_category');
			echo form_input($catData);
		?>
		</div>
		
		<!-- Note -->
		<div>
		<?php 
			$noteData = array (
			  'name' => 'trans_note',
              'id' => 'trans_note',
              'rows' => '8',
              'cols' => '10',
			);
			echo form_label('Note:', 'trans_note');
			echo form_textarea($noteData);
		?>
		</div>	
		
		<div>
		<?php 
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
