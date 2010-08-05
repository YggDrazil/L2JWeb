<?php
/**********************************************************************/
/* Project Name.: L2J-Web							*/
/* SVN .........: https://l2j-web.googlecode.com/svn/trunk/L2J-Web/	*/
/* File Name....: weapon_details.php					*/
/* Author.......: Sebastien Gascon						*/
/* Author Email.: sebastien.gascon@gmail.com				*/
/* Created On...: 23/01/2007 3:47:54 PM					*/
/* Last Updated.: 05/08/2010 2:11:32 PM					*/
/**********************************************************************/
include('header.inc.php');
include('config.inc.php');
include('lib.inc.php');


include('menu.php');
include('member.php');


if (empty($_GET[itemid])){
	echo "nothing";
	exit;
}
dbconnect();
$sql = "SELECT COUNT(*) AS count FROM items WHERE item_id = '$_GET[itemid]'";
$result = mysql_query($sql, $conn) or die(mysql_error());
while ($newArray = mysql_fetch_array($result)) {
	$item_count = $newArray['count'];
}
$sql = "SELECT * FROM weapon WHERE item_id = '$_GET[itemid]' LIMIT 0,1";
echo "<table border=\"0\" cellpadding=\"1\" cellspacing=\"1\">\n";
echo "<tr>";
if($accesslevel >= 100){
	echo "<td class=\"id\">ID</td>";
}
echo "<td class=\"id\">Icon</td>";
echo "<td class=\"name\">Name</td>";
echo "<td class=\"type\">Type</td>";
echo "<td class=\"grade\">Grade</td>";
echo "<td class=\"pmatk\">P./M.Atk</td>";
echo "<td class=\"ssspsmp\">SS/SpS/MP</td>";
echo "<td class=\"speed\">Speed</td>";
echo "<td class=\"weight\">Weight</td>";
echo "</tr>";
$result = mysql_query($sql, $conn) or die(mysql_error());
$i = 1;
while ($newArray = mysql_fetch_array($result)) {
	$weapon_id = $newArray['item_id'];
	$weapon_name = $newArray['name'];
	$weapon_type = $newArray['weaponType'];
	$weapon_grade = $newArray['crystal_type'];
	$weapon_patk = $newArray['p_dam'];
	$weapon_matk = $newArray['m_dam'];
	$weapon_soulshots = $newArray['soulshots'];
	$weapon_spiritshots = $newArray['spiritshots'];
	$weapon_mpconsume = $newArray['mp_consume'];
	$weapon_atkspeed = $newArray['atk_speed'];
	$weapon_weight = $newArray['weight'];
	$weapon_price = $newArray['price'];
	
	if ($i %2){
			$linebg = 'line1';
		}else{
			$linebg = 'line2';
		}
	
	echo "<tr class=\"$linebg\">";
	if($accesslevel >= 100){
		echo "<td class=\"id\">$weapon_id</td>";
	}
	echo "<td class=\"id\"><img src=\"images/items/$weapon_id.png\"></td>";
	echo "<td class=\"name\"><a href=\"weapon_details.php?itemid=$weapon_id\">$weapon_name</a></td>";
	echo "<td class=\"type\">$weapon_type</td>";
	echo "<td class=\"grade\"><img src=\"images/grades/grade_$weapon_grade.gif\"></td>";
	echo "<td class=\"pmatk\">$weapon_patk/$weapon_matk</td>";
	echo "<td class=\"ssspsmp\">x$weapon_soulshots/x$weapon_spiritshots/$weapon_mpconsume</td>";
	echo "<td class=\"speed\">$weapon_atkspeed</td>";
	echo "<td class=\"weight\">$weapon_weight</td>";
	echo "</tr>";
	$i ++;
}
echo "</table>";
if($accesslevel >= 100){
	echo "Number of existing items in world: <a href=\"owners.php?itemid=$weapon_id\">$item_count</a><br/></td>";
}
echo "<br/><b>Drops:</b><br/>";
echo "<table border=\"0\" cellpadding=\"1\" cellspacing=\"1\" width=\"389\">\n";
echo "<tr>";
if($accesslevel >= 100){
	echo "<td class=\"id\">ID</td>";
}
echo "<td class=\"name\">Name</td>";
echo "<td class=\"level\">Level</td>";
echo "<td class=\"chance\">Chance</td>";
echo "</tr>";
$sql = "SELECT 
	droplist.mobId, 
	droplist.chance, 
	npc.name, 
	npc.level 
	FROM droplist 
	INNER JOIN npc ON droplist.mobId = npc.id
	WHERE itemId = '$_GET[itemid]'
	AND droplist.category IN ('0', '1', '2')";
$result = mysql_query($sql, $conn) or die(mysql_error());
$i = 1;
while ($newArray = mysql_fetch_array($result)) {
	$drop_mobid = $newArray['mobId'];
	$drop_chance = $newArray['chance'];
	$mob_name = $newArray['name'];
	$mob_level = $newArray['level'];

	if ($i %2){
			$linebg = 'line1';
		}else{
			$linebg = 'line2';
		}
	echo "<tr class=\"$linebg\">";
	if($accesslevel >= 100){
		echo "<td class=\"id\">$drop_mobid</td>";
	}
	echo "<td class=\"name\"><a href=\"map.php?mobid=$drop_mobid\" rel=\"lightbox\" title=\"Location of $mob_name\">$mob_name</a></td>";
	echo "<td class=\"level\">$mob_level</td>";
	calculatedropchance($drop_chance);
	echo "<td class=\"chance\">$drop_chance_pct %</td>";
	echo "</tr>";
	$i ++;
}
echo "</table>";

echo "<br/><b>Spoils:</b><br/>";
echo "<table border=\"0\" cellpadding=\"1\" cellspacing=\"1\" width=\"389\">\n";
echo "<tr>";
if($accesslevel >= 100){
	echo "<td class=\"id\">ID</td>";
}
echo "<td class=\"name\">Name</td>";
echo "<td class=\"level\">Level</td>";
echo "<td class=\"chance\">Chance</td>";
echo "</tr>";
$sql = "SELECT 
	droplist.mobId, 
	droplist.chance, 
	npc.name, 
	npc.level 
	FROM droplist 
	INNER JOIN npc ON droplist.mobId = npc.id
	WHERE itemId = '$_GET[itemid]'
	AND droplist.category = '-1'";
$result = mysql_query($sql, $conn) or die(mysql_error());
$i = 1;
while ($newArray = mysql_fetch_array($result)) {
	$drop_mobid = $newArray['mobId'];
	$drop_chance = $newArray['chance'];
	$mob_name = $newArray['name'];
	$mob_level = $newArray['level'];

	if ($i %2){
			$linebg = 'line1';
		}else{
			$linebg = 'line2';
		}
	echo "<tr class=\"$linebg\">";
	if($accesslevel >= 100){
		echo "<td class=\"id\">$drop_mobid</td>";
	}
	echo "<td class=\"name\"><a href=\"map.php?mobid=$drop_mobid\" rel=\"lightbox\" title=\"Location of $mob_name\">$mob_name</a></td>";
	echo "<td class=\"level\">$mob_level</td>";
	calculatedropchance($drop_chance);
	echo "<td class=\"chance\">$drop_chance_pct %</td>";
	echo "</tr>";
	$i ++;
}
echo "</table>";

echo "<br/><b>Shops:</b><br/>";
echo "<table border=\"0\" cellpadding=\"1\" cellspacing=\"1\" width=\"344\">\n";
echo "<tr>";
if($accesslevel >= 100){
	echo "<td class=\"id\">ID</td>";
}
echo "<td class=\"name\">Name</td>";
echo "<td class=\"price\">Price</td>";
echo "</tr>";
$sql = "SELECT 
	merchant_shopids.npc_id,
	npc.name,
	weapon.price
	FROM merchant_buylists 
	INNER JOIN merchant_shopids on merchant_buylists.shop_id = merchant_shopids.shop_id
	INNER JOIN npc on merchant_shopids.npc_id = npc.id
	INNER JOIN weapon on merchant_buylists.item_id = weapon.item_id
	WHERE merchant_buylists.item_id = '$_GET[itemid]'";
$result = mysql_query($sql, $conn) or die(mysql_error());
$i = 1;
while ($newArray = mysql_fetch_array($result)) {
	$shop_id = $newArray['npc_id'];
	$shop_name = $newArray['name'];
	$shop_price = $newArray['price'];
	if ($i %2){
			$linebg = 'line1';
		}else{
			$linebg = 'line2';
		}
		echo "<tr class=\"$linebg\">";
		if($accesslevel >= 100){
			echo "<td class=\"id\">$shop_id</td>";
		}
		echo "<td class=\"name\"><a href=\"map.php?mobid=$shop_id\" rel=\"lightbox\" title=\"Location of $shop_name\">$shop_name</a></td>";
		echo "<td class=\"price\">$shop_price</td>";
		echo "</tr>";
		$i ++;	
}
echo "</table>";
dbclose();

include('footer.inc.php');
?>