<?php
/**********************************************************************/
/* Project Name.: L2J-Web							*/
/* SVN .........: https://l2j-web.googlecode.com/svn/trunk/L2J-Web/	*/
/* File Name....: crystals.php						*/
/* Author.......: Sebastien Gascon						*/
/* Author Email.: sebastien.gascon@gmail.com				*/
/* Created On...: 30/07/2010 1:07:45 PM					*/
/* Last Updated.: 31/07/2010 1:23:07 AM					*/
/**********************************************************************/
include('header.inc.php');
include('config.inc.php');
include('lib.inc.php');


include('menu.php');
include('member.php');

echo "<br/><br/>";
//Begin searchbar
echo "<form method=\"post\" action=\"crystals.php\">";
echo "<div>";
echo "Search String:";
echo "<input type=\"text\" name=\"sstring\"/>";
echo "<SELECT name=\"grade\">";
echo "<OPTION selected label=\"All\" value=\"all\">all</OPTION>";
echo "<OPTION label=\"D\" value=\"D\">D-Grade</OPTION>";
echo "<OPTION label=\"C\" value=\"C\">C-Grade</OPTION>";
echo "<OPTION label=\"B\" value=\"B\">B-Grade</OPTION>";
echo "<OPTION label=\"A\" value=\"A\">A-Grade</OPTION>";
echo "<OPTION label=\"S\" value=\"S\">S-Grade</OPTION>";
echo "</SELECT>";
echo "  <input type=\"submit\" value=\"Search\"/>";
echo "</div>";
echo "</form>";
//End Searchbar





dbconnect();
if (!empty($_POST[grade])){
	$search_grade = $_POST[grade];
}
if (!empty($_GET[grade])){
	$search_grade = $_GET[grade];
}
if (!empty($_POST[sstring])){
	$search_string = $_POST[sstring];
}
if (!empty($_GET[search])){
	$search_string = $_GET[search];
}
if ($search_grade == 'all'){
	$condition = "";
}else{
	$condition = "AND crystal_type = '$search_grade'";
}

$sql = "SELECT 
	item_id, 
	name, 
	crystallizable, 
	crystal_type, 
	crystal_count 
	FROM armor
	WHERE name LIKE '%$search_string%' $condition AND crystallizable = 'true'
	UNION
	SELECT 
	item_id, 
	name, 
	crystallizable, 
	crystal_type, 
	crystal_count 
	FROM weapon 
	WHERE name LIKE '%$search_string%' $condition AND crystallizable = 'true'
	";
paging();

if (empty($search_string)){
	exit;
}
echo "Search results for \"$search_string\":<br/>";

echo "<table border=\"0\" cellpadding=\"1\" cellspacing=\"1\">\n";
echo "<tr>";
if($accesslevel >= 100){
	echo "<td class=\"id\">ID</td>";
}
echo "<td class=\"id\">Icon</td>";
echo "<td class=\"name\">Name</td>";
echo "<td class=\"type\">Grade</td>";
echo "<td class=\"weight\">Crystals</td>";
echo "</tr>";
$result = mysql_query($sql.$paging, $conn) or die(mysql_error());
//

//
$i = 1;
while ($newArray = mysql_fetch_array($result)) {
	$row_count = $newArray['count'];
	$item_id = $newArray['item_id'];
	$item_name = $newArray['name'];
	$crystal_type = $newArray['crystal_type'];
	$crystal_count = $newArray['crystal_count'];
		
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
	echo "<td class=\"name\">$item_name</td>";
	echo "<td class=\"type\">$crystal_type</td>";
	echo "<td class=\"weight\">$crystal_count</td>";
	echo "</tr>";
	$i ++;	
}
echo "</table>";
//
printprevnextlink();
//

echo "<br/>";
dbclose();

include('footer.inc.php');
?>