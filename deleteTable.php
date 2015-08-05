<?php
	header('Refresh: 3; URL=http://web.engr.oregonstate.edu/~dorsettc/assignment6/src/main.php');

	$dbhost = 'oniddb.cws.oregonstate.edu';
	$dbname = 'dorsettc-db';
	$dbuser = 'dorsettc-db';
	$dbpass = 'vYA4TdijrmClBX2o';
		
	$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

	
	$sql = "DROP TABLE Movies";
	if(!$stmt = $conn->prepare($sql))
		echo "Prepare Error: " . $stmt->error . "<br>";
	if(!$stmt->execute())
		echo "Execute Error: " . $stmt->error . "<br>";
	else
		echo "Table 'Movies' deleted successfully <br>";
	
	$stmt->close();
	$conn->close();
	echo "<br>Redirecting in 3 seconds...";
?>
