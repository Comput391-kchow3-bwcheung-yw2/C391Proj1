<html>
    <body>
	<center>
        <?php 
	   include ("PHPconnectionDB.php");
           if (isset($_POST['enter_users'])) {
		$conn=connect();
		$user = $_POST['user'];
		$pass = $_POST['pass'];
		$id = $_POST['id'];
		$class = $_POST['class'];
		$date = $_POST['date'];
		$sql = 'INSERT INTO USERS VAlUES (\''.$user.'\''.', \''.$pass.'\''.', \''.$class.'\''.', \''.$id.'\''.', \''.$date.'\''.')';
		$stid = oci_parse($conn, $sql);
           	$res=oci_execute($stid); 
           	if (!$res) {
			$err = oci_error($stid);
			echo htmlentities($err['message']);
           	}
                Users_table();
	   }
	   if (isset($_POST['enter_persons'])) {
		$conn = connect();
		$first = $_POST['first'];
		$last = $_POST['last'];
		$id = $_POST['id'];
		$address = $_POST['address'];
		$phone = $_POST['phone'];
		$email = $_POST['email'];
		$sql = 'INSERT INTO PERSONS VAlUES (\''.$id.'\''.', \''.$first.'\''.', \''.$last.'\''.', \''.$address.'\''.', \''.$email.'\''.',\''.$phone.'\''.')';
		$stid = oci_parse($conn, $sql);
           	$res=oci_execute($stid); 
           	if (!$res) {
			$err = oci_error($stid);
			echo htmlentities($err['message']);
           	}
                Persons_table();
	   }
	   if (isset($_POST['enter_doctors'])) {
		$conn = connect();
		$id = $_POST['id'];
		$p_id = $_POST['p_id'];
		$sql = 'INSERT INTO FAMILY_DOCTOR VAlUES (\''.$id.'\''.', \''.$p_id.'\''.')';
		$stid = oci_parse($conn, $sql);
           	$res=oci_execute($stid); 
           	if (!$res) {
			$err = oci_error($stid);
			echo htmlentities($err['message']);
           	}
                Doctors_table();
	   }
           if (isset($_POST['update_users'])) {
		 $conn = connect();
		$user = $_POST['user'];
		$pass = $_POST['pass'];
		$id = $_POST['id'];
		$class = $_POST['class'];
		$date = $_POST['date'];
		$sql = 'UPDATE users SET USER_NAME = \''.$user.'\''.', PASSWORD = \''.$pass.'\''.', CLASS = \''.$class.'\''.', DATE_REGISTERED = \''.$date.'\''.' WHERE  PERSON_ID = \''.$id.'\'';
          	$stid = oci_parse($conn, $sql);
           	$res=oci_execute($stid); 
           	if (!$res) {
			$err = oci_error($stid);
			echo htmlentities($err['message']);
           	}
                Users_table();
           }
	   if (isset($_POST['update_persons'])) {
		$conn = connect();
		$first = $_POST['first'];
		$last = $_POST['last'];
		$id = $_POST['id'];
		$address = $_POST['address'];
		$phone = $_POST['phone'];
		$email = $_POST['email'];
		$sql = 'UPDATE persons SET FIRST_NAME = \''.$first.'\''.', LAST_NAME = \''.$last.'\''.', ADDRESS = \''.$address.'\''.', PHONE = \''.$phone.'\''.', EMAIL = \''.$email.'\''.' WHERE  PERSON_ID = \''.$id.'\'';
          	$stid = oci_parse($conn, $sql);
           	$res=oci_execute($stid); 
           	if (!$res) {
			$err = oci_error($stid);
			echo htmlentities($err['message']);
           	}
		Persons_table();
           }
	   if (isset($_POST['update_doctors'])) {
		$conn = connect();
		$id = $_POST['id'];
		$p_id = $_POST['p_id'];
		$sql = 'UPDATE family_doctor SET PATIENT_ID = \''.$p_id.'\''.' WHERE  DOCTOR_ID = \''.$id.'\'';
          	$stid = oci_parse($conn, $sql);
           	$res=oci_execute($stid); 
           	if (!$res) {
			$err = oci_error($stid);
			echo htmlentities($err['message']);
           	}
		Doctors_table();
           }
	   if (isset($_POST['Users'])) {
		users_table();
	   }
	  
	    if (isset($_POST['Persons'])) {
			Persons_table();
	    }
	    if (isset($_POST['Doctors'])) {
		Doctors_table();
	    }
	    function Doctors_table() {
		   $conn = connect();
		   echo '<h1> Doctors Table </h1>';
		   echo '<FORM action = "Modify.php" Method = "post"></br>';
	           echo 'To update table: <input type = "submit" name = "Update_Doctors" value = "submit"/></br>';
		   echo 'To enter new data: <input type = "submit" name = "Enter_Doctors" value = "submit"/></br>';
 	           echo '</form>';          
		   echo '<table>';
		   echo '<tr>';
		   echo '<th> Doctor ID </th>';
		   echo '<th> Patient ID </th>';
		   echo '</tr>';  
		   $sql = 'SELECT * FROM family_doctor';
		   $stid = oci_parse($conn, $sql );
		   $res=oci_execute($stid); 
		   if (!$res) {
			$err = oci_error($stid);
			echo htmlentities($err['message']);
		   }
		   while ($row = oci_fetch_array($stid, OCI_ASSOC)) {
		   	echo '<tr>';
			foreach ($row as $item) {
				echo "<td> $item </td>";
			}
			echo '</tr>';
			echo '<br/>';
		   }
		   echo '</table>';
		   oci_free_statement($stid);
		   oci_close($conn);
	    }
           function Persons_table() {       
                   $conn=connect();
           	   echo '<h1> Persons Table </h1>';
		   echo '<FORM action = "Modify.php" Method = "post"></br>';
	           echo 'To update table: <input type = "submit" name = "Update_Persons" value = "submit"/></br>';
		   echo 'To enter new data: <input type = "submit" name = "Enter_Persons" value = "submit"/></br>';
 	           echo '</form>';        
		   echo '<table>';
		   echo '<tr>';
		   echo '<th> ID </th>';
		   echo '<th> First Name </th>';
		   echo '<th> Last Name </th>';
		   echo '<th> Address </th>';
		   echo '<th> Email </th>';
		   echo '<th> phone </th>';
		   echo '</tr>';  
		   $sql = 'SELECT * FROM persons';
		   $stid = oci_parse($conn, $sql );
		   $res=oci_execute($stid); 
		   if (!$res) {
			$err = oci_error($stid);
			echo htmlentities($err['message']);
		   }
		   while ($row = oci_fetch_array($stid, OCI_ASSOC)) {
		   	echo '<tr>';
			foreach ($row as $item) {
				echo "<td> $item </td>";
			}
			echo '</tr>';
			echo '<br/>';
		   }
		   echo '</table>';
		   oci_free_statement($stid);
		   oci_close($conn);
	    }
            function Users_table() {
		   $conn=connect();
		   echo '<h1> Users Table </h1>';
		   echo '<FORM action = "Modify.php" Method = "post"></br>';
	           echo 'To update table: <input type = "submit" name = "Update_Users" value = "submit"/></br>';
		   echo 'To enter new data: <input type = "submit" name = "Enter_Users" value = "submit"/></br>';
 	           echo '</form>';    
		   echo '<table>';
		   echo '<tr>';
		   echo '<th> Username </th>';
		   echo '<th> Password </th>';
		   echo '<th> Class </th>';
		   echo '<th> ID </th>';
		   echo '<th> Date </th>';
		   echo '</tr>';  
		   $sql = 'SELECT * FROM Users';
		   $stid = oci_parse($conn, $sql );
		   $res=oci_execute($stid); 
		   if (!$res) {
			$err = oci_error($stid);
			echo htmlentities($err['message']);
		   }
		   while ($row = oci_fetch_array($stid, OCI_ASSOC)) {
		   	echo '<tr>';
			foreach ($row as $item) {
				echo "<td> $item </td>";
			}
			echo '</tr>';
			echo '<br/>';
		   }
		   echo '</table>';
		   oci_free_statement($stid);
		   oci_close($conn);
	    }
	    echo '<FORM action = "management.html" Method = "post"></br>';
	    echo 'Go back to management home page: <input type = "submit" name = "submit" value = "back"/></br>';  
	?>
	</table>
	</center>
    </body>
</html>
