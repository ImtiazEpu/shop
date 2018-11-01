<?php include "../Classes/Adminlogin.php";?>
<?php 
	
	$al = new Adminlogin();
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$admin_user = $_POST['admin_user'];
		$admin_password = md5($_POST['admin_password']);

		$loginMethod = $al->adminLogin($admin_user, $admin_password);
	}

 ?>

<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>AdminLogin Portal</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">
		<form action="" method="post">
			<h1>Admin Login</h1>
			<?php 
				if (isset($loginMethod)) {
					echo $loginMethod;
				}

			 ?>
			<div>
				<input type="text" placeholder="Username"  name="admin_user" style="margin-top: 30px;" />
			</div>
			<div>
				<input type="password" placeholder="Password"  name="admin_password"/>
			</div>
			<div>
				<input type="submit" value="Log in" />
			</div>
		</form><!-- form -->
		<div class="button">
			<a href="#">Training with live project</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>