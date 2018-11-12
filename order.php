<?php include "inc/header.php"; ?>
<?php 
	
	$login = Session::get("login");
	if ($login==false) {
		echo "<script type='text/javascript'>window.top.location='login.php';</script>";
	}

 ?>
 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="notfound">
    				<p><span>Order</span> Page</p>
    			</div>
		</div>  	
       <div class="clear"></div>
    </div>
 </div>
<?php include "inc/footer.php" ?>