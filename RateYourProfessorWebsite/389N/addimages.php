<?php	

	$host = "localhost";
	$user = "randomUser";
	$password = "thisisadatabase";
	$database = "RYPdb";
	$table = "userimages";
	$db = connectToDB($host, $user, $password, $database);
	
	$sqlQuery = "create table $table (docName varchar(20), docMimeType varchar(512), docData longblob)";
	$result = mysqli_query($db, $sqlQuery);
	if ($result) {
		$body = "Table $table has been created.";
	} else { 				   ;
		$body = "Creating $table failed: ".mysqli_error($db);
	}
	for($i=1;$i<=5;$i++){
	$fileToInsert = "images/user{$i}.png";
	$docMimeType = "image/png";
	
	$fileData = addslashes(file_get_contents($fileToInsert));
	
	$sqlQuery = "insert into $table (docName, docMimeType, docData) values ";
	$sqlQuery .= "('{$fileToInsert}', '{$docMimeType}', '{$fileData}')";
	$result = mysqli_query($db, $sqlQuery);
	if ($result) {
		$body .= "<h3>Document $fileToInsert has been added to the database.</h3>";
	} else { 				   ;
		$body .= "<h3>Failed to add document $fileToInsert: ".mysqli_error($db)." </h3>";
	}
	}
	/* Closing */
	mysqli_close($db);
	
	echo $body;

function connectToDB($host, $user, $password, $database) {
	$db = mysqli_connect($host, $user, $password, $database);
	if (mysqli_connect_errno()) {
		echo "Connect failed.\n".mysqli_connect_error();
		exit();
	}
	return $db;
}
?>