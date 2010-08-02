<?php
/**********************************************************************/
/* Project Name.: L2J-Web							*/
/* SVN .........: https://l2j-web.googlecode.com/svn/trunk/L2J-Web/	*/
/* File Name....: weapons.php						*/
/* Author.......: Sebastien Gascon						*/
/* Author Email.: sebastien.gascon@gmail.com				*/
/* Created On...: 23/01/2007 3:48:24 PM					*/
/* Last Updated.: 02/08/2010 11:53:12 AM					*/
/**********************************************************************/
include('header.inc.php');
include('config.inc.php');
include('lib.inc.php');


include('menu.php');
include('member.php');

echo "<br/><br/>";
//Begin searchbar
echo "<form method=\"post\" action=\"weapons.php\">";
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
	$sql = "SELECT * FROM weapon WHERE name LIKE '%$_POST[sstring]%' LIMIT 0,1000";
	echo "Search results for \"$_POST[sstring]\":<br/>";

echo "<table border=\"0\" cellpadding=\"1\" cellspacing=\"1\">\n";
echo "<tr>";
if($accesslevel >= 100){
	echo "<td class=\"id\">ID</td>";
}
echo "<td class=\"id\">Icon</td>";
echo "<td class=\"name\">Name</td>";
echo "<td class=\"type\">Type</td>";
echo "<td class=\"grade\">Grade</td>";
echo "<td class=\"pmatk\">P./M.Atk</td>";
echo "<td class=\"ssspsmp\">SS/SpS/MP</td>";
echo "<td class=\"speed\">Speed</td>";
echo "<td class=\"weight\">Weight</td>";
echo "</tr>";
$result = mysql_query($sql, $conn) or die(mysql_error());
$i = 1;
while ($newArray = mysql_fetch_array($result)) {
	$weapon_id = $newArray['item_id'];
	$weapon_name = $newArray['name'];
	$weapon_type = $newArray['weaponType'];
	$weapon_grade = $newArray['crystal_type'];
	$weapon_patk = $newArray['p_dam'];
	$weapon_matk = $newArray['m_dam'];
	$weapon_soulshots = $newArray['soulshots'];
	$weapon_spiritshots = $newArray['spiritshots'];
	$weapon_mpconsume = $newArray['mp_consume'];
	$weapon_atkspeed = $newArray['atk_speed'];
	$weapon_weight = $newArray['weight'];
	$weapon_price = $newArray['price'];
	
	if ($i %2){
			$linebg = 'line1';
		}else{
			$linebg = 'line2';
		}
	
	echo "<tr class=\"$linebg\">";
	if($accesslevel >= 100){
		echo "<td class=\"id\">$weapon_id</td>";
	}
	echo "<td class=\"id\"><img src=\"images/items/$weapon_id.png\"></td>";
	echo "<td class=\"name\"><a href=\"weapon_details.php?itemid=$weapon_id\">$weapon_name</a></td>";
	echo "<td class=\"type\">$weapon_type</td>";
	echo "<td class=\"grade\"><img src=\"images/grades/grade_$weapon_grade.gif\"></td>";
	echo "<td class=\"pmatk\">$weapon_patk/$weapon_matk</td>";
	echo "<td class=\"ssspsmp\">x$weapon_soulshots/x$weapon_spiritshots/$weapon_mpconsume</td>";
	echo "<td class=\"speed\">$weapon_atkspeed</td>";
	echo "<td class=\"weight\">$weapon_weight</td>";
	echo "</tr>";
	$i ++;
}
echo "</table>";
}
dbclose();

include('footer.inc.php');
?>