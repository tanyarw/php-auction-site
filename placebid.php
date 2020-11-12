<?php  include('./config.php'); ?>
<?php 
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;}
?>
<?php
    global $conn;
    $errors = array();
    $query1 = "SELECT * FROM items";    
    $result = mysqli_query($conn, $query1);
    if ($result->num_rows > 0) {
        echo '<div class = "container3">
        <h2 class="heading">Items for Auction</h2>
        <table border="1" cellspacing="2" cellpadding="2" class="table2"> 
        <tr> 
        <th>OWNER</th>
        <th>ITEM</th>
        <th>DESCRIPTION</th>
        <th>STARTING AMOUNT</th> 
        <th>CLOSING DATE</th>
        </tr>';

        while($row = $result->fetch_assoc()) {
        $field1name = $row["USERNAME"];
        $field2name = $row["ITEM"];
        $field3name = $row["DESCRIPTIONS"];
        $field4name = $row["BID_AMOUNT"];
        $field5name = $row["CLOSING_DATE"];

        echo '<tr> 
                  <td>'.$field1name.'</td> 
                  <td>'.$field2name.'</td> 
                  <td>'.$field3name.'</td> 
                  <td>'.$field4name.'</td> 
                  <td>'.$field5name.'</td>
              </tr>';
        }
    echo '</table></div>';
    } 
    if (isset($_POST['bid_btn'])) {
        $curr_time = date("h:i:s");
        $curr_date = date("Y-m-d");        
        $username =  $_SESSION["username"];

        $val = trim($_POST['item']); 
        $val = mysqli_real_escape_string($conn, $_POST['item']);
        $item = $val;

        $val = trim($_POST['ownername']); 
        $val = mysqli_real_escape_string($conn, $_POST['ownername']);
        $ownername = $val;

        $val = trim($_POST['bid_amount']); 
        $val = mysqli_real_escape_string($conn, $_POST['bid_amount']);
        $bid_amount = $val;
        
        $query2 = "SELECT CLOSING_DATE FROM items WHERE USERNAME = '$ownername' AND ITEM = '$item'";
        $closing_date = mysqli_query($conn, $query2);
        $closing_date = (mysqli_fetch_array($closing_date)[0]);

        $query3 = "SELECT MAX(BID_AMOUNT) FROM bidders WHERE OWNERS = '$ownername' AND ITEM = '$item'";
        $highest_bid = mysqli_query($conn, $query3);
        $highest_bid = (mysqli_fetch_array($highest_bid)[0]);

        if (empty($item)) {array_push($errors, "Please enter item name");}
        if (empty($username)) {array_push($errors, "Please enter owner");}
        if (empty($bid_amount)) {array_push($errors,"Please enter bid amount");}
        if($curr_date>$closing_date){array_push($errors, "Bidding has closed");}
        if($highest_bid>=$bid_amount){array_push($errors, "Bid Higher than $highest_bid !");}

        if (count($errors) == 0) {
            $query4 = "INSERT INTO bidders (USERNAME, ITEM, BID_AMOUNT, OWNERS, CURR_TIME, CURR_DATE) VALUES('$username', '$item', '$bid_amount', '$ownername', '$curr_time','$curr_date')";
            mysqli_query($conn, $query4);
            echo '<h1>SUCCESSFULLY PLACED!!</h1>';
        }
    }
?>
<head>
    <title>Place Bid</title>
    <link rel="stylesheet" href="./includes/style.css">
</head>
<body>
<div class="container2">
		<form method="post" action="" >
			<h2 class="heading">Place a Bid</h2>
			<?php include(ROOT_PATH . '/includes/errors.php') ?>
			<input class="input-box" type="text" name="item" placeholder="Item Name"><br/><br/>
            <input class="input-box" type="text" name="ownername" placeholder="Owner Name"><br/><br/>
            <input class="input-box" type="number" name="bid_amount" placeholder="Bid Amount"><br/><br/>			
			<button type="submit" class="btn" name="bid_btn">Place Bid</button><br/><br/>
			<p class="foot"><a href="welcome.php" style="padding:15px">Go back</a></p>
		</form>
</div>
</body>