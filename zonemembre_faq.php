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
			<h6>Foire Aux Questions</h6>
<br>
 <a href="faq/renouvellement.php?idd=47yn7iwkc4g1cf28o4so" onMouseOver="document.img_1.src='images/bullet.gif';"  onMouseOut="document.img_1.src='images/bullet2.gif';" class="none"><img name="img_1" src="images/bullet2.gif" border="no">&nbsp;&nbsp;Que faire si j'oubli de renouveller mon compte ?<a><br> 

  <a href="faq/adulte.php?idd=47yn7iwkc4g1cf28o4so" onMouseOver="document.img_2.src='images/bullet.gif';"  onMouseOut="document.img_2.src='images/bullet2.gif';" class="none"><img name="img_2" src="images/bullet2.gif" border="no">&nbsp;&nbsp;Les sites pour adultes sont t'ils autorisés ?<a><br> 

  <a href="faq/changer.php?idd=47yn7iwkc4g1cf28o4so" onMouseOver="document.img_3.src='images/bullet.gif';"  onMouseOut="document.img_3.src='images/bullet2.gif';" class="none"><img name="img_3" src="images/bullet2.gif" border="no">&nbsp;&nbsp;Est-il possible de changer le nom de mon compte ?<a><br> 

  <a href="faq/supprimer.php?idd=47yn7iwkc4g1cf28o4so" onMouseOver="document.img_4.src='images/bullet.gif';"  onMouseOut="document.img_4.src='images/bullet2.gif';" class="none"><img name="img_4" src="images/bullet2.gif" border="no">&nbsp;&nbsp;Comment supprimer mon compte ?<a><br> 

  <a href="faq/donnees.php?idd=47yn7iwkc4g1cf28o4so" onMouseOver="document.img_5.src='images/bullet.gif';"  onMouseOut="document.img_5.src='images/bullet2.gif';" class="none"><img name="img_5" src="images/bullet2.gif" border="no">&nbsp;&nbsp;Les données de mon site ont été modifiées, changez vous les données de vos clients ?<a><br> 

  <br><br>



  <a href="faq/ftp.php?idd=47yn7iwkc4g1cf28o4so" onMouseOver="document.img_6.src='images/bullet.gif';"  onMouseOut="document.img_6.src='images/bullet2.gif';" class="none"><img name="img_6" src="images/bullet2.gif" border="no">&nbsp;&nbsp;Comment me connecter au serveur FTP ?<a><br> 

  <a href="faq/adresse.php?idd=47yn7iwkc4g1cf28o4so" onMouseOver="document.img_7.src='images/bullet.gif';"  onMouseOut="document.img_7.src='images/bullet2.gif';" class="none"><img name="img_7" src="images/bullet2.gif" border="no">&nbsp;&nbsp;Quel est l'adresse de mon site?</a><br> 

  <a href="faq/bdd.php?idd=47yn7iwkc4g1cf28o4so" onMouseOver="document.img_8.src='images/bullet.gif';"  onMouseOut="document.img_8.src='images/bullet2.gif';" class="none"><img name="img_8" src="images/bullet2.gif" border="no">&nbsp;&nbsp;Comment créer une base de données ?</a><br> 

  <a href="faq/cron.php?idd=47yn7iwkc4g1cf28o4so" onMouseOver="document.img_9.src='images/bullet.gif';"  onMouseOut="document.img_9.src='images/bullet2.gif';" class="none"><img name="img_9" src="images/bullet2.gif" border="no">&nbsp;&nbsp;Comment créer une tache planifiée (cron) ?<a><br> 

  <a href="faq/compte_email.php?idd=47yn7iwkc4g1cf28o4so" onMouseOver="document.img_10.src='images/bullet.gif';"  onMouseOut="document.img_10.src='images/bullet2.gif';" class="none"><img name="img_10" src="images/bullet2.gif" border="no">&nbsp;&nbsp;Comment créer une adresse mail ?<a><br> 

  <a href="faq/backup.php?idd=47yn7iwkc4g1cf28o4so" onMouseOver="document.img_11.src='images/bullet.gif';"  onMouseOut="document.img_11.src='images/bullet2.gif';" class="none"><img name="img_11" src="images/bullet2.gif" border="no">&nbsp;&nbsp;Mon site est t'il sauvegardé ? Comment faire un backup ?</a><br> 

  <a href="faq/stat.php?idd=47yn7iwkc4g1cf28o4so" onMouseOver="document.img_12.src='images/bullet.gif';"  onMouseOut="document.img_12.src='images/bullet2.gif';" class="none"><img name="img_12" src="images/bullet2.gif" border="no">&nbsp;&nbsp;Les statistiques d'accès à mon site sont t'elles disponibles ?</a><br> 

  <a href="faq/infodns.php?idd=47yn7iwkc4g1cf28o4so" onMouseOver="document.img_14.src='images/bullet.gif';"  onMouseOut="document.img_14.src='images/bullet2.gif';" class="none"><img name="img_14" src="images/bullet2.gif" border="no">&nbsp;&nbsp;Quels sont les serveurs DNS du serveur ?</a><br> 

  <a href="faq/domaine.php?idd=47yn7iwkc4g1cf28o4so" onMouseOver="document.img_15.src='images/bullet.gif';"  onMouseOut="document.img_15.src='images/bullet2.gif';" class="none"><img name="img_15" src="images/bullet2.gif" border="no">&nbsp;&nbsp;Comment installer/rattacher d'autres domaines ?</a>

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



