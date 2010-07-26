<?php
/**********************************************************************/
/* Project Name.: L2J-Web							*/
/* SVN .........: https://l2j-web.googlecode.com/svn/trunk/L2J-Web/	*/
/* File Name....: npc_details.php						*/
/* Author.......: Sebastien Gascon						*/
/* Author Email.: sebastien.gascon@gmail.com				*/
/* Created On...: 26/07/2010 12:25:37 PM					*/
/* Last Updated.: 26/07/2010 12:25:40 PM					*/
/**********************************************************************/
include('header.inc.php');
include('config.inc.php');
include('lib.inc.php');


include('menu.php');
include('member.php');

if (empty($_GET[npcid])){
	echo "nothing";
	exit;
}
dbconnect();
$sql = "SELECT COUNT(*) AS count FROM npc WHERE id = '$_GET[npcid]'";
$result = mysql_query($sql, $conn) or die(mysql_error());
while ($newArray = mysql_fetch_array($result)) {
	$item_count = $newArray['count'];
}
$sql = "SELECT * FROM npc WHERE id = '$_GET[npcid]' LIMIT 0,1";
echo "<table border=\"0\" cellpadding=\"1\" cellspacing=\"1\" width=\"587\">\n";
echo "<tr>";
if($accesslevel >= 100){
	echo "<td class=\"id\">ID</td>";
}
echo "<td class=\"name\">Name</td>";
echo "<td class=\"level\">Level</td>";
echo "</tr>";
$result = mysql_query($sql, $conn) or die(mysql_error());
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
	if($accesslevel >= 0){
		echo "<td class=\"id\">$npc_id</td>";
	}
	echo "<td class=\"name\"><a href=\"map.php?mobid=$npc_id\">$npc_name</a></td>";
	echo "<td class=\"level\">$npc_level</td>";
	echo "</tr>";
	$i ++;	
}
echo "</table>";


echo "</table>";
dbclose();

include('footer.inc.php');
?>