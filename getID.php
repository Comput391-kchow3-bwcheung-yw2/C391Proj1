<?php
    //this page is for getting auto generated ids for entering date
    
    function newPersonID($conn){
        $sql = 'SELECT person_id_sequence.nextval AS ID from dual';
	$stid = oci_parse($conn, $sql);
	$res=oci_execute($stid); 
	if (!$res) {
            $err = oci_error($stid);
	    echo htmlentities($err['message']);
	}
        $row = oci_fetch_array($stid, OCI_ASSOC);
        $person_id = $row['ID'];
	//echo 'PersonID: ', $person_id;
        return $person_id;
    }
    
    function newRecordID($conn){
        $sql = 'SELECT record_id_sequence.nextval AS ID from dual';
	$stid = oci_parse($conn, $sql);
	$res=oci_execute($stid); 
	if (!$res) {
            $err = oci_error($stid);
	    echo htmlentities($err['message']);
	}
        $row = oci_fetch_array($stid, OCI_ASSOC);
        $record_id = $row['ID'];
        return $record_id;
    }
    
    function newImageID($conn){
        $sql = 'SELECT pic_id_sequence.nextval AS ID from dual';
	$stid = oci_parse($conn, $sql);
	$res=oci_execute($stid); 
	if (!$res) {
            $err = oci_error($stid);
	    echo htmlentities($err['message']);
	}
        $row = oci_fetch_array($stid, OCI_ASSOC);
        $image_id = $row['ID'];
        return $image_id;
    }

?>