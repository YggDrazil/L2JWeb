<?php
/**********************************************************************/
/* Project Name.: L2J-Web							*/
/* SVN .........: https://l2j-web.googlecode.com/svn/trunk/L2J-Web/	*/
/* File Name....: loadtimeend.php						*/
/* Author.......: Sebastien Gascon						*/
/* Author Email.: sebastien.gascon@gmail.com				*/
/* Created On...: 19/07/2010 5:35:42 PM					*/
/* Last Updated.: 22/07/2010 10:05:32 AM					*/
/**********************************************************************/

// Place this part at the very end of your page 

$time = microtime(); 
$time = explode(" ", $time); 
$time = $time[1] + $time[0]; 
$finish = $time; 
$totaltime = ($finish - $start); 
printf ("This page took %f seconds to load.", $totaltime); 

?>