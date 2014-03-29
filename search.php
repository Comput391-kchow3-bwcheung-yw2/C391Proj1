
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
        
        if(isset ($_POST['Search']))
	{
            $conn = connect();
            echo '<table>';
            echo '<tr>';
            echo '<th> First Name </th>';
            echo '<th> Last Name </th>';
            echo '<th> Record ID </th>';
            echo '<th> Patient ID </th>';
            echo '<th> Doctor ID </th>';
            echo '<th> Radiologist ID </th>';
            echo '<th> Test type </th>';
            echo '<th> Precribed Date </th>';
            echo '<th> Test Date </th>';
            echo '<th> Diagnosis </th>';
            echo '<th> Description </th>';
            echo '<th> RANK </th>';
            echo '<th> Images </th>';
            echo '</tr>';  
                
            //get input
	    $search_terms = $_POST['WORDS'];
            $time_start = $_POST['TIMESTART'];
            $time_end = $_POST['TIMEEND'];
            $sort_type = $_POST['SORT'];
            $person_id = $_SESSION['person_id'];
            
            if($search_terms == "" && $time_start == "" && $time_end == ""){
                echo 'No search terms or time period entered.';     
            }
            else{
		load_records($person_id, $search_terms, $time_start, $time_end, $sort_type, $conn);
            }
            
            echo '</table>';
        }
    
    ?>

<FORM ACTION = "search.html" METHOD = "POST">
<br>Back to search page: <input type = "submit" name = "back" value = "back"></br>
</FORM>

</BODY>
</Center>
</HTML>

<?php
    //load the records for patients and order by ranking
    function load_records($person_id, $search_terms, $time_start, $time_end, $sort_type, $conn)
    {
	if($search_terms != '')
	{
		//list of search terms
		$word_list = explode(' ', $search_terms);
		//count = 1 for numbering the score
		//score1 = firstname, score2 = lastname, score3 = diagnosis, score4 = description
		$sql = 'SELECT P.FIRST_NAME, P.LAST_NAME, R.*, 6*score(1) + 6*score(2) + 3*score(3) + score(4)';
	
		$count = 5;
	
		for($i = 1; $i < count($word_list); $i++)
		{
		    $sql = $sql.' + 6*score('.$count.') + 6*score('.($count+1).') + 3*score('.($count+2).') + score('.($count+3).')';
		    $count = $count+4;
		}
	
		$sql = $sql.' AS RANK ';     
		$sql = $sql.'FROM RADIOLOGY_RECORD R FULL OUTER JOIN PERSONS P ON R.PATIENT_ID = P.PERSON_ID ';
		$sql = $sql.'WHERE contains(P.FIRST_NAME, \''.$word_list[0].'\', 1) > 0 
		OR contains(P.LAST_NAME, \''.$word_list[0].'\', 2) > 0 
		OR contains(R.DIAGNOSIS, \''.$word_list[0].'\', 3) > 0 
		OR contains(R.DESCRIPTION, \''.$word_list[0].'\', 4) > 0 ';
		
		$count = 5;
		for($i = 1; $i < count($word_list); $i++)
		{
		    $sql = $sql.'OR contains(P.FIRST_NAME, \''.$word_list[$i].'\', '.$count.') > 0 
		    OR contains(P.LAST_NAME, \''.$word_list[$i].'\', '.($count+1).') > 0 
		    OR contains(R.DIAGNOSIS, \''.$word_list[$i].'\', '.($count+2).') > 0 
		    OR contains(R.DESCRIPTION, \''.$word_list[$i].'\', '.($count+3).') > 0 ';
		    $count = $count+4;
		}
	}
	
       
        //security part of query
        if($_SESSION['person_class'] == "p"){
            $sql = $sql.'AND R.PATIENT_ID = \''.$person_id.'\' AND ';
        }
        if($_SESSION['person_class'] == "d"){
            $sql = $sql.'AND R.DOCTOR_ID = \''.$person_id.'\' AND ';
        }
        if($_SESSION['person_class'] == "r"){
            $sql = $sql.'AND R.RADIOLOGIST_ID = \''.$person_id.'\' AND ';
        }
       
	if($search_terms != '' && $_SESSION['person_class'] == "a" && $time_start != "" && $time_end != "")
	{
		$sql = $sql.' AND ';
	}

        if($time_start != "" && $time_end != "")
        {
            $time_period = 'TO_DATE(\''.$time_start.'\', \'DD-MON-RR\') AND TO_DATE(\''.$time_end.'\', \'DD-MON-RR\')';
            $sql = $sql.'R.TEST_DATE BETWEEN '.$time_period.' ';
        }
 
        if($sort_type == ""){
            $sql = $sql.'ORDER BY RANK DESC';
        }
        if($sort_type == "PreAsc"){
            $sql = $sql.'ORDER BY R.PRESCRIBING_DATE ASC';
        }
        if($sort_type == "PreDesc"){
            $sql = $sql.'ORDER BY R.PRESCRIBING_DATE DESC';
        }
        if($sort_type == "TestAsc"){
            $sql = $sql.'ORDER BY R.TEST_DATE ASC';
        }
        if($sort_type == "TestDesc"){
            $sql = $sql.'ORDER BY R.TEST_DATE DESC';
        }
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
                }
		load_pics($row['RECORD_ID'], $conn);
            echo '</tr>';
            echo '<br/>';
        }
        oci_free_statement($stid);
        oci_close($conn);
    }
    
    //load the pictures for the record id
    function load_pics($recordID, $conn) {
        
        $sql = 'SELECT * FROM PACS_IMAGES WHERE RECORD_ID = '.$recordID;
        $stid = oci_parse($conn, $sql);
        $res=oci_execute($stid); 
        if (!$res) {
            $err = oci_error($stid);
            echo htmlentities($err['message']);
        }
	
	echo "<td>";
        while ($row = oci_fetch_array($stid, OCI_ASSOC) ) {
	    $img = $row['REGULAR_SIZE']->load();
            echo "<a href=GetPic.php?photo_id=".$row['IMAGE_ID'].">";
            echo '<img width="30px" height="30px" src="data:image/jpeg;base64,' .$img. '"/></a>';
        }
	echo "</td>";
    }

?>
