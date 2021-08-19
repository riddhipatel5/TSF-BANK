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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transation</title>
    <link rel="stylesheet" href="./css/transfer.css">
    <link rel="stylesheet" media="screen and (max-width: 768px)" href="./css/responsive.css">

</head>
<body>
    <div class="mainSection">
            <h2>Transaction details</h2>
            <form action="" method="post">

                <?php 
            global $sender;
            $customerId = $_GET['id'];
            $selectquery = "SELECT * FROM `customers details` WHERE ID = '$customerId'";
            $showdata = mysqli_query($con, $selectquery);
            if($bool = mysqli_fetch_array($showdata))
            {
                $money = $bool['CURRENT_BALANCE'];
                $sender = $bool['NAME'];
            }
            // echo "$showdata";
            ?>
                <table class="table">
                    <tr>
                        <td>
                            <p class="form-field">Transfer From:</p>
                        </td>
                        <td>
                            <p class="form-field"><?php echo $sender . '(' . $bool['CURRENT_BALANCE'] . ')'; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p class="form-field">Transfer To: </p>
                        </td>
                        <td>
                            <p class="form-field"><select name="customer" id="customerlist" class="input"></p>
                        
                        <?php 
                            $selectquery = "SELECT NAME,CURRENT_BALANCE FROM `customers details` WHERE NOT ID = '$customerId'";
                            $showdata = mysqli_query($con, $selectquery);
                            
                            while($transferTo = mysqli_fetch_array($showdata)){
                        ?>
                            <option value="<?php echo $transferTo['NAME']; ?>"><?php echo $transferTo['NAME'] . '(' . $transferTo['CURRENT_BALANCE'] . ')';  ?></option></p>
                        <?php
                            }
                        global $getMax;
                        ?>
                    </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p class="form-field">Enter amount: </p>
                        </td>
                        <td>
                            <input type="number" name="AMOUNT" id="amt" placeholder="Enter amount" class="form-field" required min="1" max=<?php echo "$money"; ?>>
                        </td>
                    </tr>
                </table>
                <button type="submit" class="btn"> Transfer</button>


            </form>
        <?php
            global $update;
            global $receiver;
            if(!empty($_POST['AMOUNT'])){
                $transfer = $_POST['AMOUNT'];
                $amount = $money - $transfer;
                $receiver = $_POST['customer'];
            
                $getMoneyQuery = "SELECT `CURRENT_BALANCE` FROM `customers details` WHERE `NAME` = '$receiver'";
                $getMoney = mysqli_query($con, $getMoneyQuery);
                // echo $getMoneyQuery;
                // echo $getMoney;
                if($amt = mysqli_fetch_array($getMoney)){
                    // echo $amt[0];
                    $addmoney = $amt[0] + $transfer; 
                }
                // $getMaxQuery = mysqli_query($con, "SELECT `CURRENT_BALANCE` FROM `customer details` WHERE `NAME` = '$receiver'");
                // echo $addmoney;
                $updatequery = "UPDATE `customers details` SET `CURRENT_BALANCE` = '$amount' WHERE `ID` = '$customerId'";
                $update = mysqli_query($con, $updatequery);
                
                $updateToQuery = "UPDATE `customers details` SET `CURRENT_BALANCE` = '$addmoney' WHERE `NAME` = '$receiver'";
                $updateTo = mysqli_query($con, $updateToQuery);

                $TransactionHistoryQuery = "INSERT INTO `transaction history` (`SENDER`, `RECEIVER`, `AMOUNT`, `DATE&TIME`) VALUES ('$sender','$receiver','$transfer', current_timestamp());";
                $TransactionHistory = mysqli_query($con, $TransactionHistoryQuery);
            }
            if($update){
        ?>
                <script type="text/javascript">
                    alert("Transaction Successful");
                    window.location.href = "TransactionHistory.php";
                </script>
            <?php } ?>

        </div>
</body>
</html>