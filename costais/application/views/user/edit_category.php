<h2>Categories</h2>
<br />

<div id="editCategory">
<?php echo validation_errors(); ?>
<?php 
	echo form_open();
		$editCategoryData = array(
			'name' => 'edit_category_name',
			'id' => 'edit_category_name',
			'value' => $cat->category_name,
		);
		echo form_label('Edit Category:', 'edit_category_name');
		echo form_input($editCategoryData);
		
		$editData = array(
			'name' => 'editSub',
			'id' => 'editSub',
			'value' => 'Edit Category',
		);
		echo form_submit($editData);		
	echo form_close()
?>
</div><!-- edit_category -->

<br />

<div class="categories">
	<?php 
		$this->table->set_heading('Category', 'Action');
		echo $this->table->generate($cats);
	?>
</div><!-- categories -->