<?php 
include("../inc/config.inc.php");
head();
include("./_REQPERM.php");
mn_lib();

?><BR>
<TABLE width=400 align=center>
<TR>
	<TD><?php 
	html_librarymenu("ulibclientmenu");
	?></TD>
</TR>
</TABLE>
<?php 
// พ
foot();
?>