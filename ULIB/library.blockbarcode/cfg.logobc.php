<?php 
;
include("../inc/config.inc.php");
html_start();

include("_REQPERM.php");
loginchk_lib("check");
if ($save=='yes') {
	/*
	$dr="$dcrs/_tmp/";
	if (strlen($_FILES['head']['tmp_name'])!=0) { 
	   copy($_FILES['head']['tmp_name'], "$dr" . "_paper_head.jpg"); 
	} 
	*/
	$dr="$dcrs/_tmp/";
	if (strlen($_FILES['logobc']['tmp_name'])!=0) { 
	   copy($_FILES['logobc']['tmp_name'], "$dr" . "_barcode-logobc.jpg"); 
	} 
	barcodeval_set("BARCODE-blockbc-logobc-titlesize",addslashes($titlesize));
	barcodeval_set("BARCODE-blockbc-logobc-callnsize",addslashes($callnsize));
	barcodeval_set("BARCODE-blockbc-logobc-isshownum",addslashes($isshownum));
	barcodeval_set("BARCODE-blockbc-logobc-bcline",addslashes($bcline));
	barcodeval_set("BARCODE-blockbc-logobc-bclinesize",addslashes($bclinesize));
	barcodeval_set("BARCODE-blockbc-logobc-addtext",addslashes($addtext));
	barcodeval_set("BARCODE-blockbc-logobc-addtextsize",addslashes($addtextsize));
	barcodeval_set("BARCODE-blockbc-logobc-spinewidth",addslashes($spinewidth));
}
$tbmn="width= 780  cellpadding=2 cellspacing=1 align=center bgcolor=888888";
html_htmlareajs();
?>
<BR>
 <TABLE <?php echo $tbmn;?>>
<FORM METHOD=POST ACTION="<?php  echo $PHPSELF;?>"  enctype="multipart/form-data">
<INPUT TYPE="hidden" name=save value=yes>
<TR bgcolor=ffffff> 
<TD><?php  echo getlang("ขนาดอักษรชื่อเรื่อง::l::Title font size"); ?></TD>
<TD>  <input type="number" name="titlesize" min="-10" step=1 max="10" value="<?php echo floor(barcodeval_get("BARCODE-blockbc-logobc-titlesize")); ?>"></TD>
</TR>
<TR bgcolor=ffffff>
<TD><?php  echo getlang("ขนาดอักษรเลขเรียก::l::Callnumber font size"); ?></TD>
<TD>   <input type="number" name="callnsize" min="-10" step=1 max="10" value="<?php echo floor(barcodeval_get("BARCODE-blockbc-logobc-callnsize")); ?>"></TD>
</TR>
<TR bgcolor=ffffff>
<TD><?php  echo getlang("แสดงหมายเลขหรือไม่::l::Show Number"); ?></TD>
<TD><?php 
form_quickedit("isshownum",barcodeval_get("BARCODE-blockbc-logobc-isshownum"),"yesno"); 
?></TD>
</TR>
<TR bgcolor=ffffff>
<TD><?php  echo getlang("ข้อความในบรรทัดหมายเลขบาร์โค้ด::l::Barcode number line"); ?></TD>
<TD><?php 
form_quickedit("bcline",barcodeval_get("BARCODE-blockbc-logobc-bcline"),"text"); 
?>
 size  <input type="number" name="bclinesize" min="-10" step=1 max="10" value="<?php echo floor(barcodeval_get("BARCODE-blockbc-logobc-bclinesize")); ?>">
 <BR>[bc] = barcode</TD>
</TR>
<TR bgcolor=ffffff>
<TD><?php  echo getlang("% ความกว้างของสัน::l::% width of book spine"); ?></TD>
<TD><?php 
form_quickedit("spinewidth",barcodeval_get("BARCODE-blockbc-logobc-spinewidth"),"list:20,25,30,35,40,45,50"); 
?></TD>
</TR>
<TR bgcolor=ffffff>
<TD><?php  echo getlang("ข้อความเพิ่มเติม::l::Add text"); ?></TD>
<TD><?php 
form_quickedit("addtext",barcodeval_get("BARCODE-blockbc-logobc-addtext"),"text"); 
?>  size  <input type="number" name="addtextsize" min="-10" step=1 max="10" value="<?php echo floor(barcodeval_get("BARCODE-blockbc-logobc-addtextsize")); ?>"></TD>
</TR>
<TR bgcolor=ffffff>
<TD><?php  echo getlang("รูปภาพโลโก้::l::Image"); ?></TD>
<TD><img src="../_tmp/_barcode-logobc.jpg?<?php  echo rand();?>" width=50 style="border-width:3;border-style:inset;">
<BR>
<INPUT TYPE="file" NAME="logobc" size=15 > <BR>
<small><?php  echo getlang("เฉพาะไฟล์ .JPG เท่านั้น กว้าง 50px สูง 50px::l::Only JPEG file, Width 50px Height  50 px"); ?></TD>
</TR>

<TR bgcolor=ffffff>
<TD align=center colspan=2><INPUT TYPE="submit" value="<?php  echo getlang("บันทึก::l::Save"); ?>"></TD>
</TR>

</FORM>
</TABLE>
<?php 
$bcgenmode="logobc";
include("cfg._getexamples.php");
?>