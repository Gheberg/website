<?php
//connexion base de donnees

require("conf.php");
$db_link = @mysql_connect($sql_serveur,$sql_user,$sql_passwd);

//securisation injection sql
$idd=mysql_real_escape_string($_GET['idd']);
$sujet=mysql_real_escape_string($_POST['sujet']);
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
$taille = 10;
$lettres = "abcdefghijklmnopqrstuvwxyz0123456789";
srand(time());
for ($i=0;$i<$taille;$i++)
{
$ref.=substr($lettres,(rand()%(strlen($lettres))),1);
}

require("conf.php");
$db_link = @mysql_connect($sql_serveur,$sql_user,$sql_passwd);
$support = mysql_real_escape_string($_POST['support']);
if ($sujet != null) {
$support2=mysql_real_escape_string(htmlspecialchars($_POST['support']));
$support21=mysql_real_escape_string(htmlspecialchars($_POST['support1']));
$support22=mysql_real_escape_string(htmlspecialchars($_POST['support2']));
if($support != NULL)
{
mysql_db_query($sql_bdd,"insert into ticket values ('', '$pseudo', '$ref', '$support2')",$db_link) or die(mysql_error());
}
else
{
mysql_db_query($sql_bdd,"insert into ticket values ('', '$pseudo', '$ref', '$support21<br><br><br>$support22')",$db_link) or die(mysql_error());
}
mysql_db_query($sql_bdd,"insert into ticket2 values ('', '$ref', '$pseudo', '0', '$sujet')",$db_link) or die(mysql_error());

echo "<b>Votre message vient de nous être envoyé. Vous recevrez un mail lorsque qu'un technicien aura répondu à votre question. Vous pouvez suivre l'avancement du problème <a href=\"zonemembre_contact.php?idd=$idd\">ici</a>.</b>";
$Destinataire = "$email";
$Sujet = "Support technique GHeberg !";
$From='From: "GHeberg"<contact@gheberg.eu>'."\n"; 
$From .= "MIME-version: 1.0\n";
$From .= "Content-type: text/html; charset= iso-8859-1\n";
$Message = "Bonjour $prenom, <br>Nous vous remercions d'avoir contacter le support technique.<br>Nous venons de recevoir votre message.<br><br>Vous recevrez un mail lorsque qu'un technicien aura répondu à votre question.<br><br>Merci et a bientot!<br>L'équipe GHeberg.eu";
mail($Destinataire,$Sujet,$Message,$From);
}
else {echo "<b>Veuillez taper un message et un sujet.</b>";}
?> </p>
<?php
$dossier = 'contact/';
$fichier = basename($_FILES['fichier']['name']);
$taille_maxi = 1000000;
$taille = filesize($_FILES['fichier']['tmp_name']);
$extensions = array('.png', '.gif', '.jpg', '.jpeg', '.zip', '.rar');
$extension = strrchr($_FILES['fichier']['name'], '.'); 
//Début des vérifications de sécurité...
if ($fichier != NULL) {
if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
{
     $erreur = 'Vous ne pouvez envoyer qu\'un fichier de type png, gif, jpg, jpeg, zip, rar !';
}
if($taille>$taille_maxi)
{
     $erreur = 'Veuillez envoyer un fichier de 1 mo maximum ! ';
}
if(!isset($erreur)) //S'il n'y a pas d'erreur, on upload
{
     //On formate le nom du fichier ici...
     $fichier = "$ref$extension";
     
     if(move_uploaded_file($_FILES['fichier']['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
     {
      echo "<script LANGUAGE=\"JavaScript\">alert(\"Votre fichier a bien été envoyé.\");</script>";
     }
     else //Sinon (la fonction renvoie FALSE).
     {
          echo "<script LANGUAGE=\"JavaScript\">alert(\"Echec de l'envoi du fichier !\");</script>";
     }
}
else
{
     echo "<script LANGUAGE=\"JavaScript\">alert(\"$erreur\");</script>";
}}
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



