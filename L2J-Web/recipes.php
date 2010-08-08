<?php
/**********************************************************************/
/* Project Name.: L2J-Web							*/
/* SVN .........: https://l2j-web.googlecode.com/svn/trunk/L2J-Web/	*/
/* File Name....: recipes.php						*/
/* Author.......: Sebastien Gascon						*/
/* Author Email.: sebastien.gascon@gmail.com				*/
/* Created On...: 08/08/2010 2:22:47 PM					*/
/* Last Updated.: 08/08/2010 2:22:49 PM					*/
/**********************************************************************/
include('header.inc.php');
include('config.inc.php');
include('lib.inc.php');

include('menu.php');
include('member.php');

echo "<br/><br/>";
//Begin searchbar
echo "<form method=\"post\" action=\"recipes.php\">";
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

dbconnect();
if (empty($search_string)){
	include('footer.inc.php');
	exit;
}
paging();
echo "Search results for \"$search_string\":<br/>";
$sql = "SELECT etcitem.item_id, etcitem.name FROM etcitem WHERE name LIKE '%$search_string%' and item_type = 'recipe'";


echo "<table border=\"0\" cellpadding=\"1\" cellspacing=\"1\" width=\"531\">\n";
echo "<tr>";
if($accesslevel >= 100){
	echo "<td class=\"id\">ID</td>";
}
echo "<td class=\"id\">Icon</td>";
echo "<td class=\"name\">Name</td>";

$result = mysql_query($sql, $conn) or die(mysql_error());
$i = 1;
while ($newArray = mysql_fetch_array($result)) {
	$recipe_id = $newArray['item_id'];
	$recipe_name = $newArray['name'];
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
	echo "<td class=\"name\"><a href=\"recipe_details.php?recipeitemid=$recipe_id\">$recipe_name</a></td>";
	echo "</tr>";
	$i ++;	
}
echo "</table>";
dbclose();

include('footer.inc.php');
?>