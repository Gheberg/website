<?php
 if (!empty($_POST['send'])){
   $recipient = 'contact@gheberg.eu';

   $email = $_POST['email'];

   $subject=stripslashes($_POST['subject']);

   $message = stripslashes($_POST['message']);

   $message.="\n\nCe courrier électronique vous a été
envoyé à partir du site web
http://".$_SERVER['SERVER_NAME']."/\n rubrique Contact avec l'adresse IP
".$_SERVER['REMOTE_ADDR'];
if ($email != NULL) {
   list($user, $domain) = split("@",$email, 2);
   if (checkdnsrr($domain, "MX") != TRUE) {$mail ="nok"; }
   else {mail($recipient, $subject, $message,'From:'.$email); $send = "ok"; $mail ="2";}
 }}
if ($mail == NULL and !empty($_POST['send'])) {$mail ="nok"; }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Gheberg.eu - Contact</title>
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
							    <li><a href="jeux.html">Serveur Jeux</a></li>
								<li><a href="mumble.html">Mumble</a></li>
                                <li class="last"><a href="contact.php"><img src="images/contact.png" width="22" style="margin-left:-53px;margin-top:0px"></a></li>
								</li>
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
<center>
<!--
<a href="https://www.gratuit-domaine.eu/webim/client.php?locale=fr" target="_blank" onclick="if(navigator.userAgent.toLowerCase().indexOf('opera') != -1 &amp;&amp; window.event.preventDefault) window.event.preventDefault();this.newWindow = window.open('https://www.gratuit-domaine.eu/webim/client.php?locale=fr&amp;url='+escape(document.location.href)+'&amp;referrer='+escape(document.referrer), 'webim', 'toolbar=0,scrollbars=0,location=0,status=1,menubar=0,width=640,height=480,resizable=1');this.newWindow.focus();this.newWindow.opener=window;return false;"><img src="https://www.gratuit-domaine.eu/webim/button.php?image=webim&amp;lang=fr" border="0" width="163" height="61" alt=""/></a>
<br><br>
-->
<li><a href="http://www.gratuit-domaine.eu/phpBB3/viewtopic.php?f=23&t=1977">Tutoriels</a></li>
<li><a href="forum.php">Forum</a></li>
<li><a href="faq.html">FAQ</a></li>
<li><a href="cgu_heberg.html"target="_blank">CGV</a></li><br>
<b>Support technique / Incident :</b>
<?php
require("conf.php");
$db_link = @mysql_connect($sql_serveur,$sql_user,$sql_passwd);
$requete=mysql_db_query($sql_bdd,"select * from hotline where id=\"1\"",$db_link) or die(mysql_error());
$etat=mysql_result($requete,0,"etat");
if ($etat == 1) echo"<b><font color=\"green\">OUVERT</font></b><br>";
else echo"<b><font color=\"red\">FERME</font></b><br>";
?>
<img src="images/ht.png" width="280px"><br>
Traitement immédiat de votre incident.<br>
<i>Temps d'attente actuel (indicatif) : 1 min</i>
<br><br>
    <b> <strong>Presse/Commercial :</strong></b></strong><br />  
 +33.5 35 54 18 69<br />
  <i>Appel non surtaxé.</i>
<br><br>
Nos outils :<br>
<a href="http://speedtest.gheberg.eu">SpeedTest</a><br>
<a href="http://demo.gheberg.eu">Stockage fichiers</a>
<br><br><br><br><br><br><br><br><br><br>
						</div>
								<center>	
<h6>Formulaire de contact standard</h6>
Si vous possédez déjà un compte gheberg, merci de nous contacter depuis votre compte.<br><br>
<form method="post" action="contact.php">
E-mail :<br>
<input type="text" name="email"><br>
Sujet :<br>
<input type="text" name="subject"><br>
Votre message :<br>
<textarea name="message"></textarea><br>
<INPUT type="submit" name="send" value="Envoyer" class="boiteFormulaire3"></form>

<?
if ($send == "ok")
  echo "<b>Votre mail a bien été envoyé.</b>";

if ($mail == "nok")
  echo "<b>Une erreur est survenue. Si le problème persiste, envoyé votre mail à contact@gheberg.eu</b>";
?>
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



