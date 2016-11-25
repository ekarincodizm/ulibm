<?php  //พ
header('Content-type: text/css');
include("../../inc/config.inc.php");
?>
.ddsmoothmenu{
font: bold <?php  echo floor(barcodeval_get("webboxoptions-topmenu_fontsize"));?>px Tahoma;
background-color: #<?php  echo barcodeval_get("webboxoptions-topmenu_barcolor");?>; /*#414141; /*background of menu bar (default state)*/
width: 100%;
}

.ddsmoothmenu ul{
z-index:100;
margin: 0;
padding: 0;
list-style-type: none;
}

/*Top level list items*/
.ddsmoothmenu ul li{
position: relative;
display: inline;
float: left;
}

/*Top level menu link items style*/
.ddsmoothmenu ul li a {
display: block;
background: #<?php  echo barcodeval_get("webboxoptions-topmenu_barcolor");?>;  /*#414141; /*background of menu items (default state)*/
font-size: <?php  echo floor(barcodeval_get("webboxoptions-topmenu_fontsize"));?>px;
color: white!important;
padding: 8px 10px;
border-right: 1px solid #778;
color: #2d2b2b;
text-decoration: none;
}

* html .ddsmoothmenu ul li a{ /*IE6 hack to get sub menu links to behave correctly*/
display: inline-block;
}

.ddsmoothmenu ul li a:link, .ddsmoothmenu ul li a:visited{
color: white;
}

.ddsmoothmenu ul li a.selected { /*CSS class that's dynamically added to the currently active menu items' LI A element*/
background: #<?php  echo barcodeval_get("webboxoptions-topmenu_barcolorover");?>!important; 
color: white;
}

.ddsmoothmenu ul li a:hover{
background: #<?php  echo barcodeval_get("webboxoptions-topmenu_barcolorover");?>; /*background of menu items during onmouseover (hover state)*/
color: white;
}
	
/* sub menus */
.ddsmoothmenu ul li ul{
position: absolute;
left: -3000px;
display: none; /*collapse all sub menus to begin with*/
visibility: hidden;
}

/*Sub level menu list items (alters style from Top level List Items)*/
.ddsmoothmenu ul li ul li{
display: list-item;
float: none;
}

/*All subsequent sub menu levels vertical offset after 1st level sub menu */
.ddsmoothmenu ul li ul li ul{
top: 0;
}

/* Sub level menu links style */
.ddsmoothmenu ul li ul li a{
font: normal 13px Tahoma;
width: 160px; /*width of sub menus*/
padding: 5px;
margin: 0;
border-top-width: 0;
border-bottom: 1px solid gray;
}

/* Holly Hack for IE \*/
* html .ddsmoothmenu{height: 1%;} /*Holly Hack for IE7 and below*/


/* ######### CSS classes applied to down and right arrow images  ######### */

.downarrowclass{
position: absolute;
top: 12px;
right: 7px;
}

.rightarrowclass{
position: absolute;
top: 6px;
right: 5px;
}

/* ######### CSS for shadow added to sub menus  ######### */

.ddshadow{ 
position: absolute;
left: 0;
top: 0;
width: 0;
height: 0;
background-color: #ccc; /* generally should be just a little lighter than the box-shadow color for CSS3 capable browsers */
}

.toplevelshadow{
margin: 5px 0 0 5px; /* in NON CSS3 capable browsers gives the offset of the shadow */
opacity: 0.8; /* shadow opacity mostly for NON CSS3 capable browsers. Doesn't work in IE */
}

.ddcss3support .ddshadow.toplevelshadow {
margin: 0; /* in CSS3 capable browsers overrides offset from NON CSS3 capable browsers, allowing the box-shadow values in the next selector to govern that */
/* opacity: 1; */ /* optionally uncomment this to remove partial opacity for browsers supporting a box-shadow property which has its own slight gradient opacity */
}

.ddcss3support .ddshadow {
background-color: transparent;
box-shadow: 5px 5px 5px #aaa; /* box-shadow color generally should be a little darker than that for the NON CSS3 capable browsers background-color */
-moz-box-shadow: 5px 5px 5px #aaa;
-webkit-box-shadow: 5px 5px 5px #aaa;
}