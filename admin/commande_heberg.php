<?php

$pseudo=$_GET['pseudo'];
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
							<a href="commande_heberg.php?action=hotline&hotline=<?php echo $hotline; ?>">
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
					<h1>Commandes en attente</h1>
					<div style="clearboth"></div>
<table>
<?php
if($script != NULL)
{
	mysql_query("DELETE FROM heberg_admin WHERE pseudo='$pseudo'");
	$date = date('d/m/Y');
	$heure = date('H:i:s');
	mysql_query("INSERT into heberg_admin_log (login,date,action) VALUES ('thomas','$date $heure','Validation commande $pseudo')");
}
$reponse = mysql_query("SELECT * FROM heberg_admin ORDER BY ID");

while ($donnees = mysql_fetch_array($reponse) )
{
	$pseudo = nl2br(stripslashes($donnees['pseudo']));
	$sous = nl2br(stripslashes($donnees['sous']));
	$info = nl2br(stripslashes($donnees['info']));
	$date = nl2br(stripslashes($donnees['date']));

	if ($info == "creer vps11") $color = "green";
	elseif ($info == "creer vps1" or $info == "creer vps2" or $info == "creer vps3" or $info == "creer vps4" or $info == "creer vps5" or $info == "creer vps6" or $info == "creer vps7") $color = "blue";
	elseif ($info == "supp vps") $color = "black";
	elseif ($info == "renew" or $info == "h1" or $info == "h2" or $info == "h3") $color = "red";
	else $color = "red";

	if ($date != $date2) echo"<tr><td><div style=\"height:6px;background-color:red;txt-align:center\"></div></td><td><div style=\"height:6px;background-color:red;txt-align:center\"></div></td><td><div style=\"height:6px;background-color:red;txt-align:center\"></div></td></tr>";

	$date2 = nl2br(stripslashes($donnees['date']));

	if ($info == "supp vps")
	{
		$requete=mysql_query("select * from heberg_membres where pseudo='$pseudo'");
		$datem=mysql_result($requete,0,"date");
		$prod=mysql_result($requete,0,"produit");
		echo "<tr><td width='20%'><form method=\"post\" action=\"commande_heberg.php?script=1&pseudo=$pseudo\"><font color=\"$color\"><b>$pseudo </td><td width='70%'><font color=\"$color\">$info <b>$prod</b> $datem</b></font></td><td width='30%'><input type=\"submit\" value=\"Valider\" style=\"margin-top:6px\"></form></td></tr>";
	}
	else echo "<tr><td width='20%'><form method=\"post\" action=\"commande_heberg.php?script=1&pseudo=$pseudo\"><font color=\"$color\"><b>$pseudo </td><td width='70%'><font color=\"$color\">$info ($date)</b></font></td><td width='30%'><input type=\"submit\" value=\"Valider\" style=\"margin-top:6px\"></form></td></tr>";
}
?>
		</table>

					<div class="clearboth"></div>
				</div> <!-- inner -->
			</div> <!-- primary_right -->
		</div> <!-- bgwrap -->
	</div> <!-- container -->
</body>
</html>
