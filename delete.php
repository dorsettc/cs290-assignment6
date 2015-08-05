<?php
	header('Refresh: 3; URL=http://web.engr.oregonstate.edu/~dorsettc/assignment6/src/main.php');

	$dbhost = 'oniddb.cws.oregonstate.edu';
	$dbname = 'dorsettc-db';
	$dbuser = 'dorsettc-db';
	$dbpass = 'vYA4TdijrmClBX2o';
		
	$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);


	$sql = "DELETE FROM Movies WHERE ID=?";
	if(!$stmt = $conn->prepare($sql))
		echo "Prepare Error: " . $stmt->error . "<br>";
	if(!$stmt->bind_param('i', intval($_POST['deleteID'])))
		echo "Binding Error: " . $stmt->error . "<br>";
	if(!$stmt->execute())
		echo "Execute Error: " . $stmt->error . "<br>";
	else
		echo "Row deleted successfully <br>";
	
	$stmt->close();
	$conn->close();
	echo "<br>Redirecting in 3 seconds...";
?>
