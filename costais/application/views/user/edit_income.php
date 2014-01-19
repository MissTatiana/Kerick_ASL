<h2>Add Income</h2>

<div id="add_income">

	<?php echo form_open('/action/addIncome'); ?>
	
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
			echo form_label('Category:', 'inc_category_id');
			echo form_dropdown('inc_category_id', $category_form_options, set_value('category_name'));
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
