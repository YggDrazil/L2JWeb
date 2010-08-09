<?php
/**********************************************************************/
/* Project Name.: L2J-Web							*/
/* SVN .........: https://l2j-web.googlecode.com/svn/trunk/L2J-Web/	*/
/* File Name....: menu.php							*/
/* Author.......: Sebastien Gascon						*/
/* Author Email.: sebastien.gascon@gmail.com				*/
/* Created On...: 25/01/2007 9:09:42 AM					*/
/* Last Updated.: 08/08/2010 2:30:13 PM					*/
/**********************************************************************/
echo "<table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" background=\"images/header/hmm.jpg\">";
echo "<tr>";
echo "<td width=\"361\" height=\"224\" valign=\"top\" colspan=\"5\"><img src=\"images/header/A.jpg\" width=\"361\" height=\"224\"></td>";
echo "<td width=\"100%\" align=\"center\" valign=\"top\"><img src=\"header_status.php\" width=\"107\" height=\"224\"></td>";
echo "<td width=\"361\" height=\"224\" valign=\"top\" colspan=\"2\"><img src=\"images/header/C.jpg\" width=\"361\" height=\"224\"></td>";
echo "</tr>";
echo "<tr>";
echo "<td width=\"43\" height=\"33\" valign=\"top\"><img src=\"images/header/D.jpg\" width=\"43\" height=\"33\"></td>";
echo "<td width=\"82\" height=\"33\" valign=\"top\"><a href=\"index.php\"><img src=\"images/header/E.jpg\" width=\"82\" height=\"33\" border=\"0\"></a></td>";
echo "<td width=\"75\" height=\"33\" valign=\"top\"><img src=\"images/header/F.jpg\" width=\"75\" height=\"33\"></td>";
echo "<td width=\"75\" height=\"33\" valign=\"top\"><img src=\"images/header/G.jpg\" width=\"75\" height=\"33\"></td>";
echo "<td width=\"87\" height=\"33\" valign=\"top\"><img src=\"images/header/H.jpg\" width=\"87\" height=\"33\"></td>";
echo "<td width=\"100%\" align=\"center\" valign=\"top\"><img src=\"images/header/I.jpg\" width=\"107\" height=\"33\"></td>";
echo "<td width=\"213\" height=\"33\" valign=\"top\"><img src=\"images/header/J.jpg\" width=\"213\" height=\"33\"></td>";
echo "<td width=\"149\" height=\"33\" valign=\"top\"><img src=\"images/header/K.jpg\" width=\"149\" height=\"33\"></td>";
echo "</tr>";
echo "<tr>";
echo "<td width=\"361\" height=\"43\" valign=\"top\" colspan=\"5\"><img src=\"images/header/L.jpg\" width=\"361\" height=\"43\"></td>";
echo "<td width=\"100%\" align=\"center\" valign=\"top\"><img src=\"images/header/M.jpg\" width=\"107\" height=\"43\"></td>";
echo "<td width=\"361\" height=\"43\" valign=\"top\" colspan=\"2\"><img src=\"images/header/N.jpg\" width=\"361\" height=\"43\"></td>";
echo "</tr>";
echo "</table>";


//echo "<img src=\"http://www.wydgaming.com/blocks/gameservers_image/l2.php\"><br/>";
echo "<style media=\"all\" type=\"text/css\">@import \"css/menu_style.css\";</style>";
echo "<!--[if IE]>";
echo "	<style media=\"all\" type=\"text/css\">@import \"css/ie.css\";</style>";
echo "<![endif]-->";
echo "<div class=\"nav\">";
echo "<div class=\"table\">";
echo "<ul class=\"select\"><li><a href=\"index.php\" target=\"_self\"><b>Home</b></a>";
echo "</li>";
echo "</ul>";
echo "<ul class=\"select\"><li><a href=\"online.php\" target=\"_self\"><b>Online</b></a>";
echo "</li>";
echo "</ul>";
echo "<ul class=\"select\"><li><a href=\"players.php\" target=\"_self\"><b>Players</b></a>";
echo "</li>";
echo "</ul>";
echo "<ul class=\"select\"><li><a href=\"npc.php\" target=\"_self\"><b>NPC</b></a>";
echo "<div class=\"select_sub\">";
echo "<ul class=\"sub\">";
echo "<li><a href=\"monsters.php\" target=\"_self\">Mobs</a></li>";
echo "</ul>";
echo "</div>";
echo "</li>";
echo "</ul>";
echo "<ul class=\"select\"><li><a href=\"items.php\" target=\"_self\"><b>Items</b></a>";
echo "<div class=\"select_sub\">";
echo "<ul class=\"sub\">";
echo "<li><a href=\"armors.php\" target=\"_self\">Armors</a></li>";
echo "<li><a href=\"weapons.php\" target=\"_self\">Weapons</a></li>";
echo "<li><a href=\"spellbooks.php\" target=\"_self\">Spellbooks</a></li>";
echo "</ul>";
echo "</div>";
echo "</li>";
echo "</ul>";
echo "<ul class=\"select\"><li><a href=\"recipes.php\" target=\"_self\"><b>Recipes</b></a>";
echo "</li>";
echo "</ul>";
echo "<ul class=\"select\"><li><a href=\"crystals.php\" target=\"_self\"><b>Crystals</b></a>";
echo "</li>";
echo "</ul>";
echo "<ul class=\"select\"><li><a href=\"logout.php\" target=\"_self\"><b>Logout</b></a>";
echo "</li>";
echo "</ul>";
echo "</div>";
echo "</div>";

?>