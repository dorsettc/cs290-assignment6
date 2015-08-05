<html>
	<head></head>
	<body>

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


				$filter = $_POST['filterCat'];
				echo "All movies with the category: ". $filter . "<br><br>";
				echo "<form action=\"main.php\"><input type=\"submit\" name=\"submit\" value=\"Return To Main Menu\"><br><br></form>";

				if($filter == 'All Movies'){
					$sql = "SELECT * FROM Movies";
					if(!$stmt = $conn->prepare($sql))
						echo "Prepare Error: " . $stmt->error . "<br>";
					if(!$stmt->execute())
						echo "Execute Error: " . $stmt->error . "<br>";
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
				} else {
					$sql = "SELECT * FROM Movies WHERE Category='" . $filter . "'";
					if(!$stmt = $conn->prepare($sql))
						echo "Prepare Error: " . $stmt->error . "<br>";
					if(!$stmt->execute())
						echo "Execute Error: " . $stmt->error . "<br>";
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
				}
				$stmt->close();
				$conn->close();
			?>
		</table>

	</body>
</html>
