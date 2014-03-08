<html>
<center>
<h1> Modify Data </h1>
<body>
	<?php
		if (isset($_POST['update'])) {
			echo "<form action = 'Users.php' METHOD = 'POST'></br>";
			echo 'Put in the person\'s followed by the information you would like to update';
			echo "ID: <input type = 'number' name = 'id'/></br>";
			echo "Username: <input type = 'text' name = 'user'/></br>";
			echo "Password: <input type = 'text' name = 'pass'/></br>";
			echo "Class: <input type = 'text' name = 'class'/></br>";
			echo "Date: <input type = 'text' name = 'date'/></br>";
			echo "<input type = 'submit' name = 'update' value = 'update'/>";
			echo "</form>";
		}
		if (isset($_POST['enter'])) {
		}
	?>
</center>
</body>
</html>

