<html>
<body>
<center>
    
<?php
    include("PHPconnectionDB.php");
    if(isset ($_POST['CreateView'])) {
        $conn=connect();
        
        //sql command
	$sql = 'CREATE OR REPLACE VIEW DATAVIEW AS 
                SELECT P.FIRST_NAME, P_LAST_NAME, R.TEST_TYPE, R.TEST_DATE, I.IMAGE_ID 
		FROM PERSONS P, RADIOLOGY_RECORD R, PACS_IMAGES I 
                WHERE P.PERSON_ID = R.PATIENT_ID AND I.RECORD_ID = R.RECORD_ID';
                
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
        
        $r = oci_commit($conn);
        if (!r) {
            $e = oci_error($conn);
            echo trigger_error(htmlentities($e['message']), E_USER_ERROR);
        }
        else(
            echo'Created View.';
        )
    }
?>

<FORM ACTION = "Navigation.php" METHOD = "POST">
<br>Back to home page: <input type = "submit" name = "back" value = "back"></br>
</FORM>

</center>
</body>
</html>