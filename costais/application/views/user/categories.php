<h2>Categories</h2>
<br />
<div id="addCategory">
	<?php echo validation_errors(); ?>
	<?php 
		echo form_open();
			$categoryData = array(
				'name' => 'category_name',
				'id' => 'category_name',
			);
			echo form_label('Category:', 'category_name');
			echo form_input($categoryData);
			
			$options = array(
                  0 => 'Expense',
                  1 => 'Income',
                );
			echo form_label('Type:', 'category_type');
			echo form_dropdown('category_type', $options, 0);
			
			echo '<br />';
			
			$catSubData = array(
				'name' => 'catSub',
				'id' => 'catSub',
				'value' => 'Add Category',
			);
			echo form_submit($catSubData);		
		echo form_close()
	?>
</div>

<br />

<div class="categories">
	<?php 
		$this->table->set_heading('Category', 'Type', 'Action');
		echo $this->table->generate($cats);
	?>
</div><!-- categories -->
