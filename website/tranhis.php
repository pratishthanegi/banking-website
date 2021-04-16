<!DOCTYPE HTML>
<html>
    <head>
        <title>history</title>
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


<div class="container">
<br>
<h1 align="center">TRANSACTION HISTORY</h1><br>

    <table class="table">
        <tr align="center">
            <th>S.No.</th>
            <th>Sender</th>
            <th>Receiver</th>
            <th>Amount</th>
            <th>Date & Time</th>
        </tr>
        
        <?php
            include 'config.php';
            $selectquery = "SELECT * FROM history";
            $query = mysqli_query($conn,$selectquery);

            while($res = mysqli_fetch_array($query)){
        ?>
            <tr>
                <td><?php echo $res['sno'] ?></td>
                <td><?php echo $res['sender'] ?></td>
                <td><?php echo $res['receiver'] ?></td>
                <td><?php echo $res['amount'] ?></td>
                <td><?php echo $res['time'] ?></td>
            </tr> 
        <?php           
            }
        ?>

    </table>
</div>
</body>
</html>