<?php 
;
include("./cfg.inc.php");
include("./_localfunc.php");
html_start();
    // head();// พ
$ismanager=library_gotpermission("webpage-postarticle");
 $TID=trim($TID);
 $postdata="select * from webpage_articles where id='$setdelete' ";
 if ($ismanager!=true) {
	$postdata.=" and ishide='yes' ";
 }
	$postdata=tmq($postdata);
	if (tmq_num_rows($postdata)==0) {
		die("no webpage_articles id $TID");
	}

	$postdata=tmq_fetch_array($postdata);


?><!-- <?php pathgen($postdata[boardid],$TID);?>  --><?php 


	if ( $ismanager!=true) {
		die("you cannot undelete this post");
	}

tmq("update webpage_articles set ishide='no' where id='$setdelete' ");
	if ($postdata[nestedid]!=0) {
		redir("viewtopic.php?TID=$postdata[nestedid]");
	} else {
		redir("viewtopic.php?TID=$postdata[id]");
	}

?>