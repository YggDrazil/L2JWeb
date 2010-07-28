<?php
/**********************************************************************/
/* Project Name.: L2J-Web							*/
/* SVN .........: https://l2j-web.googlecode.com/svn/trunk/L2J-Web/	*/
/* File Name....: items.php							*/
/* Author.......: Sebastien Gascon						*/
/* Author Email.: sebastien.gascon@gmail.com				*/
/* Created On...: 23/01/2007 3:53:45 PM					*/
/* Last Updated.: 26/07/2010 12:51:39 PM					*/
/**********************************************************************/
include('header.inc.php');
include('config.inc.php');
include('lib.inc.php');


include('menu.php');
include('member.php');

echo "<br/><br/>";
//Begin searchbar
echo "<form method=\"post\" action=\"items.php\">";
echo "<div>";
echo "Search String:";
echo "<input type=\"text\" name=\"sstring\"/>";
echo "  <input type=\"submit\" value=\"Search\"/>";
echo "</div>";
echo "</form>";
//End Searchbar





dbconnect();
if (empty($_POST[sstring])){
}else{
	$sql = "SELECT * FROM etcitem WHERE name LIKE '%$_POST[sstring]%' LIMIT 0,1000";
	echo "Search results for \"$_POST[sstring]\":<br/>";

echo "<table border=\"0\" cellpadding=\"1\" cellspacing=\"1\" width=\"570\">\n";
echo "<tr>";
if($accesslevel >= 100){
	echo "<td class=\"id\">ID</td>";
}
echo "<td class=\"id\">Icon</td>";
echo "<td class=\"name\">Name</td>";
echo "<td class=\"type\">Type</td>";
echo "<td class=\"weight\">Weight</td>";
echo "<td class=\"grade\">Grade</td>";
echo "</tr>";
$result = mysql_query($sql, $conn) or die(mysql_error());
$i = 1;
while ($newArray = mysql_fetch_array($result)) {
	$item_id = $newArray['item_id'];
	$item_name = $newArray['name'];
	$item_type = $newArray['item_type'];
	$item_weight = $newArray['weight'];
	$item_grade = $newArray['crystal_type'];
	$item_price = $newArray['price'];
	
	if ($i %2){
			$linebg = 'line1';
		}else{
			$linebg = 'line2';
		}
	echo "<tr class=\"$linebg\">";
	if($accesslevel >= 100){
		echo "<td class=\"id\">$item_id</td>";
	}
	echo "<td class=\"id\"><img src=\"images/items/$item_id.png\"></td>";
	echo "<td class=\"name\"><a href=\"item_details.php?itemid=$item_id\">$item_name</a></td>";
	echo "<td class=\"type\">$item_type</td>";
	echo "<td class=\"weight\">$item_weight</td>";
	echo "<td class=\"grade\">$item_grade</td>";
	echo "</tr>";
	$i ++;	
}
echo "</table>";
}
dbclose();

include('footer.inc.php');
?>