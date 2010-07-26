<?php
/**********************************************************************/
/* Project Name.: L2J-Web							*/
/* SVN .........: https://l2j-web.googlecode.com/svn/trunk/L2J-Web/	*/
/* File Name....: filecopy.php						*/
/* Author.......: Sebastien Gascon						*/
/* Author Email.: sebastien.gascon@gmail.com				*/
/* Created On...: 04/01/2007 10:50:04 AM					*/
/* Last Updated.: 23/07/2010 9:26:05 AM					*/
/**********************************************************************/
include('header.inc.php');
/** MySQL Settings **/
//Location of the MySQL Server
$dbhost="localhost";
//Name of the GameServer Database
$dbname="l2wh";
//Username to the MySQL Database
$dbuser="root";
//Password to the MySQL Database
$dbpass="";

function dbconnect(){
	global $dbhost, $dbuser, $dbpass, $conn, $dbname;
	$conn = mysql_connect($dbhost, $dbuser, $dbpass);
	/** Selecting the good DB **/
	mysql_select_db($dbname) or die(mysql_error());
}

function dbclose(){
	global $conn;
	mysql_close($conn);
}


include('menu.php');




$dbname="l2webtest";
dbconnect();
$sql = "SELECT * FROM items";
$result = mysql_query($sql, $conn) or die(mysql_error());
while ($newArray = mysql_fetch_array($result)) {
	$id = $newArray['id'];
	$icon = $newArray['pic'];
	
	
	echo "$id ";
	echo "$icon<br>";
	copy ( "icons/".$icon.".png", "icons/new/".$id.".png");
	}
dbclose();

include('footer.inc.php');
?>