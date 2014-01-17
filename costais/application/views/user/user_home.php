<h2>
	<?php foreach($userData as $user): ?>
		Hello, <?php echo $user['user_first']; ?>
	<?php endforeach; ?>
</h2>


<div id="userRight">
	<h3>Transactions:</h3>
	
	<div id="transactions">
	<?php 
	$c = true;
	foreach($transactions as $trans) {	
		echo '<div class="trans">';
            echo '<div class="transLeft">';
             	echo '<h5 class="note">' . $trans['trans_note'] . '</h5>';
                if($trans['trans_type'] == 0){
		        	echo '<p class="amount" style="color: #a65252">$' . $trans['trans_amount'] . '</p>';
	            }
				elseif($trans['trans_type'] == 1) {
					echo '<p class="amount" style="color: #52a627">$' . $trans['trans_amount'] . '</p>';
				}
            echo '</div>';//transLeft
            
            echo '<div class="transRight">';
            	echo '<p class="date">' . date('m-d-Y', strtotime($trans['trans_date'])) . '</p>';
                echo '<p class="cate">' . $trans['trans_category'] . '</p>';
            echo '</div>';//transRight
	    echo '</div>';//trans   
	}
	?>
	</div><!-- transactions -->
	
</div><!-- userRight -->

<br />
<br />
<br />
<br />
<br />
