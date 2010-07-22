<?php
/**********************************************************************/
/* Project Name.: L2J-Web							*/
/* SVN .........: https://l2j-web.googlecode.com/svn/trunk/L2J-Web/	*/
/* File Name....: online.php						*/
/* Author.......: Sebastien Gascon						*/
/* Author Email.: sebastien.gascon@gmail.com				*/
/* Created On...: 10/01/2007 09:58:58 PM					*/
/* Last Updated.: 22/07/2010 10:40:12 AM					*/
/**********************************************************************/
include('loadtimestart.php');
include('header.inc.php');
include('config.inc.php');
include('lib.inc.php');


include('menu.php');
include('member.php');
dbconnect();
echo "Players Online:<br/><br/>";
if($accesslevel < 100){
	$sql = "SELECT char_name,race FROM characters WHERE online=1 ORDER BY char_name ASC";
	$result = mysql_query($sql, $conn) or die(mysql_error());
	while ($newArray = mysql_fetch_array($result)) {
		$playername = $newArray['char_name'];
		$playerrace = $newArray['race'];
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
		echo "$playername [$playerracename]<br/>";
	}
}else{
	$sql = "SELECT charId, char_name, race, level FROM characters WHERE online=1 ORDER BY char_name ASC";
	$result = mysql_query($sql, $conn) or die(mysql_error());
	while ($newArray = mysql_fetch_array($result)) {
		$playerid = $newArray['charId'];
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
		echo "<a href=\"player_details.php?playerid=$playerid\">$playername</a> [$playerracename] $playerlevel<br/>";
	}
}
dbclose();
include('loadtimeend.php');
include('footer.inc.php');
?>