<HTML>
<HEAD>
<TITLE>Search Module</TITLE>
</HEAD>
<BODY>
<!--This is the page to display full size image-->
<CENTER>

    <?php
        include("PHPconnectionDB.php");
        $conn = connect();
        //get photo id passed in through url
        $photo_id = $_GET['photo_id'];
        
        //sql to select the image
        $sql = 'SELECT * FROM PACS_IMAGES WHERE IMAGE_ID = \''.$photo_id.'\'';
        $stid = oci_parse($conn, $sql);
        $res=oci_execute($stid); 
        if (!$res) {
            $err = oci_error($stid);
            echo htmlentities($err['message']);
        }
        while ($row = oci_fetch_array($stid, OCI_ASSOC)) {
            //load the image in and print it through html image source
            $img = $row['REGULAR_SIZE']->load();
            echo '<img width="1280px" height="900px" src="data:image/jpeg;base64,' .$img. '" />';
        }  
    ?>
    
<FORM ACTION = "search.html" METHOD = "POST">
<br>Back to search page: <input type = "submit" name = "back" value = "back"></br>
</FORM>
</CENTER>
</BODY>
</HTML>