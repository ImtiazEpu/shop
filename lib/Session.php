<?php 

	class Session{

		public static function init(){
			session_start();
		
		}

		public static function set($key,$value){
			$_SESSION[$key] = $value;

		}

		public static function get($key){
			if (isset($_SESSION[$key])) {
				return $_SESSION[$key];
			}else{
				return false;
			}
		}


		public static function checkSession(){
			self::init();
			if (self::get("adminlogin")==false) {
				self::destroy();
				echo "<script type='text/javascript'>window.top.location='login.php';</script>";
			}
		}

		public static function checklogin(){
			self::init();
			if (self::get("adminlogin")==true) {
				echo "<script type='text/javascript'>window.top.location='index.php';</script>";
			}
		}


		public static function destroy(){
			session_destroy();
			echo "<script type='text/javascript'>window.top.location='login.php';</script>";
		
		}
	

	}
 ?>