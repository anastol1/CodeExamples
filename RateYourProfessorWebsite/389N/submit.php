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
<link href="submit.css" rel="stylesheet">
<?php session_start();
	if(!isset($_SESSION['username']))
		header("Location:login.html");
?>
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
      <!-- Search form -->
      


    </div>
    <!-- Collapsible content -->

  </nav>
<br>
<div class="d-flex justify-content-center" >
<div class="col-sm-8">
<h2>   Professor Review Form </h2><br>


		<form action="submitted.php" method="post">
			<input type="text" placeholder="Professor Name" name="name" required="required" class="form-control"/><br>
			<input type="text" placeholder="Course (e.g. CMSC389N)" name="course" required="required" class="form-control"/><br>
			<input type="float" placeholder="Rating: 1-10" name="rating" required="required" class="form-control"/><br>
			<textarea name="comments"  class="form-control" placeholder="Comments" id="comments" rows=5 cols=60></textarea>
			<br><input class="btn btn-cyan" type="submit" name="submitInfoButton" /><br>
		</form>
		<br/>
		<p>Logged in as <b><?php echo $_SESSION['username']?></b></p>
		<?php
			$db_connection = new mysqli('localhost', 'randomUser', 'thisisadatabase', 'RYPdb');
			if ($db_connection->connect_error) {
				die($db_connection->connect_error);
			}

			/* Query */
			$query = "select color from users where username = '{$_SESSION['username']}'";
			$result = $db_connection->query($query);
			if (!$result) {
			  die("Retrieval failed: ". $db_connection->error);
			} else {
			  $color = $result->fetch_object()->color;
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
			echo "<img src=\"retrievingDocument.php?fileToRetrieve=$fileToRetrieve\" alt=\"avatar\" height='100px' weight='100px'/><br><br><br>";
			$db_connection->close();
		?>

	</div>
</div>
</body>
</html>
