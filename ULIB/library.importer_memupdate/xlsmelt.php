<?php 
	; 
		ini_set("max_execution_time",600);
        include ("../inc/config.inc.php");
		head();
		$_REQPERM="importer_memupdate";
        mn_lib();

			pagesection(getlang("นำเข้าข้อมูลสมาชิก::l::Import Member Records"));		
		$importFilename=$file;
		/** Include path **/
set_include_path(get_include_path() . PATH_SEPARATOR . '../inc/phpexcel/Classes/');

/** PHPExcel_IOFactory */
include 'PHPExcel/IOFactory.php';


$inputFileName = $dcrs."_input/import/$importFilename";
//echo 'Loading file ',pathinfo($inputFileName,PATHINFO_BASENAME),' using IOFactory to identify the format<br />';
$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
$data = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
//var_dump($sheetData);
//error_reporting(E_ALL ^ E_NOTICE);
//echo count($data); die;
tmq("delete from importer_memupdate_tmp");
	for ($i=1;$i<=count($data);$i++) {
		$fieldcount=count($data[$i]);
		if ($fieldcount>30) {
			$fieldcount=30;
		}
		$s="insert into importer_memupdate_tmp  set id='' ";
		@reset($data[$i]);
		for ($j=1;$j<=$fieldcount;$j++) {
			list($k,$v)=each($data[$i]);
			$tmp=$v;
			$s.=" , data$j='".addslashes(($tmp))."' ";
		}
		tmq( $s);
		//echo "$s<br>";

	}
	
	
?>

<style type="text/css" media="screen">
	table { background-color: #BBB; }
	th { background-color: #EEE; }
	td { background-color: #FFF; }
</style><br><br><center><?php  echo getlang("ด้านล่างเป็นรายการตัวอย่างการดึงข้อมูลจากไฟล์ที่เลือก ด้วยรายละเอียดที่คุณกรอก <BR>
หากมีข้อผิดพลาดหรือต้องการแก้ไข กรุณาคลิก Back::l::Following data was extracted from your file with your entered information<BR>
if need to edit or recorrect some value  click Back"); ?>
<br><?php 
echo getlang("พบเรกคอร์ดทั้งหมด ::l::Found ");
?>
<?php  echo number_format(count($data)) ;?> 
<?php 
echo getlang("รายการ ::l:: record(s). ");
?>
</center><br>
<table border="0" cellspacing="1" cellpadding="3" align=center>
	<?php 
$tmp=count($data);
if ($tmp>10) {
	$tmp=10;
}
	for ($i = 1; $i <= $tmp; $i++) { ?>
		<tr>
			<?php 
		@reset($data[$i]);
		for ($j = 1; $j <= count($data[$i]); $j++) { 
			list($k,$v)=each($data[$i]);
		?>
				<td><?php  echo $v; ?></td>
			<?php  } ?>
		</tr>
	<?php  } ?>
</table>

<FORM METHOD=POST ACTION="step4.php">
<BR><BR><TABLE align=center>

	<TR>
	<TD align=right><INPUT TYPE="reset" value=" Back " onclick="self.location='index.php?file=<?php  echo $file?>' "></TD>
	<TD><INPUT TYPE="submit" value=" Next "></TD>
</TR>
<INPUT TYPE="hidden" NAME="fromxlsmelt" value="yes">

</TABLE></FORM>
<?php 

//print_r($data);
//print_r($data->formatRecords);


foot();
?>
