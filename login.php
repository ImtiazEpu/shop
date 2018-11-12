<?php include "inc/header.php"; ?>
<?php 
	$login = Session::get("login");
	if ($login==true) {
		echo "<script type='text/javascript'>window.top.location='order.php';</script>";
	}


	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {

        $customerLogin = $cmr->customerLogin($_POST);
    }
 ?>

 <div class="main">
 	<div class="content">
 		<div class="login_panel">
 			<h3>Existing Customers</h3>
 			<p style="margin-bottom: 15px;">Sign in with the form below.</p>
 			<?php 
 			if (isset($customerLogin)) {
 				echo $customerLogin;
 			}
 			?>
 			<form action="" method="post">
 				<input name="email" type="email" placeholder="Email Address">
 				<input name="password" type="password" placeholder="Password" ><div class="buttons"><div><button class="grey" name="login">Sign In</button></div></div>
 			</div>
 		</form>
 		<!-- <p class="note">If you forgot your passoword just enter your email and click <a href="#">here</a></p> -->
 		

 		<?php 
 		if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {

 			$customerRegistration = $cmr->customerRegistration($_POST);
 		}
 		?>


 		<div class="register_account">
 			<h3 style="margin-bottom: 20px;">Register New Account</h3>
 			<?php if (isset($customerRegistration)) {
 				echo $customerRegistration;
 			} ?>
 			<form action="" method="post">
 				<table style="margin-top: 20px;">
 					<tbody>
 						<tr>
 							<td>
 								<div>
 									<input type="text" name="name" placeholder="Name">
 								</div>
 								
 								<div>
 									<input type="text" name="city" placeholder="City">
 								</div>
 								
 								<div>
 									<input type="text" name="zipcode" placeholder="Zipcode">
 								</div>
 								<div>
 									<input type="text" name="email" placeholder="Email">
 								</div>
 							</td>
 							<td>
 								<div>
 									<input type="text" name="address" placeholder="Address">
 								</div>
 								<div>
 									<input type="text" name="country" placeholder="Country">
						<!-- <select id="country" name="country" onchange="change_country(this.value)" class="frm-field required">
							<option value="null">Select a Country</option>         
							<option value="AF">Afghanistan</option>
							<option value="AL">Albania</option>
							<option value="DZ">Algeria</option>
							<option value="AR">Argentina</option>
							<option value="AM">Armenia</option>
							<option value="AW">Aruba</option>
							<option value="AU">Australia</option>
							<option value="AT">Austria</option>
							<option value="AZ">Azerbaijan</option>
							<option value="BS">Bahamas</option>
							<option value="BH">Bahrain</option>
							<option value="BD">Bangladesh</option>
						
						</select> -->
					</div>		        
					
					<div>
						<input type="text" name="phone" placeholder="Phone">
					</div>
					
					<div>
						<input type="password" name="password" placeholder="Password">
					</div>
				</td>
			</tr> 
		</tbody></table> 
		<div class="search"><div><button class="grey" name="register">Create Account</button></div></div>
		<p class="terms">By clicking 'Create Account' you agree to the <a href="#">Terms &amp; Conditions</a>.</p>
		<div class="clear"></div>
	</form>
</div>  	
<div class="clear"></div>
</div>
</div>
<?php include "inc/footer.php" ?>