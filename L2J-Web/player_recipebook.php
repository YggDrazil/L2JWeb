<?php
/**********************************************************************/
/* Project Name.: L2J-Web							*/
/* SVN .........: https://l2j-web.googlecode.com/svn/trunk/L2J-Web/	*/
/* File Name....: player_recipebook.php					*/
/* Author.......: Sebastien Gascon						*/
/* Author Email.: sebastien.gascon@gmail.com				*/
/* Created On...: 06/08/2010 6:59:51 PM					*/
/* Last Updated.: 06/08/2010 6:59:53 PM					*/
/**********************************************************************/
include('header.inc.php');
include('config.inc.php');
include('lib.inc.php');

include('menu.php');
include('member.php');
dbconnect();

$sql = "SELECT 
etcitem.item_id, 
etcitem.name,
l2wh_recipes.id, 
l2wh_recipes.lvl, 
l2wh_recipes.success, 
l2wh_recipes.mp 
FROM character_recipebook 
INNER JOIN l2wh_recipes on character_recipebook.id = l2wh_recipes.id
INNER JOIN etcitem on l2wh_recipes.recid = etcitem.item_id
WHERE charId = '$_GET[playerid]'";

echo "<table border=\"0\" cellpadding=\"1\" cellspacing=\"1\" width=\"531\">\n";
echo "<tr>";
if($accesslevel >= 100){
	echo "<td class=\"id\">ID</td>";
}
echo "<td class=\"id\">Icon</td>";
echo "<td class=\"name\">Name</td>";
echo "<td class=\"type\">Level</td>";
echo "<td class=\"weight\">Success</td>";
echo "<td class=\"grade\">MP</td>";

$result = mysql_query($sql, $conn) or die(mysql_error());
$i = 1;
while ($newArray = mysql_fetch_array($result)) {
	$recipe_id = $newArray['item_id'];
	$rid = $newArray['id'];
	$recipe_name = $newArray['name'];
	$recipe_level = $newArray['lvl'];
	$recipe_success = $newArray['success'];
	$recipe_mp = $newArray['mp'];
	if ($i %2){
			$linebg = 'line1';
		}else{
			$linebg = 'line2';
		}
	echo "<tr class=\"$linebg\">";
	if($accesslevel >= 100){
		echo "<td class=\"id\">$recipe_id</td>";
	}
	echo "<td class=\"id\"><img src=\"images/items/$recipe_id.png\"></td>";
	echo "<td class=\"name\"><a href=\"recipe_details.php?recipeid=$rid\">$recipe_name</a></td>";
	echo "<td class=\"type\">$recipe_level</td>";
	echo "<td class=\"weight\">$recipe_success</td>";
	echo "<td class=\"grade\">$recipe_mp</td>";
	echo "</tr>";
	$i ++;	
}
echo "</table>";
dbclose();

include('footer.inc.php');
?>