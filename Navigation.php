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
		session_start();
	
		//show option for modifying personal info
		echo('<FORM ');
                echo('NAME="PersonalInfoForm" ACTION="personModify.html" METHOD="post" >');
                echo('<CENTER>');
                echo('<P>Personal Info Module</P>');
                echo('<TABLE>');
                echo('<TR VALIGN=TOP ALIGN=LEFT>');
                echo('<TD><INPUT TYPE="submit" NAME="PersonalModify" VALUE="Update Personal Info"></TD>');
                echo('</TR>');
                echo('</TABLE>');
                echo('</CENTER>');
                echo('</FORM>');
		
            //show option for admins
		if($_SESSION['person_class'] == "a")
		{	
			echo('<FORM ');
			echo('NAME="ManagementForm" ACTION="management.html" METHOD="post" >');
			echo('<CENTER>');
			echo('<P>User Management Module</P>');
			echo('<TABLE>');
			echo('<TR VALIGN=TOP ALIGN=LEFT>');
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
			echo('<P>Uploading Module</P>');
			echo('<TABLE>');
			echo('<TR VALIGN=TOP ALIGN=LEFT>');
			echo('<TD><INPUT TYPE="submit" NAME="UploadButton" VALUE="Upload"></TD>');
			echo('</TR>');
			echo('</TABLE>');
			echo('</CENTER>');
			echo('</FORM>');
		}
	    
		//show option seach option for all users
                echo('<FORM ');
                echo('NAME="SearchForm" ACTION="search.html" METHOD="post" >');
                echo('<CENTER>');
                echo('<P>Search Module</P>');
                echo('<TABLE>');
                echo('<TR VALIGN=TOP ALIGN=LEFT>');
                echo('<TD><INPUT TYPE="submit" NAME="SearchButton" VALUE="Search"></TD>');
                echo('</TR>');
                echo('</TABLE>');
                echo('</CENTER>');
		echo('</FORM>');
		
		//show option data analysis option for admin
		if($_SESSION['person_class'] == "a")
		{
			echo('<FORM ');
			echo('NAME="CreateView" ACTION="CreateView.php" METHOD="post" >');
			echo('<CENTER>');
			echo('<P>Create a view for data analysis.</P>');
			echo('<TABLE>');
			echo('<TR VALIGN=TOP ALIGN=LEFT>');
			echo('<TD><INPUT TYPE="submit" NAME="CreateViewButton" VALUE="Create Data View"></TD>');
			echo('</TR>');
			echo('</TABLE>');
			echo('</CENTER>');
			echo('</FORM>');
			
			echo('<FORM ');
			echo('NAME="AnalysisForm" ACTION="OLAP.html" METHOD="post" >');
			echo('<CENTER>');
			echo('<P>Data Analysis Module</P>');
			echo('<TABLE>');
			echo('<TR VALIGN=TOP ALIGN=LEFT>');
			echo('<TD><INPUT TYPE="submit" NAME="AnalysisButton" VALUE="Data Analysis"></TD>');
			echo('</TR>');
			echo('</TABLE>');
			echo('</CENTER>');
			echo('</FORM>');
		}
        }
?>

</BODY>
</HTML>