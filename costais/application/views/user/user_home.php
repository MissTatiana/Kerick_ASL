<h2>
	<?php foreach($userData as $user): ?>
		Hello, <?php echo $user['user_first']; ?>
	<?php endforeach; ?>
</h2>


<div id="userLeft">
	<h3>Transactions:</h3>
	
	<div id="transactions">
	<?php 
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
	
</div><!-- userLeft -->

<div id="userRight">
	<h3>Spending:</h3>
	<?php
	$incomeSum = 0;
	$expenseSum = 0;
	foreach($transactions as $trans) {
		
		if($trans['trans_type'] == 0) {
			$expenseSum += $trans['trans_amount'];
		}
		
		else if($trans['trans_type'] == 1) {
			$incomeSum += $trans['trans_amount'];
		}
	}
	
	echo '<div id="spending">';
		echo '<div>';
			echo '<h4 class="em">Income: </h5>';
			echo '<p id="incSum">+ $' . $incomeSum . '</p>';
		echo '</div>';
		
		
		echo '<div>';
			echo '<h4 class="em">Expense: </h5>';
			echo '<p id="expSum">- $' . $expenseSum . '</p>';
		echo '</div>';
		
		echo '<div id="equales"></div>';
		
		echo '<h4 class="emTotal"> Spending Total: </h5>';
		$total = $incomeSum - $expenseSum;
		if($total < 1) {
			echo '<p id="total" style="color: #a65252">$' . $total . '</p>';
		}
		else {
			echo '<p id="total" style="color: #52a627">$' . $total . '</p>';
		}
		
	echo '</div>';//spending
	?>
</div><!-- userRight -->

<br />
<br />
<br />
<br />
<br />
