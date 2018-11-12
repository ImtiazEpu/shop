<?php include "inc/header.php"; ?>
<?php 
	
	$login = Session::get("login");
	if ($login==false) {
		echo "<script type='text/javascript'>window.top.location='login.php';</script>";
	}
	$cmrId =Session::get("cmrId");
	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {

        $profileUpdate = $cmr->profileUpdate($_POST,$cmrId);
    }

 ?>
<style type="text/css">
.tblone{width: 550px;margin: 0 auto; border: 2px solid #ddd;} 
.tblone tr td{text-align: justify;}
</style>

	    <div class="main">
	    	<div class="content">
	    		<div class="section group">
	    			<?php 
	    				$id = Session::get("cmrId");
	    				$getData = $cmr->getCustomerDataByID($id);
	    				if ($getData) {
	    					while ($result = $getData->fetch_assoc()) {?>

	    			<form action="" method="post">
	    				
		    		<table class="tblone content">
		    			<?php 
	    					if (isset($profileUpdate)) {
	    						echo "<tr><td colspan='2' style='text-align: center;'>".$profileUpdate."</td></tr>";
	    					}
	    				 ?>
		    			<tr>
		    				<td colspan="2" style="text-align: center;"><h2>Update Profile Details</h2></td>
		    			</tr>
		    			<tr>
		    				<td width="20%">Name</td>
		    				<td><input type="text" name="name" value="<?php echo $result['name']; ?>"></td>
		    			</tr>
		    			<tr>
		    				<td>Email</td>
		    				<td><input type="email" name="email" value="<?php echo $result['email']; ?>"></td>
		    			</tr>
		    			<tr>
		    				<td>Phone</td>
		    				<td><input type="text" name="phone" value="<?php echo $result['phone']; ?>"></td>
		    			</tr>
		    			<tr>
		    				<td>Address</td>
		    				<td><input type="text" name="address" value="<?php echo $result['address']; ?>"></td>
		    			</tr>
		    			<tr>
		    				<td>City</td>
		    				<td><input type="text" name="city" value="<?php echo $result['city']; ?>"></td>
		    			</tr>
		    			<tr>
		    				<td>Zipcode</td>
		    				<td><input type="text" name="zipcode" value="<?php echo $result['zipcode']; ?>"></td>
		    			</tr>
		    			<tr>
		    				<td>Country</td>
		    				<td><input type="text" name="country" value="<?php echo $result['country']; ?>"></td>
		    			</tr>
		    			<tr>
		    				<td colspan="3" style="text-align: center;">
		    					<input type="submit" name="submit" Value="Update" />
		    				</td>
		    			</tr>
		   			</table>
		   		</form>
		   		<?php }} ?>
	    		</div>
    		</div>
	    </div>
<?php include "inc/footer.php" ?>