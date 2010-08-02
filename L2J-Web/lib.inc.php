<?php
/**********************************************************************/
/* Project Name.: L2J-Web							*/
/* SVN .........: https://l2j-web.googlecode.com/svn/trunk/L2J-Web/	*/
/* File Name....: lib.inc.php						*/
/* Author.......: Sebastien Gascon						*/
/* Author Email.: sebastien.gascon@gmail.com				*/
/* Created On...: 22/01/2007 11:37:24 PM					*/
/* Last Updated.: 31/07/2010 1:23:00 AM					*/
/**********************************************************************/

/** Establishing the DB Connection **/
function dbconnect(){
	global $dbhost, $dbuser, $dbpass, $conn, $dbname;
	$conn = mysql_connect($dbhost, $dbuser, $dbpass);
	/** Selecting the good DB **/
	mysql_select_db($dbname) or die(mysql_error());
}

function dbclose(){
	global $conn;
	mysql_close($conn);
}
function createloc(){
	global $resultx, $resulty, $currentx, $currenty;
	// The Dimensions of the images you wish to use
	$xi_min = 96;  // the starting X pixel of your image 
	$xi_max = 749; // the end X pixel of your image
	$yi_min = 14;  // the starting Y pixel of your image 
	$yi_max = 733; // the end Y pixel of your image
	//$xi_min = 50;  // the starting X pixel of your image 
	//$xi_max = 1634; // the end X pixel of your image
	//$yi_min = 50;  // the starting Y pixel of your image 
	//$yi_max = 2560; // the end Y pixel of your image
	// The range of the DB Co-ordinates to use
	$xcoor_min = -259839;
	$xcoor_max = 196268;
	$ycoor_min = -250016;
	$ycoor_max = 250057;
	
	// Calculate the pixels where the co-ordinates should be
	$resultx = ($currentx - $xcoor_min) / ($xcoor_max - $xcoor_min);
	$resultx = (($xi_max - $xi_min) * $resultx) + $xi_min;
	$resulty = ($currenty - $ycoor_min) / ($ycoor_max - $ycoor_min);
	$resulty = (($yi_max - $yi_min) * $resulty) + $yi_min;
	
	//Gracia Map Bottom Left coords: x -259839, y 259818
}
function oldcreateloc(){
	global $resultx, $resulty, $currentx, $currenty;
	// The Dimensions of the images you wish to use
	$xi_min = 14;  // the starting X pixel of your image 
	$xi_max = 468; // the end X pixel of your image
	$yi_min = 14;  // the starting Y pixel of your image 
	$yi_max = 733; // the end Y pixel of your image
	//$xi_min = 50;  // the starting X pixel of your image 
	//$xi_max = 1634; // the end X pixel of your image
	//$yi_min = 50;  // the starting Y pixel of your image 
	//$yi_max = 2560; // the end Y pixel of your image
	// The range of the DB Co-ordinates to use
	$xcoor_min = -118715;
	$xcoor_max = 196268;
	$ycoor_min = -250016;
	$ycoor_max = 250057;
	
	// Calculate the pixels where the co-ordinates should be
	$resultx = ($currentx - $xcoor_min) / ($xcoor_max - $xcoor_min);
	$resultx = (($xi_max - $xi_min) * $resultx) + $xi_min;
	$resulty = ($currenty - $ycoor_min) / ($ycoor_max - $ycoor_min);
	$resulty = (($yi_max - $yi_min) * $resulty) + $yi_min;	
}
function createloczoom(){
	global $resultx, $resulty, $currentx, $currenty;
	// The Dimensions of the images you wish to use
	$xi_min = 50;  // the starting X pixel of your image 
	$xi_max = 1634; // the end X pixel of your image
	$yi_min = 50;  // the starting Y pixel of your image 
	$yi_max = 2560; // the end Y pixel of your image
	// The range of the DB Co-ordinates to use
	$xcoor_min = -118715;
	$xcoor_max = 196268;
	$ycoor_min = -250016;
	$ycoor_max = 250057;
	
	// Calculate the pixels where the co-ordinates should be
	$resultx = ($currentx - $xcoor_min) / ($xcoor_max - $xcoor_min);
	$resultx = (($xi_max - $xi_min) * $resultx) + $xi_min;
	$resulty = ($currenty - $ycoor_min) / ($ycoor_max - $ycoor_min);
	$resulty = (($yi_max - $yi_min) * $resulty) + $yi_min;
}

function paging(){
	global $limit_max, $limit_min, $search_page, $row_count;
		$limit_max = $search_page*100;
		$limit_min = $limit_max - 100;
		//if ($row_count > $limit_max){
			$search_page++;
		//}else{
		//	$search_page = "";
		//}
}
?>