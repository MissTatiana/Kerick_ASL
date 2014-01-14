<h2>Categories</h2>
<div id="addCategory">
	<?php echo validation_errors(); ?>
	<?php 
		form_open();
		
		$categoryData = array (
			'name' => 'category_name',
			'id' => 'category_name',
		);
		echo form_label('New Category:', 'category_name');
		echo form_input($categoryData);
		
		$categorySub = array(
			'name' => 'catSub',
			'id' => 'catSub',
			'value' => 'Add Category',
		);
		echo form_submit($categorySub)
		
	
	?>
</div>

<div id="catories">
	<!-- list of categories populated by db -->
</div><!-- categories -->
