<!DOCTYPE HTML>
    <html>
        <head>
            <title>customer table</title>
            <link rel="stylesheet" type="text/css" href="style.css">
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


        </head>
<body> 
    <?php
    include 'config.php';
    $selectquery = "SELECT * FROM users";
    $query= mysqli_query($conn,$selectquery);
    ?>

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
<h1 align="center">LIST OF CUSTOMERS</h1><br>
                <table class="table"> 
                        <tr align="center">
                            <th>Id</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Balance</th>
                            <th>Operation</th>
                        </tr>
<?php
while($res = mysqli_fetch_array($query)){
?>
    <tr>
        <td><?php echo $res['id'] ?></td>
        <td><?php echo $res['name'] ?></td>
        <td><?php echo $res['email'] ?></td>
        <td><?php echo $res['amount'] ?></td>
        <td><a href="info.php?id=<?php echo $res['id'];?>"><button class="view view1">VIEW</button></a></td>
    </tr>

<?php 
}
?>                       
                </table>
</div>
</body>
</html>
