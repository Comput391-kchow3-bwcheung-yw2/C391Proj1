<HTML>
<HEAD>
<TITLE>Data Analysis Results</TITLE>
</HEAD>

<BODY>
<CENTER>
	    <style>
	    table, th, td {
		border:1px solid black;
	    }
	    </style>
    
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
            $sql = $sql.'TRUNC(TEST_DATE, \'YEAR\'), ';
            echo '<th> Year of </th>';
        }
        if($time == 'Monthly')
        {
            $sql = $sql.'TRUNC(TEST_DATE, \'MONTH\'), ';
            echo '<th> Month of </th>';
        }
        if($time == 'Weekly')
        {
            $sql = $sql.'TRUNC(TEST_DATE, \'W\'), ';
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
            $sql = $sql.'TRUNC(TEST_DATE, \'YEAR\')';
        }
        if($time == 'Monthly')
        {
            $sql = $sql.'TRUNC(TEST_DATE, \'MONTH\')';
        }
        if($time == 'Weekly')
        {
            $sql = $sql.'TRUNC(TEST_DATE, \'W\')';
        }
	if($time != 'Yearly' && $time != 'Monthly' && $time != 'Weekly'){
	    $sql = rtrim($sql, ', ');
	    //echo $sql;
	}
        $sql = $sql.')';
        
	//echo $sql;
        $stid = oci_parse($conn, $sql );
	$res=oci_execute($stid); 
	if (!$res) {
            $err = oci_error($stid);
	    echo htmlentities($err['message']);
	}
	while ($row = oci_fetch_array($stid, OCI_ASSOC)) {
	    echo '<tr>';
	    if($patient == 'Yes')
	    {
		echo '<th>'. $row['FIRST_NAME'] .'</th>';
		echo '<th>'. $row['LAST_NAME'] .'</th>';
	    }
	    if($test == 'Yes')
	    {
		echo '<th>'. $row['TEST_TYPE'] .'</th>';
	    }
	    if($time == 'Yearly')
	    {
		echo '<th>'. $row['TRUNC(TEST_DATE,\'YEAR\')'] .'</th>';
	    }
	    if($time == 'Monthly')
	    {
		echo '<th>'. $row['TRUNC(TEST_DATE,\'MONTH\')'] .'</th>';
	    }
	    if($time == 'Weekly')
	    {
		echo '<th>'. $row['TRUNC(TEST_DATE,\'W\')'] .'</th>';
	    }
	    echo '<th>'. $row['COUNT(IMAGE_ID)'] .'</th>';
            echo '</tr>';
	    echo '<br/>';
	}
        oci_free_statement($stid);
	oci_close($conn);
        echo '</table>';
    }
?>


<FORM ACTION = "OLAP.html" METHOD = "POST">
<br>Back to data page: <input type = "submit" name = "back" value = "back"></br>
</FORM>

</CENTER>
</BODY>
</HTML>