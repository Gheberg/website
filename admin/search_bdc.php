<?php

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

if ($_GET['demande'] == "1")
{
	$search = $_POST['bdc'];
	$bon=mysql_query("select * from heberg_bdc WHERE pseudo='$search' OR idd='$search'");
	if(mysql_num_rows($bon)==0) $retour = "Aucune information retrouvée";
	else
	{
		$pseudo=mysql_result($bon, 0, "pseudo");
		$date=mysql_result($bon, 0, "date");
		$produit=mysql_result($bon, 0, "produit");
		$prixttc=mysql_result($bon, 0, "prixttc");
		$info=mysql_result($bon, 0, "info");
		$idd=mysql_result($bon, 0, "idd");
	}
	
	$bon_allo=mysql_query("select * from heberg_bdc_allopass WHERE idd_bdc='$idd'");

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
							<a href="utile.php?action=hotline&hotline=<?php echo $hotline; ?>">
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
					<h1>Rechercher un Bon de Commande</h1>
					<div style="clearboth"></div>
<form action="search_bdc.php?demande=1" method="post">
<table><tr><td>Code BdC : </td><td><input type="text" size="25" name="bdc" value=""/></td><td><input type="submit" value="Envoyer" /></td></tr></table></form>
<?php if ($_GET['demande'] == 1) { ?>
<br>
	<b><?php echo $retour; ?></b>
	<table width="70%"
		<tr width="70%"><th witdh="40px" style="border: solid 1px black">Pseudo</th><th witdh="20%" style="border: solid 1px black">Date</th><th witdh="20%" style="border: solid 1px black">Produit</th><th width="20%"  style="border: solid 1px black">Prix TTC</th><th witdh="20%" style="border: solid 1px black">Info</th><th style="border: solid 1px black">idd</th></tr>
		<tr width="70%" align="center"><td witdh="40px" style="border: solid 1px black"><?php echo $pseudo; ?></td><td witdh="20%" style="border: solid 1px black"><?php echo $date; ?></td><td witdh="20%" style="border: solid 1px black"><?php echo $produit; ?></td><td witdh="20%" style="border: solid 1px black"><?php echo $prixttc; ?> €</td><td witdh="20%" style="border: solid 1px black"><?php echo $info; ?></td><td witdh="20%" style="border: solid 1px black"><?php echo $idd; ?></td></tr>
	</table>
	<?php
	if(mysql_num_rows($bon_allo)==0) $retour_allo = "Aucune information retrouvée";
	else
	{
		echo "<table><tr><th style=\"border: solid 1px black\">Date</th><th style=\"border: solid 1px black\">Code allopass</th></tr>";
		while($donnees = mysql_fetch_array($bon_allo))
		{
			$code_allo=$donnees['code'];
			$date_allo=$donnees['date'];
			echo "<tr align=\"center\"><td style=\"border: solid 1px black\">$date_allo</td><td style=\"border: solid 1px black\">$code_allo</td></tr>";
		}
		echo "</table>";
	}
	
} ?>

					<div class="clearboth"></div>
				</div> <!-- inner -->
			</div> <!-- primary_right -->
		</div> <!-- bgwrap -->
	</div> <!-- container -->
</body>
</html>
