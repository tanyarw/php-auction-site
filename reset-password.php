<?php  include('./config.php'); ?>
<?php 
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;}
?>
<?php    
    $USERNAME = "";
    $errors = array(); 
	if (isset($_POST['reset_btn'])) {
        global $conn;
        $USERNAME = $_SESSION["username"];

		$val = trim($_POST['newpass']); 
		$val = mysqli_real_escape_string($conn, $_POST['newpass']);
        $password = $val;
        
        $val = trim($_POST['confpass']); 
		$val = mysqli_real_escape_string($conn, $_POST['confpass']);
		$conf_password = $val;

        if (empty($password)) {  array_push($errors, "Please enter a new password"); }
        if (empty($conf_password)) {  array_push($errors, "Please confirm password"); }
        if ($password !== $conf_password) {  array_push($errors, "Passwords don't match"); }
		if (count($errors) == 0) {
			$password = md5($password);
			$query = "UPDATE user
                      SET PASSWORD_HASH = '$password',USERNAME = '$USERNAME'
                      WHERE USERNAME = '$USERNAME'";
            mysqli_query($conn, $query);
            echo '<h1>CHANGED!</h1>';
		}
	}
?> 
<head>
    <title>Reset Password</title>
    <link rel="stylesheet" href="./includes/style.css">
</head>
<body>
<div class="container">
    <form method="post" action="reset-password.php" >
        <h2 class="heading">Reset Password</h2>
        <?php include(ROOT_PATH . '/includes/errors.php') ?>
        <input class="input-box" type="password" name="newpass" placeholder="New Password"><br/><br/>
        <input class="input-box" type="password" name="confpass" placeholder="Confirm Password"><br/><br/>
        <button type="submit" class="btn" name="reset_btn">RESET</button><br/><br/>
        <p class="foot"><a href="welcome.php" style="padding:15px">Go back</a></p>
    </form>
</div>
</body>