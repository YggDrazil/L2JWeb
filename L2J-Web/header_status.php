<?php
/**********************************************************************/
/* Project Name.: L2J-Web							*/
/* SVN .........: https://l2j-web.googlecode.com/svn/trunk/L2J-Web/	*/
/* File Name....: header_status.php					*/
/* Author.......: Sebastien Gascon						*/
/* Author Email.: sebastien.gascon@gmail.com				*/
/* Created On...: 25/01/2007 9:49:08 PM					*/
/* Last Updated.: 28/07/2010 10:04:05 AM					*/
/**********************************************************************/
include('config.inc.php');
include('lib.inc.php');

$im = imagecreatefromjpeg("images/header/B.jpg") or die("Cannot Initialize new GD image");
/* Login Server 1 Query */
if($login=@fsockopen("208.91.214.69",9014,$errno,$errstr,1)){
	$loginstatus="online";
	fclose($login);
} else {
	$loginstatus="offline";
}
/* Game Server 1 Query */
if($bartz=@fsockopen("208.91.214.69",7777,$errno,$errstr,1)){
	$bartzstatus="online";
	fclose($bartz);
} else {
	$bartzstatus="offline";
}
/* Game Server 2 Query */
if($sieghardt=@fsockopen("208.91.214.69",7778,$errno,$errstr,1)){
	$sieghardtstatus="online";
	fclose($sieghardt);
} else {
	$sieghardtstatus="offline";
}
/* Display Lineage 2 Login Server Status */
$loginimage = imagecreatefromgif("images/header/login-".$loginstatus.".gif");
imagecopymerge($im, $loginimage,9,109,0,0, 89, 10, 100);

/* Display Lineage 2 Login Server 1 Status */
$bartzimage = imagecreatefromgif("images/header/bartz-".$bartzstatus.".gif");
imagecopymerge($im, $bartzimage,9,139,0,0, 89, 10, 100);
	
/* Display Lineage 2 Game Server 2 Status */
$sieghardtimage = imagecreatefromgif("images/header/sieghardt-".$sieghardtstatus.".gif");
imagecopymerge($im, $sieghardtimage,9,169,0,0, 89, 10, 100);
	



header("Content-type: image/gif");
imagegif($im); // outputs image to browser
imagedestroy($im);

?>