<?php
$modif = $_GET['modif'];

//connexion base de donnees

require("conf.php");
$db_link = @mysql_connect($sql_serveur,$sql_user,$sql_passwd);

//securisation injection sql
$idd=mysql_real_escape_string($_GET['idd']);

//requete
$requete=mysql_db_query($sql_bdd,"select * from heberg_membres where idd=\"$idd\"",$db_link);

if(mysql_num_rows($requete)==0)
	{
	header("Location:$url_erreur"); exit;
	}

if($idd == NULL)
	{
	header("Location:$url_erreur"); exit;
	}

//recuperation des informations
$pseudo=mysql_result($requete,0,"pseudo");
$nom=mysql_result($requete,0,"nom");
$prenom=mysql_result($requete,0,"prenom");
$p=mysql_result($requete,0,"produit");

$requete0=mysql_db_query($sql_bdd,"select * from heberg_vip where pseudo=\"$pseudo\"",$db_link);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Gheberg.eu - Zone Membres</title>
<meta name="keywords" content="heberg gratuit, hebergement gratuit,hébergement gratuit,hébergement,gratuit,hébergeur gratuit,hebergeur gratuit,hebergement mutualise,hébergement mutualisé,hébergeur free,hebergeur free, hébergeur php, hebergeur php" />
<meta name="description" content="Solution d'hébergement internet, de serveurs dédiés et serveurs virtuel (vps). Support technique gratuit. " />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Style-Type" content="text/css" />
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="layout.css" rel="stylesheet" type="text/css" />
<script src="maxheight.js" type="text/javascript"></script>
<script type="text/javascript" src="https://apis.google.com/js/plusone.js">
  {lang: 'fr'}
</script>
</head>

<body id="page2">
<div class="right_bgd"></div>
<div class="tail-top">
  	<div class="tail-bottom">
    	<div class="main">
          	<div id="header">
       	  		<div class="indent"><center><a href="loginout.php">Deconnexion</a><br><?php echo"$nom $prenom";?></center></div>
                <a href="index.html"><img alt="" src="images/logo.gif" class="logo" /></a><br />
                <div class="block">
                	<div class="block-left">
                    	<div class="block-right">
                            <ul>
                                <li class="first"><a href="zonemembre.php?idd=<?php echo"$idd";?>">Accueil</a></li>
                                <li><a href="zonemembre_compte.php?idd=<?php echo"$idd";?>">Votre Compte</a></li>
								<li><a href="zonemembre_product.php?idd=<?php echo"$idd";?>">Votre Produit</a></li>
                                <li><a href="zonemembre_vip.php?idd=<?php echo"$idd";?>">Support VIP</a></li>
                                <li><a href="forum.php">Forum</a></li>
							    <li><a href="zonemembre_faq.php?idd=<?php echo"$idd";?>">F.A.Q</a></li>
                                <li class="last"><a href="zonemembre_contact.php?idd=<?php echo"$idd";?>">Assistance</a></li>
                            </ul>
                         
                        </div>
                    </div>
                </div>
                <div class="block1">
                	<div class="block1-indent">
                    	<img alt="cluster de serveurs sécurisés" src="images/title1.gif" /><br />
                    	<img alt="bande passante garantie" src="images/title2.gif" /><br />
                    	<img alt="trafic illimité" src="images/title3.gif" /><br />
                    	<img alt="support technique gratuit" src="images/title4.gif" /><a href="tous-produits.html"><img alt="voir tous les produits" src="images/button.gif" /></a><br />
                    </div>
                </div>
      		</div>
      		<div id="content">		
                <div class="indent-main2">
<fieldset id="fieldset"><legend><h1>Chat</h1></legend>
Pour contacter notre support technique, utiliser ce formulaire mais n'hésitez pas à faire un tour sur <a href="forum.php">le forum</a>.
Nos techniciens sont disponible afin de vous répondre en direct via le module ci-dessous.<br><br>
<center><a href="https://www.gratuit-domaine.eu/webim/client.php?locale=fr" target="_blank" onclick="if(navigator.userAgent.toLowerCase().indexOf('opera') != -1 &amp;&amp; window.event.preventDefault) window.event.preventDefault();this.newWindow = window.open('https://www.gratuit-domaine.eu/webim/client.php?locale=fr&amp;url='+escape(document.location.href)+'&amp;referrer='+escape(document.referrer), 'webim', 'toolbar=0,scrollbars=0,location=0,status=1,menubar=0,width=640,height=480,resizable=1');this.newWindow.focus();this.newWindow.opener=window;return false;"><img src="https://www.gratuit-domaine.eu/webim/button.php?image=webim&amp;lang=fr" border="0" width="163" height="61" alt=""/></a></center><br>
</fieldset>
<br>
<fieldset id="fieldset"><legend><h1>Hotline</h1></legend>
<b>Support technique / Incident :</b> 
<?php
require("conf.php");
$db_link = @mysql_connect($sql_serveur,$sql_user,$sql_passwd);
$requete=mysql_db_query($sql_bdd,"select * from hotline where id=\"1\"",$db_link) or die(mysql_error());
$etat=mysql_result($requete,0,"etat");
if ($etat == 1) echo"<b><font color=\"green\">OUVERT</font></b><br>";
else echo"<b><font color=\"red\">FERME</font></b><br>";
?>
<img src="images/ht.png" width="280px"><br>
Traitement immédiat de votre incident par un technicien.<br><br>
<i>Temps d'attente actuel (indicatif) : 1 min</i>



</fieldset><br>
<fieldset id="fieldset"><legend><h1>Contact</h1></legend>
<?php
if(mysql_num_rows($requete0)!=0)
	{
echo"<font color=\"red\"><b>Vous bénéficiez du support VIP </b>: vos demandes sont traités en priorité</font><br>";
	}
?>
<li><a href="http://www.gratuit-domaine.eu/travaux" target="_blank">Consulter les travaux en cours</a></li>
<br>
Accès au formulaire de contact : <br>
<form action="zonemembre_contact21.php?idd=<?php echo"$idd";?>" method="post">
<input type="radio" name="choix" value="1"> Support Commercial<br>
<input type="radio" name="choix" value="2"> Ticket Incident Technique<br>
<input type="radio" name="choix" value="3"> Réinstallation<br>
<input type="radio" name="choix" value="1"> Autre<br><br>
<input type="submit" value="Continuer">
</form>
</fieldset><br>
<?php if ($p = "sd1" && $p = "sd2" && $p = "sd3" && $p = "sd4" && $p = "sd5" && $p = "sd6" && $p = "sd7") { ?>
<fieldset id="fieldset"><legend><h1>Interventions Datacenter</h1></legend>
<?php
$requetededie=mysql_db_query($sql_bdd,"select * from heberg_dedie where pseudo=\"$pseudo\"",$db_link);

if(mysql_num_rows($requete)!=0)
{
$server=mysql_result($requetededie,0,"vnc");
$vnc = substr($server, 0, 2);
if ($vnc == "ns") $serveur = "ovh.net";
if ($vnc == "ks") $serveur = "kimsufi.com";
try {
$soap = new SoapClient("https://www.ovh.com/soapi/soapi-re-1.46.wsdl");
$session = $soap->login("***-ovh", "***","fr", false);

$result = $soap->ticketListIncidentsByDomain($session, "$server.$serveur");
$soap->logout($session);
 } catch(SoapFault $fault) {}
$i=0;
echo "<table width=\"100%\"><tr><th>ID</th><th>Date</th><th>Priorité</th><th>Statut</th></tr>";
while(isset($result[$i]))
{
  if ($result[$i]->level == "n/a") $result[$i]->level = "High";
  echo '<tr style=\"border:1px solid black\"><td width=\"20%\"><u><a href=zonemembre_contact_data.php?idd='.$idd.'&id='.$result[$i]->id.'>'.$result[$i]->id.'</a></u></td><td width=\"20%\">'.$result[$i]->creationDate.'</td><td width=\"20%\">'.$result[$i]->level.'</td><td width=\"20%\">'.$result[$i]->requestStatus.'</td></tr>';
  $i++;
}
echo "</table>";
}
?>
</fieldset><br>
<?php } ?>
<fieldset id="fieldset"><legend><h1>Conversation</h1></legend>
  <?php
mysql_connect("localhost", "root", "***");
mysql_select_db("db252300216");

$retour = mysql_query("SELECT * FROM ticket2 WHERE pseudo='$pseudo' ORDER BY resolu ASC");
while ($donnees = mysql_fetch_array($retour))
{
$ref = nl2br(stripslashes($donnees['ref']));
$sujet = nl2br(stripslashes($donnees['sujet']));
$resolu = nl2br(stripslashes($donnees['resolu']));
if ($resolu == "0") {
$ok = "en cours";
echo"<img src=\"images/cour.gif\"> <b><a href=\"zonemembre_contact3.php?idd=$idd&ref=$ref\" style=\"color:red\">$sujet</a></b><br>";
}
if ($resolu == "1") {
echo"<img src=\"images/fini.gif\"> <b><a href=\"zonemembre_contact3.php?idd=$idd&ref=$ref\" style=\"color:green\">$sujet</a></b><br>";
$ok = "résolu";
}
}
?>
</fieldset>
                        <br class="clear" />
                    </div>
                </div>
            </div>	 
      		<div id="footer">
				<div id="left-footer"><a href="https://twitter.com/gheberg" target="_blank"><img src="images/twitter.png" title="twitter"></a> <span style="margin-left:5px;"><g:plusone></g:plusone></span></div>
               <div class="indent-footer">Gheberg.eu &copy; 2012 | <a href="cgu_heberg.html">Mentions légales</a></div>
            </div>
         </div>
     </div>
</div>
<!-- Piwik --> 
<script type="text/javascript">
var pkBaseURL = (("https:" == document.location.protocol) ? "https://www.gheberg.eu/piwik/" : "http://www.gheberg.eu/piwik/");
document.write(unescape("%3Cscript src='" + pkBaseURL + "piwik.js' type='text/javascript'%3E%3C/script%3E"));
</script><script type="text/javascript">
try {
var piwikTracker = Piwik.getTracker(pkBaseURL + "piwik.php", 1);
piwikTracker.trackPageView();
piwikTracker.enableLinkTracking();
} catch( err ) {}
</script><noscript><p><img src="http://www.gheberg.eu/piwik/piwik.php?idsite=1" style="border:0" alt="" /></p></noscript>
<!-- End Piwik Tracking Code -->
</body>
</html>



