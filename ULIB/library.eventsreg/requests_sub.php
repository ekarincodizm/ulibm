<?php 
include("../inc/config.inc.php");
head();
include("_REQPERM.php");
mn_lib();
$p=tmq("select * from eventsreg_requests where id=$pid");
$pr=tfa($p);
pagesection("ตัวเลือกย่อยของคำขอ");
echo "<center>".stripslashes($pr[name])."<BR>";
$tbname="eventsreg_requests_sub";


$c[2][text]="ข้อความ::l::Text";
$c[2][field]="name";
$c[2][fieldtype]="text";
$c[2][descr]=" ";
$c[2][defval]="";

$c[6][text]="ข้อความเพิ่มเติม::l::Details";
$c[6][field]="detail";
$c[6][fieldtype]="longtext";
$c[6][descr]="";
$c[6][defval]="";

$c[3][text]="เรียงลำดับ::l::Order";
$c[3][field]="ordr";
$c[3][fieldtype]="number";
$c[3][descr]="";
$c[3][defval]="";

$c[5][text]="จำกัดจำนวนผู้เข้าร่วม::l::Limit participants";
$c[5][field]="limitpart";
$c[5][fieldtype]="number";
$c[5][descr]=getlang("0 = ไม่จำกัด::l::0 = no limit");;
$c[5][defval]="";

$c[4][text]="เปิดรับสมัคร";
$c[4][field]="openreg";
$c[4][fieldtype]="yesno";
$c[4][descr]="";
$c[4][defval]="yes";


$c[9][text]="";
$c[9][field]="pid";
$c[9][fieldtype]="addcontrol";
$c[9][descr]="";
$c[9][defval]=$pid;


//dsp

$dsp[5][text]="order::l::order";
$dsp[5][field]="ordr";
$dsp[5][width]="5%";

$dsp[2][text]="ข้อความ::l::Text";
$dsp[2][field]="name";
$dsp[2][width]="30%";

$dsp[4][text]="Open?";
$dsp[4][field]="openreg";
$dsp[4][filter]="switchsingle";
$dsp[4][width]="10%";

/*
$dsp[3][text]="กิจกรรมย่อย";
$dsp[3][field]="name";
$dsp[3][filter]="module:local_sub";
$dsp[3][width]="30%";

function local_sub($wh) {
	$s=tmq("select * from areceventjournal_sub where pid='$wh[id]' ");
	$res= "<CENTER><A HREF='edit_event_sub.php?pid=$wh[id]'>กิจกรรมย่อย ".tmq_num_rows($s)."</A></CENTER>";
	return $res;
}
*/
fixform_tablelister($tbname," pid=$pid  ",$dsp,"yes","yes","yes","pid=$pid",$c," ordr ");
?><A HREF="requests.php?pid=<?php 

echo $pr[pid];
?>"><CENTER>กลับ</CENTER></A><?php

foot();
?>