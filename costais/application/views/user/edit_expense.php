<h2>Edit Expense</h2>
<?php echo validation_errors(); ?>
<div id="edit_expense">
	
	<?php echo form_open('/user/editExpense/'); ?>
		
		<!-- Transaction id -->
		<div>
			<?php 
				echo '<input name="edit_trans_id" value="' . $transactions->trans_id . '" readonly />'
			?>
		</div>
		<br />
		<!-- Date -->
		<div>
		<!-- this needs to be a date select -->
		<?php 
			$dateData = array(
				'name' => 'edit_trans_date',
				'id' => 'edit_trans_date',
				'value' => $transactions->trans_date
 			);
			echo form_label('Date:', 'edit_trans_date');
			echo form_input($dateData);
		?>
		</div>
		
		<!-- Amount -->
		<div>
		<?php 
			$amountData = array(
				'name' => 'edit_trans_amount',
				'id' => 'edit_trans_amount',
				'value' => $transactions->trans_amount
			);
			echo form_label('Amount:', 'edit_trans_amount');
			echo form_input($amountData);
		?>
		</div>
		
		<!-- Category -->
		<div>
		<!-- this needs to be a dropdown populated from db -->
		<?php
			echo form_label('Category:', 'edit_category_id');
			$options = array(
				$transactions->trans_category = $category->category_name,
				$category_form_options,
			);
			echo form_dropdown('edit_category_id', $options, set_value('category_name'));
		?>
		</div>
		
		<!-- Note -->
		<div>
		<?php 
			$noteData = array (
			  'name' => 'edit_trans_note',
              'id' => 'edit_trans_note',
              'rows' => '8',
              'cols' => '10',
              'value' => $transactions->trans_note,
			);
			echo form_label('Note:', 'edit_trans_note');
			echo form_textarea($noteData);
		?>
		</div>	
		
		<div>
		<?php 
			$editexpReset = array(
				'name' => 'edit_expReset',
				'id' => 'edit_expReset',
				'value' => 'Reset',
			);
			echo form_reset($editexpReset); 

			$editExpData = array(
				'name' => 'editexpSub',
				'id' => 'editexpSub',
				'value' => 'Edit Expense'
			);
			echo form_submit($editExpData);
		?>
		</div>
		
	<?php echo form_close(); ?>
</div><!-- add_expense -->

