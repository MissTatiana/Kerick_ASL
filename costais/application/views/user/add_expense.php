<div id="add_expense">
	<h2>Add Expense</h2>
	
	<?php echo form_open(); ?>
	
		<!-- how should I go about getting in the user id in? -->
		<!-- user id -->
		<div>
			<?php echo form_label('User Id:', 'user_id'); ?>
			<?php echo form_input('user_id', set_value('user_id')); ?>
		</div>
		
		<!-- will need if to determing the value to send in for the trans_type -->
		<!-- Type -->
		<div>
			<!-- probably will need to be hidden -->
			<?php echo form_label('Type:', 'trans_type'); ?>
			<?php echo form_input('trans_type', set_value('trans_type')); ?>
		</div>	
		
		<!-- Date -->
		<div>
			<?php echo form_label('Date:', 'trans_date'); ?>
			<?php echo form_input('trans_date', set_value('trans_date')); ?>
		</div>
		
		<!-- Amount -->
		<div>
			<?php echo form_label('Amount:', 'trans_amount'); ?>
			<?php echo form_input('trans_amount', set_value('trans_amount')); ?>
		</div>
		
		<!-- Category -->
		<div>
			<?php echo form_label('Category:', 'trans_category'); ?>
			<?php echo form_input('trans_category', set_value('trans_category')); ?>
		</div>
		
		<!-- Note -->
		<div>
			<?php echo form_label('Note:', 'trans_note'); ?>
			<?php echo form_textarea('trans_note', set_value('trans_note')); ?>
		</div>	
		
		<div>
			<?php echo form_submit('addExpense', 'Add'); ?>
		</div>
		
	<?php echo form_close(); ?>
</div><!-- add_expense -->

