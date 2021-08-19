<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customers Detail</title>
    <link rel="stylesheet" href="./css/customer.css">
    <link rel="stylesheet" media="screen and (max-width: 768px)" href="./css/responsive.css">

</head>
<body>
    <nav class="navbar-customer">
        <img class="logo" src="./images/TSF logo.jpeg" alt="TSF logo"> 
        <div class="navmenu"> 
            <ul class="item"> 
                <li><a href="index.php"><button class="btn outer-shadow hover-in-shadow">Home</button></a></li>
                <li><a href="TransactionHistory.php"><button class="btn outer-shadow hover-in-shadow">Transaction history</button></a></li>  
            </ul> 
        </div>
    </nav>
    
    <div>
    <h1 class="header">Customers' Details</h1><br><br>

    <table class="main-table">
        <thead>
            <tr>
                <th>Sr. no.</th>
                <th>Name</th>
                <th>Email</th>
                <th>Current Balance</th>
                <th>Transfer</th>
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
                $selectquery="SELECT * FROM `customers details`";
                $query = mysqli_query($con, $selectquery);
                $rownum = mysqli_num_rows($query);

                while($res = mysqli_fetch_array($query)){
                ?>
                    <tr>
                        <td><?php echo $res['ID'] ?></td>
                        <td><?php echo $res['NAME'] ?></td>
                        <td><?php echo $res['EMAIL'] ?></td>
                        <td><?php echo $res['CURRENT_BALANCE'] ?></td>
                        <td><button style="padding: 0 3px; background-color:green"><a style="text-decoration: none; color: white;" href="TransferMoney.php?id=<?php echo $res['ID']?> "><p>Transfer now</p></a></button></td>
                    </tr>
            <?php
                }
            ?>
            
            
            </tbody>   
        </table>
    </div>
</body>
</html>