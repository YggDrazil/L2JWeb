<?php
/**********************************************************************/
/* Project Name.: L2J-Web							*/
/* SVN .........: https://l2j-web.googlecode.com/svn/trunk/L2J-Web/	*/
/* File Name....: loadtimestart.php					*/
/* Author.......: Sebastien Gascon						*/
/* Author Email.: sebastien.gascon@gmail.com				*/
/* Created On...: 19/07/2010 5:35:42 PM					*/
/* Last Updated.: 22/07/2010 10:05:35 AM					*/
/**********************************************************************/


// Insert this block of code at the very top of your page: 

$time = microtime(); 
$time = explode(" ", $time); 
$time = $time[1] + $time[0]; 
$start = $time; 

?>