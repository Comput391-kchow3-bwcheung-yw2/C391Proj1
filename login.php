<?php
include("PHPconnectionDB.php");
?>
<HTML>
<HEAD>


<TITLE>Login Result</TITLE>
</HEAD>
<Center>
<BODY>
	<?php
	
	if(isset ($_POST['LOGIN']))
	{
		session_start();
		//get input
		$user = $_POST['USERID'];
		$pass = $_POST['PASSWORD'];
		
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
		$sql = 'SELECT * FROM USERS WHERE USER_NAME = \''.$user.'\'';
		
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
			//echo 'Rows Extracted <br/>';
		}
		
		$redirect = false;
		
		while (($row = oci_fetch_array($stid, OCI_ASSOC)) != false)
		{
			//echo $item.'&nbsp;';
			if($row['USER_NAME'] == $user && $row['PASSWORD'] == $pass)
			{
				echo '<CENTER><p><b>Your Login is Successful!</b></p></CENTER>';
				$_SESSION['person_id'] = $row['PERSON_ID'];
				$_SESSION['person_class'] = $row['CLASS'];
				$redirect = true;
			}
		
		echo '<br/>';
		}
		
		if($redirect)
		{
			//redirect to main navigation page
			echo('<CENTER>');
			echo('<form method=post action=Navigation.php>');
			echo('<input type=submit name=NAV value="Go To Navigation">');
			echo('</CENTER>');
			
		}
		else
		{
			echo('<CENTER>');
			echo('<p><b>Username or password is invalid!</b></p>');
			echo('<form method=post action=login.html>');
			echo('<input type=submit name=Submit value=Retry>');
			echo('</CENTER>');
		}
		
		oci_free_statement($stid);
		oci_close($conn);
		
	}
	?>
	

</BODY>
</Center>
</HTML>

