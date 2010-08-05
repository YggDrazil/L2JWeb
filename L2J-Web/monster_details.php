<?php
/**********************************************************************/
/* Project Name.: L2J-Web							*/
/* SVN .........: https://l2j-web.googlecode.com/svn/trunk/L2J-Web/	*/
/* File Name....: monster_details.php					*/
/* Author.......: Sebastien Gascon						*/
/* Author Email.: sebastien.gascon@gmail.com				*/
/* Created On...: 14/07/2010 10:39:51 AM					*/
/* Last Updated.: 05/08/2010 1:41:37 PM					*/
/**********************************************************************/
include('header.inc.php');
include('config.inc.php');
include('lib.inc.php');


include('menu.php');
include('member.php');

if (empty($_GET[mobid])){
	echo "nothing";
	exit;
}
dbconnect();
$sql = "SELECT COUNT(*) AS count FROM npc WHERE id = '$_GET[mobid]'";
$result = mysql_query($sql, $conn) or die(mysql_error());
while ($newArray = mysql_fetch_array($result)) {
	$item_count = $newArray['count'];
}
$sql = "SELECT * FROM npc WHERE id = '$_GET[mobid]' LIMIT 0,1";
echo "<table border=\"0\" cellpadding=\"1\" cellspacing=\"1\" width=\"587\">\n";
echo "<tr>";
if($accesslevel >= 100){
	echo "<td class=\"id\">ID</td>";
}
echo "<td class=\"name\">Name</td>";
echo "<td class=\"level\">Level</td>";
echo "<td class=\"hp\">HP</td>";
echo "</tr>";
$result = mysql_query($sql, $conn) or die(mysql_error());
$i = 1;
while ($newArray = mysql_fetch_array($result)) {
	$mob_id = $newArray['id'];
	$mob_name = $newArray['name'];
	$mob_level = $newArray['level'];
	$mob_hp = $newArray['hp'];
	if ($i %2){
			$linebg = 'line1';
		}else{
			$linebg = 'line2';
		}
	echo "<tr class=\"$linebg\">";
	if($accesslevel >= 0){
		echo "<td class=\"id\">$mob_id</td>";
	}
	echo "<td class=\"name\"><a href=\"map.php?mobid=$mob_id\" rel=\"lightbox\" title=\"Location of $mob_name\">$mob_name</a></td>";
	echo "<td class=\"level\">$mob_level</td>";
	echo "<td class=\"hp\">$mob_hp</td>";
	echo "</tr>";
	$i ++;	
}
echo "</table>";

echo "<br/><b>Drops:</b><br/>";
echo "<table border=\"0\" cellpadding=\"1\" cellspacing=\"1\" width=\"389\">\n";
echo "<tr>";
if($accesslevel >= 100){
	echo "<td class=\"id\">ID</td>";
}
echo "<td class=\"id\">Icon</td>";
echo "<td class=\"name\">Name</td>";
echo "<td class=\"quantity\">Quantity</td>";
echo "<td class=\"chance\">Chance</td>";
echo "</tr>";
$sql = "SELECT 
	droplist.*, 
	etcitem.name AS itemname, 
	armor.name AS armorname, 
	weapon.name as weaponname 
	FROM droplist
	LEFT JOIN etcitem on droplist.itemId = etcitem.item_id
	LEFT JOIN armor on droplist.itemId = armor.item_id
	LEFT JOIN weapon on droplist.itemId = weapon.item_id
	WHERE droplist.mobId = '$_GET[mobid]' 
	AND droplist.category IN ('0', '1', '2')";

$result = mysql_query($sql, $conn) or die(mysql_error());
$i = 1;
while ($newArray = mysql_fetch_array($result)) {
	$drop_itemid = $newArray['itemId'];
	$drop_quantity_min = $newArray['min'];
	$drop_quantity_max = $newArray['max'];
	$drop_category = $newArray['category'];
	$drop_chance = $newArray['chance'];
	$item_name = $newArray['itemname'];
	$armor_name = $newArray['armorname'];
	$weapon_name = $newArray['weaponname'];
	if ($i %2){
			$linebg = 'line1';
		}else{
			$linebg = 'line2';
		}
	echo "<tr class=\"$linebg\">";
	if($accesslevel >= 100){
		echo "<td class=\"id\">$drop_itemid</td>";
	}
	echo "<td class=\"id\"><img src=\"images/items/$drop_itemid.png\"></td>";
	if (!empty($item_name)){
		$display_name = $item_name;
	}
	if (!empty($armor_name)){
		$display_name = $armor_name;
	}
	if (!empty($weapon_name)){
		$display_name = $weapon_name;
	}
	echo "<td class=\"name\"><a href=\"item_details.php?itemid=$drop_itemid\">$display_name</a></td>";
	if ($drop_quantity_min == $drop_quantity_max){
		echo "<td class=\"quantity\">$drop_quantity_min</td>";	
	}else{
		echo "<td class=\"quantity\">$drop_quantity_min - $drop_quantity_max</td>";
	}
	calculatedropchance($drop_chance);
	echo "<td class=\"chance\">$drop_chance_pct %</td>";
	echo "</tr>";
	$i ++;
	
}
echo "</table>";
echo "<br/><b>Spoils:</b><br/>";
echo "<table border=\"0\" cellpadding=\"1\" cellspacing=\"1\" width=\"344\">\n";
echo "<tr>";
if($accesslevel >= 0){
	echo "<td class=\"id\">ID</td>";
}
echo "<td class=\"id\">Icon</td>";
echo "<td class=\"name\">Name</td>";
echo "<td class=\"quantity\">Quantity</td>";
echo "<td class=\"chance\">Chance</td>";
echo "</tr>";
$sql = "SELECT 
	droplist.*, 
	etcitem.name AS itemname, 
	armor.name AS armorname, 
	weapon.name as weaponname 
	FROM droplist
	LEFT JOIN etcitem on droplist.itemId = etcitem.item_id
	LEFT JOIN armor on droplist.itemId = armor.item_id
	LEFT JOIN weapon on droplist.itemId = weapon.item_id
	WHERE droplist.mobId = '$_GET[mobid]'
	AND droplist.category = '-1'";
$result = mysql_query($sql, $conn) or die(mysql_error());
$i = 1;
while ($newArray = mysql_fetch_array($result)) {
	$drop_itemid = $newArray['itemId'];
	$drop_quantity_min = $newArray['min'];
	$drop_quantity_max = $newArray['max'];
	$drop_category = $newArray['category'];
	$drop_chance = $newArray['chance'];
	$item_name = $newArray['itemname'];
	$armor_name = $newArray['armorname'];
	$weapon_name = $newArray['weaponname'];
	if ($i %2){
			$linebg = 'line1';
		}else{
			$linebg = 'line2';
		}
		echo "<tr class=\"$linebg\">";
		if($accesslevel >= 100){
			echo "<td class=\"id\">$drop_itemid</td>";
		}
		echo "<td class=\"id\"><img src=\"images/items/$drop_itemid.png\"></td>";
		if (!empty($item_name)){
		$display_name = $item_name;
		}
		if (!empty($armor_name)){
			$display_name = $armor_name;
		}
		if (!empty($weapon_name)){
			$display_name = $weapon_name;
		}
		echo "<td class=\"name\"><a href=\"item_details.php?itemid=$drop_itemid\">$display_name</a></td>";
		if ($drop_quantity_min == $drop_quantity_max){
			echo "<td class=\"quantity\">$drop_quantity_min</td>";	
		}else{
			echo "<td class=\"quantity\">$drop_quantity_min - $drop_quantity_max</td>";
		}
		echo "<td class=\"chance\">$drop_chance_pct %</td>";
		echo "</tr>";
		$i ++;	
}

echo "</table>";
dbclose();

include('footer.inc.php');
?>