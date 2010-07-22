<?php
/**********************************************************************/
/* Project Name.: L2J-Web							*/
/* SVN .........: https://l2j-web.googlecode.com/svn/trunk/L2J-Web/	*/
/* File Name....: extractzip.php						*/
/* Author.......: Sebastien Gascon						*/
/* Author Email.: sebastien.gascon@gmail.com				*/
/* Created On...: 22/07/2010 12:23:14 PM					*/
/* Last Updated.: 22/07/2010 12:32:31 PM					*/
/**********************************************************************/

$zip = new ZipArchive;
//Enter the name of the ZIP archive	
$res = $zip->open('test.zip');
     if ($res === TRUE) {
     		//Enter the destination path
	       $zip->extractTo('extract/');
	       $zip->close();
       	echo "ok";
     } else {
     		echo "failed";
	     }
?>