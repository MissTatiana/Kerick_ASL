<h2>Add Income</h2>

<div id="add_income">

	<?php echo form_open(); ?>
	
		<!-- Transaction id -->
		<div>
			<?php 
				$idData = array(
					'name' => 'edit_inc_trans_id',
					'id' => 'edit_inc_trans_id',
					'readonly' => 'readonly',
					'value' => $transactions->trans_id,
	 			);
				echo form_label('Transactions Id:', 'edit_inc_trans_id');
				echo form_input($idData);
			?>
		</div>
		
		<!-- Date -->
		<div>
		<!-- this needs to be a date select -->
		<?php 
			$dateData = array(
				'name' => 'edit_inc_trans_date',
				'id' => 'edit_inc_trans_date',
				'value' => $transactions->trans_date,
			);
			echo form_label('Edit Date:', 'edit_inc_trans_date');
			echo form_input($dateData);
		?>
		</div>
		
		<!-- Amount -->
		<div>
		<?php 
			$amountData = array(
				'name' => 'edit_inc_trans_amount',
				'id' => 'edit_inc_trans_amount',
				'value' => $transactions->trans_amount,
			);
			echo form_label('Edit Amount:', 'edit_inc_trans_amount');
			echo form_input($amountData);
		?>
		</div>
		
		<!-- Category -->
		<div>
		<!-- this needs to be a dropdown populated from db -->
		<?php 
			echo form_label('Category:', 'edit_inc_category_id');
			$options = array(
				$transactions->trans_category = $category->category_name,
				$category_form_options,
			);
			echo form_dropdown('edit_inc_category_id', $options, set_value('category_name'));
		?>
		</div>
		
		<!-- Note -->
		<div>
		<?php 
			$noteData = array (
			  'name' => 'edit_inc_trans_note',
              'id' => 'edit_inc_trans_note',
              'rows' => '8',
              'cols' => '10',
              'value' => $transactions->trans_note,
			);
			echo form_label('Edit Note:', 'edit_inc_trans_note');
			echo form_textarea($noteData);
		?>
		</div>	
		
		<div>
		<?php 
			$editIncReset = array(
				'name' => 'editIncReset',
				'id' => 'editIncReset',
				'value' => 'Reset',
			);
			echo form_reset($editIncReset); 
			
			$editIncData = array(
				'name' => 'editIncSub',
				'id' => 'editIncSub',
				'value' => 'Add Income'
			);
			echo form_submit($editIncData);
		?>
		</div>
		
	<?php echo form_close(); ?>

</div>
