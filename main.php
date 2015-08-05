<html>
	<head>
		<title>Collin Dorsett - CS 290 Assignment 6</title>
	</head>
	<body>

		<h1 align="center">Assignment 6 - PHP/MySQL</h1>
		
		<?php
			$dbhost = 'oniddb.cws.oregonstate.edu';
			$dbname = 'dorsettc-db';
			$dbuser = 'dorsettc-db';
			$dbpass = 'vYA4TdijrmClBX2o';
		
			$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
			if ($conn->connect_error) {
			    die("Connection failed: " . $conn->connect_error);
			} else {
				echo "Successfully connected to database <br>";
			}


			$sql = "CREATE TABLE Movies (
				ID INT(255) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
				Name VARCHAR(255) NOT NULL UNIQUE,
				Category VARCHAR(255) NOT NULL,
				Length INT(255) NOT NULL,
				Rented VARCHAR(255) NOT NULL
			)";									
			if(!$stmt = $conn->prepare($sql))
				echo "Prepare Error: " . $stmt->error . "<br>";
			if(!$stmt->execute())
				echo "Execute Error: " . $stmt->error . "<br>";
			else 
				echo "Table 'Movies' created successfully<br>";
				
			$stmt->close();
			$conn->close();
		?>

		<br>
		<b>Add Video</b>

		<form action="add.php" method="POST">
			Name: <input type="text" name="name"><br>
			Category: <input type="text" name="category"><br>
			Length: <input type="number" name="length" min="1" max="999"> minutes<br>
			<input type="submit" name="submit" value="Submit">
			<br><br>
		</form>

		<form action="deleteTable.php">
			<input type="submit" name="submit" value="Delete All Videos">
			<br><br>
		</form>

		<form action="filterCat.php" method="POST">
			<select name="filterCat">
				<option value="All Movies">All Movies</option>
				<?php
					$dbhost = 'oniddb.cws.oregonstate.edu';
					$dbname = 'dorsettc-db';
					$dbuser = 'dorsettc-db';
					$dbpass = 'vYA4TdijrmClBX2o';
				
					$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);		
					

					$sql = "SELECT DISTINCT Category FROM Movies";
					if(!$stmt = $conn->prepare($sql))
						echo "Prepare Error: " . $stmt->error . "<br>";
					if(!$stmt->execute())
						echo "Execute Error: " . $stmt->error . "<br>";
					if(!$stmt->bind_result($res_cat))
						echo "Binding Error: " . $stmt->error . "<br>";
	
					while($stmt->fetch()){
						echo "<option value=" . $res_cat . ">" . $res_cat . "</option>";
					}
				?>
			</select>
			<br>
			<input type="submit" name="submit" value="Filter By Category">
			<br><br>
		</form>

		<table id="movies" border='1'>
			<tr>
				<th>ID</th>
				<th>Name</th>
				<th>Category</th>
				<th>Length</th>
				<th>Rented</th>
				<th>Delete</th>
				<th>Check</th>
			</tr>
			<?php
				$dbhost = 'oniddb.cws.oregonstate.edu';
				$dbname = 'dorsettc-db';
				$dbuser = 'dorsettc-db';
				$dbpass = 'vYA4TdijrmClBX2o';
			
				$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);		
					

				$sql = "SELECT * FROM Movies";
				if(!$stmt = $conn->prepare($sql))
					echo "Prepare Error: " . $stmt->error . "<br>";
				if(!$stmt->execute())
					echo "Execute Erro: " . $stmt->error . "<br>";
				if(!$stmt->bind_result($res_id, $res_name, $res_cat, $res_length, $res_rented))
					echo "Binding Error: " . $stmt->error . "<br>";

				while($stmt->fetch()){
					echo "<tr>";
					echo "<td>" . $res_id . "</td>";
					echo "<td>" . $res_name . "</td>";
					echo "<td>" . $res_cat . "</td>";
					echo "<td>" . $res_length . "</td>";
					echo "<td>" . $res_rented . "</td>";
					echo "<td>
							<form action=\"delete.php\" method=\"POST\">
								<input type=\"submit\" name=\"delete\" value=\"Delete\">
								<input type=\"hidden\" name=\"deleteID\" value=\"" . $res_id . "\">
							</form>
						</td>";
					echo "<td>
							<form action=\"checkOutIn.php\" method=\"POST\">
								<input type=\"submit\" name=\"check\" value=\"Out / In\">
								<input type=\"hidden\" name=\"checkID\" value=\"" . $res_id . "\">
							</form>
						</td>";
					echo "</tr>";
				}
				$stmt->close();
				$conn->close();
			?>
		</table>

	</body>
</html>
