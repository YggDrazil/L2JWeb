<?php
/**********************************************************************/
/* Project Name.: L2J-Web							*/
/* SVN .........: https://l2j-web.googlecode.com/svn/trunk/L2J-Web/	*/
/* File Name....: monster_details.php					*/
/* Author.......: Sebastien Gascon						*/
/* Author Email.: sebastien.gascon@gmail.com				*/
/* Created On...: 14/07/2010 10:39:51 AM					*/
/* Last Updated.: 22/07/2010 10:47:26 AM					*/
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
	echo "<td class=\"name\"><a href=\"map.php?mobid=$mob_id\">$mob_name</a></td>";
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
$sql = "SELECT droplist.*, etcitem.name FROM droplist INNER JOIN etcitem on droplist.itemId = etcitem.item_id WHERE mobId = '$_GET[mobid]' LIMIT 0,1000";
$result = mysql_query($sql, $conn) or die(mysql_error());
$i = 1;
while ($newArray = mysql_fetch_array($result)) {
	$drop_itemid = $newArray['itemId'];
	$drop_quantity_min = $newArray['min'];
	$drop_quantity_max = $newArray['max'];
	$drop_category = $newArray['category'];
	$drop_chance = $newArray['chance'];
	$item_name = $newArray['name'];
	if ($i %2){
			$linebg = 'line1';
		}else{
			$linebg = 'line2';
		}
	echo "<tr class=\"$linebg\">";
	if($drop_category == -1){
		$drop_spoil = 1;
	}else{
		$drop_spoil = 0;
	}
	if($accesslevel >= 100){
		echo "<td class=\"id\">$drop_itemid</td>";
	}
	echo "<td class=\"id\"><img src=\"images/items/$drop_itemid.gif\"></td>";
	echo "<td class=\"name\"><a href=\"item_details.php?itemid=$drop_itemid\">$item_name</a></td>";
	if ($drop_quantity_min == $drop_quantity_max){
		echo "<td class=\"quantity\">$drop_quantity_min</td>";	
	}else{
		echo "<td class=\"quantity\">$drop_quantity_min - $drop_quantity_max</td>";
	}
	$drop_chance_pct = $drop_chance / 1000;
	$drop_chance_pct = round($drop_chance_pct, 2);
	if ($drop_spoil == 1){
		echo "<td class=\"chance\">$drop_chance_pct %<br/>[Spoil]</td>";
	}else{
		echo "<td class=\"chance\">$drop_chance_pct %</td>";
	}
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
echo "<td class=\"name\">Name</td>";
echo "<td class=\"price\">Price</td>";
echo "</tr>";
$sql = "SELECT * FROM merchant_buylists WHERE item_id = '$_GET[itemid]' LIMIT 0,1000";
$result = mysql_query($sql, $conn) or die(mysql_error());
$i = 1;
while ($newArray = mysql_fetch_array($result)) {
	$shop_id = $newArray['shop_id'];
	$shop_price = $newArray['price'];


	$sql2 = "SELECT * FROM merchant_shopids WHERE shop_id = '$shop_id' LIMIT 0,1000";
	$result2 = mysql_query($sql2, $conn) or die(mysql_error());
	while ($newArray2 = mysql_fetch_array($result2)) {
		$shop_npcid = $newArray2['npc_id'];
	
		$sql3 = "SELECT * FROM npc WHERE id = '$shop_npcid' LIMIT 0,1";
		$result3 = mysql_query($sql3, $conn) or die(mysql_error());
		while ($newArray3 = mysql_fetch_array($result3)) {
			$shop_npcname = $newArray3['name'];

	if ($i %2){
			$linebg = 'line1';
		}else{
			$linebg = 'line2';
		}
		echo "<tr class=\"$linebg\">";
		if($accesslevel >= 100){
			echo "<td class=\"id\">$shop_id</td>";
		}
		echo "<td class=\"name\">$shop_npcname</td>";
		echo "<td class=\"price\">$shop_price</td>";
		echo "</tr>";
		$i ++;	
	}
	}
	
}
echo "</table>";
dbclose();

include('footer.inc.php');
?>