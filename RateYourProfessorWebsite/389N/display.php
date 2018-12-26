<?php
	$show = $_POST['show'];
	$sort = $_POST['sort'];
	$condition = $_POST['condition'];

	$query = "select ".implode(", ", $show)."from `applicants` where ".$condition;
	echo $query;

	$db_connection = new mysqli('localhost', 'dbuser', 'goodbyeWorld', 'applicationdb');
	if ($db_connection->connect_error) {
	  die($db_connection->connect_error);
	}

	$result = $db_connection->query($query);?>
	<table>
        <thead>
            <tr>
                <?php foreach($show as $val) {?>
									<td><?php $val ?></td>
								<?php } ?>
            </tr>
        </thead>
<tbody>
	<?php
	if (!$result) {
	  die("Retrieval failed: ". $db_connection->error);
	} else {
	  /* Number of rows found */
	  $num_rows = $result->num_rows;
	    for ($row_index = 0; $row_index < $num_rows; $row_index++) {
	      $result->data_seek($row_index);
	      $row = $result->fetch_array(MYSQLI_ASSOC); ?>
				<tr>
				<?php foreach($show as $value) { ?>
					<td> <?php $row[$value] ?> </td>
				<?php } ?> </tr>
			<?php }
		}
 ?>
 </tbody>
 </table>
