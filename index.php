<?php  include('./config.php'); ?>
<?php  
	if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
		header("location: welcome.php");
		exit;}
	$USERNAME = "";
	$PHONE    = "";
	$errors = array();
	if (isset($_POST['login_btn'])) {
		global $conn;

		$val = trim($_POST['USERNAME']); 
		$val = mysqli_real_escape_string($conn, $_POST['USERNAME']);
		$USERNAME = $val;


		$val = trim($_POST['password']); 
		$val = mysqli_real_escape_string($conn, $_POST['password']);
		$password = $val;

		if (empty($USERNAME)) { array_push($errors, "Username required"); }
		if (empty($password)) { array_push($errors, "Password required"); }
		if (empty($errors)) {
			$password = md5($password); 
			$sql = "SELECT * FROM user WHERE USERNAME='$USERNAME' and PASSWORD_HASH='$password' LIMIT 1";

			$result = mysqli_query($conn, $sql);
			if (mysqli_num_rows($result) > 0) {
				session_start();
                            
				$_SESSION["loggedin"] = true;
				$_SESSION["username"] = $USERNAME;     
				
				if($_POST["remember_me"]=='1' || $_POST["remember_me"]=='on')
				{
					$hour = time() + 3600 * 24 * 30;
					setcookie('username', $USERNAME, $hour);
					setcookie('password', $password, $hour);
				}
				
				header("location: welcome.php");
			} 
			else {array_push($errors, 'Invalid username or password');	}
		}
	}
?>
<head>
	<title>Login</title>
	<link rel="stylesheet" href="./includes/style.css">
</head>
<body>
<div class="container">	
	<form method="post" action="" >
		<h2 class="heading">User Login</h2>			
		<img class="illust1" src="./login.jpg" alt="">
		<?php include(ROOT_PATH . '/includes/errors.php') ?>
		<input class="input-box" type="text" name="USERNAME" value="<?php echo $USERNAME; ?>" value="" placeholder="Username"><br/><br/>
		<input class="input-box" type="password" name="password" placeholder="Password"><br/><br/>			
		<button type="submit" class="btn" name="login_btn">LOGIN</button><br/><br/>
		<p><label>
		<input type="checkbox" name="remember_me" class="chkbx">
		Remember me 
		</label></p>
		<p class="foot">
			Not yet a member? <a href="register.php">Sign up</a><br>
			Forgot Password? <a href="forgot-password.php">Reset</a>
		</p>
	</form>
</div>
</body>