<html>
    <body>
	<center>
        
        <?php
	//page for letting a user modify their login or personal info
            include ("PHPconnectionDB.php");
            session_start();
	    
	    //for displaying login info
            if (isset($_POST['LoginModify'])) {
		$conn = connect();
		$sql = 'SELECT * FROM Users WHERE PERSON_ID = \''.$_SESSION['person_id'].'\'';
		   $stid = oci_parse($conn, $sql );
		   $res=oci_execute($stid); 
		if (!$res) {
		    $err = oci_error($stid);
		    echo htmlentities($err['message']);
		}
		while ($row = oci_fetch_array($stid, OCI_ASSOC)) {
		    $Username = $row['USER_NAME'];
		    $Password = $row['PASSWORD'];
		}
	    echo "<form action = 'personsModify.php' METHOD = 'POST'>";
	    echo '<br>Put in the new information you would like to enter:</br>';
	    echo "<br>Username: <input type = 'text' name = 'user' value ="."'".$Username."'"."/></br>";
	    echo "<br>Password: <input type = 'text' name = 'pass' value ="."'".$Password."'"."/></br>";
	    echo "<br><input type = 'submit' name = 'update_login' value = 'enter'/></br>";
	    echo "</form>";
            }
	    
	    //for updating new login info
	    if (isset($_POST['update_login'])) {
		$conn = connect();
		$user = $_POST['user'];
		$pass = $_POST['pass'];
		
		$sql = 'UPDATE users SET USER_NAME = \''.$user.'\''.', PASSWORD = \''.$pass.'\''.' WHERE  PERSON_ID = \''.$_SESSION['person_id'].'\'';
	    
		$stid = oci_parse($conn, $sql);
           	$res=oci_execute($stid); 
           	if (!$res) {session_start();
			$err = oci_error($stid);
			echo htmlentities($err['message']);
           	}
		else{
		    echo 'Login Information Updated Successfully</br>';
		}
	    }
	    
	    //for displaying personal info
            if (isset($_POST['PersonsModify'])) {
                $conn = connect();
		$sql = 'SELECT * FROM PERSONS WHERE PERSON_ID = \'' . $_SESSION['person_id'].'\'';
		   $stid = oci_parse($conn, $sql );
		   $res=oci_execute($stid); 
		   if (!$res) {
			$err = oci_error($stid);
			echo htmlentities($err['message']);
		   }
		   while ($row = oci_fetch_array($stid, OCI_ASSOC)) {
			$first_name = $row['FIRST_NAME'];
			$last_name = $row['LAST_NAME'];
			$address = $row['ADDRESS'];
			$email = $row['EMAIL'];
			$phone = $row['PHONE'];
		   }
		   
		echo "<form action = 'personsModify.php' METHOD = 'POST'></br>";
		echo '<br>Put in the new information you would like to enter:</br>';
		echo "<br>First Name: <input type = 'text' name = 'first' value ="."'".$first_name."'"."/></br>";
		echo "<br>Last Name: <input type = 'text' name = 'last' value ="."'".$last_name."'"."/></br>";
		echo "<br>Address: <input type = 'text' name = 'address' value ="."'".$address."'"."/></br>";
		echo "<br>Email: <input type = 'text' name = 'email' value ="."'".$email."'"."/></br>";
		echo "<br>Phone: <input type = 'text' name = 'phone' value ="."'".$phone."'"."/></br>";
		echo "<br><input type = 'submit' name = 'update_person' value = 'enter'/>";
		echo "</form>";
            }
	    
	    //for updating the new personal info
	    if (isset($_POST['update_person'])) {
		$conn = connect();
		$first = $_POST['first'];
		$last = $_POST['last'];
		$id = $_POST['id'];
		$address = $_POST['address'];
		$phone = $_POST['phone'];
		$email = $_POST['email'];
		
		$sql = 'UPDATE persons SET FIRST_NAME = \''.$first.'\''.', LAST_NAME = \''.$last.'\''.', ADDRESS = \''.$address.'\''.', PHONE = \''.$phone.'\''.', EMAIL = \''.$email.'\''.' WHERE  PERSON_ID = \''.$_SESSION['person_id'].'\'';
	    
		$stid = oci_parse($conn, $sql);
           	$res=oci_execute($stid); 
           	if (!$res) {
			$err = oci_error($stid);
			echo htmlentities($err['message']);
           	}
		else{
		    echo 'Personal Information Updated Successfully</br>';
		}
	    }
        
	    echo '<FORM action = "personModify.html" Method = "post"></br>';
	    echo 'Go back to Personal Info Management: <input type = "submit" name = "submit" value = "back"/></br>';  
	?>
        
        </center>
    </body>
</html>