<?php 
	; 
		
        include ("../inc/config.inc.php");
		head();
		$_REQPERM="importer_mem";
        mn_lib();

			pagesection(getlang("นำเข้าข้อมูลสมาชิก - เลือกไฟล์ที่ต้องการ::l::Import member - choose your file"));

if ($delll!="" && (strpos($delll,"..")===false)) {
	unlink($dcrs.'/_input/import/' . "$delll");
}

?><BR><TABLE align=center width=550>
<?php 
// Note that !== did not exist until 4.0.0-RC2

if ($handle = opendir('../_input/import/')) {
   // echo "Directory handle: $handle\n";
    //echo "Files:\n";

    /* This is the correct way to loop over the directory. */
    while (false !== ($file = readdir($handle))) {
		if ($file!="." && $file !=".." && $file !="import") {
			$fileurl="step1.php?file=$file";
			?><TR>
	<TD><IMG SRC="../neoimg/View.gif" WIDTH="16" HEIGHT="16" BORDER="0" ALT="" align=absmiddle> <?php 
	$ext=strtolower(substr($file,-3));
	$ext2=strtolower(substr($file,-4));
	if ($ext!='xls' && $ext2!='xlsx') {
		echo "<A HREF=\"$fileurl\" >$file</A><BR>\n";
	} else {
		echo "$file <A HREF=\"xlsmelt.php?file=$file\" ><b>IMPORT</b></a><BR>\n";
	}
?></TD><TD><A HREF="index.php?delll=<?php  echo $file;?>"><IMG SRC="../neoimg/Delete.gif" WIDTH="16" HEIGHT="16" BORDER="0" ALT="" align=absmiddle> Delete</A></TD>
</TR><?php 
		}
    }

    closedir($handle);
}
?> 

</TABLE>
<BR><BR>
<HR><TABLE width=600 align=center>
<TR>
	<TD>
	<?php  echo getlang("<B>หมายเหตุ</B> รายการดังกล่าวเป็นไฟล์ที่มีผู้นำไปไว้ที่โฟลเดอร์ /_input/import/ <BR>
ซึ่งสามารถนำไปไว้ได้ทั้งวิธีการคัดลอกไฟล์ไปไว้ <A HREF='UPLOAD.php'  class=a_btn>หรืออัพโหลดผ่านแบบฟอร์ม</A> ที่เตรียมไว้ให้ ::l::
<B>Note</B> Files in folder /_input/import/ are shown above. To upload more files Administrator might upload files mannually or by <A HREF='UPLOAD.php' class=a_btn>provided form</A>"); ?>
<BR><BR><?php 
echo getlang("หากเป็นการนำเข้าข้อมูลจำนวนไม่มาก <BR>สามารถทำการนำเข้าข้อมูลโดยการ คัดลอกและวาง <a href='pasteexcel.php' class=a_btn>(คลิกที่นี่)</a>::l::For low amounts of records<BR> Can import by copy and paste <a href='pasteexcel.php' class=a_btn>(clickh here)</a>");
?>
<BR></TD>
</TR>
</TABLE><?php 
foot();
?>