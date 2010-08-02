<?php
/**********************************************************************/
/* Project Name.: L2J-Web							*/
/* SVN .........: https://l2j-web.googlecode.com/svn/trunk/L2J-Web/	*/
/* File Name....: npc.php							*/
/* Author.......: Sebastien Gascon						*/
/* Author Email.: sebastien.gascon@gmail.com				*/
/* Created On...: 26/07/2010 12:16:41 PM					*/
/* Last Updated.: 02/08/2010 2:33:54 PM					*/
/**********************************************************************/
include('header.inc.php');
include('config.inc.php');
include('lib.inc.php');


include('menu.php');
include('member.php');

echo "<br/><br/>";
//Begin searchbar
echo "<form method=\"post\" action=\"npc.php\">";
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
$sql = "SELECT * FROM npc WHERE name LIKE '%$search_string%' and class LIKE 'LineageNPC%'";
paging();
echo "Search results for \"$search_string\":<br/>";

echo "<table border=\"0\" cellpadding=\"1\" cellspacing=\"1\">\n";
echo "<tr>";
if($accesslevel >= 100){
	echo "<td class=\"id\">ID</td>";
}
//echo "<td class=\"id\">Icon</td>";
echo "<td class=\"name\">Name</td>";
echo "<td class=\"type\">Level</td>";
echo "</tr>";
$result = mysql_query($sql.$paging, $conn) or die(mysql_error());
$i = 1;
while ($newArray = mysql_fetch_array($result)) {
	$npc_id = $newArray['id'];
	$npc_name = $newArray['name'];
	$npc_level = $newArray['level'];
	if ($i %2){
			$linebg = 'line1';
		}else{
			$linebg = 'line2';
		}
	echo "<tr class=\"$linebg\">";
	if($accesslevel >= 100){
		echo "<td class=\"id\">$npc_id</td>";
	}
	//echo "<td class=\"id\"><img src=\"images/items/$armor_id.gif\"></td>";
	echo "<td class=\"name\"><a href=\"npc_details.php?npcid=$npc_id\">$npc_name</a></td>";
	echo "<td class=\"level\">$npc_level</td>";
	echo "</tr>";
	$i ++;	
}
echo "</table>";
printprevnextlink();
dbclose();

include('footer.inc.php');
?>