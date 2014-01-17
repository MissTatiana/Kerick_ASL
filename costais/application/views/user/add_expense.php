<h2>Add Expense</h2>
<?php echo validation_errors(); ?>
<div id="add_expense">
	
	<?php echo form_open('/action/addExpense'); ?>
		
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
			echo form_label('Category:', 'category_id');
			echo form_dropdown('category_id', $category_form_options, set_value('category_name'));
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
			$expReset = array(
				'name' => 'expReset',
				'id' => 'expReset',
				'value' => 'Reset',
			);
			echo form_reset($expReset); 

			$addExpData = array(
				'name' => 'expSub',
				'id' => 'expSub',
				'value' => 'Add Expense'
			);
			echo form_submit($addExpData);
		?>
		</div>
		
	<?php echo form_close(); ?>
</div><!-- add_expense -->

