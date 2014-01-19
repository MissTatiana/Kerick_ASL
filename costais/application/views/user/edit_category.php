<h2>Edit Category</h2>
<br />

<div id="editCategory">
<?php echo validation_errors(); ?>
<?php 
	echo form_open();
		
		$idData = array (
			'name' => 'edit_category_id',
			'id' => 'edit_category_id',
			'readonly' => 'readonly',
			'value' => $category->category_id,
		);
		echo form_label('Category Id:', 'edit_category_id');
		echo form_input($idData);
	
		$editCategoryData = array(
			'name' => 'edit_category_name',
			'id' => 'edit_category_name',
			'value' => $category->category_name,
		);
		echo form_label('Edit Category:', 'edit_category_name');
		echo form_input($editCategoryData);
		
		$options = array(
			$category->category_type,
			0 => 'Expense',
			1 => 'Income',
		);
		echo form_label('Edit Type:', 'edit_category_type');
		echo form_dropdown('edit_category_type', $options, 0);
		
		echo '<br />';
		
		$editData = array(
			'name' => 'editSub',
			'id' => 'editSub',
			'value' => 'Edit Category',
		);
		echo form_submit($editData);		
	echo form_close()
?>
</div><!-- edit_category -->