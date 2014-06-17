<?php
$demande=$_GET['demande'];
$pseudo=$_POST['pseudo'];
$ip=$_POST['ip'];
$systeme=$_POST['systeme'];
$mac=$_POST['mac'];
$vmid=$_POST['vmid'];
$type=$_POST['type'];
$vnc=$_POST['vnc'];

if ($demande == "1")
{
	require("conf.php");
	mysql_connect($sql_serveur,$sql_user,$sql_passwd);
	
	$requete=mysql_query("select * from heberg_membres where pseudo='$pseudo'");
	$p=mysql_result($requete,0,"produit");
	
	switch($p)
	{
		case "vps11":
		$offre = 1;
		break;
		case "vps1":
		$offre = 1;
		break;
		case "vps2":
		$offre = 2;
		break;
		case "vps3":
		$offre = 3;
		break;
		case "vps4":
		$offre = 4;
		break;
		case "vps5":
		$offre = 5;
		break;
		case "vps6":
		$offre = 6;
		break;
		case "vps7":
		$offre = 7;
		break;
		
		case "vps2013_1":
		$offre = 2;
		break;
		case "vps2013_2":
		$offre = 22;
		break;
		case "vps2013_3":
		$offre = 23;
		break;
		case "vps2013_4":
		$offre = 24;
		break;
		case "vps2013_5":
		$offre = 25;
		break;
		case "vps2013_6":
		$offre = 26;
		break;
		
	}
	
	mysql_query("insert into heberg_dedie values ('', '$pseudo', '$ip', '$mac', '$systeme', '$vnc')");
	mysql_query("UPDATE heberg_ip set libre=\"0\", nom=\"$pseudo\" where ip=\"$ip\"");
	$date = date('d/m/Y');
	$heure = date('H:i:s');
	mysql_query("INSERT into heberg_admin_log (login,date,action) VALUES ('thomas','$date $heure','Ajout BDD VPS $pseudo ($ip $mac)')");
	
	mysql_close();
	
	require_once("conf_vps.php");
	$db_link_vps = mysql_connect($sql_serveur_vps,$sql_user_vps,$sql_passwd_vps) or die(mysql_error());
	
	mysql_db_query($sql_bdd_vps,"insert into vps values ('', '$vmid', '$type', '', '$pseudo', '$offre', '$ip', '$mac', '', '1')",$db_link_vps);

}

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
							<a href="ajout_bdd.php?action=hotline&hotline=<?php echo $hotline; ?>">
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
					<h1>Enregistrement en BDD</h1>
					<div style="clearboth"></div>
					
<?php
if ($demande != NULL) {echo"<b>Enregistrement inséré.</b><br><br>";}
?>
<form action="ajout_bdd.php?demande=1" method="post">
<table><tr><td>Pseudo </td><td><input type="text" size="25" name="pseudo"/></td></tr>
<tr><td>IP </td><td><input type="text" size="25" name="ip"/></td></tr>
<tr><td>MAC </td><td><input type="text" size="25" name="mac"/></td></tr>
<tr><td>Système </td><td><input type="text" size="25" name="systeme"/></td></tr>
<tr><td>Type </td><td><input type="text" size="25" name="type"/></td></tr>
<tr><td>VMID </td><td><input type="text" size="25" name="vmid"/></td></tr>
<tr><td>VNC </td><td><input type="text" size="25" name="vnc"/></td></tr></table>
<input type="submit" value="Insérer" /></form>

				<div class="clearboth"></div>
				</div> <!-- inner -->
			</div> <!-- primary_right -->
		</div> <!-- bgwrap -->
	</div> <!-- container -->
</body>
</html>
