<?php  
    ;
    set_time_limit (2000);
	include("../inc/config.inc.php");
	head();
	include("_REQPERM.php");
	mn_lib();
	pagesection(getlang("รายงานหนังสือทั้งหมดในหมวดหมู่ LC::l::Books in LC Classifications"));
?>
    <table width = "780" align=center border = "0" cellspacing = "0" cellpadding = "0">
        <tr valign = "top">
            <td>
        <table width = "100%" border = "0" cellspacing = "1" cellpadding = "10">

            <tr align = "center">
                <td colspan = "3">
                    <table width = "780" border = "0" cellspacing = "1" cellpadding = "3" bgcolor = #F9EA9F class=table_border>
                        <tr bgcolor = "#A27100" class=table_head>
                            <td width = "9%">
                                <nobr><b><font face = "MS Sans Serif" size = "2"><?php echo getlang("ลำดับที่::l::No."); ?></font></b></font></td>
                            <td width = "" align = center>
                              <b><font face = "MS Sans Serif" size = "2"><nobr><?php echo getlang("หมวดของวัสดุสารสนเทศ::l::Classification"); ?></font></b></font></td>
                            <td width = 20% colspan = 1>
                                <b><font face = "MS 
Sans Serif" size = "2"><nobr><?php echo getlang("รวม::l::Total"); ?></font></b></font>
<font color = "#FFFFFF"><b><font face = "MS Sans Serif" size = "2"></font></b></font></td><td>&nbsp;</td>
                        </tr>
            <?php  
                /* */
                $i=0;
                $allc=0;
                $maxc=0;
                //echo $dcsub;
$_STR_A_Z=explode(',',$_STR_A_Z);
//print_r($_STR_A_Z);
                foreach ($_STR_A_Z as $iff2) {
					$prefDcsearch="__";
                    $sql1="SELECT count(id) AS sum2  FROM media where  ";
                    //echo tmq_error();
					/*
                    $sql1="$sql1 LOWER(" . getval("stat","lc_tagname") . ") like '$prefDcsearch^a$iff2%'";
                    $sql1="$sql1 or LOWER(" . getval("stat","lc_tagname") . ") like '$prefDcsearch$iff2%'";
                    $sql1="$sql1 or LOWER(" . getval("stat","lc_tagname") . ") like '$prefDcsearch$prefDcsearch$iff2%'";
                    $sql1="$sql1 or LOWER(" . getval("stat","lc_tagname") . ") like '$prefDcsearch$prefDcsearch^a$iff2%'";
					*/
					$sql1="$sql1 LOWER(" . getval("stat","lc_tagname") . ") like '$prefDcsearch^a$iff2%'";
					$sql1="$sql1 or LOWER(" . getval("stat","lc_tagname") . ") like '%^a$iff2%'";

                  //  echo $sql1 . "<BR>";
                    $result=tmq( $sql1);

                    $NRow=tmq_num_rows($result);
                    $row=tmq_fetch_array($result);
                    $summ=$row[sum2];
                    if ($summ>$maxc) $maxc=$summ;
					$stat[$iff2]=$summ;
					$allc=$allc + $summ;
				}
                foreach ($_STR_A_Z as $iff2)
                    {

                    $countt=$countt + 1;
                    $ittt=1 + $i;
                        echo "<tr  class=table_td> ";

                    echo "<td><font face='MS Sans Serif' size=2>$ittt</font></td>";
                    echo "<td><font face='MS Sans Serif' size=2>  ".strtoupper($iff2)."</font></td>";
                    echo "<td><font face='MS Sans Serif' size=2>  ".number_format($stat[$iff2])."</font></td>";
                    echo "<td><font face='MS Sans Serif' size=2>  ".html_graph("W",$maxc,$stat[$iff2],10,300)."</font></td>";
                    echo "</td>";
                    $i++;
                    $s=$i - 1;
                    }
            ?>
                <tr>
                    <td colspan = 2 align = right>
                        <?php echo getlang("รวม::l::Sum.");?></td>
                    <td>
                        <U><B><?php  
                echo "$allc";
            ?></B></U></td>
			<?php              
				//echo "<td><font face='MS Sans Serif' size=2>  ".html_graph("W",$allc,$allc,10,300)."</font></td>";
			?>
			</tr>
                    <tr>
                        <td colspan = 2 align = right>
                            <?php echo getlang("เฉลี่ย::l::Avg.");?></td>
                        <td>
                            <U><B><?php  
                echo number_format(round($allc / $i,2),2);
            ?></B></U></td>
                    </tr>
        </table>
            </td>
        </tr>
    </table>
    </td>
    </tr>
    </table><BR>
	<CENTER><?php  
	$r=tmq("select count(id) as aa from media ");
	$r=tmq_fetch_array($r);
	echo "ผลจากสถิติ ประมวลผลได้ ".number_format($allc)." รายการ จากทั้งหมด ".number_format($r[aa])." รายการในฐานข้อมูล<BR>";
	$free=$r[aa]-$allc;
	if ($free!=0) {
		echo "มี ".number_format($free)." รายการไม่สามารถจำแนกเลขหมู่ได้ <!-- <A HREF=\"../library.book/DBbook.php?search=wrongdc\">กรุณาคลิกที่นี่</A> เพื่อแสดงรายการ -->";
	}

	?></CENTER>


	<?php  
	foot();
	?>