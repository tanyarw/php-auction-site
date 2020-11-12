<?php
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;}
?>
<head>
    <title>Welcome</title>
    <link rel="stylesheet" href="./includes/style.css">
</head>
<body>   
    <h1 class="heading">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>! Welcome to our site.</h1>
    <table class="table1">
        <tr>
            <td>
            <img class="illust2" src="./welcome.jpg" alt="">
            </td>
            <td>
                <p>
                    <a href="./additem.php" class="btn2"> Add Item</a>
                    <a href="./placebid.php" class="btn2"> Place Bid</a>
                    <a href="./myitems.php" class="btn2"> My Items</a>
                    <a href="./reset-password.php" class="btn2"> Reset Password</a>
                    <a href="./logout.php" class="btn2"> Sign Out</a>
                </p>
            </td>
        </tr>
    </table>
</body>
</html>