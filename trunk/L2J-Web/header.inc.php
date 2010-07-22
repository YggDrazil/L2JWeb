<?php
/*************************************************/
/* Project Name.: L2J-Web				*/
/* File Name....: header.inc.php			*/
/* Author.......: Sebastien Gascon			*/
/* Author Email.: sebastien.gascon@gmail.com	*/
/* Created On...: 24/12/2006 12:53:45 PM		*/
/* Last Updated.: 22/07/2010 10:04:00 AM		*/
/*************************************************/
echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">\n";
echo "<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"en\" lang=\"en\">\n";
echo "<head>\n";
echo "<title>WYD Lineage 2</title>\n";
echo "<meta name=\"description\" content=\"\"/>\n";
echo "<meta name=\"keywords\" content=\"\"/>\n";
echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"style.css\" />\n";
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
echo "</head>\n";
echo "<body>\n";
?>