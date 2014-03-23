
<!--Referenced :http://stackoverflow.com/questions/5525830/displaying-an-image-stored-in-a-mysql-blob?rq=1-->
<?php
include("PHPconnectionDB.php");
session_start();
?>

<HTML>
<HEAD>


<TITLE>Search Result</TITLE>
</HEAD>
<Center>
<BODY>
    <h1>Search Result</h1>
    <style>
    table, th, td {
    	border:1px solid black;
    }
    </style>

    <?php
        
        if(isset ($_POST['SEARCH']))
	{
            $conn = connect();
            echo '<table>';
            echo '<tr>';
            echo '<th> Record ID </th>';
            echo '<th> Patient ID </th>';
            echo '<th> Doctor ID </th>';
            echo '<th> Radiologist ID </th>';
            echo '<th> Test type </th>';
            echo '<th> Precribed Date </th>';
            echo '<th> Test Date </th>';
            echo '<th> Diagnosis </th>';
            echo '<th> Description </th>';
            echo '</tr>';  
                
            //get input
	    $search_terms = $_POST['WORDS'];
                
            if($search_terms != ""){
                
                //user is a patient so patient_id = person_id
                if($_SESSION['person_class'] == "p"){
                    $patient_id = $_SESSION['person_id'];
                    
                    $sql = 'SELECT *
                            FROM RADIOLOGY_RECORD
                            WHERE contains(description, \''.$key.'\''.') > 0 
                            AND PATIENT_ID = \''.$patient_id.'\'';
                    $stid = oci_parse($conn, $sql);
                    $res=oci_execute($stid); 
                    if (!$res) {
                        $err = oci_error($stid);
                        echo htmlentities($err['message']);
                    }
                    while ($row = oci_fetch_array($stid, OCI_ASSOC)) {
                        echo '<tr>';
                        foreach ($row as $item) {
                            echo "<td> $item </td>";
                            //get the images with the record id
                            load_pics($row['RECORD_ID']);
                        }
                        echo '</tr>';
                        echo '<br/>';
                    }
                }
                
                //user is a doctor so doctor_id = person_id
                if($_SESSION['person_class'] == "d"){
                    $doctor_id = $_SESSION['person_id'];
                    
                    $sql = 'SELECT *
                            FROM RADIOLOGY_RECORD
                            WHERE contains(description, \''.$key.'\''.') > 0 
                            AND DOCTOR_ID = \''.$doctor_id.'\'';
                    $stid = oci_parse($conn, $sql);
                    $res=oci_execute($stid); 
                    if (!$res) {
                        $err = oci_error($stid);
                        echo htmlentities($err['message']);
                    }
                    while ($row = oci_fetch_array($stid, OCI_ASSOC)) {
                        echo '<tr>';
                        foreach ($row as $item) {
                            echo "<td> $item </td>";
                            //get the images with the record id
                            load_pics($row['RECORD_ID']);
                        }
                        echo '</tr>';
                        echo '<br/>';
                    }
                }
                
                //user is a radiologist so radiologit_id = person_id
                if($_SESSION['person_class'] == "r"){
                    $radiologist_id = $_SESSION['person_id'];
                    
                    $sql = 'SELECT *
                            FROM RADIOLOGY_RECORD
                            WHERE contains(description, \''.$key.'\''.') > 0 
                            AND RADIOLOGIST_ID = \''.$radiologist_id.'\'';
                    $stid = oci_parse($conn, $sql);
                    $res=oci_execute($stid); 
                    if (!$res) {
                        $err = oci_error($stid);
                        echo htmlentities($err['message']);
                    }
                    while ($row = oci_fetch_array($stid, OCI_ASSOC)) {
                        echo '<tr>';
                        foreach ($row as $item) {
                            echo "<td> $item </td>";
                            //get the images with the record id
                            load_pics($row['RECORD_ID']);                           
                        }
                        echo '</tr>';
                        echo '<br/>';
                    }                    
                }
                
                //user is a admin so list all records
                if($_SESSION['person_class'] == "a"){
                    
                    $sql = 'SELECT * FROM RADIOLOGY_RECORD WHERE contains(description, \''.$key.'\''.') > 0';
                    $stid = oci_parse($conn, $sql);
                    $res=oci_execute($stid); 
                    if (!$res) {
                        $err = oci_error($stid);
                        echo htmlentities($err['message']);
                    }
                    while ($row = oci_fetch_array($stid, OCI_ASSOC)) {
                        echo '<tr>';
                        foreach ($row as $item) {
                            echo "<td> $item </td>";
                            //get the images with the record id
                            load_pics($row['RECORD_ID']);                               
                        }
                        echo '</tr>';
                        echo '<br/>';
                    }
                }
                
                echo '</table>';
                oci_free_statement($stid);
                oci_close($conn);    
            }
            else
            {
                echo 'No search terms entered.'     
            }
        }
    
    
    
    ?>

<FORM ACTION = "search.html" METHOD = "POST">
<br>Back to search page: <input type = "submit" name = "back" value = "back"></br>
</FORM>

</BODY>
</Center>
</HTML>

<?php
    function load_pics($recordID) {
        
        $sql = 'SELECT * FROM PACS_IMAGES WHERE RECORD_ID = \''.$recordID.'\'';
        $stid = oci_parse($conn, $sql);
        $res=oci_execute($stid); 
        if (!$res) {
            $err = oci_error($stid);
            echo htmlentities($err['message']);
        }
        while ($row = oci_fetch_array($stid, OCI_ASSOC)) {
            echo "<td>"
            echo "<a href=GetPic.php?photo_id=".$row['IMAGE_ID'].">";
            echo '<img src="data:image/jpeg;base64,' . base64_encode( $row['THUMBNAIL'] ) . '" /></a>';
            echo "</td>
        }  
    }

?>