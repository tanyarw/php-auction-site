<?php  include('config.php'); ?>
<?php 
	$USERNAME = "";
	$PHONE    = "";
	$errors = array(); 

	if (isset($_POST['reg_user'])) {
		global $conn;

		$val = trim($_POST['USERNAME']); 
		$val = mysqli_real_escape_string($conn, $_POST['USERNAME']);
		$USERNAME = $val;

		$val = trim($_POST['PHONE']); 
		$val = mysqli_real_escape_string($conn, $_POST['PHONE']);
		$PHONE = $val;

		$val = trim($_POST['password']); 
		$val = mysqli_real_escape_string($conn, $_POST['password']);
		$password = $val;
		
		if (empty($USERNAME)) {  array_push($errors, "We are going to need your username"); }
		if (empty($PHONE)) {  array_push($errors, "We are going to need your phone number"); }
		if (empty($password)) {  array_push($errors, "We are going to need your password"); }

		$user_check_query = "SELECT * FROM user WHERE USERNAME='$USERNAME'  LIMIT 1";

		$result = mysqli_query($conn, $user_check_query);
		$user = mysqli_fetch_assoc($result);
		if ($user) { 
			if ($user['USERNAME'] === $USERNAME) {
				array_push($errors, "Username already exists");
			}
		}
		if (count($errors) == 0) {
			$password = md5($password);
			$query = "INSERT INTO user (USERNAME, PHONE, PASSWORD_HASH) 
					  VALUES('$USERNAME', '$PHONE', '$password')";
			mysqli_query($conn, $query);
		}
	}
?>
<head>
	<title>Register</title>
	<link rel="stylesheet" href="./includes/style.css">
</head>
<body>
<div class="container">
		<form method="post" action="register.php" >
			<h2 class="heading">Register User</h2>
			<img class="illust1" src="./login.jpg" alt="">
			<?php include(ROOT_PATH . '/includes/errors.php') ?>
			<input class="input-box" type="text" name="USERNAME" value="<?php echo $USERNAME; ?>" pattern="^[a-zA-Z0-9]*$" placeholder="Username"><br/><br/>
			<input class="input-box" type="phone" name="PHONE" value="<?php echo $PHONE ?>" placeholder="Phone Number"><br/><br/>
			<input class="input-box" type="password" name="password" placeholder="Password"><br/><br/>
			<button type="submit" class="btn" name="reg_user">REGISTER</button><br/><br/>
			<p class="foot">
				Already a member? <a href="index.php">Sign in</a>
			</p>
		</form>
</div>
</body>