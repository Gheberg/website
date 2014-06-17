<?php
$p = htmlentities($_GET['p'],ENT_QUOTES);
$info = htmlentities($_POST['sys'],ENT_QUOTES);
$backup = htmlentities($_POST['backup'],ENT_QUOTES);
$disk = htmlentities($_POST['disk'],ENT_QUOTES);
if ($p != "vps2013_6" and $p != "vps2013_5" and $p != "vps2013_4" and $p != "vps2013_3" and $p != "vps2013_2" and $p != "vps2013_1" and $p != "low" and $p != "mb1" and $p != "m1" and $p != "m2" and $p != "m3" and $p != "vps11" and $p != "vps1" and $p != "vps2" and $p != "vps3" and $p != "vps4" and $p != "vps5" and $p != "vps6" and $p != "vps7" and $p != "h1" and $p != "h2" and $p != "h3"  and $p != "sd14_1" and $p != "sd14_2" and $p != "sd14_3" and $p != "sd13_4" and $p != "sd14_5")
{
$p = "Produit spécial Geek";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Gheberg.eu - Commande</title>
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
       	  		<div class="indent"><a href="connect.php">Connexion</a> &nbsp;  &nbsp; &nbsp; <a href="oubli.php">Mot de passe oublié</a></div>
                <a href="index.html"><img alt="" src="images/logo.gif" class="logo" /></a><br />
                <div class="block">
                	<div class="block-left">
                    	<div class="block-right">
                            <ul>
                                <li class="first"><a href="index.html">Accueil</a></li>
                                <li><a href="hebergement.html">Hébergement</a></li>
								<li><a href="https://www.gratuit-domaine.eu">Noms de domaine</a></li>
                                <li><a href="vps.html">VPS</a></li>
                                <li><a href="dedie.html">Serveurs Dédiés</a></li>
							    <li><a href="jeux.html" >Serveurs Jeux</a></li>
                                <li class="last"><a href="contact.html">Assistance</a></li>
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
                    <div class="container1">

	                        <div class="col-1">
                        	<div class="title"><h6>Moyens de paiement</h6></div>
                           Sur l'ensemble de nos pack, vous pourrez régler via Allopass ou Paypal.<br>
							<div align="center"><img src="https://www.gheberg.eu/images/paiement.gif" alt="Moyen de paiement"></div>
							<br>
                        </div>
						
<h6>Commande / Inscription</h6><br>
Votre produit : <b><?php echo "$p";?></b><br>
<form action="command2.php?p=<?php echo "$p";?>&info=<?php echo"$info";?>&disk=<?php echo $disk; ?>&backup=<?php echo $backup;?>" method="post">
<input type="radio" name="radio" value="1"> Vous possédez un compte <a href="https://www.gratuit-domaine.eu" target="_blank">Gratuit-Domaine</a><br>
<input type="radio" name="radio" value="2"> Vous souhaitez créer un nouveau compte<br><br>
<input type="submit" value="Continuer" class="boiteFormulaire3"/></form>


						
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



