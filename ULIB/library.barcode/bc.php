<?php 
;
include("../inc/config.inc.php");// พ
head();
include("_REQPERM.php");
mn_lib();

?><BR>
<TABLE width=400 align=center>
<TR>
	<TD><?php 
html_librarymenu("barcodemenu");
?></TD>
</TR>
</TABLE>

<?php foot();?>