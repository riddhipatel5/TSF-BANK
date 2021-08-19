<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction History</title>
    <link rel="stylesheet" href="./css/customer.css">
    <link rel="stylesheet" media="screen and (max-width: 768px)" href="./css/responsive.css">

</head>
<body>
    <nav class="navbar-customer">
        <img class="logo" src="images/TSF logo.jpeg" alt="TSF logo"> 
        <div class="navmenu"> 
            <ul class="item"> 
                <li><a href="index.php"><button class="btn outer-shadow hover-in-shadow">Home</button></a></li>
                <li><a href="customer.php"><button class="btn outer-shadow hover-in-shadow">View all customers</button></a></li>  
            </ul> 
        </div>
    </nav>
    <h1>Transaction History</h1><br><br>
    <div>
    <table class="main-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Sender</th>
                <th>Receiver</th>
                <th>Amount</th>
                <th>Date & Time</th>
            </tr>
        </thead>
        <tbody>
                <?php
                    $server = "sql203.epizy.com";
                    $username = "epiz_29464705";
                    $password = "3kRrXXshyo9X4wi";
                    $db = "epiz_29464705_bank_tsf";

                //to establish connection
                $con = mysqli_connect($server, $username, $password,$db);

                //to check
                if(!$con){
                    die("Connection to this database failed due to " . mysqli_connect_error());
                }
                // else{
                //     echo "Coonnection successful";
                // }
                $selectquery="SELECT * FROM `transaction history`";
                $query = mysqli_query($con, $selectquery);
                $rownum = mysqli_num_rows($query);

                while($res = mysqli_fetch_array($query)){
                ?>
                    <tr>
                        <td><?php echo $res['ID'] ?></td>
                        <td><?php echo $res['SENDER'] ?></td>
                        <td><?php echo $res['RECEIVER'] ?></td>
                        <td><?php echo $res['AMOUNT'] ?></td>
                        <td><?php echo $res['DATE&TIME'] ?></td>
                        
                    </tr>
            <?php
                }
            ?>
    
            </tbody>
    </table>
    </div>
</body>
</html>