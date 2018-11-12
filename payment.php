<?php include "inc/header.php"; ?>
<?php 
	
	$login = Session::get("login");
	if ($login==false) {
		echo "<script type='text/javascript'>window.top.location='login.php';</script>";
	}

 ?>

 <div class="main">
    <div class="content">
    	<div class="section group">	
    		<div class="payment">
    			<h2>Choose Payment option</h2>
    			<a href="offline.php">Offline Pay</a>
    			<a href="offline.php">Online Pay</a>
    		</div>
    		<div class="back">
    			<a href="cart.php">Previous</a>
    		</div>	
			
		</div> 
    </div>
 </div>
<?php include "inc/footer.php" ?>