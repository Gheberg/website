<?php

$demande=$_GET['demande'];
$pseudo=$_POST['pseudo'];

$prenom=$_POST['prenom'];
$nom=$_POST['nom'];
$passe=$_POST['passe'];
$adresse=$_POST['adresse'];
$tel=$_POST['tel'];
$email=$_POST['email'];
$domaine=$_POST['domaine'];
$idd=$_POST['idd'];
$verif=$_POST['verif'];
$point=$_POST['point'];

$dns1=$_POST['DNS1'];
$dns2=$_POST['DNS2'];
$dns3=$_POST['DNS3'];
$dns4=$_POST['DNS4'];

$pdns=$_POST['pdns'];

if ($_GET['action'] == "logout")
{
	header('WWW-Authenticate: Basic realm="Acces protege"');
	header('HTTP/1.0 401 Unauthorized');
}

require("conf.php");
mysql_connect($sql_serveur,$sql_user,$sql_passwd);

if ($_GET['action'] == "hotline")
{
	$change = $_GET['hotline'];
	if ($change == "ON") $change = 2;
	else $change = 1;
	mysql_query("UPDATE hotline set etat='$change' where id='1'");
	$date = date('d/m/Y');
	$heure = date('H:i:s');
	mysql_query("INSERT into heberg_admin_log (login,date,action) VALUES ('thomas','$date $heure','HOTLINE => $change')");
}

$ticket=mysql_query("select count(*) from ticket2 WHERE resolu='0'");
$ticket=mysql_result($ticket, 0);
$commande = mysql_query("SELECT count(*) FROM heberg_admin WHERE info like 'creer %'");
$commande=mysql_result($commande, 0);
$hotline=mysql_query("select * from hotline where id='1'");
$hotline=mysql_result($hotline, 0, "etat");
if ($hotline == 1) $hotline = "ON";
else $hotline = "OFF";

if ($demande == "2") mysql_query("UPDATE membres set prenom='$prenom', nom='$nom', passe='$passe', adresse='$adresse', tel='$tel', email='$email', domaine='$domaine', idd='$idd', verif='$verif', point='$point'  where pseudo='$pseudo'");
if ($demande == "3") mysql_query("UPDATE dns set  dns1='$dns1', dns2='$dns2', dns3='$dns3', dns4='$dns4' where pseudo='$pseudo'");
if ($demande == "4") mysql_query("UPDATE pdns set  champ='$pdns' where pseudo='$pseudo'");

?>
<!DOCTYPE html> 
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
	
	<title>GHEBERG -administration-</title>

	<link type="text/css" href="style.css" rel="stylesheet" /> <!-- the layout css file -->
	<link type="text/css" href="css/jquery.cleditor.css" rel="stylesheet" />
	
	<script type='text/javascript' src='js/jquery-1.4.2.min.js'></script>	<!-- jquery library -->
	<script type='text/javascript' src='js/jquery-ui-1.8.5.custom.min.js'></script> <!-- jquery UI -->
	<script type='text/javascript' src='js/cufon-yui.js'></script> <!-- Cufon font replacement -->
	<script type='text/javascript' src='js/ColaborateLight_400.font.js'></script> <!-- the Colaborate Light font -->
	<script type='text/javascript' src='js/easyTooltip.js'></script> <!-- element tooltips -->
	<script type='text/javascript' src='js/jquery.tablesorter.min.js'></script> <!-- tablesorter -->
	
	<!--[if IE 8]>
		<script type='text/javascript' src='js/excanvas.js'></script>
		<link rel="stylesheet" href="css/IEfix.css" type="text/css" media="screen" />
	<![endif]--> 
 
	<!--[if IE 7]>
		<script type='text/javascript' src='js/excanvas.js'></script>
		<link rel="stylesheet" href="css/IEfix.css" type="text/css" media="screen" />
	<![endif]--> 
	
	<script type='text/javascript' src='js/visualize.jQuery.js'></script> <!-- visualize plugin for graphs / statistics -->
	<script type='text/javascript' src='js/iphone-style-checkboxes.js'></script> <!-- iphone like checkboxes -->
	<script type='text/javascript' src='js/jquery.cleditor.min.js'></script> <!-- wysiwyg editor -->

	<script type='text/javascript' src='js/custom.js'></script> <!-- the "make them work" script -->
</head>

<body>

	<div id="container">
		<div id="bgwrap">
			<div id="primary_left">
        
				<div id="logo">
					<a href="dashboard.html" title="Dashboard"><img src="https://www.gheberg.eu/images/logo.gif" alt="" width="90%"/></a>
				</div> <!-- logo end -->

				<?php include("menu.php"); ?>
				
			</div> <!-- sidebar end -->

			<div id="primary_right">
				<div class="inner">

					<h1>Bienvenue </h1>

					<ul class="dash">

						
						<li class="fade_hover tooltip" title="Tickets ouverts">
						<span class="bubble"><?php echo $ticket - 3; ?></span>
							<a href="ticket.php">
								<img src="assets/icons/dashboard/3.png" alt="" /> 
								<span>Tickets</span>
							</a>
						</li>

						<li class="fade_hover tooltip" title="Commandes en cours">
						<span class="bubble"><?php echo $commande; ?></span>
							<a href="commande_heberg.php">
								<img src="assets/icons/dashboard/21.png" alt="" />
								<span>Commandes</span>
							</a>
						</li>
						
						<li class="fade_hover tooltip" title="Activer ou Désactiver la hotline">
						<span class="bubble"><?php echo $hotline; ?></span>
							<a href="client_gd.php?action=hotline&hotline=<?php echo $hotline; ?>">
								<img src="assets/icons/dashboard/123.png" alt="" />
								<span>Hotline</span>
							</a>
						</li>
						
						<li class="fade_hover tooltip" title="Mettre fin à sa session">
							<a href="index.php?action=logout">
								<img src="assets/icons/dashboard/118.png" alt="" />
								<span>Déconnexion</span>
							</a>
						</li>

					</ul> <!-- end dashboard items -->
					
		<hr />
					<h1>Annuaire Clients Gratuit-Domaine</h1>
					<div style="clearboth"></div>
					<table>
<form action="client_gd.php?demande=1" method="post">
<p>Pseudo : <input type="text" size="25" name="pseudo" value="<?php echo"$pseudo";?>"/><input type="submit" value="Envoyer" /></form></p>

<?php
if ($demande == "1")
{
$requete=mysql_query("select * from membres where pseudo='$pseudo'");
$requete2=mysql_query("select * from dns where pseudo='$pseudo'");
$requete3=mysql_query("select * from email where pseudo='$pseudo'");
$requete4=mysql_query("select * from pdns where pseudo='$pseudo'");

if(mysql_num_rows($requete)!=0)
{
$pseudo=mysql_result($requete,0,"pseudo");
$prenom=mysql_result($requete,0,"prenom");
$nom=mysql_result($requete,0,"nom");
$adresse=mysql_result($requete,0,"adresse");
$tel=mysql_result($requete,0,"tel");
$passe=mysql_result($requete,0,"passe");
$email=mysql_result($requete,0,"email");
$domaine=mysql_result($requete,0,"domaine");
$point=mysql_result($requete,0,"point");
$idd=mysql_result($requete,0,"idd");
$verif=mysql_result($requete,0,"verif");

$dns1=mysql_result($requete2,0,"dns1");
$dns2=mysql_result($requete2,0,"dns2");
$dns3=mysql_result($requete2,0,"dns3");
$dns4=mysql_result($requete2,0,"dns4");

$pdns=mysql_result($requete4,0,"champ");

echo "Adresse mails :<br>";
while ($donnees = mysql_fetch_array($requete3) )
{
$emaila = nl2br(stripslashes($donnees['email']));
$emailb = nl2br(stripslashes($donnees['vers']));
echo "$emaila > $emailb<br>";

}

$requete = mysql_query("SELECT * FROM part where pseudo='$pseudo'");
 
$att_point = 0;
 
while($donnees = mysql_fetch_array($requete))
{
$att_point += $donnees['points'];
}
}
else {echo "<p><b>Le pseudo n'existe pas</b></p>";}
?>

<form action="client_gd.php?demande=2" method="post">
<table>
<tr><td>Pseudo </td><td><input type="text" size="25" name="pseudo" value="<?php echo"$pseudo";?>"/></td></tr>
<tr><td>Prenom </td><td><input type="text" size="25" name="prenom" value="<?php echo"$prenom";?>"/></td></tr>
<tr><td>Nom </td><td><input type="text" size="25" name="nom" value="<?php echo"$nom";?>"/></td></tr>
<tr><td>Adresse </td><td><input type="text" size="25" name="adresse" value="<?php echo"$adresse";?>"/></td></tr>
<tr><td>Tel </td><td><input type="text" size="25" name="tel" value="<?php echo"$tel";?>"/></td></tr>
<tr><td>Passe </td><td><input type="text" size="25" name="passe" value="<?php echo"$passe";?>"/></td></tr>
<tr><td>Email </td><td><input type="text" size="25" name="email" value="<?php echo"$email";?>"/></td></tr>
<tr><td>Domaine </td><td><input type="text" size="25" name="domaine" value="<?php echo"$domaine";?>"/></td></tr>
<tr><td>Points </td><td><input type="text" size="25" name="point" value="<?php echo"$point";?>"/></td></tr>
<tr><td>idd </td><td><input type="text" size="25" name="idd" value="<?php echo"$idd";?>"/></td></tr>
<tr><td>verif </td><td><input type="text" size="25" name="verif" value="<?php echo"$verif";?>"/></td></tr>
</table>
<input type="submit" value="Modifier" /></form><br>
<hr />
<p>Total des gains partenaires : <a href="admin_part.php?pseudo=<?php echo"$pseudo";?>" target="_blank"><?php echo"$att_point";?> points</a>
<br>
<hr />
<table>
<form action="client_gd.php?demande=3" method="post">
<tr><td>DNS 1 </td><td><input type="text" size="25" name="DNS1" value="<?php echo"$dns1";?>"/></td></tr>
<tr><td>DNS 2 </td><td><input type="text" size="25" name="DNS2" value="<?php echo"$dns2";?>"/></td></tr>
<tr><td>DNS 3 </td><td><input type="text" size="25" name="DNS3" value="<?php echo"$dns3";?>"/></td></tr>
<tr><td>DNS 4 </td><td><input type="text" size="25" name="DNS4" value="<?php echo"$dns4";?>"/></td></tr>
<input type="hidden" name="pseudo" value="<?php echo"$pseudo";?>"/>
</table>
<input type="submit" value="Modifier" /></form>
<hr />
<br><br>
<form action="client_gd.php?demande=4" method="post">
<TEXTAREA name="pdns" rows="10" COLS="40"><?php echo"$pdns";?></TEXTAREA>
<input type="hidden" name="pseudo" value="<?php echo"$pseudo";?>"/>
<br>
<input type="submit" value="Modifier" /></form>
<?php } ?>
					</table>
					<div class="clearboth"></div>
				</div> <!-- inner -->
			</div> <!-- primary_right -->
		</div> <!-- bgwrap -->
	</div> <!-- container -->
</body>
</html>
