<?php
/**********************************************************************/
/* Project Name.: L2J-Web							*/
/* SVN .........: https://l2j-web.googlecode.com/svn/trunk/L2J-Web/	*/
/* File Name....: paperdoll.php						*/
/* Author.......: Sebastien Gascon						*/
/* Author Email.: sebastien.gascon@gmail.com				*/
/* Created On...: 23/01/2007 8:00:02 PM					*/
/* Last Updated.: 22/07/2010 10:40:52 AM					*/
/**********************************************************************/

$sql = "SELECT 
		items.item_id,
		loc_data,
		bodypart,
		name
	FROM items 
	LEFT JOIN (armor) ON (items.item_id=armor.item_id)
	WHERE owner_id = '$playerid' AND loc = 'PAPERDOLL'";
	
$result = mysql_query($sql, $conn) or die(mysql_error());
while ($paperdoll = mysql_fetch_array($result)) {
	if($paperdoll['loc_data'] == 1){
		$paperdoll_slot12 = "images/items/".$paperdoll['item_id'].".png";
		$paperdoll_slot12_name = $paperdoll['name'];
	}
	elseif($paperdoll['loc_data'] == 2){
		$paperdoll_slot13 = "images/items/".$paperdoll['item_id'].".png";
		$paperdoll_slot13_name = $paperdoll['name'];
	}
	elseif($paperdoll['loc_data'] == 3){
		$paperdoll_slot11 = "images/items/".$paperdoll['item_id'].".png";
		$paperdoll_slot11_name = $paperdoll['name'];
	}
	elseif($paperdoll['loc_data'] == 4){
		$paperdoll_slot14 = "images/items/".$paperdoll['item_id'].".png";
		$paperdoll_slot14_name = $paperdoll['name'];
	}
	elseif($paperdoll['loc_data'] == 5){
		$paperdoll_slot15 = "images/items/".$paperdoll['item_id'].".png";
		$paperdoll_slot15_name = $paperdoll['name'];
	}
	elseif($paperdoll['loc_data'] == 6){
		$paperdoll_slot2 = "images/items/".$paperdoll['item_id'].".png";
		$paperdoll_slot2_name = $paperdoll['name'];
	}
	elseif($paperdoll['loc_data'] == 7){
		$paperdoll_slot4 = "images/items/".$paperdoll['item_id'].".png";
		$paperdoll_slot4_name = $paperdoll['name'];
	}
	elseif($paperdoll['loc_data'] == 8){
		$paperdoll_slot6 = "images/items/".$paperdoll['item_id'].".png";
		$paperdoll_slot6_name = $paperdoll['name'];
	}
	elseif($paperdoll['loc_data'] == 9){
		$paperdoll_slot7 = "images/items/".$paperdoll['item_id'].".png";
		$paperdoll_slot7_name = $paperdoll['name'];
	}
	elseif($paperdoll['loc_data'] == 10 && $paperdoll['bodypart'] == 'chest'){
		$paperdoll_slot5 = "images/items/".$paperdoll['item_id'].".png";
		$paperdoll_slot5_name = $paperdoll['name'];
	}
	elseif($paperdoll['loc_data'] == 10 && $paperdoll['bodypart'] == 'fullarmor'){
		$paperdoll_slot5 = "images/items/".$paperdoll['item_id']."-u.png";
		$paperdoll_slot5_name = $paperdoll['name'];
		$paperdoll_slot8 = "images/items/".$paperdoll['item_id']."-l.png";
		$paperdoll_slot8_name = $paperdoll['name'];
	}
	elseif($paperdoll['loc_data'] == 11){
		$paperdoll_slot8 = "images/items/".$paperdoll['item_id'].".png";
		$paperdoll_slot8_name = $paperdoll['name'];
	}
	elseif($paperdoll['loc_data'] == 12){
		$paperdoll_slot9 = "images/items/".$paperdoll['item_id'].".png";
		$paperdoll_slot9_name = $paperdoll['name'];
	}
	elseif($paperdoll['loc_data'] == 13){
		$paperdoll_slot10 = "images/items/".$paperdoll['item_id'].".png";
		$paperdoll_slot10_name = $paperdoll['name'];
	}
	elseif($paperdoll['loc_data'] == 14){
		$paperdoll_slot4 = "images/items/".$paperdoll['item_id'].".png";
		$paperdoll_slot4_name = $paperdoll['name'];
		$paperdoll_slot6 = "images/items/".$paperdoll['item_id'].".png";
		$paperdoll_slot6_name = $paperdoll['name'];
	}
	elseif($paperdoll['loc_data'] == 15){
		$paperdoll_slot3 = "images/items/".$paperdoll['item_id'].".png";
		$paperdoll_slot3_name = $paperdoll['name'];
	}
	elseif($paperdoll['loc_data'] == 16){
		$paperdoll_slot1 = "images/items/".$paperdoll['item_id'].".png";
		$paperdoll_slot1_name = $paperdoll['name'];
	}
	elseif($paperdoll['loc_data'] == 17){
		$paperdoll_slot1 = "images/items/".$paperdoll['item_id'].".png";
		$paperdoll_slot1_name = $paperdoll['name'];
		$paperdoll_slot3 = "images/items/".$paperdoll['item_id'].".png";
		$paperdoll_slot3_name = $paperdoll['name'];
	}
}

	if(empty($paperdoll_slot1)){
		$paperdoll_slot1 = "images/paperdoll/paperdoll-1.gif";
	}
	if(empty($paperdoll_slot2)){
		$paperdoll_slot2 = "images/paperdoll/paperdoll-2.gif";
	}
	if(empty($paperdoll_slot3)){
		$paperdoll_slot3 = "images/paperdoll/paperdoll-3.gif";
	}
	if(empty($paperdoll_slot4)){
		$paperdoll_slot4 = "images/paperdoll/paperdoll-4.gif";
	}
	if(empty($paperdoll_slot5)){
		$paperdoll_slot5 = "images/paperdoll/paperdoll-5.gif";
	}
	if(empty($paperdoll_slot6)){
		$paperdoll_slot6 = "images/paperdoll/paperdoll-6.gif";
	}
	if(empty($paperdoll_slot7)){
		$paperdoll_slot7 = "images/paperdoll/paperdoll-7.gif";
	}
	if(empty($paperdoll_slot8)){
		$paperdoll_slot8 = "images/paperdoll/paperdoll-8.gif";
	}
	if(empty($paperdoll_slot9)){
		$paperdoll_slot9 = "images/paperdoll/paperdoll-9.gif";
	}
	if(empty($paperdoll_slot10)){
		$paperdoll_slot10 = "images/paperdoll/paperdoll-10.gif";
	}
	if(empty($paperdoll_slot11)){
		$paperdoll_slot11 = "images/paperdoll/paperdoll-11.gif";
	}
	if(empty($paperdoll_slot12)){
		$paperdoll_slot12 = "images/paperdoll/paperdoll-12.gif";
	}
	if(empty($paperdoll_slot13)){
		$paperdoll_slot13 = "images/paperdoll/paperdoll-13.gif";
	}
	if(empty($paperdoll_slot14)){
		$paperdoll_slot14 = "images/paperdoll/paperdoll-14.gif";
	}
	if(empty($paperdoll_slot15)){
		$paperdoll_slot15 = "images/paperdoll/paperdoll-15.gif";
	}

echo "<table border=\"0\" cellpadding=\"1\" cellspacing=\"1\">\n";
echo "<tr class=\"line2\">";
echo "<td><img src=\"$paperdoll_slot1\" title=\"$paperdoll_slot1_name\"></td>";
echo "<td><img src=\"$paperdoll_slot2\" title=\"$paperdoll_slot2_name\"></td>";
echo "<td><img src=\"$paperdoll_slot3\" title=\"$paperdoll_slot3_name\"></td>";
echo "<td>&nbsp;</td>";
echo "<td><img src=\"$paperdoll_slot10\" title=\"$paperdoll_slot10_name\"></td>";
echo "<td><img src=\"$paperdoll_slot11\" title=\"$paperdoll_slot11_name\"></td>";
echo "</tr>";
echo "<tr class=\"line2\">";
echo "<td><img src=\"$paperdoll_slot4\" title=\"$paperdoll_slot4_name\"></td>";
echo "<td><img src=\"$paperdoll_slot5\" title=\"$paperdoll_slot5_name\"></td>";
echo "<td><img src=\"$paperdoll_slot6\" title=\"$paperdoll_slot6_name\"></td>";
echo "<td>&nbsp;</td>";
echo "<td><img src=\"$paperdoll_slot12\" title=\"$paperdoll_slot12_name\"></td>";
echo "<td><img src=\"$paperdoll_slot13\" title=\"$paperdoll_slot13_name\"></td>";
echo "</tr>";
echo "<tr class=\"line2\">";
echo "<td><img src=\"$paperdoll_slot7\" title=\"$paperdoll_slot7_name\"></td>";
echo "<td><img src=\"$paperdoll_slot8\" title=\"$paperdoll_slot8_name\"></td>";
echo "<td><img src=\"$paperdoll_slot9\" title=\"$paperdoll_slot9_name\"></td>";
echo "<td>&nbsp;</td>";
echo "<td><img src=\"$paperdoll_slot14\" title=\"$paperdoll_slot14_name\"></td>";
echo "<td><img src=\"$paperdoll_slot15\" title=\"$paperdoll_slot15_name\"></td>";
echo "</tr>";
echo "</table>";
echo "";
echo "";



?>