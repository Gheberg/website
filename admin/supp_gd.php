<?php

$pseudo=$_POST['pseudo'];
$script=$_GET['script'];

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

if ($action == "dossier")
{
	$pseudo=$_GET['pseudo'];
	$dossier=$_POST['dossier'];

	$requete=mysql_query("select * from heberg_dossier where pseudo='$pseudo'");
	if(mysql_num_rows($requete)==0)
		{
		mysql_query("insert into heberg_dossier values ('', '$pseudo', '$dossier')");
		}
	mysql_query("UPDATE heberg_dossier set text='$dossier' where pseudo='$pseudo'");
}

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
							<a href="supp_gd.php?action=hotline&hotline=<?php echo $hotline; ?>">
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
					<h1>Suppression comptes Gratuit-Domaine</h1>
					<div style="clearboth"></div>
<?php

if ($script == "1")
{
$date = date('d/m/Y');
$heure = date('H:i:s');
mysql_query("INSERT into heberg_admin_log (login,date,action) VALUES ('thomas','$date $heure','suppression gratuit-domaine $pseudo')");

$requete=mysql_query("select * from membres where pseudo='$pseudo'");
$email=mysql_result($requete,0,"email");
$prenom=mysql_result($requete,0,"prenom");
$domaine=mysql_result($requete,0,"domaine");

mysql_query("DELETE FROM membres WHERE pseudo='$pseudo'");
mysql_query("DELETE FROM email WHERE pseudo='$pseudo'");
mysql_query("DELETE FROM dns WHERE pseudo='$pseudo'");
mysql_query("DELETE FROM ads WHERE pseudo='$pseudo'");
mysql_query("DELETE FROM ads2 WHERE pseudo='$pseudo'");
mysql_query("DELETE FROM att_point WHERE pseudo='$pseudo'");
mysql_query("DELETE FROM att_points WHERE pseudo='$pseudo'");
mysql_query("DELETE FROM att_domaine WHERE pseudo='$pseudo'");
mysql_query("DELETE FROM att_dns WHERE pseudo='$pseudo'");
mysql_query("DELETE FROM redirection WHERE pseudo='$pseudo'");
mysql_query("DELETE FROM envoi WHERE pseudo='$pseudo'");
mysql_query("DELETE FROM domaine WHERE pseudo='$pseudo'");
mysql_query("DELETE FROM ticket WHERE pseudo='$pseudo'");
mysql_query("DELETE FROM ticket2 WHERE pseudo='$pseudo'");
mysql_query("DELETE FROM log WHERE pseudo='$pseudo'");
mysql_query("DELETE FROM pdns WHERE pseudo='$pseudo'");
mysql_query("DELETE FROM part WHERE pseudo='$pseudo'");
mysql_query("DELETE FROM api WHERE pseudo='$pseudo'");
mysql_query("DELETE FROM api_dns WHERE pseudo='$pseudo'");
mysql_query("DELETE FROM api_redirection WHERE pseudo='$pseudo'");

$Destinataire = "$email";
$Sujet = "Suppression de votre compte Gratuit-Domaine.com !";
$From='From: "Gratuit-Domaine"<contact@gratuit-domaine.eu>'."\n";
$From .= "MIME-version: 1.0\n";
$From .= "Content-type: text/html; charset= iso-8859-1\n";
$Message = "Bonjour $prenom, <br>Suite à votre demande, votre compte vient d'être définitivement supprimé de nos bases de données.<br>Si vous le souhaitez, vous pouvez remplir notre questionnaire : <a href=\"https://www.gratuit-domaine.eu/enquete/enquete_supp.html\">https://www.gratuit-domaine.eu/enquete/enquete_supp.html</a><br>Merci et a bientot sur Gratuit-Domaine.com!<br>L'équipe Gratuit-Domaine.com";
mail($Destinataire,$Sujet,$Message,$From);

$Destinataire2 = "$email";
$Sujet2 = "Suppression de votre compte Gratuit-Domaine.com !";
$From2='From: "Gratuit-Domaine"<contact@gratuit-domaine.eu>'."\n";
$From2 .= "MIME-version: 1.0\n";
$From2 .= "Content-type: text/html; charset= iso-8859-1\n";
$Message2 = "Bonjour $prenom, <br>Vous venez de nous quitter! Si vous souhatiez réserver votre nom de domaine (<b>$domaine</b>) malgrès tout, nous vous proposons les promotions de notre partenaire 1AND1.<br><br><a href=\"http://www.1and1.fr/?k_id=19253705\"><img src=\"http://ovm-einsundeins.com/france/Affilinet/Mar09/fr_468x60dom_mars2009.gif\"></a><br><a href=\"http://www.1and1.fr/?k_id=19253705\"></a><br><br>A très bientot sur Gratuit-Domaine.com !";
mail($Destinataire2,$Sujet2,$Message2,$From2);

echo "<p style=\"text-align:justify;\">Le compte $pseudo à bien été supprimé";
}

?>
<form action="supp_gd.php?script=1" method="post">
<table><tr><td>Pseudo : </td><td><input type="text" size="30" name="pseudo"></td><td><input type="submit" value="Supprimer" /></td></tr></table></form>
		  <hr />

					<div class="clearboth"></div>
				</div> <!-- inner -->
			</div> <!-- primary_right -->
		</div> <!-- bgwrap -->
	</div> <!-- container -->
</body>
</html>
