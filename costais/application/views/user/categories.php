<h2>Categories</h2>
<br />
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
			echo form_submit($categorySub);
		echo form_close();
	?>
</div>

<br />

<div id="categories">
	<?php 
		$this->table->set_heading('Category', 'Action');
		echo $this->table->generate($cats);
	?>
</div><!-- categories -->
