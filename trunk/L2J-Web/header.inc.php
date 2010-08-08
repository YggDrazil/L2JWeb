<?php
/**********************************************************************/
/* Project Name.: L2J-Web							*/
/* SVN .........: https://l2j-web.googlecode.com/svn/trunk/L2J-Web/	*/
/* File Name....: header.inc.php						*/
/* Author.......: Sebastien Gascon						*/
/* Author Email.: sebastien.gascon@gmail.com				*/
/* Created On...: 24/12/2006 12:53:45 PM					*/
/* Last Updated.: 08/08/2010 2:41:33 PM					*/
/**********************************************************************/
include('loadtimestart.php');
echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">\n";
echo "<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"en\" lang=\"en\">\n";
echo "<head>\n";
echo "<title>WYD Lineage 2</title>\n";
echo "<meta name=\"description\" content=\"\"/>\n";
echo "<meta name=\"keywords\" content=\"\"/>\n";
echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"style.css\" />\n";
echo "<!--[if gte IE 9 ]><link rel=\"stylesheet\" type=\"text/css\" href=\"css/tree.css\" media=\"screen\"><![endif]-->\n";
echo "<!--[if !IE]>--><link rel=\"stylesheet\" type=\"text/css\" href=\"css/tree.css\" media=\"screen\"><!--<![endif]-->\n";
echo "<script type=\"text/javascript\">\n";
echo "function showAndHide(theId) {\n";
echo "var el = document.getElementById(theId);\n";
echo "var link = document.getElementById(\"moreLink\");\n";
echo "if (el.style.display==\"none\") {\n";
echo "el.style.display=\"block\"; //show element\n";
echo "link.innerHTML = \"+\";\n";
echo "}\n";
echo "else {\n";
echo "el.style.display=\"none\"; //hide element\n";
echo "link.innerHTML = \"+\";\n";
echo "}\n";
echo "return false;\n";
echo "} \n";
echo "</script>\n";
echo "<script type=\"text/javascript\" src=\"js/prototype.js\"></script>\n";
echo "<script type=\"text/javascript\" src=\"js/scriptaculous.js?load=effects,builder\"></script>\n";
echo "<script type=\"text/javascript\" src=\"js/lightbox.js\"></script>\n";
echo "<link rel=\"stylesheet\" href=\"css/lightbox.css\" type=\"text/css\" media=\"screen\" />\n";
echo "</head>\n";
echo "<body>\n";
?>