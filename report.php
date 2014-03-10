<?php
include("PHPconnectionDB.php");
?>
<HTML>
<HEAD>


<TITLE>Search Result</TITLE>
</HEAD>
<Center>
<BODY>
	<?php
	
	if(isset ($_POST['SEARCH']))
	{
		//get input
		$diagnosis = $_POST['DIAGNOSIS'];
		$from = $_POST['FROM'];
		$till = $_POST['TILL'];
		
		ini_set('display_errors', 1);
		error_reporting(E_ALL);
		
		//establish connection
		$conn=connect();
		if (!$conn)
		{
			$e = oci_error();
			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		}
		
		//sql command
		$sql = 'SELECT persons.first_name, persons.last_name, persons.address, persons.phone, radiology_record.test_date
			FROM persons, users, radiology_record
			WHERE users.class = 'a', persons.person_id = radiology_record.patient_id, radiology_record.diagnosis = \''.$diagnosis.'\', radiology_record.test_date > TO_DATE(\''.$from.'\', 'yyyymmdd'), radiology_record.test_date < TO_DATE(\''.$till.'\', 'yyyymmdd')';
		
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
		else
		{
			echo 'Search Result <br/>';
		}
		
		$redirect = false;
		
		while ($row = oci_fetch_array($stid, OCI_ASSOC)) {
	   	
			foreach ($row as $item) {
				echo $item.'&nbsp;';
			}
			echo '<br/>';
	   	}
		
		
		oci_free_statement($stid);
		oci_close($conn);
		
	}
	?>
	

</BODY>
</Center>
</HTML>

