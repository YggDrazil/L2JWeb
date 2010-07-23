<?php
/**********************************************************************/
/* Project Name.: L2J-Web							*/
/* SVN .........: https://l2j-web.googlecode.com/svn/trunk/L2J-Web/	*/
/* File Name....: member.php						*/
/* Author.......: Sebastien Gascon						*/
/* Author Email.: sebastien.gascon@gmail.com				*/
/* Created On...: 09/01/2007 10:58:06 AM					*/
/* Last Updated.: 23/07/2010 9:33:22 AM					*/
/**********************************************************************/
#include('header.inc.php');
#include('config.inc.php');
#include('lib.inc.php');
dbconnect();


//checks cookies to make sure they are logged in
if(isset($_COOKIE['WYDL2j']))
{
$username = $_COOKIE['WYDL2j'];
$pass = $_COOKIE['WYDL2jkey'];
$accesslevel = $_COOKIE['WYDL2jAL'];
$check = mysql_query("SELECT password, accessLevel FROM accounts WHERE login = '$username'")or die(mysql_error());
while($info = mysql_fetch_array( $check ))
{

//if the cookie has the wrong password, they are taken to the login page
if ($pass != $info['password'])
{ 
	print "<script language=\"JavaScript\">";
	print "window.location = 'logout.php' ";
	print "</script>";
}

//otherwise they are shown the admin area
elseif ($accesslevel != $info['accessLevel']){
	print "<script language=\"JavaScript\">";
	print "window.location = 'logout.php' ";
	print "</script>";
}
else
{
	
	echo "<table border=\"0\" cellpadding=\"1\" cellspacing=\"1\">\n";
	dbconnect();
	$sql = "SELECT charId,
		char_name,
		race, 
		level 
		FROM characters WHERE account_name = '$username'";
		
	$result = mysql_query($sql, $conn) or die(mysql_error());
	while ($newArray = mysql_fetch_array($result)) {
		$playerId = $newArray['charId'];
		$playername = $newArray['char_name'];
		$playerrace = $newArray['race'];
		$playerlevel = $newArray['level'];
		if($playerrace == 0){
		$playerracename = "Human";
		}
		elseif($playerrace == 1){
			$playerracename = "Elf";
		}
		elseif($playerrace == 2){
			$playerracename = "Dark Elf";
		}
		elseif($playerrace == 3){
			$playerracename = "Orc";
		}
		elseif($playerrace == 4){
			$playerracename = "Dwarf";
		}
		elseif($playerrace == 5){
			$playerracename = "Kamael";
		}
		echo "<tr class=\"$linebg\">";
		echo "<td><a href=\"player_details.php?playerid=$playerId\">$playername</a></td>";
		echo "<td>$playerracename</td>";
		echo "<td>$playerlevel</td>";
		echo "</tr>";
	}
	echo "</table>";
}
}
}
else

//if the cookie does not exist, they are taken to the login screen
{
print "<script language=\"JavaScript\">";
print "window.location = 'index.php' ";
print "</script>";
}
dbclose();
?>