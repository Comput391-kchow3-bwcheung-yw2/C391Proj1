<html>
<center>
<h1> Modify Data </h1>
<body>
	<?php
		if (isset($_POST['Update_Users'])) {
			echo "<form action = 'management.php' METHOD = 'POST'></br>";
			echo 'Put in the users\'s id followed by the information you would like to update';
			echo "ID: <input type = 'text' name = 'id'/></br>";
			echo "Username: <input type = 'text' name = 'user'/></br>";
			echo "Password: <input type = 'text' name = 'pass'/></br>";
			echo "Class: <input type = 'text' name = 'class'/></br>";
			echo "Date Registered: <input type = 'text' name = 'date'/></br>";
			echo "<input type = 'submit' name = 'update_users' value = 'update'/>";
			echo "</form>";
		}
		if (isset($_POST['Enter_Users'])) {
			echo "<form action = 'management.php' METHOD = 'POST'></br>";
			echo 'Put in the new users\'s information you would like to enter:</br>';
			echo "ID: <input type = 'text' name = 'id'/></br>";
			echo "Username: <input type = 'text' name = 'user'/></br>";
			echo "Password: <input type = 'text' name = 'pass'/></br>";
			echo "Class: <input type = 'text' name = 'class'/></br>";
			echo "Date Registered: <input type = 'text' name = 'date'/></br>";
			echo "<input type = 'submit' name = 'enter_users' value = 'enter'/>";
			echo "</form>";
		}
		if (isset($_POST['Update_Doctors'])) {
			echo "<form action = 'management.php' METHOD = 'POST'></br>";
			echo 'Put in the doctor\'s id followed by the information you would like to update';
			echo "ID: <input type = 'text' name = 'id'/></br>";
			echo "Patient ID: <input type = 'text' name = 'p_id'/></br>";
			echo "<input type = 'submit' name = 'update_doctors' value = 'update'/>";
			echo "</form>";
		}
		if (isset($_POST['Enter_Doctors'])) {
			echo "<form action = 'management.php' METHOD = 'POST'></br>";
			echo 'Put in the new doctor\'s information you would like to enter:</br>';
			echo "Doctor ID: <input type = 'text' name = 'id'/></br>";
			echo "Patient ID: <input type = 'text' name = 'p_id'/></br>";
			echo "<input type = 'submit' name = 'enter_doctors' value = 'enter'/>";
			echo "</form>";
		}
		if (isset($_POST['Update_Persons'])) {
			echo "<form action = 'management.php' METHOD = 'POST'></br>";
			echo 'Put in the person\'s id followed by the information you would like to update';
			echo "ID: <input type = 'text' name = 'id'/></br>";
			echo "First Name: <input type = 'text' name = 'first'/></br>";
			echo "Last Name: <input type = 'text' name = 'last'/></br>";
			echo "Address: <input type = 'text' name = 'address'/></br>";
			echo "Email: <input type = 'text' name = 'email'/></br>";
			echo "Phone: <input type = 'text' name = 'phone'/></br>";
			echo "<input type = 'submit' name = 'update_persons' value = 'update'/>";
			echo "</form>";
		}
		if (isset($_POST['Enter_Persons'])) {
			echo "<form action = 'management.php' METHOD = 'POST'></br>";
			echo 'Put in the new person\'s information you would like to enter:</br>';
			echo "ID: <input type = 'text' name = 'id'/></br>";
			echo "First Name: <input type = 'text' name = 'first'/></br>";
			echo "Last Name: <input type = 'text' name = 'last'/></br>";
			echo "Address: <input type = 'text' name = 'address'/></br>";
			echo "Email: <input type = 'text' name = 'email'/></br>";
			echo "Phone: <input type = 'text' name = 'phone'/></br>";
			echo "<input type = 'submit' name = 'enter_persons' value = 'enter'/>";
			echo "</form>";
		}
	?>
</center>
</body>
</html>
