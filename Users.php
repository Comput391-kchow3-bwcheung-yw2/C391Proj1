<html>
    <body>
	<center>
	<h1> Users Table </h1>
	<FORM action = "Modify.php" Method = "post"></br>
	To update table: <input type = "submit" name = "update" value = "submit"/></br>
	To enter new data: <input type = "submit" name = "enter" value = "submit"/></br>
	</form>
	<table>
	<tr>
	<th> Username </th>
	<th> Password </th>
	<th> Class </th>
	<th> ID </th>
	<th> Date </th>
	</tr>
        <?php 
	   include ("PHPconnectionDB.php");        
	   //establish connection
           $conn=connect();
           if (isset($_POST['update'])) {
		$user = $_POST['user'];
		$pass = $_POST['pass'];
		$id = $_POST['id'];
		$class = $_POST['class'];
		$date = $_POST['date'];
		$sql = 'UPDATE Users SET USER_NAME = \''.$user.'\''.', PASSWORD = \''.$pass.'\''.', CLASS = \''.$class.'\''.', DATE_REGISTERED = \''.$date.'\''.' WHERE  PERSON_ID = \''.$id.'\'';
          	$stid = oci_parse($conn, $sql);
           	$res=oci_execute($stid); 
           	if (!$res) {
			$err = oci_error($stid);
			echo htmlentities($err['message']);
           	}
           }      
     
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
	   oci_free_statement($stid);
	   oci_close($conn);
	?>
	</table>
	</center>
    </body>
</html>

