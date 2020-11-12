<?php  include('./config.php'); ?>
<?php    
    
    $errors = array(); 
	if (isset($_POST['change_btn'])) {
        global $conn;

        $val = trim($_POST['username']); 
		$val = mysqli_real_escape_string($conn, $_POST['username']);
        $username = $val;

        $val = trim($_POST['phone']); 
		$val = mysqli_real_escape_string($conn, $_POST['phone']);
		$phone = $val;

        if (empty($username)) {  array_push($errors, "Please enter your Username"); }
        if (empty($phone)) {  array_push($errors, "Please enter your Phone Number"); }
		if (empty($errors)) {
			$sql = "SELECT * FROM user WHERE USERNAME='$username' and PHONE='$phone' LIMIT 1";

			$result = mysqli_query($conn, $sql);
			if (mysqli_num_rows($result) > 0) {
                
                $newpass = substr(bin2hex(random_bytes(10)),0, 10); 
                $password = md5($newpass); 
				$query = "UPDATE user
                      SET PASSWORD_HASH = '$password',USERNAME = '$username'
                      WHERE USERNAME = '$username'";
                mysqli_query($conn, $query);
                echo '<h2 style="color:red">NEW PASSWORD: '.$newpass.'</h2>';

            }
            else {
				array_push($errors, 'Invalid username or password');
			}
        }
    }
?> 
<head>
    <title>Forgot Password</title>
    <link rel="stylesheet" href="./includes/style.css">
</head>
<body>
<div class="container">
    <form method="post" action="" >
        <h2 class="heading">Forgot Password</h2>
        <?php include(ROOT_PATH . '/includes/errors.php') ?>
        <input class="input-box" type="text" name="username" placeholder="Your Username"><br/><br/>
        <input class="input-box" type="number" name="phone" placeholder="Your Phone Number"><br/><br/>        
        <button type="submit" class="btn" name="change_btn">RESET</button><br/><br/>
        <p class="foot"><a href="index.php" style="padding:15px">Login</a></p>
    </form>
</div>
</body>