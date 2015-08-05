<?php
	header('Refresh: 3; URL=http://web.engr.oregonstate.edu/~dorsettc/assignment6/src/main.php');

	$dbhost = 'oniddb.cws.oregonstate.edu';
	$dbname = 'dorsettc-db';
	$dbuser = 'dorsettc-db';
	$dbpass = 'vYA4TdijrmClBX2o';
		
	$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);


	$sql = "SELECT * FROM Movies WHERE ID=?";
	if(!$stmt = $conn->prepare($sql))
		echo "Prepare Error: " . $stmt->error . "<br>";
	if(!$stmt->bind_param('i', intval($_POST['checkID'])))
		echo "Binding Error: " . $stmt->error . "<br>";
	if(!$stmt->execute())
		echo "Execute Erro: " . $stmt->error . "<br>";
	if(!$stmt->bind_result($res_id, $res_name, $res_cat, $res_length, $res_rented))
		echo "Binding Error: " . $stmt->error . "<br>";
	while($stmt->fetch()){
		if($res_rented == 'Checked Out')
			$temp = 1;
		if($res_rented == 'Available')
			$temp = 2;
	}
	$stmt->close();
	if($temp == 1)
		goto _in;
	if($temp == 2)
		goto _out;

	_out:
	$sql = "UPDATE Movies 
			SET Rented='Checked Out'
			WHERE ID=?"; 
	if(!$stmt = $conn->prepare($sql))
		echo "Prepare Error: " . $stmt->error . "<br>";
	if(!$stmt->bind_param('i', intval($_POST['checkID'])))
		echo "Binding Error: " . $stmt->error . "<br>";
	if(!$stmt->execute())
		echo "Execute Error: " . $stmt->error . "<br>";
	else
		echo "Movie checked out successfully <br>";
	$stmt->close();
	$conn->close();
	echo "<br>Redirecting in 3 seconds...";
	exit();

	_in:
	$sql = "UPDATE Movies 
			SET Rented='Available'
			WHERE ID=?";
	if(!$stmt = $conn->prepare($sql))
		echo "Prepare Error: " . $stmt->error . "<br>";
	if(!$stmt->bind_param('i', intval($_POST['checkID'])))
		echo "Binding Error: " . $stmt->error . "<br>";
	if(!$stmt->execute())
		echo "Execute Error: " . $stmt->error . "<br>";
	else	
		echo "Movie checked in successfully <br>";
	$stmt->close();
	$conn->close();
	echo "<br>Redirecting in 3 seconds...";
	exit();
?>
