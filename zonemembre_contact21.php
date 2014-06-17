<?php
$choix = $_POST['choix'];

//connexion base de donnees

require("conf.php");
$db_link = @mysql_connect($sql_serveur,$sql_user,$sql_passwd);

//securisation injection sql
$idd=mysql_real_escape_string($_GET['idd']);

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
$nom=mysql_result($requete,0,"nom");
$prenom=mysql_result($requete,0,"prenom");

$requete0=mysql_db_query($sql_bdd,"select * from heberg_vip where pseudo=\"$pseudo\"",$db_link) or die(mysql_error());
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
if(mysql_num_rows($requete0)!=0)
	{
echo"<font color=\"red\"><b>Vous bénéficiez du support VIP </b>: vos demandes sont traités en priorité</font><br><br>";
	}
if($choix == 1){
?>
<b>Support Commercial :</b><br>
<form action="zonemembre_contact2.php?idd=<?php echo"$idd"; ?>" method="post" enctype="multipart/form-data">
Sujet :<br>
<INPUT maxLength="100" name="sujet" size="70" class="boiteFormulaire"><br>
Message :<br>
<textarea cols="67" name="support" rows="8" class="boiteFormulaire"></TEXTAREA><br>
<input type="hidden" name="MAX_FILE_SIZE" value="1000000" class="boiteFormulaire">
Joindre un fichier : (jpg, png, gif, zip, rar uniquement) :<br>
<input type="file" name="fichier" class="boiteFormulaire" size="70"><br><br>
<INPUT type="submit" name="send" value="Envoyer">
</form>

<?php
}
if ($choix == 2)
{
?>
<b>Incident technique :</b><br><br>
<form action="zonemembre_contact2.php?idd=<?php echo"$idd"; ?>" method="post" enctype="multipart/form-data">
Sujet :<br>
<INPUT maxLength="100" name="sujet" size="70" class="boiteFormulaire"><br><br>
Expliquer brièvement votre soucis :<br>
<textarea cols="67" name="support1" rows="8" class="boiteFormulaire"></TEXTAREA><br><br>
Veuillez renvoyer le résultat de la commande ping depuis votre ordinateur vers votre serveur :<br>
<textarea cols="67" name="support2" rows="8" class="boiteFormulaire"></TEXTAREA><br><br>
Avez-vous tester la connexion VNC (onglet PRODUIT) :<br>
<input type="radio" name="3">Oui<br>
<input type="radio" name="3">Non<br><br>
Avant de poster votre message, merci de tenter un reboot de votre serveur (onglet PRODUIT).<br><br>
<input type="submit" value="Poster mon incident">
</form>
<br><br>
<span style="background: #0068B1; color: #FFFFFF; font-weight: bold; padding-left:5px;">Commande ping :</span><pre style="font-size: 11px; text-align: left; background: black; color: #bbbbbb; padding: 2px;">ping XXX.XXX.XXX.XXX<br><br>PING XXX.XXX.XXX.XXX (XXX.XXX.XXX.XXX) 56(84) bytes of data.<br>64 bytes from XXX.XXX.XXX.XXX (XXX.XXX.XXX.XXX): icmp_seq=1 ttl=58 time=4.30 ms<br>64 bytes from XXX.XXX.XXX.XXX (XXX.XXX.XXX.XXX): icmp_seq=2 ttl=58 time=4.30 ms<br>--- XXX.XXX.XXX.XXX ping statistics ---<br>2 packets transmitted, 2 received, 0% packet loss, time 999ms<br>rtt min/avg/max/mdev = 4.302/4.303/4.305/0.065 ms</pre> 
<?php
}
if ($choix == 3)
{
?>
<b>Réinstallation :</b><br><br>
<form action="zonemembre_contact2.php?idd=<?php echo"$idd"; ?>" method="post" enctype="multipart/form-data">
Sujet :<br>
<INPUT maxLength="100" name="sujet" size="70" class="boiteFormulaire" value="réinstallation"><br><br>
Indiquer le système d'exploitation de votre choix :<br>
<textarea cols="67" name="support1" rows="8" class="boiteFormulaire"></TEXTAREA><br><br>
Souhaitez-vous une réinstallation effectuée par un technicien (temps d'attente 24 heures) ou souhaitez vous faire une réinstallation assistée <br><li><a href="tuto_reinstall.php" target="_blank">Tutoriel de réinstallation</a></li><br>
<INPUT maxLength="100" name="support2" size="70" class="boiteFormulaire" value="oui ou non"><br><br>
Pour les réinstallation assistée, vous recevrez un mail une fois votre serveur lancé. Vous pourrez ensuite effectuer le paramétrage en suivant le tuto.
<br><br>
<input type="submit" value="Poster mon incident">
</form>
<?php
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



