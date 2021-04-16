<!DOCTYPE HTML>
<html>
    <head>
        <title>send money</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </head>
<body>

<div class="topnav">
  <a class="active" href="index.html">Home</a>
  <a href="tranhis.php">Transaction History</a>
    <div class="search-container">

<form action="/action_page.php">
    <input type="text" placeholder="Search.." name="search">
    <button type="submit">Search</i></button>
</form>    
    
    </div>
</div>

<br>

<h1 align="center">SEND MONEY</h1>
<br><br>

    <?php
    include 'config.php';
    $uid = $_GET['id'];
    $selectquery = "SELECT * FROM  users where id=$uid";
    $query = mysqli_query($conn,$selectquery); 
    $res = mysqli_fetch_array($query);  
    ?>

<div class="w-50 m-auto">
<form method="POST" name="credit"> 

    <table class="table" align="center">
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone no.</th>
            <th>Balance</th>
        </tr>
    
        <tr>
            <td><?php echo $res['id'] ?></td>
            <td><?php echo $res['name'] ?></td>
            <td><?php echo $res['email'] ?></td>
            <td><?php echo $res['phone'] ?></td>
            <td><?php echo $res['amount'] ?></td>          
        </tr>
    </table><br>

<label><b>TRANSFER TO :</b></label>
    <select name="to" class="form-control" required>
        <option disabled selected>Choose</option>

            <?php
                include 'config.php';
                $sid=$_GET['id'];
                $selectquery = "SELECT * FROM users where id!=$sid";
                $query=mysqli_query($conn,$selectquery);
                if(!$query)
                {
                    echo "Error ".$selectquery."<br>".mysqli_error($conn);
                }
                while($res = mysqli_fetch_assoc($query)) {
            ?>
                <option value="<?php echo $res['id'];?>" >
                
                    <?php echo $res['name'] ;?> : 
                    <?php echo $res['amount'] ;?> 
               
                </option>
            <?php 
                } 
            ?>
    </select><br>

    <label><b>AMOUNT :</b></label><br>
    <input type="number" name="amount" class="form-control" required/><br><br>

    <input action="user.php" type="submit" name="transfer" class="form-control" value="Transfer"/> 
</div>
</form> 

<?php

    include 'config.php';

    if(isset($_POST['transfer'])){
        $sendr = $_GET['id'];
        $recvr = $_POST['to'];
        $amount = $_POST['amount'];

        $selectquery = "SELECT * FROM users WHERE id='$sendr' ";
        $query = mysqli_query($conn,$selectquery);
        $res1 = mysqli_fetch_array($query);

        $selectquery = "SELECT * FROM users WHERE id='$recvr' ";
        $query = mysqli_query($conn,$selectquery);
        $res2 = mysqli_fetch_array($query);

        if($amount<0){
            echo '<script>alert("Error! Negative value cannot be transferred")</script>';
        }

        else if($amount==0){
            echo '<script>alert("Error! 0 amount cannot be transferred")</script>';
        }

        else if($amount>$res1['amount']){
            echo '<script>alert("Error! Insufficient Balance")</script>';
        }

        else{
        $bal = $res1['amount']-$amount;
        $selectquery = "UPDATE users SET amount=$bal WHERE id=$sendr";
        mysqli_query($conn,$selectquery);
        
        
        $bal = $res2['amount']+$amount;
        $selectquery = "UPDATE users SET amount=$bal WHERE id=$recvr";
        mysqli_query($conn,$selectquery);

        $sendr = $res1['name'];
        $recvr = $res2['name'];
        $selectquery = "INSERT INTO history(`sender`, `receiver`, `amount`) VALUES ('$sendr','$recvr','$amount')";
        mysqli_query($conn,$selectquery);
        
        echo '<script>alert("Transaction Successful !!")</script>';
        }

        header("Refresh:0");
    }
?>


</body>
</html>

