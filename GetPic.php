<HTML>
<HEAD>
<TITLE>Search Module</TITLE>
</HEAD>
<BODY>
<!--This is the page to display normal size image-->
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
            echo "<a href=GetBigPic.php?photo_id=".$row['IMAGE_ID'].">";
            echo '<img src="data:image/jpeg;base64,' . base64_encode( $row['REGULAR_SIZE'] ) . '" /></a>';
        }  
    ?>
    
    
</CENTER>
</BODY>
</HTML>