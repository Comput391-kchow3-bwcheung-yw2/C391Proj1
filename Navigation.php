<HTML>
<HEAD>
<TITLE>Online Radiology Information System Navigation</TITLE>
</HEAD>

<BODY>
<!--This is the navigation page-->
<H1><CENTER>Online Radiology Information System Navigation</CENTER></H1>

<?php
        if(isset ($_POST['NAV']))
	{
		//show option for modifying personal info
		echo('<FORM');
                echo('NAME="PERSONFORM" ACTION="personModify.html" METHOD="post" >');
                echo('<CENTER>');
                echo('<TABLE>');
                echo('<TR VALIGN=TOP ALIGN=LEFT>');
                echo('<P>Modify Personal Info</P>');
                echo('<TD><INPUT TYPE="submit" NAME="PersonButton" VALUE="Update Info"></TD>');
                echo('</TR>');
                echo('</TABLE>');
                echo('</CENTER>');
                echo('</FORM>');
		
            //show option for admins
            if($_SESSION['person_class'] == "a")
            {
                echo('<FORM');
                echo('NAME="ManagementForm" ACTION="management.html" METHOD="post" >');
                echo('<CENTER>');
                echo('<TABLE>');
                echo('<TR VALIGN=TOP ALIGN=LEFT>');
                echo('<P>User Management Module</P>');
                echo('<TD><INPUT TYPE="submit" NAME="ModifyButton" VALUE="User Management"></TD>');
                echo('</TR>');
                echo('</TABLE>');
                echo('</CENTER>');
                echo('</FORM>');
                      
                echo('<FORM ');
                echo('NAME="ReportForm" ACTION="report.html" METHOD="post" >');
                echo('<CENTER>');
                echo('<P>Report Generating Module</P>');
                echo('<TABLE>');
                echo('<TR VALIGN=TOP ALIGN=LEFT>');
                echo('<TD><INPUT TYPE="submit" NAME="ReportButton" VALUE="Report Generation"></TD>');
                echo('</TR>');
                echo('</TABLE>');
                echo('</CENTER>');
                echo('</FORM>');
            }
            
            //show option for radiologists
            if($_SESSION['person_class'] == "r")
            {
                echo('<FORM ');
                echo('NAME="UploadForm" ACTION="upload.html" METHOD="post" >');
                echo('<CENTER>');
                echo('<P>UploadingModule</P>');
                echo('<TABLE>');
                echo('<TR VALIGN=TOP ALIGN=LEFT>');
                echo('<TD><INPUT TYPE="submit" NAME="UploadButton" VALUE="Upload"></TD>');
                echo('</TR>');
                echo('</TABLE>');
                echo('</CENTER>');
                echo('</FORM>');
            }
            
            
        }
?>

</BODY>
</HTML>