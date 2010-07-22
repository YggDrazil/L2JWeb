<?php
/**********************************************************************/
/* Project Name.: L2J-Web							*/
/* SVN .........: https://l2j-web.googlecode.com/svn/trunk/L2J-Web/	*/
/* File Name....: monsters.php						*/
/* Author.......: Sebastien Gascon						*/
/* Author Email.: sebastien.gascon@gmail.com				*/
/* Created On...: 14/07/2010 10:38:29 AM					*/
/* Last Updated.: 22/07/2010 10:40:07 AM					*/
/**********************************************************************/
include('header.inc.php');
include('config.inc.php');
include('lib.inc.php');


include('menu.php');
include('member.php');

echo "<br/><br/>";
//Begin searchbar
echo "<form method=\"post\" action=\"monsters.php\">";
echo "<div>";
echo "Search String:";
echo "<input type=\"text\" name=\"sstring\"/>";
echo "  <input type=\"submit\" value=\"Search\"/>";
echo "</div>";
echo "</form>";
//End Searchbar





dbconnect();
if (empty($_POST[sstring])){
	echo "Please Enter Search String\n";
}else{
	$sql = "SELECT * FROM npc WHERE name LIKE '%$_POST[sstring]%' LIMIT 0,1000";
	echo "Search results for \"$_POST[sstring]\":<br/>";

echo "<table border=\"0\" cellpadding=\"1\" cellspacing=\"1\">\n";
echo "<tr>";
if($accesslevel >= 100){
	echo "<td class=\"id\">ID</td>";
}
//echo "<td class=\"id\">Icon</td>";
echo "<td class=\"name\">Name</td>";
echo "<td class=\"type\">Level</td>";
echo "</tr>";
$result = mysql_query($sql, $conn) or die(mysql_error());
$i = 1;
while ($newArray = mysql_fetch_array($result)) {
	$mob_id = $newArray['id'];
	$mob_name = $newArray['name'];
	$mob_level = $newArray['level'];
	if ($i %2){
			$linebg = 'line1';
		}else{
			$linebg = 'line2';
		}
	echo "<tr class=\"$linebg\">";
	if($accesslevel >= 100){
		echo "<td class=\"id\">$mob_id</td>";
	}
	//echo "<td class=\"id\"><img src=\"images/items/$armor_id.gif\"></td>";
	echo "<td class=\"name\"><a href=\"monster_details.php?mobid=$mob_id\">$mob_name</a></td>";
	echo "<td class=\"level\">$mob_level</td>";
	echo "</tr>";
	$i ++;	
}
echo "</table>";
}
dbclose();

include('footer.inc.php');
?>