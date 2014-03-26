<HTML>
<HEAD>
<TITLE>Data Analysis Results</TITLE>
</HEAD>

<BODY>
<CENTER>
    
<?php

    include("PHPconnectionDB.php");
    if(isset ($_POST['Analysis'])) {
        
        echo '<h1> Data Result </h1>';       
	echo '<table>';
	echo '<tr>';
        
        $conn=connect();
        
        $patient = $_POST['PATIENT'];
        $test = $_POST['TESTTYPE'];
        $time = $_POST['TIME_PERIOD'];
        
        //build the query to get data from the view
        $sql = 'SELECT ';
        
        if($patient == 'Yes')
        {
            $sql = $sql.'FIRST_NAME, LAST_NAME, ';
            echo '<th> First Name </th>';
            echo '<th> Last Name </th>';
        }
        if($test == 'Yes')
        {
            $sql = $sql.'TEST_TYPE, ';
            echo '<th> Test Type </th>';
        }
        if($time == 'Yearly')
        {
            $sql = $sql.'TRUNC(TEST_DATE, YEAR), ';
            echo '<th> Year of </th>';
        }
        if($time == 'Monthly')
        {
            $sql = $sql.'TRUNC(TEST_DATE, MONTH), ';
            echo '<th> Month of </th>';
        }
        if($time == 'Weekly')
        {
            $sql = $sql.'TRUNC(TEST_DATE, WW), ';
            echo '<th> Week of </th>';
        }
        
        echo '<th> Image Count </th>';
        echo '</tr>';
        
        //add the count number to query, view and the cube group by
        $sql = $sql.'COUNT(IMAGE_ID)
                     FROM DATAVIEW
                     GROUP BY CUBE (';
                     
                     
        if($patient == 'Yes')
        {
            $sql = $sql.'FIRST_NAME, LAST_NAME, ';
        }
        if($test == 'Yes')
        {
            $sql = $sql.'TEST_TYPE, ';
        }
        if($time == 'Yearly')
        {
            $sql = $sql.'TRUNC(TEST_DATE, YEAR), ';
        }
        if($time == 'Monthly')
        {
            $sql = $sql.'TRUNC(TEST_DATE, MONTH), ';
        }
        if($time == 'Weekly')
        {
            $sql = $sql.'TRUNC(TEST_DATE, WW), ';
        }
        //trim off unneeded chars
        rtrim($sql, ", ");
        $sql = $sql.')';
        
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
        echo '</table>';
    }
?>


<FORM ACTION = "Navigation.php" METHOD = "POST">
<br>Back to home page: <input type = "submit" name = "back" value = "back"></br>
</FORM>

</CENTER>
</BODY>
</HTML>