<html>
<head>
    <meta charset="utf-8" />

    <!-- Font Awesome -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- Bootstrap core CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">
<!-- Material Design Bootstrap -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.5.14/css/mdb.min.css" rel="stylesheet">
<link href="reviewed.css" rel="stylesheet">

    <title>Section</title>
</head>

<body>

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



    </div>
    <!-- Collapsible content -->

  </nav>
  <br>
  <div class="d-flex justify-content-center" >
  <div class="col-sm-8">

<?php


session_start();

$name = "";

$match = "";
$nomatch = "";



$query = "";

$db_connection = new mysqli('localhost', 'randomUser', 'thisisadatabase', 'rypdb');

if ($db_connection->connect_error) {
	die($db_connection->connect_error);
}

if (isset($_POST['goBack'])){

	header("Location: review.php");
}

else{


    $name = $_POST['name'];



	$query = "SELECT * FROM userreviews WHERE name = '$name'";
	$result = $db_connection->query($query);

	if (!$result) {

		die("Query failed: " . $db_connection->error);
	}

	else{

		$num_rows = $result->num_rows;

		if ($num_rows === 0) {
			$nomatch = "<br><br><h2>No results found.</h2><br>";
			$query = "SELECT * FROM userreviews WHERE name LIKE '%$name[0]%'";
			$result = $db_connection->query($query);

			if (!$result) {
				die("Query failed: " . $db_connection->error);
			}

			else{

				$num_rows = $result->num_rows;

				if ($num_rows !== 0) {

					$nomatch .= "Perhaps you were looking for...<br>";
					$possible = array();

					for ($row_index = 0; $row_index < $num_rows; $row_index++) {

						$result->data_seek($row_index);
						$row = $result->fetch_array(MYSQLI_ASSOC);

						array_push($possible, $row['name']);
					}

					$unq = array_unique($possible);

					foreach($unq as $val){

						$nomatch .= "<br>$val";
					}
				}
			}
		}

		else{

			$match .= "<h1 align = 'center'>$name Reviews</h1>";
			$avg = 0;

			for ($row_index = $num_rows - 1; $row_index >= 0; $row_index--){

				$result->data_seek($row_index);
				$row = $result->fetch_array(MYSQLI_ASSOC);
				$avg = $avg + $row['rating'];
			}

			$avg = round($avg/$num_rows, 2);
			$match .= "<h4 align = 'center'>Cumulative Rating: <strong>$avg</strong> <br><br><h4>";


			for ($row_index = $num_rows -1; $row_index >= 0; $row_index--){
$match .= "<table cellpadding='12'>";
				$result->data_seek($row_index);
				$row = $result->fetch_array(MYSQLI_ASSOC);
				$query = "select color from users where username = '{$row['user']}'";
				//fetches user image
				$cresult = $db_connection->query($query);
				if (!$cresult) {
				  die("Retrieval failed: ". $db_connection->error);
				} else {
				  $color = $cresult->fetch_object()->color;
				}
				$fileToRetrieve="";
				if($color=="grey")
					$fileToRetrieve="images/user1.png";
				else if($color=="red")
					$fileToRetrieve="images/user2.png";
				else if($color=="blue")
					$fileToRetrieve="images/user3.png";
				else if($color=="green")
					$fileToRetrieve="images/user4.png";
				else
					$fileToRetrieve="images/user5.png";
			
				$match .= "<div class='d-flex justify-content-center' ><tr class='data'><td class='stuff'><img src=\"retrievingDocument.php?fileToRetrieve=$fileToRetrieve\" alt=\"avatar\" height='45px' width='45px'/>";
				$match .= " <strong>
         {$row['user']}";
				$match .= " <br><br> <u>course</u>: {$row['course']} <br> <u>rating</u>: {$row['rating']} </strong><br><br><br> </td>";
				$match .= "<td class='comments' width='80%'>   <h4>{$row['comments']}</h4> </td></tr></div>";
        $match .="</table><br>";

			}


		}
	}


	/* Closing connection */
	$db_connection->close();
}

	$body = "<form action='{$_SERVER['PHP_SELF']}' method='post'>";
	$body .= "<br><input align = 'left' class='btn btn-cyan' type='submit' name='goBack' value='Back to Search'>";
	$body .= "</form>";

	if($nomatch !== "")
		echo $nomatch.$body;
	else
		echo $match.$body;
?>

</div>
</div>
</body>
</html>
