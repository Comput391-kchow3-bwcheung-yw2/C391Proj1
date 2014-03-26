<?php
    //this page is for getting auto generated ids for entering date
    include ("PHPconnectionDB.php");
    $conn=connect();
    
    function newPersonID(){
        $sql = 'SELECT person_id_sequence.nextval AS id from dual';
	$stid = oci_parse($conn, $sql);
	$res=oci_execute($stid); 
	if (!$res) {
            $err = oci_error($stid);
	    echo htmlentities($err['message']);
	}
        $row = oci_fetch_array($stid, OCI_ASSOC);
        $person_id = $row['id'];
	//echo 'PersonID: ', $person_id;
        return $person_id;
    }
    
    function newRecordID(){
        $sql = 'SELECT record_id_sequence.nextval AS id from dual';
	$stid = oci_parse($conn, $sql);
	$res=oci_execute($stid); 
	if (!$res) {
            $err = oci_error($stid);
	    echo htmlentities($err['message']);
	}
        $row = oci_fetch_array($stid, OCI_ASSOC);
        $record_id = $row['id'];
        return $record_id;
    }
    
    function newImageID(){
        $sql = 'SELECT pic_id_sequence.nextval AS id from dual';
	$stid = oci_parse($conn, $sql);
	$res=oci_execute($stid); 
	if (!$res) {
            $err = oci_error($stid);
	    echo htmlentities($err['message']);
	}
        $row = oci_fetch_array($stid, OCI_ASSOC);
        $image_id = $row['id'];
        return $image_id;
    }

?>