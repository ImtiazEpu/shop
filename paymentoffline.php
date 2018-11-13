<?php include "inc/header.php"; ?>
<?php 
	
	$login = Session::get("login");
	if ($login==false) {
		echo "<script type='text/javascript'>window.top.location='login.php';</script>";
	}

    if (isset($_GET['oderid']) && $_GET['oderid']== 'order') {
        $cmrId = Session::get("cmrId");
        $orderProduct = $crt->orderProduct($cmrId);
        $deldata      = $crt->delCustomerCart();
        echo "<script type='text/javascript'>window.top.location='ordersuccess.php';</script>";
    }

 ?>


<style type="text/css">
.tblone{width: 716px;margin: 0 auto; border: 2px solid #ddd;} 
.tblone tr td{text-align: justify;}
.division{width: 50%; float: left;}

.tbltwo{ float:right; text-align:left; width:50%; border:2px solid #ddd; margin-right: 14px; margin-top: 10px; }
.tbltwo tr td{text-align: right; padding: 5px 27px 5px 10px}

</style>

 <div class="main">
    <div class="content">
    	<div class="section group">	
    		<div class="division">

                <table class="tblone">
                    <tr>
                        <th>NO</th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>

                    <?php 

                        $getAddToCart = $crt->getAddToCart();
                        if ($getAddToCart) {
                            $i=0;
                            $sum = 0;
                            $qty = 0;
                            while ($result = $getAddToCart->fetch_assoc()) {$i++; ?>
                                <tr>
                                    <td style="text-align:center;"><?php echo $i; ?></td>
                                    <td style="text-align:center;"><?php echo $result['productName']; ?></td>
                                    <td style="text-align:center;">$<?php echo $result['productPrice']; ?></td>
                                    <td style="text-align:center;"><?php echo $result['quantity']; ?></td>
                                    <td style="text-align:center;">$
                                        <?php 
                                            $total = $result['productPrice'] * $result['quantity'];
                                             echo $total; 
                                        ?>
                                    </td>
                                </tr>
                                <?php 
                                    $sum = $sum + $total;
                                    $qty = $qty + $result['quantity'];
                                ?>
                    <?php }} ?>
                </table>

                    <?php 
                    $getCart = $crt->checkCartTable();
                    if ($getCart) {
                       ?>
                       <table class="tbltwo">
                        <tr>
                            <td style="text-align:left">Sub Total</td>
                            <td>:</td>
                            <td>$ <?php echo $sum; ?></td>
                        </tr>
                         <tr>
                            <td style="text-align:left">Quantity</td>
                            <td>:</td>
                            <td><?php echo $qty; ?></td>
                        </tr>
                        <tr style="border-bottom: 2px solid #ddd">
                            <td style="text-align:left">VAT(15%)</td>
                            <td>:</td>
                            <td>(+) <?php echo $vat = $sum * 0.15; ?></td>
                        </tr>
                        <tr style="padding: 10px 0px">
                            <td style="text-align:left">Grand Total</td>
                            <td>:</td>
                            <td>
                                $ <?php 
                                $vat = $sum * 0.15;
                                $gTotal = $sum + $vat;
                                echo $gTotal;
                                ?>
                            </td>
                        </tr>
                    </table>
                <?php }else {
                    echo "<script type='text/javascript'>window.top.location='index.php';</script>"; 
                }
                ?>
                
            </div>
            <div class="division">
    		<?php 
                $id = Session::get("cmrId");
                $getData = $cmr->getCustomerDataByID($id);
                if ($getData) {
                    while ($result = $getData->fetch_assoc()) {?>
                        <table class="tblone">
                            <tr>
                                <td colspan="3" style="text-align: center;"><h2>Your Profile Details</h2></td>
                            </tr>
                            <tr>
                                <td width="20%">Name</td>
                                <td width="5%">:</td>
                                <td><?php echo $result['name']; ?></td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>:</td>
                                <td><?php echo $result['email']; ?></td>
                            </tr>
                            <tr>
                                <td>Phone</td>
                                <td>:</td>
                                <td><?php echo $result['phone']; ?></td>
                            </tr>
                            <tr>
                                <td>Address</td>
                                <td>:</td>
                                <td><?php echo $result['address']; ?></td>
                            </tr>
                            <tr>
                                <td>City</td>
                                <td>:</td>
                                <td><?php echo $result['city']; ?></td>
                            </tr>
                            <tr>
                                <td>Zipcode</td>
                                <td>:</td>
                                <td><?php echo $result['zipcode']; ?></td>
                            </tr>
                            <tr>
                                <td>Country</td>
                                <td>:</td>
                                <td><?php echo $result['country']; ?></td>
                            </tr>
                            <tr>
                                <td colspan="3" style="text-align: center;">
                                    <a class="btn btn-blue" href="customeredit.php">Edit Details</a>
                                </td>
                            </tr>
                        </table>
                <?php }} ?>
    		</div>  
    	</div> 
         <div class="back" style="margin-top: 70px;">
                <a href="cart.php">Previous</a>
                <a style="background: #26C22B !important;" href="?oderid=order">Order Now</a>
            </div>
    </div>
 </div>
<?php include "inc/footer.php" ?>