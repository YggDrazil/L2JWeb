<?php
/**********************************************************************/
/* Project Name.: L2J-Web							*/
/* SVN .........: https://l2j-web.googlecode.com/svn/trunk/L2J-Web/	*/
/* File Name....: filemove.php						*/
/* Author.......: Sebastien Gascon						*/
/* Author Email.: sebastien.gascon@gmail.com				*/
/* Created On...: 04/01/2007 10:50:04 AM					*/
/* Last Updated.: 22/07/2010 1:00:31 PM					*/
/**********************************************************************/

$operation = rename("test.zip", "extract/mytest.zip");
$operation;
if ($operation === TRUE) {
	echo "OK";
}else{
	echo "failed";
}

?>