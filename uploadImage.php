<html>
<body>
<center>
    
        
    <?php
        //code taken from: http://www.php-tutorials.com/oracle-blob-insert-php-bind-variables/
        //http://www.9lessons.info/2009/03/upload-and-resize-image-with-php.html
        include("PHPconnectionDB.php");
        include("getID.php");
        $conn=connect();
        
        if (isset($_POST['Pictures'])) {
	    echo'<form name="upload-image" method="POST" enctype="multipart/form-data" action="uploadImage.php">';
            echo'<table>';
            echo'<tr>';
            echo "<td>Record ID: <input type = 'int' name = 'RECORD_ID'/></br></td>";
            echo'<th>File path: </th>';
            echo'<td><input name="filename" type="file" ></input></td>';
            echo'<td><input type="submit" name="upload" value="Upload"></td>';
            echo'</tr>';
            echo'</table>';
            echo'</form>';
	}
        
        if (isset($_POST['upload'])) {

            $record_id = $_POST['RECORD_ID'];

            if(is_uploaded_file($_FILES['filename']['tmp_name'])){

		$file = $_FILES['filename']['tmp_name'];
		
		$content = base64_encode(file_get_contents($file));
                $image_id = newImageID($conn);
                
                $image = imagecreatefromjpeg($file);
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
		

		$blob_thumbnail = oci_new_descriptor($conn, OCI_D_LOB);
		$blob_regular = oci_new_descriptor($conn, OCI_D_LOB);
		$blob_full = oci_new_descriptor($conn, OCI_D_LOB);
	
		$sql = 'INSERT into PACS_IMAGES (RECORD_ID, IMAGE_ID, THUMBNAIL, REGULAR_SIZE, FULL_SIZE)
		values(:recordid, :imageid, empty_blob(), empty_blob(), empty_blob())
		returning THUMBNAIL, REGULAR_SIZE, FULL_SIZE into :thumbnail, :regularsize, :fullsize';
	
		$stmt = oci_parse($conn, $sql);
	
		oci_bind_by_name($stmt, ':recordid', $record_id);
		oci_bind_by_name($stmt, ':imageid', $image_id);
		oci_bind_by_name($stmt, ':regularsize',$blob_thumbnail, -1, OCI_B_BLOB);
		oci_bind_by_name($stmt, ':thumbnail',$blob_regular, -1, OCI_B_BLOB);
		oci_bind_by_name($stmt, ':fullsize',$blob_full, -1, OCI_B_BLOB);
		
		oci_execute($stmt, OCI_DEFAULT);
	
		if($blob_thumbnail->save($thumbnail) && $blob_regular->save($content) && $blob_full->save($fullsize)) {
			oci_commit($conn);
			echo 'Successfully uploaded.';
		}
		else {
			oci_rollback($conn);
			echo 'Failed upload.';
		}
		imagedestroy($thumbnail);
		imagedestroy($image);
		imagedestroy($fullsize);
		$blob_thumbnail->free();
		$blob_regular->free();
		$blob_full->free();
		oci_close($conn);
		
            }        
        }
    ?>
    
<FORM ACTION = "upload.html" METHOD = "POST">
<br>Back to upload page: <input type = "submit" name = "back" value = "back"></br>
</FORM>

</center>
</body>
</html>
