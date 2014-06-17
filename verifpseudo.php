<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<script type="text/javascript" src="testpseudo.js"></script>
<title>Document sans titre</title>
</head>

<body><?php
//
// VERIFICATION EN LIVE DU PSEUDO
//

// CONNECION SQL
mysql_connect("localhost", "root", "***");
mysql_select_db("db252300216");


$pseudo = mysql_real_escape_string($_GET["pseudo"]);
// VERIFICATION
$result = mysql_query("SELECT pseudo FROM heberg_membres WHERE pseudo='".$pseudo."'");
if(mysql_num_rows($result)>=1)
{echo "<p><font color='#FF3300'>Désoler, ce pseudo existe déjà !</font></p>";}
else {
echo "<img src='images/ok.png'>";
}
?> 