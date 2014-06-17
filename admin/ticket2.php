<?php

$case=$_POST['case'];
$ref=$_GET['ref'];
$qui=$_GET['qui'];
$support=addslashes($_POST['support']);
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
							<a href="index.php?action=hotline&hotline=<?php echo $hotline; ?>">
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
					<h1>Tickets Clients</h1>
					<div style="clearboth"></div>
<?php
$dossier = '../contact';
$d = dir($dossier);
while ($entry = $d->read())
{
	if($entry != "." && $entry != "..")
	{
		$lien = $dossier .'/'.$entry;
		
		$refe = explode(".", $entry);
		if ($refe[0] == $ref)
		{
			echo '<blink>Fichier joint à la discussion : <a href="'.$lien.'" target=\"_blank\">'.$entry.'</a></blink><br><br>';
		}
	}
}
$d->close(); 

$pseudo = "admin";

if ($script == "1")
{
	if (!empty($case))
	{
		$requete3=mysql_query("UPDATE ticket2 set resolu='1' where ref='$ref'");
		echo "Conversation terminé !";
	}
	if ($support != null)
	{
			
		$requete=mysql_query("select * from membres where pseudo='$qui'");
		@$prenom3=mysql_result($requete,0,"prenom");
		@$email3=mysql_result($requete,0,"email");
		
		mysql_query("insert into ticket values ('', '$pseudo', '$ref', '$support')");
		
		$Destinataire = "$email3";
		$Sujet = "Support technique Gratuit-Domaine !";
		$From='From: "Gratuit-Domaine"<contact@gratuit-domaine.eu>'."\n"; 
		$From .= "MIME-version: 1.0\n";
		$From .= "Content-type: text/html; charset= iso-8859-1\n";
		$Message = "Bonjour $prenom3, <br>un technicien vient de répondre à votre question. Connectez vous à votre espace membre pour lire la réponse.<br><br>Vous recevrez un mail lorsque qu'un technicien aura répondu à votre question.<br><br>Merci et a bientot!<br>L'équipe Gratuit-Domaine.com";
		
		mail($Destinataire,$Sujet,$Message,$From);
	}
	else {echo "Veuillez taper un message.<br><br>";}
}

$retour = mysql_query("SELECT * FROM ticket WHERE ref='$ref' ORDER BY id ");
while ($donnees = mysql_fetch_array($retour))
{
	$sujet = nl2br(htmlentities($donnees['sujet']));
	$message = nl2br(stripslashes($donnees['message']));
	$qui = nl2br(stripslashes($donnees['pseudo']));
	
	$requete=mysql_query("select * from membres where pseudo='$qui'");
	@$nom2=mysql_result($requete,0,"nom");
	@$prenom2=mysql_result($requete,0,"prenom");
	@$email2=mysql_result($requete,0,"email");
	
	echo "<table class=\"cadre\" border=\"0\" cellpadding=\"3\" cellspacing=\"1\" width=\"100%\">
	<tr class=\"titre\">
	  <td class=\"titre\"><strong>R&eacute;ponse de <a class=\"titre\" href=\"mailto:$email2\">$prenom2 $nom2</a>,</strong></td>
	</tr>
	<tr class=\"cadre\">
	  <td valign=\"top\">
		<div";if ($qui != "admin") echo " style=\"background-color:#F2CEC3\""; else echo " style=\"background-color:#BDE5B8\""; echo ">$message </div>
	
		
	  </td>
	</tr>
	</table><br>";
}

echo "
<form action=\"ticket2.php?script=1&ref=$ref&qui=$qui\" method=\"post\">
Votre réponse :<br><textarea cols=\"60\" name=\"support\" rows=\"15\">Bonjour, 

Cordialement
</TEXTAREA><br>
<input type='checkbox' name='case' value='on'>Mettre fin à la conversation ?<br>
<INPUT type=\"submit\" name=\"send\" value=\"Envoyer\">
</form> ";
?>
afin qu'un technicien puisse vérifier votre problème, je vous invite à ouvrir un ticket incident COMPLET.<br><br>
Merci de l'intérêt que vous portez à notre société.<br><br>
je viens d'amorcer la réinstallation, je vous invite à la poursuivre en suivant le guide suivant :<br><br>
http://www.gheberg.eu/tuto_reinstall.php<br><br>
Nous restons à votre disposition en cas de problème.
					
					<div class="clearboth"></div>
				</div> <!-- inner -->
			</div> <!-- primary_right -->
		</div> <!-- bgwrap -->
	</div> <!-- container -->
</body>
</html>
