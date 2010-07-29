<?php
/**********************************************************************/
/* Project Name.: L2J-Web							*/
/* SVN .........: https://l2j-web.googlecode.com/svn/trunk/L2J-Web/	*/
/* File Name....: spellbooks.php						*/
/* Author.......: Sebastien Gascon						*/
/* Author Email.: sebastien.gascon@gmail.com				*/
/* Created On...: 23/01/2007 2:35:54 PM					*/
/* Last Updated.: 29/07/2010 11:46:07 AM					*/
/**********************************************************************/
include('header.inc.php');
include('config.inc.php');
include('lib.inc.php');


include('menu.php');
include('member.php');

echo "<br/><br/>";
//Begin searchbar
echo "<form method=\"post\" action=\"spellbooks.php\">";
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
	$sql = "SELECT * FROM etcitem WHERE name LIKE '%$_POST[sstring]%' AND item_type = 'Spellbook' LIMIT 0,1000";
	echo "Search results for \"$_POST[sstring]\":<br/>";

echo "<table border=\"0\" cellpadding=\"1\" cellspacing=\"1\">\n";
echo "<tr>";
if($accesslevel >= 100){
	echo "<td class=\"id\">ID</td>";
}
echo "<td class=\"id\">Icon</td>";
echo "<td class=\"name\">Name</td>";
echo "</tr>";
$result = mysql_query($sql, $conn) or die(mysql_error());
$i = 1;
while ($newArray = mysql_fetch_array($result)) {
	$item_id = $newArray['item_id'];
	$item_name = $newArray['name'];
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
	echo "<td class=\"name\"><a href=\"spellbook_details.php?itemid=$item_id\">$item_name</a></td>";
	echo "</tr>";
	$i ++;	
}
echo "</table>";
}

dbclose();

include('footer.inc.php');
?>