<?php
/**********************************************************************/
/* Project Name.: L2J-Web							*/
/* SVN .........: https://l2j-web.googlecode.com/svn/trunk/L2J-Web/	*/
/* File Name....: players.php						*/
/* Author.......: Sebastien Gascon						*/
/* Author Email.: sebastien.gascon@gmail.com				*/
/* Created On...: 09/01/2007 10:45:42 PM					*/
/* Last Updated.: 22/07/2010 10:41:29 AM					*/
/**********************************************************************/
include('header.inc.php');
include('config.inc.php');
include('lib.inc.php');


include('menu.php');
include('member.php');

if($accesslevel < 0){
	die('You do not have access to this page');
}
dbconnect();
$sql = "SELECT charId, 
	account_name, 
	char_name, 
	race, 
	level, 
	curHp, 
	maxHp, 
	curMp, 
	maxMp, 
	curCp, 
	maxCp, 
	sex, 
	exp, 
	sp, 
	pvpkills, 
	pkkills, 
	classid, 
	online, 
	onlinetime, 
	lastAccess 
	FROM characters WHERE accesslevel > 0 ORDER BY level DESC";
	
echo "GMs<br/>\n";
echo "<table border=\"0\" cellpadding=\"1\" cellspacing=\"1\">\n";
echo "<tr>";
echo "<td>Account Name</td>";
echo "<td>Character Name</td>";
echo "<td>Race</td>";
echo "<td>Level</td>";
echo "<td>HP</td>";
echo "<td>MP</td>";
echo "<td>CP</td>";
echo "<td>Sex</td>";
echo "<td>Exp</td>";
echo "<td>SP</td>";
echo "<td>PVP Kills</td>";
echo "<td>PK Kills</td>";
echo "<td>Class</td>";
echo "<td>Online</td>";
echo "<td>Playing Time</td>";
echo "<td>Last Access</td>";
echo "</tr>";
$result = mysql_query($sql, $conn) or die(mysql_error());
$i = 1;
while ($newArray = mysql_fetch_array($result)) {
	$playerid = $newArray['charId'];
	$accountname = $newArray['account_name'];
	$playername = $newArray['char_name'];
	$playerrace = $newArray['race'];
	$playerlevel = $newArray['level'];
	$playercurhp = $newArray['curHp'];
	$playermaxhp = $newArray['maxHp'];
	$playercurmp = $newArray['curMp'];
	$playermaxmp = $newArray['maxMp'];
	$playercurcp = $newArray['curCp'];
	$playermaxcp = $newArray['maxCp'];
	$playersex = $newArray['sex'];
	$playerexp = $newArray['exp'];
	$playersp = $newArray['sp'];
	$playerpvpkills = $newArray['pvpkills'];
	$playerpkkills = $newArray['pkkills'];
	$playerclassid = $newArray['classid'];
	$playeronline = $newArray['online'];
	$playeronlinetime = $newArray['onlinetime'];
	$playerlastaccess = $newArray['lastAccess'];
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
	if($playersex == 0){
		$playersexname = "Male";
	}
	elseif($playersex == 1){
		$playersexname = "Female";
	}
	$playeronlinetimehour = $playeronlinetime / 3600;
	$playeronlinetimehour = round($playeronlinetimehour, 2);
	$playerlastaccess = substr($playerlastaccess, 0, 10);
	$playerlastaccessdisplay = gmdate('M jS Y H:i', $playerlastaccess);
	$sql2 = "SELECT * FROM class_list WHERE id = '$playerclassid'";
	$result2 = mysql_query($sql2, $conn) or die(mysql_error());
	while ($newArray2 = mysql_fetch_array($result2)) {
		$playerclassname = $newArray2['class_name'];
	if ($i %2){
			$linebg = 'line1';
		}else{
			$linebg = 'line2';
		}
	echo "<tr class=\"$linebg\">";
	echo "<td>$accountname</td>";
	echo "<td><a href=\"player_details.php?playerid=$playerid\">$playername</a></td>";
	echo "<td>$playerracename</td>";
	echo "<td>$playerlevel</td>";
	echo "<td>$playercurhp/$playermaxhp</td>";
	echo "<td>$playercurmp/$playermaxmp</td>";
	echo "<td>$playercurcp/$playermaxcp</td>";
	echo "<td>$playersexname</td>";
	echo "<td>$playerexp</td>";
	echo "<td>$playersp</td>";
	echo "<td>$playerpvpkills</td>";
	echo "<td>$playerpkkills</td>";
	echo "<td>$playerclassname</td>";
	echo "<td>$playeronline</td>";
	echo "<td>$playeronlinetimehour h</td>";
	echo "<td>$playerlastaccessdisplay</td>";
	echo "</tr>";
	$i ++;
	}
}

$sql = "SELECT charId, 
	account_name, 
	char_name, 
	race, 
	level, 
	curHp, 
	maxHp, 
	curMp, 
	maxMp, 
	curCp, 
	maxCp, 
	sex, 
	exp, 
	sp, 
	pvpkills, 
	pkkills, 
	classid, 
	online, 
	onlinetime, 
	lastAccess 
	FROM characters WHERE accesslevel = 0 ORDER BY level DESC";
	
echo "<table border=\"0\" cellpadding=\"1\" cellspacing=\"1\">\n";
echo "<tr>";
echo "<td>Account Name</td>";
echo "<td>Character Name</td>";
echo "<td>Race</td>";
echo "<td>Level</td>";
echo "<td>HP</td>";
echo "<td>MP</td>";
echo "<td>CP</td>";
echo "<td>Sex</td>";
echo "<td>Exp</td>";
echo "<td>SP</td>";
echo "<td>PVP Kills</td>";
echo "<td>PK Kills</td>";
echo "<td>Class</td>";
echo "<td>Online</td>";
echo "<td>Playing Time</td>";
echo "<td>Last Access</td>";
echo "</tr>";
$result = mysql_query($sql, $conn) or die(mysql_error());
$i = 1;
while ($newArray = mysql_fetch_array($result)) {
	$playerid = $newArray['charId'];
	$accountname = $newArray['account_name'];
	$playername = $newArray['char_name'];
	$playerrace = $newArray['race'];
	$playerlevel = $newArray['level'];
	$playercurhp = $newArray['curHp'];
	$playermaxhp = $newArray['maxHp'];
	$playercurmp = $newArray['curMp'];
	$playermaxmp = $newArray['maxMp'];
	$playercurcp = $newArray['curCp'];
	$playermaxcp = $newArray['maxCp'];
	$playersex = $newArray['sex'];
	$playerexp = $newArray['exp'];
	$playersp = $newArray['sp'];
	$playerpvpkills = $newArray['pvpkills'];
	$playerpkkills = $newArray['pkkills'];
	$playerclassid = $newArray['classid'];
	$playeronline = $newArray['online'];
	$playeronlinetime = $newArray['onlinetime'];
	$playerlastaccess = $newArray['lastAccess'];
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
	if($playersex == 0){
		$playersexname = "Male";
	}
	elseif($playersex == 1){
		$playersexname = "Female";
	}
	$playeronlinetimehour = $playeronlinetime / 3600;
	$playeronlinetimehour = round($playeronlinetimehour, 2);
	$playerlastaccess = substr($playerlastaccess, 0, 10);
	$playerlastaccessdisplay = gmdate('M jS Y H:i', $playerlastaccess);
	$sql2 = "SELECT * FROM class_list WHERE id = '$playerclassid'";
	$result2 = mysql_query($sql2, $conn) or die(mysql_error());
	while ($newArray2 = mysql_fetch_array($result2)) {
		$playerclassname = $newArray2['class_name'];
	if ($i %2){
			$linebg = 'line1';
		}else{
			$linebg = 'line2';
		}
	echo "<tr class=\"$linebg\">";
	echo "<td>$accountname</td>";
	echo "<td><a href=\"player_details.php?playerid=$playerid\">$playername</a></td>";
	echo "<td>$playerracename</td>";
	echo "<td>$playerlevel</td>";
	echo "<td>$playercurhp/$playermaxhp</td>";
	echo "<td>$playercurmp/$playermaxmp</td>";
	echo "<td>$playercurcp/$playermaxcp</td>";
	echo "<td>$playersexname</td>";
	echo "<td>$playerexp</td>";
	echo "<td>$playersp</td>";
	echo "<td>$playerpvpkills</td>";
	echo "<td>$playerpkkills</td>";
	echo "<td>$playerclassname</td>";
	echo "<td>$playeronline</td>";
	echo "<td>$playeronlinetimehour h</td>";
	echo "<td>$playerlastaccessdisplay</td>";
	echo "</tr>";
	$i ++;
	}
}
echo "</table>";
dbclose();

include('footer.inc.php');
?>