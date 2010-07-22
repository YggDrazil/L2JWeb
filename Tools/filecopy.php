<?php
/**********************************************************************/
/* Project Name.: L2J-Web							*/
/* SVN .........: https://l2j-web.googlecode.com/svn/trunk/L2J-Web/	*/
/* File Name....: filecopy.php						*/
/* Author.......: Sebastien Gascon						*/
/* Author Email.: sebastien.gascon@gmail.com				*/
/* Created On...: 04/01/2007 10:50:04 AM					*/
/* Last Updated.: 22/07/2010 12:33:20 PM					*/
/**********************************************************************/
include('header.inc.php');
include('config.inc.php');
include('lib.inc.php');


include('menu.php');




$dbname="l2webtest";
dbconnect();
$sql = "SELECT * FROM l2jz_items WHERE item_id < 10";
$result = mysql_query($sql, $conn) or die(mysql_error());
while ($newArray = mysql_fetch_array($result)) {
	$id = $newArray['item_id'];
	$icon = $newArray['icon'];
	
	
	echo "$id ";
	echo "$icon<br>";
	copy ( '/home/users/web/b1203/ipw.springfield-u/public_html/WYD/l2jz/i/items/$icon.png', '/home/users/web/b1203/ipw.springfield-u/public_html/WYD/l2jz/i/items/new/$id.png');
	echo "<img src=\"../l2jz/i/items/$icon.png\">";
	}
dbclose();

include('footer.inc.php');
?>