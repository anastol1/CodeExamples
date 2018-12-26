<?php
session_start();
include("Review.php");
$username = $_POST['username'];

$password = $_POST['pw'];


$db_connection = new mysqli('localhost', 'randomUser', 'thisisadatabase', 'RYPdb');
if ($db_connection->connect_error) {
  die($db_connection->connect_error);
}

/* Query */
$query = "select * from users where username='$username'";

/* Executing query */
$result = $db_connection->query($query);
if (!$result) {
  die("Retrieval failed: ". $db_connection->error);
} else {
  /* Number of rows found */
  $num_rows = $result->num_rows;
  if ($num_rows === 0 ) {
    header("Location:loginError.php");//loginError.php
  } else {
	  
    for ($row_index = 0; $row_index < $num_rows; $row_index++) {
      $result->data_seek($row_index);
      $row = $result->fetch_array(MYSQLI_ASSOC);

      //echo "Name: {$row['name']}, Id: {$row['id']} <br>";
      if (!password_verify($password, $row['password'])) {
        header("Location:loginError.php");
      }
      else {
		$_SESSION['username'] = $username;
		header("Location:main.html");
      }
    }
  }
}

/* Freeing memory */
$result->close();

/* Closing connection */
$db_connection->close();

?>
