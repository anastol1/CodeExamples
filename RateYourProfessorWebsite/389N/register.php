<!doctype html>
<html>
<head>
    <meta charset="utf-8" />

    <!-- Font Awesome -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- Bootstrap core CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">
<!-- Material Design Bootstrap -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.5.14/css/mdb.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="loginerror.css">
    <title>Section</title>
</head>
<body>


  <div class="bg">

    <!--Navbar-->

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark  justify-content-between">
      <!-- Navbar brand -->
      <span class="navbar-brand mb-0 h1">Rate Your Professor</span>

      <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="main.html">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="login.html">Login</a>
            </li>

          </ul>
        </div>




        <!-- Links -->

        <!-- Links -
        <!-- Search form -->
        

      </div>
      <!-- Collapsible content -->

    </nav>
 <!--/.Navbar-->




<?php
  echo "<br><br><br><br><br><h3>Account Created!</h3><br>";
?>


  <a href="login.html" class="btn btn-cyan">Return to Login Screen</a>

</body>
</html>



<?php


$user = $_POST['user'];
$password = $_POST['password'];
$color = $_POST['color'];
$hashed = password_hash($password, PASSWORD_DEFAULT);


$db_connection = new mysqli('localhost', 'randomUser', 'thisisadatabase', 'RYPdb');
if ($db_connection->connect_error) {
	die($db_connection->connect_error);
}

/* Query */

$query = "insert into users values ('$user','$hashed','$color')";

/* Executing query */
$result = $db_connection->query($query);
if (!$result) {
	die("Insertion failed: " . $db_connection->error);
}

/* Closing connection */
$db_connection->close();


?>
