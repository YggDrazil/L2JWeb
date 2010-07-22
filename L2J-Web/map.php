<?php
/**********************************************************************/
/* Project Name.: L2J-Web							*/
/* SVN .........: https://l2j-web.googlecode.com/svn/trunk/L2J-Web/	*/
/* File Name....: map.php							*/
/* Author.......: Sebastien Gascon						*/
/* Author Email.: sebastien.gascon@gmail.com				*/
/* Created On...: 22/01/2007 11:42:59 PM					*/
/* Last Updated.: 22/07/2010 10:47:19 AM					*/
/**********************************************************************/
//include('header.inc.php');
include('config.inc.php');
include('lib.inc.php');


//include('menu.php');
//include('member.php');

//if($accesslevel < 100){
//	die('You do not have access to this page');
//}
if(empty($_GET[playerid]) && empty($_GET[mobid])){
	die('No Player or Mob Specified');
}else{
$playerid = $_GET[playerid];
$mobid = $_GET[mobid];
}
dbconnect();
// path to your font
$font = 'FFFHARMO.TTF'; 
if ($font) {	
	$im = imagecreatefromjpeg("images/map/wydworld.jpg") or die("Cannot Initialize new GD image");
	$mycol['txt'] = imagecolorallocate($im, 255, 255, 255); // orange
	

if(empty($mobid)){
	$sql = "SELECT * FROM characters WHERE charId = '$playerid'";
	$result = mysql_query($sql, $conn) or die(mysql_error());
	while ($newArray = mysql_fetch_array($result)) {
		$currentx = $newArray['x'];
		$currenty = $newArray['y'];
		createloc();
		$mapposition = imagecreatefrompng("images/map/x.png");
		imageColorTransparent($mapposition, imageColorAt($mapposition, 0, 0));
		imagecopymerge($im, $mapposition,$resultx,$resulty,0,0, 9, 9, 100);
	}
}
if(empty($playerid)){
	$sql = "SELECT * FROM spawnlist WHERE npc_templateid = '$mobid'";
	$result = mysql_query($sql, $conn) or die(mysql_error());
	while ($newArray = mysql_fetch_array($result)) {
		$currentx = $newArray['locx'];
		$currenty = $newArray['locy'];
		createloc();
		$mapposition = imagecreatefrompng("images/map/x2.png");
		imageColorTransparent($mapposition, imageColorAt($mapposition, 0, 0));
		imagecopymerge($im, $mapposition,$resultx,$resulty,0,0, 9, 9, 100);
	}
}
	
	header("Content-type: image/gif");
	imagegif($im); // outputs image to browser
	imagedestroy($im);
}
dbclose();
?>