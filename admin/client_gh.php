<?php

$demande=$_GET['demande'];
$pseudo=$_POST['pseudo'];
$action=$_GET['action'];

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
							<a href="client_gh.php?action=hotline&hotline=<?php echo $hotline; ?>">
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
					<h1>Annuaire Clients Gheberg</h1>
					<div style="clearboth"></div>
<form action="client_gh.php?demande=1" method="post">
<table><tr><td>Pseudo : </td><td><input type="text" size="25" name="pseudo" value="<?php echo"$pseudo";?>"/></td><td><input type="submit" value="Envoyer" /></td></tr></table></form>
<?php
if ($demande == "1")
{
	$requete=mysql_query("select * from heberg_membres where pseudo='$pseudo'");
	$requetedossier=mysql_query("select * from heberg_dossier where pseudo='$pseudo'");
	@$dossier=mysql_result($requetedossier,0,"text");
	if(mysql_num_rows($requete)!=0)
	{
		$pseudo=mysql_result($requete,0,"pseudo");
		$prenom=mysql_result($requete,0,"prenom");
		$nom=mysql_result($requete,0,"nom");
		$tel=mysql_result($requete,0,"tel");
		$passe=mysql_result($requete,0,"passe");
		$email=mysql_result($requete,0,"email");
		$idd=mysql_result($requete,0,"idd");
		$p=mysql_result($requete,0,"produit");
		$date=mysql_result($requete,0,"date");
	}
	else {echo "<p><b>Le pseudo n'existe pas</b></p>";}

	$requete88=mysql_query("select * from heberg_dedie where pseudo='$pseudo'");
	if(mysql_num_rows($requete88)!=0)
	{
		$sys=mysql_result($requete88,0,"sys");
		$ip=mysql_result($requete88,0,"ip");
		$mac=mysql_result($requete88,0,"mac");
		$vnc=mysql_result($requete88,0,"vnc");
	}

	$requete89=mysql_query("select * from heberg_vps where pseudo='$pseudo'");
	if(mysql_num_rows($requete89)!=0) $sys=mysql_result($requete89,0,"sys");
?>
<table>
<tr><td>Pseudo </td><td><input type="text" size="25" name="pseudo" value="<?php echo"$pseudo";?>"/></td></tr>
<tr><td>Prenom </td><td><input type="text" size="25" name="prenom" value="<?php echo"$prenom";?>"/></td></tr>
<tr><td>Nom </td><td><input type="text" size="25" name="nom" value="<?php echo"$nom";?>"/></td></tr>
<tr><td>Tel </td><td><input type="text" size="25" name="tel" value="<?php echo"$tel";?>"/></td></tr>
<tr><td>Passe </td><td><input type="text" size="25" name="passe" value="<?php echo"$passe";?>"/></td></tr>
<tr><td>Email </td><td><input type="text" size="25" name="email" value="<?php echo"$email";?>"/></td></tr>
<tr><td>idd </td><td><input type="text" size="25" name="idd" value="<?php echo"$idd";?>"/></td></tr>
<tr><td>Produit </td><td><input type="text" size="25" name="idd" value="<?php echo"$p";?>"/></td></tr>
<tr><td>système </td><td><input type="text" size="25" name="idd" value="<?php echo"$sys";?>"/></td></tr>
<tr><td>ip </td><td><input type="text" size="25" name="idd" value="<?php echo"$ip";?>"/></td></tr>
<tr><td>mac </td><td><input type="text" size="25" name="idd" value="<?php echo"$mac";?>"/></td></tr>
<tr><td>vnc </td><td><input type="text" size="25" name="idd" value="<?php echo"$vnc";?>"/></td></tr>
<tr><td>date </td><td><?php echo"$date";?></td></tr>
</table>
<form action="client_gh.php?action=dossier&pseudo=<?php echo"$pseudo";?>" method="post">
<textarea name="dossier" rows="10" COLS="40"><?php echo"$dossier";?></textarea><br>
<input type="submit" value="Envoyer" /></form>

<?php } ?>
		  <hr />

					<div class="clearboth"></div>
				</div> <!-- inner -->
			</div> <!-- primary_right -->
		</div> <!-- bgwrap -->
	</div> <!-- container -->
</body>
</html>
