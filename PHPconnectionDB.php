<?php
function connect(){
	$conn = oci_connect('bwcheung', 'bc4784387');
	if (!$conn) {
		$e = oci_error();
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}

	return $conn;
}
?>
