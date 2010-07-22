<?php
/**********************************************************************/
/* Project Name.: L2J-Web							*/
/* SVN .........: https://l2j-web.googlecode.com/svn/trunk/L2J-Web/	*/
/* File Name....: player_details.php					*/
/* Author.......: Sebastien Gascon						*/
/* Author Email.: sebastien.gascon@gmail.com				*/
/* Created On...: 26/01/2007 6:50:34 PM					*/
/* Last Updated.: 22/07/2010 10:41:15 AM					*/
/**********************************************************************/
include('header.inc.php');
include('config.inc.php');
include('lib.inc.php');


include('menu.php');
include('member.php');
dbconnect();
$sql = "SELECT account_name FROM characters WHERE charId = '$_GET[playerid]' LIMIT 0,1";
$result = mysql_query($sql, $conn) or die(mysql_error());
while ($newArray = mysql_fetch_array($result)) {
	$accountname = $newArray['account_name'];
}
if($username != $accountname && $accesslevel < 0){
	die('You do not have access to this page');
}else{

if (empty($_GET[playerid])){
	echo "nothing";
	exit;
}

$sql = "SELECT characters.charId, 
	characters.account_name, 
	characters.char_name, 
	characters.race, 
	characters.level, 
	characters.curHp, 
	characters.maxHp, 
	characters.curMp, 
	characters.maxMp, 
	characters.curCp, 
	characters.maxCp, 
	characters.sex, 
	characters.exp, 
	characters.sp, 
	characters.pvpkills, 
	characters.pkkills,  
	characters.online, 
	characters.onlinetime, 
	characters.lastAccess,
	class_list.class_name
	FROM characters 
	INNER JOIN class_list ON characters.classid = class_list.id
	WHERE charId = '$_GET[playerid]' LIMIT 0,1";
	
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
	$playeronline = $newArray['online'];
	$playeronlinetime = $newArray['onlinetime'];
	$playerlastaccess = $newArray['lastAccess'];
	$playerclassname = $newArray['class_name'];
	if ($i %2){
			$linebg = 'line1';
		}else{
			$linebg = 'line2';
		}
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
echo "</table>";
//echo "<img src=\"inventory.php?playerid=$_GET[playerid]\">";
include("paperdoll.php");
echo "<img src=\"map.php?playerid=$_GET[playerid]\">";
echo "<br/><b>Inventory:</b><br/>";
echo "<table border=\"0\" cellpadding=\"1\" cellspacing=\"1\" width=\"667\">\n";
echo "<tr>";
echo "<td class=\"id\">ID</td>";
echo "<td class=\"id\">Icon</td>";
echo "<td class=\"name\">Count</td>";
echo "<td class=\"name\">Name</td>";
echo "<td class=\"id\">Grade</td>";
echo "<td class=\"id\">loc</td>";
echo "<td class=\"id\">loc_data</td>";
echo "</tr>";
$sql = "SELECT 
		items.item_id,
		items.count,
		items.enchant_level,
		items.loc,
		items.loc_data,
		etcitem.name AS etcitemname,
		weapon.name AS weaponname,
		armor.name AS armorname,
		etcitem.crystal_type AS etcitemgrade,
		weapon.crystal_type AS weapongrade,
		armor.crystal_type AS armorgrade
	FROM items 
	LEFT JOIN (etcitem) ON (items.item_id=etcitem.item_id) 
	LEFT JOIN (weapon) ON (items.item_id=weapon.item_id) 
	LEFT JOIN (armor) ON (items.item_id=armor.item_id) 
	WHERE items.owner_id = '$_GET[playerid]' 
	ORDER BY items.loc ASC
	LIMIT 0,1000";
		
$result = mysql_query($sql, $conn) or die(mysql_error());
$i = 1;
while ($newArray = mysql_fetch_array($result)) {
	$item_id = $newArray['item_id'];
	$item_count = $newArray['count'];
	$item_enchant_level = $newArray['enchant_level'];
	$item_loc = $newArray['loc'];
	$item_loc_data = $newArray['loc_data'];
	$item_etcname = $newArray['etcitemname'];
	$item_weaponname = $newArray['weaponname'];
	$item_armorname = $newArray['armorname'];
	$item_etcgrade = $newArray['etcitemgrade'];
	$item_weapongrade = $newArray['weapongrade'];
	$item_armorgrade = $newArray['armorgrade'];
	$drop_spoil = $newArray['sweep'];
	$drop_spoil = $newArray['sweep'];
	$drop_spoil = $newArray['sweep'];
	$drop_spoil = $newArray['sweep'];

	if ($i %2){
		$linebg = 'line1';
	}else{
		$linebg = 'line2';
	}
	echo "<tr class=\"$linebg\">";
	echo "<td class=\"id\">$item_id</td>";
	echo "<td class=\"id\"><img src=\"images/items/$item_id.png\"></td>";
	echo "<td class=\"id\">$item_count</td>";
	if($item_enchant_level == 0){
		$item_enchant_level = "";
		$item_enchant_level_sign = "";
	}else{
		$item_enchant_level_sign = "+";
	}
	if(empty($item_etcname) && empty($item_weaponname)){
		echo "<td class=\"name\">$item_armorname <b>$item_enchant_level_sign$item_enchant_level</b></td>";
	}
	elseif(empty($item_etcname) && empty($item_armorname)){
		echo "<td class=\"name\">$item_weaponname <b>$item_enchant_level_sign$item_enchant_level</b></td>";
	}
	elseif(empty($item_weaponname) && empty($item_armorname)){
		echo "<td class=\"name\">$item_etcname <b>$item_enchant_level_sign$item_enchant_level</b></td>";
	}
	if(empty($item_etcgrade) && empty($item_weapongrade)){
		if($item_armorgrade == 'none'){
			$item_armorgrade = '';
		}
		$item_armorgrade = strtoupper($item_armorgrade);
		echo "<td class=\"id\">$item_armorgrade</td>";
	}
	elseif(empty($item_etcgrade) && empty($item_armorgrade)){
		if($item_weapongrade == 'none'){
			$item_weapongrade = '';
		}
		$item_weapongrade = strtoupper($item_weapongrade);
		echo "<td class=\"id\">$item_weapongrade</td>";
	}
	elseif(empty($item_weapongrade) && empty($item_armorgrade)){
		if($item_etcgrade == 'none'){
			$item_etcgrade = '';
		}
		$item_etcgrade = strtoupper($item_etcgrade);
		echo "<td class=\"id\">$item_etcgrade</td>";
	}
	if($item_loc == 'PAPERDOLL'){
		$item_loc = 'WEARING';
	}
	echo "<td class=\"id\">$item_loc</td>";
	echo "<td class=\"id\">$item_loc_data</td>";
	echo "</tr>";
	$i ++;
	
}
echo "</table>";

dbclose();

include('footer.inc.php');
}
?>