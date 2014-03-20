<html>
    <body>
	<center>
        
        <?php
            include ("PHPconnectionDB.php");
            
            if (isset($_POST['LoginModify'])) {
		
		$sql = 'SELECT USER_NAME, PASSWORD FROM Users WHERE PERSON_ID = \'' . $_SESSION['person_id'].'\'';
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
		   
		echo "<form action = 'personModify.php' METHOD = 'POST'></br>";
		echo 'Put in the new information you would like to enter:</br>';
		echo "Username: <input type = 'text' name = 'user value =".$Username."/></br>";
		echo "Password: <input type = 'text' name = 'pass' value =".$Password."/></br>";
		echo "<input type = 'submit' name = 'update_login' value = 'enter'/>";
		echo "</form>";
            }
	    
	    if (isset($_POST['update_login'])) {
		$user = $_POST['user'];
		$pass = $_POST['pass'];
		
		$sql = 'UPDATE users SET USER_NAME = \''.$user.'\''.', PASSWORD = \''.$pass.'\''.' WHERE  PERSON_ID = \''.$_SESSION['person_id'].'\'';
	    
		$stid = oci_parse($conn, $sql);
           	$res=oci_execute($stid); 
           	if (!$res) {
			$err = oci_error($stid);
			echo htmlentities($err['message']);
           	}
		else{
		    echo 'Login Information Updated Successfully</br>';
		}
	    }
	    
	    
            
            if (isset($_POST['PersonsModify'])) {
                
		$sql = 'SELECT * FROM Users WHERE PERSON_ID = \'' . $_SESSION['person_id'].'\'';
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
		   
		echo "<form action = 'personModify.php' METHOD = 'POST'></br>";
		echo 'Put in the new information you would like to enter:</br>';
		echo "First Name: <input type = 'text' name = 'first value =".$first_name."/></br>";
		echo "Last Name: <input type = 'text' name = 'last' value =".$last_name."/></br>";
		echo "Address: <input type = 'text' name = 'address value =".$address."/></br>";
		echo "Email: <input type = 'text' name = 'email' value =".$email."/></br>";
		echo "Phone: <input type = 'text' name = 'phone value =".$phone."/></br>";
		echo "<input type = 'submit' name = 'update_person' value = 'enter'/>";
		echo "</form>";
            }
	    
	    if (isset($_POST['update_person'])) {
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
	    
        
	    echo '<FORM action = "personModify.html.html" Method = "post"></br>';
	    echo 'Go back to Personal Info Management: <input type = "submit" name = "submit" value = "back"/></br>';  
	?>
        
        </center>
    </body>
</html>