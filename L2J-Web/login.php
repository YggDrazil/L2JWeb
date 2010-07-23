<?php
/**********************************************************************/
/* Project Name.: L2J-Web							*/
/* SVN .........: https://l2j-web.googlecode.com/svn/trunk/L2J-Web/	*/
/* File Name....: login.php							*/
/* Author.......: Sebastien Gascon						*/
/* Author Email.: sebastien.gascon@gmail.com				*/
/* Created On...: 23/01/2007 9:25:28 PM					*/
/* Last Updated.: 23/07/2010 9:29:55 AM					*/
/**********************************************************************/
include('config.inc.php');
include('lib.inc.php');

dbconnect();

//Checks if there is a login cookie
if(isset($_COOKIE['WYDL2j']))

//if there is, it logs you in and directes you to the members page
{ 
	$username = $_COOKIE['WYDL2j']; 
	$pass = $_COOKIE['WYDL2jkey'];
	
	$check = mysql_query("SELECT * FROM accounts WHERE login = '$username'")or die(mysql_error());

	while($info = mysql_fetch_array( $check )) 	
		{

		if ($pass != $info['password']) 
			{
			
			}

		else
			{
			include('header.inc.php');
			include('menu.php');
			echo "You are already logged in, you can logout <a href=\"logout.php\">here</a>!";
			exit;
			}

		}

}

//if the login form is submitted
if (isset($_POST['submit'])) { // if form has been submitted

// makes sure they filled it in
	if(!$_POST['username'] | !$_POST['pass']) {
		die('You did not fill in a required field.');
	}

	// checks it against the database
	if (!get_magic_quotes_gpc()) {
		$_POST['email'] = addslashes($_POST['email']);
	}
	$check = mysql_query("SELECT * FROM accounts WHERE login = '".$_POST['username']."'")or die(mysql_error());

//Gives error if user dosen't exist
$check2 = mysql_num_rows($check);
if ($check2 == 0) {
		die('That user does not exist in our database.');
				}

while($info = mysql_fetch_array( $check )) 	
{
	$_POST['pass'] = stripslashes($_POST['pass']);
	$info['password'] = stripslashes($info['password']);
	$_POST['pass'] = base64_encode(pack("H*",sha1(utf8_encode($_POST['pass']))));

//gives error if the password is wrong
	if ($_POST['pass'] != $info['password']) {
		die('Incorrect password, please try again.');
	}
else
{
// if login is ok then we add a cookie 
$_POST['username'] = stripslashes($_POST['username']);
$hour = time() + 43200; 
setcookie(WYDL2j, $_POST['username'], $hour, '/', $cookiedomain);
setcookie(WYDL2jkey, $_POST['pass'], $hour, '/', $cookiedomain);	
setcookie(WYDL2jAL, $info['access_level'], $hour, '/', $cookiedomain);	

//then redirect them to the members area
print "<script language=\"JavaScript\">";
print "window.location = 'players.php' ";
print "</script>";
}

}
dbclose();
} else {	
include('header.inc.php');
// if they are not logged in
echo "<form action=\"".$_SERVER['PHP_SELF']."\" method=\"post\">";
echo "<table border=\"0\">";
echo "<tr><td colspan=2><h1>Login</h1></td></tr>";
echo "<tr><td>Username:</td><td>";
echo "<input type=\"text\" name=\"username\" maxlength=\"40\">";
echo "</td></tr>";
echo "<tr><td>Password:</td><td>";
echo "<input type=\"password\" name=\"pass\" maxlength=\"50\">";
echo "</td></tr>";
echo "<tr><td colspan=\"2\" align=\"right\">";
echo "<input type=\"submit\" name=\"submit\" value=\"Login\">";
echo "</td></tr>";
echo "</table>";
echo "</form>";

}


?>
