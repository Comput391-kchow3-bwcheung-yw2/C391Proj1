<html>
<body>
<center>
<style>
table, th, td {
border:1px solid black;
}
</style>
        <?php
	//page for uploading a radiology record
	   include ("PHPconnectionDB.php");
	   include ("getID.php");
	   
	   //insert record
           if (isset($_POST['RecordRetrieve'])) {
		$conn=connect();
		$Record_id = newRecordID($conn);;
		$Patient_id = $_POST['PATIENT_ID'];
		$Doctor_id = $_POST['DOCTOR_ID'];
		$Radiologist_id = $_POST['RADIOLOGIST_ID'];
		$Test_type = $_POST['TEST_TYPE'];
		$Presribing_date = $_POST['PRESCRIBING_DATE'];
		$Test_date = $_POST['TEST_DATE'];
		$Diagnosis = $_POST['DIAGNOSIS'];
		$Description = $_POST['DESCRIPTION'];
		$sql = 'INSERT INTO RADIOLOGY_RECORD VAlUES (\''.$Record_id.'\''.', \''.$Patient_id.'\''.', \''.$Doctor_id.'\''.', \''.$Radiologist_id.'\''.', \''.$Test_type.'\''.', \''.$Presribing_date.'\''.', \''.$Test_date.'\''.', \''.$Diagnosis.'\''.', \''.$Description.'\''.')';
		$stid = oci_parse($conn, $sql);
           	$res=oci_execute($stid); 
           	if (!$res) {
			$err = oci_error($stid);
			echo htmlentities($err['message']);
           	}
                Records_table();
	   }

	   //display the records table
	   if (isset($_POST['Records'])) {
		Records_table();
	   }
	   
	   //show input to user for inputting a new record
	   if (isset($_POST['Enter_Records'])){
	    	echo "<form action = 'upload.php' METHOD = 'POST'></br>";
		echo 'Put in the new record you would like to enter:</br>';
		echo "Patient ID: <input type = 'int' name = 'PATIENT_ID'/></br>";
		echo "Doctor ID: <input type = 'int' name = 'DOCTOR_ID'/></br>";
		echo "Radiologist ID: <input type = 'int' name = 'RADIOLOGIST_ID'/></br>";
		echo "Test Type: <input type = 'text' name = 'TEST_TYPE'/></br>";
		echo "Prescribing Date: <input type = 'date' name = 'PRESCRIBING_DATE'/></br>";
		echo "Test Date: <input type = 'date' name = 'TEST_DATE'/></br>";
		echo "Diagnosis: <input type = 'text' name = 'DIAGNOSIS'/></br>";
		echo "Description: <input type = 'text' name = 'DESCRIPTION'/></br>";
		echo "<input type = 'submit' name = 'RecordRetrieve' value = 'Enter'/>";
		echo "</form>";
	   }
	  
	  //shows records table
	   function Records_table() {
		   $conn = connect();
		   echo '<h1> Records Table </h1>';
		   echo '<FORM action = "upload.php" Method = "post"></br>';
		   echo 'To enter new data: <input type = "submit" name = "Enter_Records" value = "Submit"/></br>';
 	           echo '</form>';          
		   echo '<table>';
		   echo '<tr>';
		   echo '<th> Record ID </th>';
		   echo '<th> Patient ID </th>';
		   echo '<th> Doctor ID </th>';
		   echo '<th> Radiologist ID </th>';
		   echo '<th> Test Type </th>';
		   echo '<th> Prescribing Date </th>';
		   echo '<th> Test Date </th>';
		   echo '<th> Diagnosis </th>';
		   echo '<th> Description </th>';
		   echo '</tr>';  
		   $sql = 'SELECT * FROM radiology_record';
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
           
	   echo '<FORM action = "upload.html" Method = "post"></br>';
	   echo 'Go back to upload home page: <input type = "submit" name = "submit" value = "Back"/></br>';  
	?>
</table>
</center>
</body>
</html>
