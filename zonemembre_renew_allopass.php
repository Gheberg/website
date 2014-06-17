<?php
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
				<h6>Renouvellement du produit</h6>
				<br>

<?php
require("conf.php");
$db_link = @mysql_connect($sql_serveur,$sql_user,$sql_passwd);
$id = mysql_real_escape_string($_POST['idde']);

mysql_connect("localhost", "root", "***");
mysql_select_db("db252300216");
$reponse = mysql_query("SELECT * FROM heberg_bdc_allopass WHERE idd_bdc=\"$id\" ORDER BY id");
$i=0;
while ($donnees = mysql_fetch_array($reponse) )
{
$i++;
}

if ($p == "h1") {$tarif = 0;$allopass = 9;}
if ($p == "h2") {$tarif = 1.5;$allopass = 1;}
if ($p == "h3") {$tarif = 3;$allopass = 2;}
if ($p == "sd1") {$tarif = 19;$allopass = 17;}
if ($p == "sd2") {$tarif = 50;$allopass = 45;}
if ($p == "sd3") {$tarif = 62;$allopass = 55;}
if ($p == "sd4") {$tarif = 62;$allopass = 55;}
if ($p == "sd5") {$tarif = 87;$allopass = 77;}
if ($p == "sd13_1") {$tarif = 13;$allopass = 13;}
if ($p == "sd13_2") {$tarif = 19;$allopass = 19;}
if ($p == "sd13_3") {$tarif = 25;$allopass = 22;}
if ($p == "sd13_4") {$tarif = 38;$allopass = 34;}
if ($p == "sd13_5") {$tarif = 50;$allopass = 45;}
if ($p == "css1") {$tarif = 2.5;$allopass = 2;}
if ($p == "css2") {$tarif = 3.5;$allopass = 3;}
if ($p == "css3") {$tarif = 4.5;$allopass = 4;}
if ($p == "vps11") {$tarif = 1.5;$allopass = 1;}
if ($p == "vps1") {$tarif = 3.5;$allopass = 3;}
if ($p == "vps2") {$tarif = 5.5;$allopass = 4;}
if ($p == "vps3") {$tarif = 9.5;$allopass = 9;}
if ($p == "vps4") {$tarif = 13;$allopass = 12;}
if ($p == "vps5") {$tarif = 17.5;$allopass = 17;}
if ($p == "vps6") {$tarif = 22.99;$allopass = 22;}
if ($p == "vps7") {$tarif = 32;$allopass = 30;}
if ($p == "m1") {$tarif = 14;$allopass = 13;}
if ($p == "voip1") {$tarif = 2;$allopass = 1;}

if ($p == "vps2013_1") {$tarif = 4.5;$allopass = 4;}
if ($p == "vps2013_2") {$tarif = 8;$allopass = 8;}
if ($p == "vps2013_3") {$tarif = 12;$allopass = 10;}
if ($p == "vps2013_4") {$tarif = 18;$allopass = 16;}
if ($p == "vps2013_5") {$tarif = 22;$allopass = 20;}
if ($p == "vps2013_6") {$tarif = 30;$allopass = 25;}

$test = $allopass - $i;
	
	if ($test != 0) die("Nombre de code incorrect.<br><br><br>");
	
$requete_ssecu=mysql_db_query($sql_bdd,"select * from heberg_bdc where idd=\"$id\"",$db_link) or die(mysql_error());
@$info_ssecu=mysql_result($requete_ssecu,0,"info");
if ($info_ssecu != "renew") die("Ce bon de commande ($id) a déjà été payé.<br><br><br>");
	
$ancien_mois = explode("/", $date);
$nouveau_mois =  $ancien_mois[1] + "1";
if ($nouveau_mois > "12") {$nouveau_mois = "01";}
$date_jour = date('d');
$date2 = date('d/m/Y');
$heure = date('H:i:s');
$nouveau_date = "$ancien_mois[0]/$nouveau_mois";
require("conf.php");
$db_link = @mysql_connect($sql_serveur,$sql_user,$sql_passwd);

$requete3=mysql_db_query($sql_bdd,"UPDATE heberg_membres set date=\"$nouveau_date\" where pseudo=\"$pseudo\"",$db_link) or die(mysql_error());
$requete_secu=mysql_db_query($sql_bdd,"UPDATE heberg_bdc set info=\"renew OK\" where idd=\"$id\"",$db_link) or die(mysql_error());
mysql_db_query($sql_bdd,"insert into heberg_admin values ('', '$pseudo', '$nouveau_date', 'renew')",$db_link) or die(mysql_error());
mysql_db_query($sql_bdd,"insert into heberg_fact values ('', '$id', 'allopass', '$date2 $heure')",$db_link) or die(mysql_error());

$Destinataire = "$email";
$Sujet = "[Gheberg] Prolongement de votre espace d'hébergement";
$From='From: "Gheberg"<contact@gheberg.eu>'."\n"; 
$From .= "MIME-version: 1.0\n";
$From .= "Content-type: text/html; charset= iso-8859-1\n";
$Message = "Bonjour $prenom, <br>Merci, votre serveur vps vient d'être renouvelé. Il sera actif jusqu'au $nouveau_point .
<br><br>
Merci et a bientot!<br>L'équipe GHeberg.com";
mail($Destinataire,$Sujet,$Message,$From);

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