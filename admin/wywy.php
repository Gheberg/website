<?php 
$pseudo=$_GET['pseudo'];
mysql_connect("localhost", "root", "***");
mysql_select_db("db252300216");
$requete = mysql_query("SELECT * FROM part where pseudo='$pseudo'")or die(mysql_error());
 require("conf.php");
 $db_link = @mysql_connect($sql_serveur,$sql_user,$sql_passwd);
while($donnees = mysql_fetch_array($requete))
{
$jour = nl2br(stripslashes($donnees['jour']));

echo $jour;
echo "<br>";
echo $i++;
echo "<br>";
echo "<br>";
$requet=mysql_db_query($sql_bdd,"UPDATE part set points=\"0\"  where pseudo=\"$pseudo\"",$db_link) or die(mysql_error());
}
?>