<?php  include('./config.php'); ?>
<?php 
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;}
?>
<?php
    global $conn;
    $errors = array();

    $USERNAME = $_SESSION["username"];
    $query1 = "SELECT ITEM, CLOSING_DATE, DESCRIPTIONS, BID_AMOUNT FROM items WHERE items.USERNAME = '$USERNAME' ";

    $result1 = mysqli_query($conn, $query1);
    if ($result1->num_rows > 0) {

        echo '
        <div class="container3">
            <h2 class="heading">My Items</h2>
            <table border="1" cellspacing="2" cellpadding="2" class="table2"> 
            <tr> 
            <th>ITEM</th>
            <th>CLOSING DATE</th>
            <th>DESCRIPTION</th> 
            <th>BID AMOUNT</th>
            </tr>';

            while($row = $result1->fetch_assoc()) {
        
            $field1name = $row["ITEM"];
            $field2name = $row["CLOSING_DATE"];
            $field3name = $row["DESCRIPTIONS"];
            $field4name = $row["BID_AMOUNT"];

            echo '<tr> 
                    <td>'.$field1name.'</td> 
                    <td>'.$field2name.'</td> 
                    <td>'.$field3name.'</td> 
                    <td>'.$field4name.'</td> 
                </tr>';
            }
        echo '</table>';

        $query2 = "SELECT bidders.USERNAME, bidders.ITEM, bidders.BID_AMOUNT, bidders.curr_time, bidders.curr_date FROM bidders,items WHERE items.USERNAME = '$USERNAME' AND bidders.OWNERS = items.USERNAME";

        $result2 = mysqli_query($conn, $query2);
        if ($result2->num_rows > 0) {
            echo '<h2 class="heading">My Bidders</h2>
            <table border="1" cellspacing="2" cellpadding="2" class="table2"> 
            <tr> 
            <th>BIDDER</th>
            <th>ITEM</th>
            <th>BID AMOUNTS</th>
            <th>TIME</th>
            <th>DATE</th> 
            </tr>';

            while($row = $result2->fetch_assoc()) {
        
            $field1name = $row["USERNAME"];
            $field2name = $row["ITEM"];
            $field3name = $row["BID_AMOUNT"];
            $field4name = $row["curr_time"];
            $field5name = $row["curr_date"];

            echo '<tr> 
                    <td>'.$field1name.'</td> 
                    <td>'.$field2name.'</td> 
                    <td>'.$field3name.'</td> 
                    <td>'.$field4name.'</td> 
                    <td>'.$field5name.'</td> 
                </tr>';
            }
        echo '</table> </div>';
        } 
        else{ echo '</div>';}
    }
    if (isset($_POST['delete_btn'])) {
        global $conn;        
		$val = trim($_POST['item']); 
		$val = mysqli_real_escape_string($conn, $_POST['item']);
        $item = $val;
        if (empty($item)) { array_push($errors, "Item name required"); }
        if (empty($errors)) {
            $query1 = "DELETE FROM items WHERE USERNAME = '$USERNAME' AND ITEM = '$item'";
            $query2 = "DELETE FROM bidders WHERE OWNERS = '$USERNAME' AND ITEM = '$item'";
            mysqli_query($conn, $query1);
            mysqli_query($conn, $query2);
            header("location: myitems.php");
		} else {array_push($errors, 'Invalid Item Name');}
    }
?>
<head>
<title>My Items</title>
    <link rel="stylesheet" href="./includes/style.css">
</head>
<body>
    <div class="container2">
        <form method="post" action="myitems.php" >
            <h2 class="heading">Delete an Item</h2>
            <?php include(ROOT_PATH . '/includes/errors.php') ?>
            <input class="input-box" type="text" name="item" placeholder="Item Name"><br/><br/>			
            <button id="submit" type="submit" class="btn" name="delete_btn">Delete</button><br/><br/>
            <p class="foot"><a href="welcome.php" style="padding:15px">Go back</a></p>
        </form>
    </div>
</body>