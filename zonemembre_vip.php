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
<link href="http://www.ovh.com/fr/themes/10/products.css" rel="stylesheet" type="text/css" />
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
				<h6>Support VIP</h6>
				<br>
				
<table style="margin: 0 0 0 25px; width:90%;"class="price center"cellspacing="1">
<tr class="title"> 
<th></th> 
<th width="100px;">Basique</th> 
<th width="100px;">Support VIP</th> 
</tr> 
<tr class="price"><td class="bold left" colspan="4"><b>Conseil commercial et technique</b></td></tr> 
<tr class="price"> 
<td class="left" qtlid="300486;300498">Email<br>(Heures ouvrées)</td> 
<td class="bg_green"><img src="images/yes.gif" alt="inclus"></td> 
<td class="bg_green"><img src="images/yes.gif" alt="inclus"></td> 
</tr> 
<tr class="price"> 
<td class="left" qtlid="300522;300534">Conseiller commercial<br> et conseiller technique attitrés</td> 
<td></td> 
<td class="bg_green"><img src="images/yes.gif" alt="inclus"></td> 
</tr> 
<tr class="price"><td class="bold left" colspan="4"><b>Incidents</b></td></tr> 
<tr class="price"> 
<td class="left" style="padding-left: 20px" >Email<br>(24h/24, 7j/7)</td> 
<td class="bg_green"><img src="images/yes.gif" alt="inclus"></td> 
<td class="bg_green"><img src="images/yes.gif" alt="inclus"></td>
</tr> 
<tr class="price"> 
<td class="left" style="padding-left: 20px;">Traitement prioritaire</td> 
<td></td> 
<td class="bg_green"><img src="images/yes.gif" alt="inclus"></td> 
</tr> 
<tr class="price"><td class="bold left" colspan="4"><b>Interventions hors garantie</b></td></tr> 
<tr class="price"> 
<td class="left" style="padding-left: 20px;" >Traitement standard du Lundi au Vendredi <br> de 9h à 19h</td> 
<td class="bg_green"><img src="images/yes.gif" alt="inclus"></td> 
<td class="bg_green"><img src="images/yes.gif" alt="inclus"></td> 
</tr><tr class="price">
<td class="left" style="padding-left: 40px;">Devis</td>
<td qtlid="300630"><span class=" red bold ">3 €</span></td>
<td class="bg_green bold" style="color : #448A13"><b>Gratuit</b></td> 
</tr>
<tr class="price"> 
<td class="left" style="padding-left: 20px;">Traitement urgent <br>24h/24 7j/7</td> 
<td></td> 
<td class="bg_green"><img src="images/yes.gif" alt="inclus"></td> 
</tr> 
<tr class="price"> 
<td class="left" style="padding-left: 40px;" >Un administrateur me recontacte</td> 
<td></td> 
<td class="bg_green"><img src="images/yes.gif" alt="inclus"></td> 
</tr>
<tr class="price"><td class="bold left" colspan="4"><b>Tarifs</b></td></tr><tr
                                    class="price"
                               ><td rowspan="3"></td> 
<td class="bold">inclus</td><td
                                    qtlid="145021"
                               ><span class=" red bold ">1.5 €</span></td></tr><tr class="price"> 

</tr></table>
<br>
Dans le cadre de votre compte, nous vous proposons un support VIP vous permettant d'avoir accès à :<br><br>
<li>un traitement prioritaire de vos incidents (panne serveur, vps innaccessible ...)</li>
<li>réinstallation d'un vps prioritaire</li>
<li>l'accès à une zone restrainte du forum</li>
<li>un support technique et commercial prioritaire</li>
<li>un technicien unique pour la gestion de vos comptes</li>
<br>
<b>Tarif :</b> 1 code allopass ou 1.5 € <i>pour 12 mois</i><br><br>
<small>Pour les clients ayant plusieurs comptes, la souscription au support VIP couvre la totalité des comptes</small>
<br><br>
<center>
<!-- Begin Allopass Checkout-Button Code -->
<script type="text/javascript" src="https://payment.allopass.com/buy/checkout.apu?ids=226116&idd=964396&lang=fr&data=<?php echo"$idd";?>"></script>
<noscript>
 <a href="https://payment.allopass.com/buy/buy.apu?ids=226116&idd=964396&data=<?php echo"$idd";?>" style="border:0">
  <img src="https://payment.allopass.com/static/buy/button/fr/162x56.png" style="border:0" alt="Buy now!" />
 </a>
</noscript>
<!-- End Allopass Checkout-Button Code -->
</center>

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



