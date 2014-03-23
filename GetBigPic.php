<HTML>
<HEAD>
<TITLE>Search Module</TITLE>
</HEAD>
<BODY>
<!--This is the page to display full size image-->
<CENTER>

    <?php
        $conn = connect();
        $photo_id = $_GET['photo_id'];
        
        $sql = 'SELECT * FROM PACS_IMAGES WHERE IMAGE_ID = \''.$photo_id.'\'';
        $stid = oci_parse($conn, $sql);
        $res=oci_execute($stid); 
        if (!$res) {
            $err = oci_error($stid);
            echo htmlentities($err['message']);
        }
        while ($row = oci_fetch_array($stid, OCI_ASSOC)) {
            echo '<img src="data:image/jpeg;base64,' . base64_encode( $row['FULL_SIZE'] ) . '" />';
        }  
    ?>
    
    
</CENTER>
</BODY>
</HTML>