<?php
	header('Refresh: 3; URL=http://web.engr.oregonstate.edu/~dorsettc/assignment6/src/main.php');
	
	$dbhost = 'oniddb.cws.oregonstate.edu';
	$dbname = 'dorsettc-db';
	$dbuser = 'dorsettc-db';
	$dbpass = 'vYA4TdijrmClBX2o';
		
	$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);


	if(isset($_POST['name']) && !empty($_POST['name'])){
		$name = $_POST['name'];
	} else {
		echo "Error with 'name'<br>";
		echo "<br>Redirecting in 5 seconds...";
		exit();
	}
	if(isset($_POST['category']) && !empty($_POST['category'])){
		$category = $_POST['category'];
	} else {
		echo "Error with 'category'<br>";
		echo "<br>Redirecting in 5 seconds...";
		exit();
	}
	if(isset($_POST['length']) && !empty($_POST['length'])){
		$length = $_POST['length'];
	} else {
		echo "Error with 'length'<br>";
		echo "<br>Redirecting in 5 seconds...";
		exit();
	}
	$rented = 'Available';

	$sql = "INSERT INTO Movies (Name, Category, Length, Rented) 
			VALUES (?, ?, ?, ?)";
	if(!$stmt = $conn->prepare($sql))
		echo "Prepare Error: " . $stmt->error . "<br>";
	if(!$stmt->bind_param('ssis', $name, $category, $length, $rented))
		echo "Binding Error: " . $stmt->error . "<br>";
	if(!$stmt->execute())
		echo "Execute Error: " . $stmt->error . "<br>";
	else
		echo "New row successfully added to Table 'Movies'" . "<br>";
	
	$stmt->close();
	$conn->close();
	echo "<br>Redirecting in 3 seconds...";
?>
