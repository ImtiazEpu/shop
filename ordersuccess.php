<?php include "inc/header.php"; ?>
<?php 
	
	$login = Session::get("login");
	if ($login==false) {
		echo "<script type='text/javascript'>window.top.location='login.php';</script>";
	}

 ?>
<?php $sum =0;?>
 <div class="main">
    <div class="content">
    	<div class="section group">	
    		<div class="success">
    			<h2 style="color: red;">Congratulations !!</h2>
                <p style="margin-bottom: 40px;color: #666">Your Order Successfully Placed.</p>
                <?php 

                    $cmrId = Session::get("cmrId");
                    $payableAmount = $crt->payableAmount($cmrId);
                    if ($payableAmount){
                         global $sum;
                         while ($result = $payableAmount->fetch_assoc()) {
                            $price = $result['productPrice'];
                            $sum   = $sum + $price;
                        }
                    }
                 ?>

                <p>Total Payble Amount (Including Vat) : $ 
                    <?php 
                        $vat =  $sum * 0.15; 
                        $total =  $sum + $vat;
                        echo $total;
                     ?>
                
                </p>
                <p>Thanks for order. We will contact ASAP with the delivery details.</p>
                <div class="back">
                <a href="orderdetails.php">Your Order Details</a>
            </div>
    		</div>
            
    	</div> 
    </div>
 </div>
<?php include "inc/footer.php" ?>