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
							<a href="supp_gh.php?action=hotline&hotline=<?php echo $hotline; ?>">
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
					<h1>Suppression comptes Gheberg</h1>
					<div style="clearboth"></div>
<?php

if ($script == "1")
{
$date = date('d/m/Y');
$heure = date('H:i:s');
mysql_query("INSERT into heberg_admin_log (login,date,action) VALUES ('thomas','$date $heure','suppression gheberg $pseudo')");

$requete2=mysql_query("select * from heberg_membres where pseudo='$pseudo'");
if(mysql_num_rows($requete2)==0)
	{
echo "Erreur de suppression dans heberg_membres<br>";
	}
else
{
mysql_query("DELETE FROM heberg_membres WHERE pseudo='$pseudo'");
mysql_query("DELETE FROM heberg_log WHERE pseudo='$pseudo'");
mysql_query("DELETE FROM ticket WHERE pseudo='$pseudo'");
mysql_query("DELETE FROM ticket2 WHERE pseudo='$pseudo'");
mysql_query("DELETE FROM heberg_vip WHERE pseudo='$pseudo'");
mysql_query("DELETE FROM heberg_ping WHERE pseudo='$pseudo'");
mysql_query("DELETE FROM heberg_pingdown WHERE pseudo='$pseudo'");
mysql_query("DELETE FROM heberg_sms WHERE pseudo='$pseudo'");
mysql_query("UPDATE heberg_ip set libre='1' where nom='$pseudo'");

}
$requete3=mysql_query("select * from heberg_dedie where pseudo='$pseudo'");
if(mysql_num_rows($requete3)==0)
	{
echo "Erreur de suppression dans heberg_dedie<br>";
	}
else
{
mysql_query("DELETE FROM heberg_dedie WHERE pseudo='$pseudo'");
}
mysql_close();

require("conf_vps.php");
// CONNEXION MYSQL
$db_link_vps = @mysql_connect($sql_serveur_vps,$sql_user_vps,$sql_passwd_vps);
$requete=mysql_query("select * from vps where nom='$pseudo'")  or die(mysql_error());

if(mysql_num_rows($requete)==0)
	{
echo "Erreur de suppression dans vpsm";
	}
else
{
mysql_query("DELETE FROM vps WHERE nom='$pseudo'") or die(mysql_error());
}
mysql_close();

echo "Le compte $pseudo à bien été supprimé";
}

?>
<form action="supp_gh.php?script=1" method="post">
<table><tr><td>Pseudo : </td><td><input type="text" size="30" name="pseudo"></td><td><input type="submit" value="Supprimer" /></td></tr></table></form>
		  <hr />

					<div class="clearboth"></div>
				</div> <!-- inner -->
			</div> <!-- primary_right -->
		</div> <!-- bgwrap -->
	</div> <!-- container -->
</body>
</html>
