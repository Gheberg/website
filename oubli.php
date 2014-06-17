<?php
$script=$_GET['script'];

if ($script == "1") {
require("conf.php");
$db_link = @mysql_connect($sql_serveur,$sql_user,$sql_passwd);
$email=mysql_real_escape_string($_POST['email']);
$requete=mysql_db_query($sql_bdd,"select * from membres where email='$email'",$db_link) or die(mysql_error());
if(mysql_num_rows($requete)==0)
	{
	echo"<SCRIPT LANGUAGE=\"JavaScript\">
alert('Votres adresse mail ne correspond à aucun compte !');
</SCRIPT>";
	}
else {
$pseudo=mysql_result($requete,0,"pseudo");
$prenom=mysql_result($requete,0,"prenom");
$passe=mysql_result($requete,0,"passe");
$Destinataire = "$email";
$Sujet = "Récupération du mot de passe";
$From='From: "GHeberg.eu"<contact@gheberg.eu>'."\n"; 
$From .= "MIME-version: 1.0\n";
$From .= "Content-type: text/html; charset= iso-8859-1\n";
$Message = "Bonjour $prenom, <br>Voici un rappel de vos identifiants :<br><li>Pseudo : <b>$pseudo</b></li><li>Mot de passe : <b>$passe</b></li><br><br>Merci et a bientot!<br>L'équipe GHeberg.eu";
mail($Destinataire,$Sujet,$Message,$From);
echo"<SCRIPT LANGUAGE=\"JavaScript\">
alert('Vos indentifiants viennent de vous être envoyés par e-mail !');
</SCRIPT>";
}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Gheberg.eu - Mot de passe oublié</title>
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
                                <li class="last"><a href="contact.php">Assistance</a></li>
                            </ul>
                         
                        </div>
                    </div>
                </div>
                <div class="block1">
                	<div class="block1-indent">
                    	<a href="#"><img alt="" src="images/title1.gif" /></a><br />
                    	<a href="#"><img alt="" src="images/title2.gif" /></a><br />
                    	<a href="#"><img alt="" src="images/title3.gif" /></a><br />
                    	<a href="#"><img alt="" src="images/title4.gif" /></a><a href="../tous-produits.html"><img alt="voir tous les produits" src="images/button.gif" /></a><br />
                    </div>
                </div>
      		</div>
      		<div id="content">		
                <div class="indent-main2">
                    <div class="container1">

                        <div class="col-1">
						<b>Site sécurisé</b><br>
Afin d'assurer la sécurité de nos clients sur le site (plateforme et pages d'inscription), sur le forum ainsi que sur le blog, nous venons de mettre en place un certificat SSL 256 bit.
<br><br>
Ce certificat assure que toutes les données transmises entre votre navigateurs et notre serveur sont sécurisées.
<br><br>
Ce chiffrement de très haut niveau rend très difficile aux personnes non autorisé la visualisation des transferts.
<br><br>
Afin de bénéficier de la sécurisation sur le blog et sur le forum, vous devez utiliser l'adresse suivante : <a href="https://www.gheberg.eu">https://www.gheberg.eu</a>
						</div>
								<center>	
<h6>Module d'authentification sécurisée</h6>


    <h6>Récupération du mot de passe</h6>

<form method="post" action="oubli.php?script=1">
Votre E-mail :<br>
<input type="text" name="email">
<br>
<br>
<input type="submit" value="Envoyer" class="boiteFormulaire3"><br>
</form>
			</center>

						
                        <br class="clear" />
                    </div>
                </div>
            </div>	 
      		<div id="footer">
               <div class="indent-footer">Gheberg.eu &copy; 2011 | <a href="cgu_heberg.html">Mentions légales</a></div>
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



