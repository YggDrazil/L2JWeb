<?php
/**********************************************************************/
/* Project Name.: L2J-Web							*/
/* SVN .........: https://l2j-web.googlecode.com/svn/trunk/L2J-Web/	*/
/* File Name....: armors.php						*/
/* Author.......: Sebastien Gascon						*/
/* Author Email.: sebastien.gascon@gmail.com				*/
/* Created On...: 23/01/2007 3:20:21 PM					*/
/* Last Updated.: 02/08/2010 2:19:41 PM					*/
/**********************************************************************/
include('header.inc.php');
include('config.inc.php');
include('lib.inc.php');


include('menu.php');
include('member.php');

echo "<br/><br/>";
//Begin searchbar
echo "<form method=\"post\" action=\"armors.php\">";
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
$sql = "SELECT * FROM armor WHERE name LIKE '%$search_string%'";
paging();
echo "Search results for \"$search_string\":<br/>";

echo "<table border=\"0\" cellpadding=\"1\" cellspacing=\"1\">\n";
echo "<tr>";
if($accesslevel >= 100){
	echo "<td class=\"id\">ID</td>";
}
echo "<td class=\"id\">Icon</td>";
echo "<td class=\"name\">Name</td>";
echo "<td class=\"type\">Type</td>";
echo "<td class=\"weight\">Weight</td>";
echo "<td class=\"grade\">Grade</td>";
echo "<td class=\"pdef\">P.Def</td>";
echo "<td class=\"mdef\">M.Def</td>";
echo "<td class=\"mp\">MP</td>";
echo "</tr>";
$result = mysql_query($sql.$paging, $conn) or die(mysql_error());
$i = 1;
while ($newArray = mysql_fetch_array($result)) {
	$armor_id = $newArray['item_id'];
	$armor_name = $newArray['name'];
	$armor_type = $newArray['armor_type'];
	$armor_weight = $newArray['weight'];
	$armor_grade = $newArray['crystal_type'];
	$armor_pdef = $newArray['p_def'];
	$armor_mdef = $newArray['m_def'];
	$armor_mpbonus = $newArray['mp_bonus'];
	$armor_price = $newArray['price'];
	
	if ($i %2){
			$linebg = 'line1';
		}else{
			$linebg = 'line2';
		}
	echo "<tr class=\"$linebg\">";
	if($accesslevel >= 100){
		echo "<td class=\"id\">$armor_id</td>";
	}
	echo "<td class=\"id\"><img src=\"images/items/$armor_id.png\"></td>";
	echo "<td class=\"name\"><a href=\"armor_details.php?itemid=$armor_id\">$armor_name</a></td>";
	echo "<td class=\"type\">$armor_type</td>";
	echo "<td class=\"weight\">$armor_weight</td>";
	echo "<td class=\"grade\"><img src=\"images/grades/grade_$armor_grade.gif\"></td>";
	echo "<td class=\"pdef\">$armor_pdef</td>";
	echo "<td class=\"mdef\">$armor_mdef</td>";
	echo "<td class=\"mp\">$armor_mpbonus</td>";
	echo "</tr>";
	$i ++;	
}
echo "</table>";
printprevnextlink();
dbclose();

include('footer.inc.php');
?>