<h2>
	<?php foreach($userData as $user): ?>
		Hello, <?php echo $user['user_first']; ?>
	<?php endforeach; ?>
</h2>


<div id="userRight">
	<h4>Transactions:</h4>
	
	<div id="transactions">
	<?php foreach($transactions as $trans): ?>	
		
		<div class="trans">
            <div class="transLeft">
                    <p class="note"><?php echo $trans['trans_note']; ?></p>
                    <p><?php echo $trans['trans_date']; ?></p>
            </div><!-- transLeft -->
            
            <div class="transRight">
                    <p class="category"><?php echo $trans['trans_category']; ?></p>
                    <p><?php echo $trans['trans_amount'] ?></p>
            </div><!-- transRight -->
	    </div><!-- trans -->      
		<!-- <p><?php echo $trans['trans_id']; ?></p>-->
	<?php endforeach; ?>
	</div><!-- transactions -->
	
</div><!-- userRight -->
