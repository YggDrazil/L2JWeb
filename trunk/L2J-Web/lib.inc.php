<?php
/**********************************************************************/
/* Project Name.: L2J-Web							*/
/* SVN .........: https://l2j-web.googlecode.com/svn/trunk/L2J-Web/	*/
/* File Name....: lib.inc.php						*/
/* Author.......: Sebastien Gascon						*/
/* Author Email.: sebastien.gascon@gmail.com				*/
/* Created On...: 22/01/2007 11:37:24 PM					*/
/* Last Updated.: 05/08/2010 1:45:24 PM					*/
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
	global $rowsPerPage, $pageNum, $rowsquery, $pageNum, $maxPage, $offset, $sql, $paging;
		// By default show the first page
		$pageNum = 1;
		// If $_GET['page'] is defined, use it as page number
		if(isset($_GET['page']))
		{
		$pageNum = $_GET['page'];
		}
		// Calculating the offset
		$offset = ($pageNum - 1) * $rowsPerPage;
		// SQL Query for counting the number of rows. See function paging()
		$rowsquery   = "SELECT COUNT(*) AS numrows FROM (".$sql.") countalias";
		$result  = mysql_query($rowsquery) or die('Error, query failed');
		$row     = mysql_fetch_array($result, MYSQL_ASSOC);
		$numrows = $row['numrows'];
		// Total number of pages
		$maxPage = ceil($numrows/$rowsPerPage);
		// Limits the SQL results to the ones we want
		$paging = "LIMIT $offset,$rowsPerPage";
}
function printprevnextlink(){
	global $pageNum, $maxPage, $search_string, $search_grade;
	// Print the link to access each page
	$self = $_SERVER['PHP_SELF'];
	// Creating Previous and Next links
	// Plus the link to go straight to the first and last page
	if ($pageNum > 1)
	{
	   $page  = $pageNum - 1;
	   $prev  = " <a href=\"$self?search=$search_string&amp;grade=$search_grade&amp;page=$page\">[Prev]</a> ";
	
	   $first = " <a href=\"$self?search=$search_string&amp;grade=$search_grade&amp;page=1\">[First Page]</a> ";
	} 
	else
	{
	   $prev  = '&nbsp;'; // We are on Page One, don't print Previous link
	   $first = '&nbsp;'; // Nor the first page link
	}
	
	if ($pageNum < $maxPage)
	{
	   $page = $pageNum + 1;
	   $next = " <a href=\"$self?search=$search_string&amp;grade=$search_grade&amp;page=$page\">[Next]</a> ";
	
	   $last = " <a href=\"$self?search=$search_string&amp;grade=$search_grade&amp;page=$maxPage\">[Last Page]</a> ";
	} 
	else
	{
	   $next = '&nbsp;'; // We are on the Last Page, don't print Next link
	   $last = '&nbsp;'; // Nor the last page link
	}
	
	// Print the navigation links
	echo $first . $prev . 
	" Showing page $pageNum of $maxPage pages " . $next . $last;
	echo "<br/>";
}
function calculatedropchance($dropchance){
	global $drop_chance_pct;
	$drop_chance_pct = $dropchance / 10000;
	$drop_chance_pct = round($drop_chance_pct, 3);
}
?>