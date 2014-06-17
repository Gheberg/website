<?php
//connexion base de donnees

require("conf.php");
$db_link = @mysql_connect($sql_serveur,$sql_user,$sql_passwd);

//securisation injection sql
$idd=mysql_real_escape_string($_GET['DATAS']);

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
$prenom=mysql_result($requete,0,"prenom");
$nom=mysql_result($requete,0,"nom");
$p=mysql_result($requete,0,"produit");
$email=mysql_result($requete,0,"email");
$date=mysql_result($requete,0,"date");
$pseudo=mysql_result($requete,0,"pseudo");
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
				<h6>Renouvellement du produit</h6>
				<br>


<?php
$ancien_mois = explode("/", $date);
$nouveau_mois =  $ancien_mois[1] + "1";
if ($nouveau_mois > "12") {$nouveau_mois = "01";}
$date_jour = date('d');
$nouveau_date = "$ancien_mois[0]/$nouveau_mois";
require("conf.php");
$db_link = @mysql_connect($sql_serveur,$sql_user,$sql_passwd);

$requete3=mysql_db_query($sql_bdd,"UPDATE heberg_membres set date=\"$nouveau_date\" where pseudo=\"$pseudo\"",$db_link) or die(mysql_error());
mysql_db_query($sql_bdd,"insert into heberg_admin values ('', '$pseudo', '$nouveau_date', 'renew')",$db_link) or die(mysql_error());


$Destinataire = "$email";
$Sujet = "Prolongement de votre espace d'hébergement !";
$From='From: "Gratuit-Domaine"<contact@gratuit-domaine.eu>'."\n"; 
$From .= "MIME-version: 1.0\n";
$From .= "Content-type: text/html; charset= iso-8859-1\n";
$Message = "Bonjour $prenom, <br>Merci, votre espace d'hébergement vient d'être prolongé de 31 jours. Il sera actif jusqu'au $nouveau_point .<br><br>
Vous pouvez dès maintenant vous connectez à votre espace d'admininstration pour créer des utilisateurs ftp, des bases de données, ... Pour cela, veuillez vous rendrez sur la palteforme membre, onglet DOMAINE, puis <b>hébergement</b>.
<br><br>
Merci et a bientot!<br>L'équipe Gratuit-Domaine.com";
mail($Destinataire,$Sujet,$Message,$From);


$date2 = date('d/m/Y');
$heure = date('H:i:s');
$ip = $_SERVER['REMOTE_ADDR'];
mysql_db_query($sql_bdd,"insert into heberg_log values ('', '$pseudo', '$date2 $heure', '$ip', 'Renouvellement hébergement', '$idd')",$db_link) or die(mysql_error());

echo "
<h1>Commande effectuée avec succès,</h1>
Merci, votre commande vient d'être prise en compte. Votre espace d'hébergement vient d'être prolongé de 31 jours.<br><br>
   <b>¤ Nouveau solde :</b> Votre espace est actif jusqu'au $nouveau_date .
";
	
?>
				
                        <br class="clear" />
                    </div>
                </div>
            </div>	 
      		<div id="footer">
               <div class="indent-footer">Gheberg.eu &copy; 2012</div>
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



