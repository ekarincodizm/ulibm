<?php 
    ;
	include ("../inc/config.inc.php");
	loginchk_lib();

tmq("update media_mid set place='$itemplace' where ismarked='YES' ");
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
alert("<?php  echo getlang("การดำเนินการเรียบร้อย::l::Operation done."); ?> ");
//-->
</SCRIPT>
<?php 
redir("media_type.php");

	?>