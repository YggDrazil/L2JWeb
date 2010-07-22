<?php
/**********************************************************************/
/* Project Name.: L2J-Web							*/
/* SVN .........: https://l2j-web.googlecode.com/svn/trunk/L2J-Web/	*/
/* File Name....: logout.php						*/
/* Author.......: Sebastien Gascon						*/
/* Author Email.: sebastien.gascon@gmail.com				*/
/* Created On...: 09/01/2007 10:45:05 PM					*/
/* Last Updated.: 22/07/2010 10:46:55 AM					*/
/**********************************************************************/
$past = time() - 100;
//this makes the time in the past to destroy the cookie
setcookie(WYDL2j, gone, $past, '/', 'wydgaming.com');
setcookie(WYDL2jkey, gone, $past, '/', 'wydgaming.com');
setcookie(WYDL2jAL, gone, $past, '/', 'wydgaming.com');
header("Location: index.php");
?>