<html>
    <body>
	<center>
	<?php
	  include("PHPconnectionDB.php");
	  if(isset ($_POST['Search'])) {
		//establish connection
		$conn=connect();
		//get input
		$diagnosis = $_POST['DIAGNOSIS'];
		$from = $_POST['FROM'];
		$till = $_POST['TILL'];
		echo '<h1> Search Result </h1>';
		echo '</form>';        
		echo '<table>';
		echo '<tr>';
		echo '<th> First Name </th>';
		echo '<th> Last Name </th>';
		echo '<th> Address </th>';
		echo '<th> Phone </th>';
		echo '<th> Test Date </th>';
		echo '</tr>';

		//sql command
		$sql = 'SELECT persons.first_name, persons.last_name, persons.address, persons.phone, radiology_record.test_date
			FROM persons, users, radiology_record
			WHERE users.class = 'a', persons.person_id = radiology_record.patient_id, radiology_record.diagnosis = \''.$diagnosis.'\', radiology_record.test_date > \''.$from.'\', radiology_record.test_date < \''.$till.'\'';
		
		//Prepare sql using conn and returns the statement identifier
		$stid = oci_parse($conn, $sql);
		
		//Execute a statement returned from oci_parse()
		$res = oci_execute($stid);
		
		//if error, retrieve the error using the oci_error() function & output an error
		if(!$res)
		{
			$err = oci_error($stid);
			echo htmlentities($err['message']);
		}
		
		while ($row = oci_fetch_array($stid, OCI_ASSOC)) {
	   		echo '<tr>';
			foreach ($row as $item) {
				echo $item.'&nbsp;';
			}
			echo '</tr>';
			echo '<br/>';
	   	}
		
		echo '</table>';
		oci_free_statement($stid);
		oci_close($conn);
		
	}
	?>
	

	</table>
	</center>
    </body>
</html>
