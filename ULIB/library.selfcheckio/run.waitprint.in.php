<?php 
include_once("../inc/config.inc.php");
html_start();
include_once("./inc.php");

//printr($_GET);
//printr($s);
$bcinlist=sessionval_get("bcinlist");
$bcinlist=unserialize($bcinlist);
//printr($bcinlist);
if (!is_array($bcinlist)) {
	$bcinlist=Array();
}
if (count($bcinlist)==0) {
	?>
	<script type="text/javascript">
	<!--
		setTimeout("self.location='./galleria/index.php?code=<?php  echo $s[id]?>';",10);
	//-->
	</script>
	<?php 
	die;
}
?>
<script type="text/javascript">
<!--
function localprint() {
	top.b_cancel();
	tmp=top.getobj("localhiddenif");
	tmp.src="<?php  echo $dcrURL;?>library.printtemplate/_preview.php?pid=<?php  echo $s[cislip]; ?>&memberbarcode=<?php  echo $memberbarcode;?>&compilevar=yes&autoprint=yes";
	setTimeout("self.location='./galleria/index.php?code=<?php  echo $s[id]?>';",5000);
}
//-->
</script><?php 
if ($s[io_autoprint]=="no") {
	redir("./galleria/index.php?code=$s[id]");
	die;
}
if ($s[io_autoprint]=="yes") {
	?>
	<script type="text/javascript">
	<!--
		localprint();
	//-->
	</script>
	<?php 
}
if ($s[io_autoprint]=="ask") {
	echo getlang("พิมพ์ใบคืน?::l::Print out slip?");
	?>
	<center><a href="javascript:void(null);" class="iomainbtn" onclick="localprint()"><?php  echo getlang("พิมพ์::l::Print");?></a>
	<a href="javascript:void(null);" class="iobtnorange" onclick="top.b_cancel()"><?php  echo getlang("ไม่พิมพ์::l::no");?></a>
</center>	<?php 
}
?>