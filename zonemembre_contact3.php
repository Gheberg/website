<?php
$script=$_GET['script'];
$case=$_POST['case'];

//connexion base de donnees

require("conf.php");
$db_link = @mysql_connect($sql_serveur,$sql_user,$sql_passwd);

//securisation injection sql
$idd=mysql_real_escape_string($_GET['idd']);
$ref=mysql_real_escape_string($_GET['ref']);
$support=mysql_real_escape_string($_POST['support']);

//requete
$requete=mysql_db_query($sql_bdd,"select * from heberg_membres where idd=\"$idd\"",$db_link) or die(mysql_error());

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
$email=mysql_result($requete,0,"email");
$nom=mysql_result($requete,0,"nom");
$prenom=mysql_result($requete,0,"prenom");

if ($script == "1") {
//connexion a la bdd
require("conf.php");
$db_link = @mysql_connect($sql_serveur,$sql_user,$sql_passwd);

if ($support != null) {
mysql_db_query($sql_bdd,"insert into ticket values ('', '$pseudo', '$ref', '$support')",$db_link) or die(mysql_error());
$Destinataire = "$email";
$Sujet = "[Gheberg] Support technique Gratuit-Domaine";
$From='From: "Gheberg"<contact@gheberg.eu>'."\n"; 
$From .= "MIME-version: 1.0\n";
$From .= "Content-type: text/html; charset= iso-8859-1\n";
$Message = "Bonjour $prenom, <br>Nous vous remercions d'avoir contacté le support technique.<br>Nous venons de recevoir votre message.<br><br>Vous recevrez un mail lorsque qu'un technicien aura répondu à votre question.<br><br>Merci et a bientot!<br>L'équipe Gratuit-Domaine.com";
mail($Destinataire,$Sujet,$Message,$From);
}
else {echo "Veuillez taper un message.<br><br>";}
}
if ($script == 2) {
$requete3=mysql_db_query($sql_bdd,"UPDATE ticket2 set resolu='0' where ref='$ref'",$db_link) or die(mysql_error());
}
if (!empty($case)) {$requete3=mysql_db_query($sql_bdd,"UPDATE ticket2 set resolu='1' where ref='$ref'",$db_link) or die(mysql_error());}
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
<fieldset id="fieldset"><legend><h1>Formulaire</h1></legend>
<?php
$dossier = './contact';
$d = dir($dossier);
while ($entry = $d->read())
{
if($entry != "." && $entry != ".."){
$lien = $dossier .'/'.$entry;

$refe = explode(".", $entry);
if ($refe[0] == $ref) {
echo '<blink>Fichier joint à la discussion : <a href="'.$lien.'" target=\"_blank\">'.$entry.'</a></blink><br><br>';
}}
}
$d->close(); 
 ?>
<?php
mysql_connect("localhost", "root", "***");
mysql_select_db("db252300216");

$retour = mysql_query("SELECT * FROM ticket WHERE ref='$ref' ORDER BY id ");
while ($donnees = mysql_fetch_array($retour))
{
$sujet = nl2br(stripslashes($donnees['sujet']));
$message = nl2br(stripslashes($donnees['message']));
$qui = nl2br(stripslashes($donnees['pseudo']));

//connexion a la bdd
require("conf.php");
$db_link = @mysql_connect($sql_serveur,$sql_user,$sql_passwd);
$requete=mysql_db_query($sql_bdd,"select * from heberg_membres where pseudo='$qui'",$db_link) or die(mysql_error());
@$nom2=mysql_result($requete,0,"nom");
@$prenom2=mysql_result($requete,0,"prenom");
@$email2=mysql_result($requete,0,"email");


echo "<table class=\"cadre\" border=\"0\" cellpadding=\"3\" cellspacing=\"1\" width=\"600px\" style=\"margin-left:100px\">
<tr class=\"titre\">
  <td class=\"titre\" width=\"800px\"><strong>R&eacute;ponse de <a class=\"titre\" href=\"mailto:$email2\">$prenom2 $nom2</a>,</strong></td>
</tr>
<tr class=\"cadre\">
  <td valign=\"top\">
	<div>$message</div>

	
  </td>
</tr>
</table><br>";
}

//connexion a la bdd
require("conf.php");
$db_link = @mysql_connect($sql_serveur,$sql_user,$sql_passwd);
$requete2=mysql_db_query($sql_bdd,"select * from ticket2 where ref=\"$ref\"",$db_link) or die(mysql_error());
$resolu=mysql_result($requete2,0,"resolu");

if ($resolu == "0") {
echo "
<form action=\"zonemembre_contact3.php?idd=$idd&script=1&ref=$ref\" method=\"post\">
Votre réponse :<br><textarea name=\"support\" style=\"width:800px;height:200px\"></TEXTAREA><br>
<input type='checkbox' name='case' value='on'> Mettre fin à la conversation ?<br><br>
<INPUT type=\"submit\" name=\"send\" value=\"Envoyer\"class=\"boiteFormulaire3\">
</form> ";}
else {echo "<b><center>Cette discussion est maintenant terminé !</b><br><a href=\"zonemembre_contact3.php?idd=$idd&ref=$ref&script=2\">Cliquer ici</a> pour la réouvrir.</center>";}
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



