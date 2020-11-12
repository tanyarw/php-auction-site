<?php  include('config.php'); ?>
<?php 
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;}
?>
<?php 
	$USERNAME = "";
	$errors = array(); 
	if (isset($_POST['add_item'])) {	
        global $conn;
        $USERNAME = $_SESSION["username"];

		$val = trim($_POST['item']); 
		$val = mysqli_real_escape_string($conn, $_POST['item']);
		$item = $val;

		$val = trim($_POST['closing_date']); 
		$val = mysqli_real_escape_string($conn, $_POST['closing_date']);
		$closing_date = $val;

		$val = trim($_POST['bid_amount']); 
		$val = mysqli_real_escape_string($conn, $_POST['bid_amount']);
        $bid_amount = $val;
        
        $val = trim($_POST['description']); 
		$val = mysqli_real_escape_string($conn, $_POST['description']);
		$description = $val;
		
		if (empty($item)) {array_push($errors, "Please enter item name"); }
		if (empty($closing_date)) {array_push($errors, "Please enter closing date"); }
		if (empty($bid_amount)) {array_push($errors, "Please enter starting bid amount"); }
		
		if (count($errors) == 0) {
			$query = "INSERT INTO items (USERNAME, CLOSING_DATE, BID_AMOUNT, ITEM, DESCRIPTIONS) 
					  VALUES('$USERNAME', '$closing_date', '$bid_amount','$item','$description')";
            mysqli_query($conn, $query);
            echo '<h1> ITEM ADDED! <h1>';
		}
	}
?>
<head>
	<title>Add item</title>
    <link rel="stylesheet" href="./includes/style.css">
</head>
<body>
	<div class="container">
		<form method="post" action="" >
			<h2 class="heading">Add an Item</h2>
			<?php include(ROOT_PATH . '/includes/errors.php') ?>
			<input class="input-box" type="text" name="item" placeholder="Item Name"><br/><br/>
			<input class="input-box" type="date" name="closing_date" ><br/><br/>
			<input class="input-box" type="number" name="bid_amount" placeholder = "Bidding Amount"><br/><br/>
			<textarea class="input-text" name="description" cols="30" rows="10" placeholder = "Description"></textarea><br/><br/>
			<button id="submit"type="submit" class="btn" name="add_item">Add item</button><br/><br/>
			<p class="foot"><a href="welcome.php" style="padding:15px">Go back</a></p>
		</form>
	</div>
</body>