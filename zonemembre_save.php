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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>GHeberg.eu</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery.js"></script> 
<script type="text/javascript" src="js/carrousel.js"></script> 
<script type="text/javascript" src="https://apis.google.com/js/plusone.js">
  {lang: 'fr'}
</script>
</head>
<body>

<div id="header">
	<div id="logo"><a href="" title="" target="_parent"></a></div>

    <div id="connexion">
    <table width="230" border="0" align="center">
      <tr>
        <td><br><center>Bonjour <?php echo "$nom $prenom";?></center></td>
        <td rowspan="2"></td>
      </tr>
      <tr>
        <td><center><a href="loginout.php?idd=<?php echo "$idd"; ?>">Deconnexion</a><br><br>Charge serveur :<?php include("cpu.php");?></center>

      </tr>
    </table>
  </div>
</div>

<div id="navbar">	
	<ul id="menu" >
    	<li><a href="zonemembre.php?idd=<?php echo"$idd";?>" title="" target="_parent" class="m_accueil">Accueil</a></li>
        <li></li>
        <li><a href="zonemembre_compte.php?idd=<?php echo"$idd";?>" title="votre compte" target="_parent" class="m_hebergement">Votre Compte</a></li>
        <li><a href="zonemembre_product.php?idd=<?php echo"$idd";?>" title="votre produit" target="_parent" class="m_nomdedomaine">Votre produit</a></li>
        <li><a href="zonemembre_save.php?idd=<?php echo"$idd";?>" title="Sauvegarde" target="_parent" class="m_serveurdedie">Support VIP</a></li>
        <li><a href="forum.php" title="forum" target="_parent" class="m_ecommerce">forum</a></li>
        <li><a href="zonemembre_faq.php?idd=<?php echo"$idd";?>" title="faq" target="_parent" class="m_faq">F.A.Q</a></li>
        <li><a href="zonemembre_contact.php?idd=<?php echo"$idd";?>" title="contact" target="_parent" class="m_contact">Contact</a></li>
	</ul>     
</div>

<div id="conteneur">
 <div id="carrousel"> 
 
	<div id="slide1" class="slide"> 
	    <div class="visu"> <img src="images/slide/slide1.png"/> </div>
	</div> 
    
    <div id="slide2" class="slide"> 
	    <div class="visu"> <img src="images/slide/slide2.png"/> </div>
	</div> 
    
 </div>
</div>

<div id="corpshaut"></div>

<div id="bloc">
  <div id="corps">
    <h2>Support VIP</h2>
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
<br><br>
</div>
</div>


<div id="footer">
<p>© 2010 <a href="index.html">GHeberg.eu</a><br/>
  Partenaires : <a href="https://www.gratuit-domaine.eu" target="_blank">Gratuit-Domaine.eu</a> </p>
  
  <a href="http://www.creativegfx.fr" title="CreativeGFX" target="_blank" class="creativegfx"></a>

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
