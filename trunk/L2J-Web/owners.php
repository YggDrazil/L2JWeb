<?php
/**********************************************************************/
/* Project Name.: L2J-Web							*/
/* SVN .........: https://l2j-web.googlecode.com/svn/trunk/L2J-Web/	*/
/* File Name....: owners.php						*/
/* Author.......: Sebastien Gascon						*/
/* Author Email.: sebastien.gascon@gmail.com				*/
/* Created On...: 23/01/2007 10:19:12 PM					*/
/* Last Updated.: 30/07/2010 10:00:20 AM					*/
/**********************************************************************/
include('header.inc.php');
include('config.inc.php');
include('lib.inc.php');


include('menu.php');
include('member.php');

dbconnect();
if (empty($_GET[itemid]) || $accesslevel < 100){
}else{
	$sql = "SELECT 
		items.item_id,
		items.owner_id AS owner,
		clan_data.clan_name AS clan,
		clan_data.clan_level AS clanlevel,
		items.count,
		items.enchant_level,
		characters.char_name,
		characters.account_name,
		characters.level		
		FROM items 
		LEFT JOIN characters ON items.owner_id=characters.charId
		LEFT JOIN clan_data ON items.owner_id=clan_data.clan_id
		WHERE items.item_id = '$_GET[itemid]'";
	
	echo "Owners of item: $_GET[itemid]<br/>";
	echo "<table border=\"0\" cellpadding=\"1\" cellspacing=\"1\">\n";
	echo "<tr>";
	echo "<td class=\"name\">Name</td>";
	echo "<td class=\"level\">Level</td>";
	echo "<td class=\"type\">Count</td>";
	echo "<td class=\"weight\">Enchant</td>";
	echo "</tr>";
	$result = mysql_query($sql, $conn) or die(mysql_error());
	$i = 1;
	while ($newArray = mysql_fetch_array($result)) {
		$owner = $newArray['owner'];
		$owner_count = $newArray['count'];
		$owner_enchant = $newArray['enchant_level'];
		$owner_char = $newArray['char_name'];
		$owner_clan = $newArray['clan'];
		$owner_account = $newArray['account_name'];
		$owner_level = $newArray['level'];
		$owner_clanlvl = $newArray['clanlevel'];
		if ($i %2){
				$linebg = 'line1';
			}else{
				$linebg = 'line2';
			}
		echo "<tr class=\"$linebg\">";
		if(empty($owner_char)){
			echo "<td class=\"name\">Clan: $owner_clan</td>";
		}else{
			echo "<td class=\"name\"><a href=\"player_details.php?playerid=$owner\">$owner_char</a>[$owner_account]</td>";
		}
		echo "<td class=\"type\">$owner_level$owner_clanlvl</td>";
		echo "<td class=\"weight\">$owner_count</td>";
		echo "<td class=\"grade\">$owner_enchant</td>";
		echo "</tr>";
		$i ++;	
	}
	echo "</table>";
}
dbclose();

include('footer.inc.php');
?>