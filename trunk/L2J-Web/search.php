<?php
/**********************************************************************/
/* Project Name.: L2J-Web							*/
/* SVN .........: https://l2j-web.googlecode.com/svn/trunk/L2J-Web/	*/
/* File Name....: search.php						*/
/* Author.......: Sebastien Gascon						*/
/* Author Email.: sebastien.gascon@gmail.com				*/
/* Created On...: 14/08/2010 11:49:28 PM					*/
/* Last Updated.: 15/08/2010 1:32:20 AM					*/
/**********************************************************************/
include('header.inc.php');
include('config.inc.php');
include('lib.inc.php');
include('menu.php');
include('member.php');

echo "<br/><br/>";
//Begin searchbar
echo "<form method=\"post\" action=\"search.php?category=$_GET[category]\">";
echo "<div>";
echo "Search String:";
echo "<input type=\"text\" name=\"sstring\"/>";
echo "  <input type=\"submit\" value=\"Search\"/>";
echo "</div>";
echo "</form>";
//End Searchbar

if (!empty($_POST[sstring])){
	$search_string = $_POST[sstring];
}
if (!empty($_GET[search])){
	$search_string = $_GET[search];
}
if (empty($search_string)){
	include('footer.inc.php');
	exit;
}

dbconnect();
//Set the correct SQL Query
$armor_searchquery = "SELECT * FROM armor WHERE name LIKE '%$search_string%'";
$item_searchquery = "SELECT * FROM etcitem WHERE name LIKE '%$search_string%'";
$monster_searchquery = "SELECT * FROM npc WHERE name LIKE '%$search_string%' and class LIKE 'LineageMonster%'";
$npc_searchquery = "SELECT * FROM npc WHERE name LIKE '%$search_string%' and class LIKE 'LineageNPC%'";
$recipe_searchquery = "SELECT etcitem.item_id, etcitem.name FROM etcitem WHERE name LIKE '%$search_string%' and item_type = 'recipe'";
$spellbook_searchquery = "SELECT * FROM etcitem WHERE name LIKE '%$search_string%' AND item_type = 'Spellbook'";
$weapon_searchquery = "SELECT * FROM weapon WHERE name LIKE '%$search_string%'";

//Set Table Header Columns
$standard_headercolumms = "<td class=\"icon\">Icon</td><td class=\"name\">Name</td><td class=\"grade\">Grade</td>";
$monster_headercolumms = "<td class=\"name\">Name</td><td class=\"type\">Level</td>";
$recipe_headercolumms = "<td class=\"icon\">Icon</td><td class=\"name\">Name</td>";

//Set Table Results Columns
function resultcolumns($set){
	if ($set == "standard"){
		global $id, $name, $grade;
		echo "<td class=\"icon\"><img src=\"images/items/$id.png\"></td>";
		echo "<td class=\"name\"><a href=\"$_GET[category]_details.php?itemid=$id\">$name</a></td>";
		echo "<td class=\"grade\"><img src=\"images/grades/grade_$grade.gif\"></td>";
		}
	if ($set == "monster"){
		global $id, $name, $level;
		echo "<td class=\"name\"><a href=\"$_GET[category]_details.php?mobid=$id\">$name</a></td>";
		echo "<td class=\"level\">$level</td>";
	}
	if ($set == "npc"){
		global $id, $name, $level;
		echo "<td class=\"name\"><a href=\"$_GET[category]_details.php?npcid=$id\">$name</a></td>";
		echo "<td class=\"level\">$level</td>";
	}
	if ($set == "recipe"){
		global $id, $name;
		echo "<td class=\"id\"><img src=\"images/items/$id.png\"></td>";
		echo "<td class=\"name\"><a href=\"$_GET[category]_details.php?recipeitemid=$id\">$name</a></td>";
	}
	if ($set == "spellbook"){
		global $id, $name;
		echo "<td class=\"id\"><img src=\"images/items/$id.png\"></td>";
		echo "<td class=\"name\"><a href=\"$_GET[category]_details.php?itemid=$id\">$name</a></td>";
	}
}
function setvariablesfromsql($set){
	if ($set == "standard"){
		global $id, $name, $grade, $newArray;
		$id = $newArray['item_id'];
		$name = $newArray['name'];
		$grade = $newArray['crystal_type'];
	}
	if ($set == "monster"){
		global $id, $name, $level, $newArray;
		$id = $newArray['id'];
		$name = $newArray['name'];
		$level = $newArray['level'];
	}
	if ($set == "npc"){
		global $id, $name, $level, $newArray;
		$id = $newArray['id'];
		$name = $newArray['name'];
		$level = $newArray['level'];
	}
	if ($set == "recipe"){
		global $id, $name, $newArray;
		$id = $newArray['item_id'];
		$name = $newArray['name'];
	}
	if ($set == "spellbook"){
		global $id, $name, $newArray;
		$id = $newArray['item_id'];
		$name = $newArray['name'];
	}
}

				
if ($_GET[category] == "armor"){
	$sql = $armor_searchquery;
	$column_set = "standard";
	$header_columns = $standard_headercolumms;
}
if ($_GET[category] == "item"){
	$sql = $item_searchquery;
	$column_set = "standard";
	$header_columns = $standard_headercolumms;
}
if ($_GET[category] == "monster"){
	$sql = $monster_searchquery;
	$column_set = "monster";
	$header_columns = $monster_headercolumms;
}
if ($_GET[category] == "npc"){
	$sql = $npc_searchquery;
	$column_set = "npc";
	$header_columns = $monster_headercolumms;
}
if ($_GET[category] == "recipe"){
	$sql = $recipe_searchquery;
	$column_set = "recipe";
	$header_columns = $recipe_headercolumms;
}
if ($_GET[category] == "spellbook"){
	$sql = $spellbook_searchquery;
	$column_set = "spellbook";
	$header_columns = $recipe_headercolumms;
}
if ($_GET[category] == "weapon"){
	$sql = $weapon_searchquery;
	$column_set = "standard";
	$header_columns = $standard_headercolumms;
}
paging();
echo "Search results for \"$search_string\":<br/>";

echo "<table border=\"0\" cellpadding=\"1\" cellspacing=\"1\">\n";
echo "<tr>";
if($accesslevel >= 100){
	echo "<td class=\"id\">ID</td>";
}
echo $header_columns;
echo "</tr>";
$result = mysql_query($sql.$paging, $conn) or die(mysql_error());
$i = 1;
while ($newArray = mysql_fetch_array($result)) {
	setvariablesfromsql($column_set);
		if ($i %2){
			$linebg = 'line1';
		}else{
			$linebg = 'line2';
		}
	echo "<tr class=\"$linebg\">";
	if($accesslevel >= 100){
		echo "<td class=\"id\">$id</td>";
	}
	resultcolumns($column_set);
	echo "</tr>";
	$i ++;	
}
echo "</table>";
printprevnextlink();
dbclose();

include('footer.inc.php');

?>