<html>
<body>
<center>
    
        
    <?php
        //code taken from: http://www.php-tutorials.com/oracle-blob-insert-php-bind-variables/
        //http://www.9lessons.info/2009/03/upload-and-resize-image-with-php.html
	include ("PHPconnectionDB.php");
	include ("getID.php");
        $conn=connect();
        
        if (isset($_POST['Pictures'])) {
	    echo'<form name="upload-image" method="POST" enctype="multipart/form-data" action="uploadImage.php">';
            echo'<table>';
            echo'<tr>';
            echo "<td>Record ID: <input type = 'int' name = 'RECORD_ID'/></br></td>";
            echo'<th>File path: </th>';
            echo'<td><input name="filename" type="file" size="30" ></input></td>';
            echo'<td><input type="submit" name=".submit" value="Upload"></td>';
            echo'</tr>';
            echo'</table>';
            echo'</form>';
	}
        
        if (isset($_POST['upload-image'])) {
            
            $record_id = $_POST['RECORD_ID'];
            
            if(is_uploaded_file($_FILES['filename']['tmp_name'])){
                
                $image_id = newImageID($conn);
                    
                $uploadedfile = $_FILES['filename']['tmp_name'];
                $image = imagecreatefromjpeg($uploadedfile);
                list($width,$height)=getimagesize($uploadedfile);

                $newwidth=800;
                $newheight=($height/$width)*$newwidth;
                $fullsize=imagecreatetruecolor($newwidth,$newheight);
                
                $newwidth1=64;
                $newheight1=($height/$width)*$newwidth1;
                $thumbnail=imagecreatetruecolor($newwidth1,$newheight1);
                
                imagecopyresampled($fullsize,$image,0,0,0,0,$newwidth,$newheight,
                 $width,$height);
                
                imagecopyresampled($thumbnail,$image,0,0,0,0,$newwidth1,$newheight1, 
                $width,$height);


                
                // sql with variables
                $sql = 'INSERT INTO PAC_IMAGES
                        VALUES(\''.$record_id.'\', '.$image_id.'\', '.'EMPTY_BLOB(), EMPTY_BLOB(), EMPTY_BLOB)
                        returning field_lob_a,field_lob_b,field_lob_c into :LOB_A,:LOB_B:LOB_C';
                $parse_sql = oci_parse($conn, $sql);
                
                // create empty lob descriptor
                $lob_a = oci_new_descriptor($conn, OCI_D_LOB);
                $lob_b = oci_new_descriptor($conn, OCI_D_LOB);
                $lob_c = oci_new_descriptor($conn, OCI_D_LOB);
                
                // bind the LOB fields
                oci_bind_by_name($parsed_sql, ':LOB_A', $lob_a, -1, OCI_B_BLOB);
                oci_bind_by_name($parsed_sql, ':LOB_B', $lob_b, -1, OCI_B_BLOB);
                oci_bind_by_name($parsed_sql, ':LOB_C', $lob_b, -1, OCI_B_BLOB);
                
                if(!oci_execute($parse_sql, OCI_DEFAULT)) {
                    $e = error_get_last();
                    $f = oci_error();
                    echo "Message: ".$e['message']."\n";
                    echo "File: ".$e['file']."\n";
                    echo "Line: ".$e['line']."\n";
                    echo "Oracle Message: ".$f['message'];
                    // exit if you consider this fatal
                    exit(9);
                }
                else {
                    // save the blob data
                    $lob_a->save($thumbnail);
                    $lob_b->save($image);
                    $lob_c->save($fullsize);
                    // commit the query
                    oci_commit($conn);
                    // free up the blob descriptors
                    $lob_a->free();
                    $lob_b->free();
                    $lob_c->free();
                    echo 'Successfully uploaded.';
                }
                imagedestroy($image);
                imagedestroy($fullsize);
                imagedestroy($thumbnail);
            }        
        }
    ?>
    
<FORM ACTION = "search.html" METHOD = "POST">
<br>Back to search page: <input type = "submit" name = "back" value = "back"></br>
</FORM>

</center>
</body>
</html>
