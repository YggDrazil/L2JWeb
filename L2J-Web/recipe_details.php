<?php
/**********************************************************************/
/* Project Name.: L2J-Web							*/
/* SVN .........: https://l2j-web.googlecode.com/svn/trunk/L2J-Web/	*/
/* File Name....: recipe_details.php					*/
/* Author.......: Sebastien Gascon						*/
/* Author Email.: sebastien.gascon@gmail.com				*/
/* Created On...: 06/08/2010 10:03:56 PM					*/
/* Last Updated.: 08/08/2010 2:40:46 PM					*/
/**********************************************************************/
include('header.inc.php');
include('config.inc.php');
include('lib.inc.php');





include('menu.php');
include('member.php');
dbconnect();
if(!empty($_GET[recipeid])){
	$sql = "SELECT 
		l2wh_recipes.id, 
		etcitem.item_id, 
		l2wh_recipes.success, 
		etcitem.name
		FROM  l2wh_recipes
		INNER JOIN etcitem on l2wh_recipes.recid = etcitem.item_id
		WHERE id ='$_GET[recipeid]'";
}
if(!empty($_GET[recipeitemid])){
	$sql = "SELECT 
		l2wh_recipes.id, 
		etcitem.item_id, 
		l2wh_recipes.success, 
		etcitem.name
		FROM  l2wh_recipes
		INNER JOIN etcitem on l2wh_recipes.recid = etcitem.item_id
		WHERE recid ='$_GET[recipeitemid]'";
}

$result = mysql_query($sql, $conn) or die(mysql_error());
echo "<table border=\"0\" cellpadding=\"1\" cellspacing=\"1\" width=\"531\">";
echo "<tr>";
while ($newArray = mysql_fetch_array($result)) {
	$queryid = $newArray['id'];
	$item_id = $newArray['item_id'];
	$recipe_success = $newArray['success'];
	$item_name = $newArray['name'];
	echo "<td><img src=\"images/items/$item_id.png\"> $item_name</td>";
}

echo "</tr>";
echo "<tr>";
echo "<td>";
echo "<ol class=\"tree\">";
listrecipeitems($queryid);
echo "</ol>";
echo "</td>";
echo "</tr>";
echo "</table>";
dbclose();

include('footer.inc.php');
?>