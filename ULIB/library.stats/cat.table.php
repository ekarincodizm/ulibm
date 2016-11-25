<?php 
	$statdb[badd][name]="เพิ่มรายการใหม่::l::Add new Bib";
	$statdb[badd][sql]="add new bib%";
	$statdb[bedit][name]="แก้ไข Bib::l::Edit Bib";
	$statdb[bedit][sql]="update bib%";
	$statdb[bdel][name]="ลบ Bib::l::Delete Bib";
	$statdb[bdel][sql]="delete bib%";

	$statdb[ftuploadcam][name]="เพิ่ม Fulltext โดยกล้อง::l::Add Fulltext using camera";
	$statdb[ftuploadcam][sql]="upload cover by camera%";
	$statdb[ftdel][name]="ลบไฟล์ Fulltext ::l::Delete Fulltext";
	$statdb[ftdel][sql]="Delete File ID%";
	$statdb[ftupload][name]="เพิ่ม Fulltext::l::Add Fulltext";
	$statdb[ftupload][sql]="upload fulltext %";
	$statdb[fturl][name]="เพิ่ม Fulltext โดย URL::l::Add Fulltext using URL";
	$statdb[fturl][sql]="fulltext URL%";


	$statdb[iadd][name]="เพิ่ม Item::l::Add new Item";
	$statdb[iadd][sql]="add item bc%";
	$statdb[iedit][name]="แก้ไข Item::l::Edit Item";
	$statdb[iedit][sql]="update item bc%";
   $statdb[keyserial][name]="เพิ่มชื่อวารสารใหม่::l::Add new serial";
	$statdb[keyserial][sql]="add new serial%";
   $statdb[eserial][name]="แก้ไขวารสาร::l::Update serial";
	$statdb[eserial][sql]="update serial%";
   $statdb[keyjindex][name]="เพิ่มดรรชนีวารสารใหม่::l::Add new Journal Index";
	$statdb[keyjindex][sql]="add new jindex%";
   $statdb[ejindex][name]="แก้ไขวารสาร::l::Update Journal Index";
	$statdb[ejindex][sql]="update jindex%";

	$statdb[idel][name]="ลบ Bib::l::Delete Bib";
	$statdb[idel][sql]="delete item id%";
	$statdb[isadd][name]="เพิ่มไอเทมวารสาร::l::Add Serial Item";
	$statdb[isadd][sql]="add serial item%";
	$statdb[isbound][name]="เย็บเล่มวารสาร::l::Bound Serial Item";
	$statdb[isbound][sql]="bound item%";


	unset($tmpsum);
	unset($tmp);
	$gdata=Array();
	$gdatatitle=Array();
	$gdatatitle[Position]="Statistics";
	$gid="graph_gdata:thestat:$db:$USEMON:$USEYEA";
	//$sql1 ="SELECT distinctrow head  FROM $tbl where mon='$USEMON' and yea='$USEYEA' "; 

	//$sql2 = "$sql1 order by head";
//	$result=tmq($sql2);
?> 
                <table width="<?php  echo $_TBWIDTH;?>" align=center border="0" cellspacing="1" cellpadding="3" class=table_border>
                  <tr bgcolor="#006699"> 
                    <td class=table_head rowspan=2 width=150>Statistics</td>
                    <td class=table_head  colspan=32>
										<?php echo $thaimonstr[$USEMON]; ?> <?php echo $USEYEA+543; ?></td>
			</tr>
                  <tr bgcolor="#006699"> 
<?php 
for ($i=1;$i<=31;$i++) {
	$tmp="0$i";
	$tmp=substr($tmp,-2);
?><td class=table_td align=center <?php 
	$today=date("N",mktime(0, 0, 0, $USEMON, $i, $USEYEA));
	if ($today==6) {
		echo " style='background-color: #BFDFFF' ";
	}
	if ($today==7) {
		echo " style='background-color: #FFB3B3' ";
	}
?> style="font-size: 12px;"><?php  echo $tmp?></td><?php 
}
echo "<td align=center class=table_td>-</td>";
?>
</tr>
                  <?php 
         $i=1; 
		 $monthi=0;
		 @reset($statdb);
         while(list($k,$v)=each($statdb)) {
			 $monthi++;
$rowsum[$row[head]]=0;
$ittt = ($startrow)+$i;
          echo"<tr bgcolor=#F2F2F2 height=2 valign=top>";
            echo"<td   class=table_td><font face='MS Sans Serif' size=3 color=#003366>";
			$tmplocaldsp= $v[name];
			echo getlang($tmplocaldsp);
			echo "</td>";
///collecting data
$USEMON=floor($USEMON);
	$dts=ymd_mkdt(1,$USEMON,$USEYEA);
	$dte=ymd_mkdt(1,$USEMON+1,$USEYEA);
	$t="select FROM_UNIXTIME(dt,'%d')  as dat2,count(id) as cc from $tbl where dt<=$dte and dt>=$dts ";
	if ($libtoview!="") {
      $t.="and  login='$libtoview'";
	}
	$t.=" and edittype like '".$v[sql]."' group by FROM_UNIXTIME(dt,'%d')";

	$t.="  ";
	$t=tmq($t,false);
	$tmp=Array();

while ($r=tmq_fetch_array($t)) {
	//printr($r);
	$tmp[floor($r["dat2"])]=floor($r["cc"]);//=$r["aa"];
}
///collecting data-end
//printr($tmp);
	$gdatatitle[Description]["name$monthi"]=getlang($tmplocaldsp);

for ($i=1;$i<=31;$i++) {
	$col=$coldb[$tmp[$i]];
	if ($col=="") {
		$col="#ffcc00";
	}
	if ($tmp[$i]==0) {
		$col="#FFFFFF";
	}
	?><td class=table_td align=center style="font-size: 12px;"
	<?php 
	$today=date("N",mktime(0, 0, 0, $USEMON, $i, $USEYEA));
	if ($today==6) {
		echo " style='border-bottom-color: #BFDFFF; border-bottom-style: solid; border-bottom-width: 2' ";
	}
	if ($today==7) {
		echo " style='border-bottom-color: #FFB3B3; border-bottom-style: solid; border-bottom-width: 2' ";
	}
	$tmpsum[$i]=$tmpsum[$i]+$tmp[$i];
	$rowsum[$row[head]]=getlang($rowsum[$row[head]]+$tmp[$i]);
	$gdata[$monthi]["Serie$i"]=floatval($tmp[$i]);

	?> style="background-color: <?php  echo $col;?>;"	><?php  
	if (floor($tmp[$i])!=0) {
	  echo "<a href='cat.detail.php?y=$USEYEA&m=$USEMON&d=$i&libtoview=$libtoview&edittype=".base64_encode($v[sql])."'>";
	}
	echo number_format($tmp[$i])?></a></td><?php 
}
echo "<td align=right class=table_td>". number_format($rowsum[$row[head]])."</td>";
echo "</tr>";

    $i++;
		$s = $i-1;	
       }
	  // echo $_pagesplit_btn_var;
 ?>

                  <tr bgcolor="#006699"> 

                    <td class=table_head rowspan=2 width=150>Sum</td>
										<?php 
$maxonsumthismonth=0;
	for ($i=1;$i<=31;$i++) {
		$gmdata[$mmonthi]["Serie$i"]=floatval($tmpsum[$i]);
		if ($maxonsumthismonth<floor($tmpsum[$i])) {
		 $maxonsumthismonth=floor($tmpsum[$i]);
		}
		?><td class=table_td align=center ><?php  echo number_format($tmpsum[$i])?></td><?php 
	}
?><td class=table_head align=center ><?php  echo number_format(@array_sum($tmpsum))?></td>				</tr>


<tr bgcolor="#ffffff" valign=bottom height=50> 
<?php 
	for ($i=1;$i<=31;$i++) {
	?><td class=table_td align=center ><div 
	style="xxx; width: 100%; background-color: #999999!important; border:1px solid #dddddd; height: <?php echo floor(percent_cal($maxonsumthismonth,floor($tmpsum[$i]))/2);?>px">&nbsp;</div>
</td><?php 
	}
?><td class=table_head align=center > </td>
</tr>


<?php 
if (count($gdata)>0) {
	echo "
	<TR>
		<TD colspan=33 align=right>";
	echo "<A HREF='$dcrURL"."library.stats/graph.php?gid=$gid'  rel='gb_page_fs[]'   class='smaller2 a_btn'>".getlang("กราฟ::l::Graph")." 1</A>";
	echo "<A HREF='$dcrURL"."library.stats/graph2.php?gid=$gid'  rel='gb_page_fs[]'   class='smaller2 a_btn'>".getlang("กราฟ::l::Graph")." 2</A>";
	echo "</TD>
	</TR>";
}
?>
</table><?php 

$gdataall[data]=$gdata;
$gdataall[title]=$gdatatitle;
$gdataall[reporttitle]=$dspname." - ".$thaimonstr[$USEMON]." ".($USEYEA+543);;

//printr($gdataall);
$gdataalls=serialize($gdataall);
sessionval_set($gid,$gdataalls);
//echo $sqlgdata;
//echo serialize($gdata);
?>