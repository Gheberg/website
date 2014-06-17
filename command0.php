<?php
$p = htmlentities($_GET['p'],ENT_QUOTES);
$info = htmlentities($_GET['info'],ENT_QUOTES);
if ($p != "vps2013_6" and $p != "vps2013_5" and $p != "vps2013_4" and $p != "vps2013_3" and $p != "vps2013_2" and $p != "vps2013_1" and $p != "vps11" and $p != "vps1" and $p != "vps2" and $p != "vps3" and $p != "vps4" and $p != "vps5" and $p != "vps6" and $p != "vps7" and $p != "h1" and $p != "h2" and $p != "h3"  and $p != "sd14_1" and $p != "sd14_2" and $p != "sd14_3" and $p != "sd13_4" and $p != "sd14_5")
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
<script language="JavaScript"> 
	function affich(quel){
		obj=document.getElementById(quel);
		if (obj.style.display=="none"){
		obj.style.display="block";}
		if (quel == 1)
		{
			obj=document.getElementById(2);
			obj.style.display="none";
		}
		else if (quel == 2)
		{
			obj=document.getElementById(1);
			obj.style.display="none";
		}
	}
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
							<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                        </div>
						
<h6>Commande / Inscription</h6><br>
<?php
if ($p == "vps2013_6" or $p == "vps2013_5" or $p == "vps2013_4" or $p == "vps2013_3" or $p == "vps2013_2" or $p == "vps2013_1" or $p == "vps1" or $p == "vps2" or $p == "vps3" or $p == "vps4" or $p == "vps5" or $p == "vps6" or $p == "vps7" or $p == "vps11")
{
?>
Veuillez choisir le système d'exploitation de votre choix :
<form action="command.php?p=<?php echo"$p";?>" method="post">
<!--<select name="sys">
<option value="">Choisissez...</option>
<option value="Debian 5.0">Debian 5.0</option>
<option value="Debian 6.0">Debian 6.0</option>
<option value="Ubuntu 10.04">Ubuntu 10.04</option>
<option value="ArchLinux 2011">ArchLinux 2011</option>
<option value="Linux Mint 11">Linux Mint 11</option>
<option value="Mandriva 2011">Mandriva 2011</option>
<option value="OpenSuse">OpenSuse</option>
<option value="plesk 9.5">PLESK 9.5</option>
<option value="plesk 10">PLESK 10</option>
<option value="Ubuntu 10.10 Desktop">Ubuntu 10.10 Desktop</option>
<option value="Windows Server 2003 r2">Windows Server 2003 r2</option>
<option value="Windows Server 2008 standard">Windows Server 2008 standard</option>
<option value="Windows Server 2008 enterprise">Windows Server 2008 enterprise</option>
</select>
-->

<table><tr><td><img src="images/sd_win.jpg"></td><td><input type="radio" name="radio" OnClick="affich(1);"> Systèmes Windows</td></tr><br>
<tr><td><img src="images/sd_linux.jpg"></td><td><input type="radio" name="radio" OnClick="affich(2);"> Systèmes Linux</td></tr>
<tr><td><img src="images/iso.png" width="70%"></td><td><input type="radio" name="sys" value="ISO perso"> Envoyer votre ISO</td></tr>

</table><br>

<div id="1" style="display:none">
<br><p>GHEBERG vous offre le choix entre les systèmes suivants :</p>
<input type="radio" name="sys" value="Windows Server 2003 R2" style="margin-left:20px;"> Windows Server 2003 R2<br>
<input type="radio" name="sys" value="Windows Server 2008 R2" style="margin-left:20px;"> Windows Server 2008 R2 <b>(VPS2 minimum)</b><br>
</div>
<div id="2" style="display:none">
<br><p>GHEBERG vous offre le choix entre les systèmes suivants :</p>
<table>
<tr><td><input type="radio" name="sys" value="Ubuntu 10.04 Console" style="margin-left:20px;"> Ubuntu 10.04 Console</td><td></td></tr>
<tr><td><input type="radio" name="sys" value="Debian 5.0 32 bits" style="margin-left:20px;"> Debian 5.0 32 bits Deprecated<br></td><td></td></tr>
<tr><td><input type="radio" name="sys" value="Debian 5.0 64 bits" style="margin-left:20px;"> Debian 5.0 64 bits Deprecated<br></td><td></td></tr>
<tr><td><input type="radio" name="sys" value="Debian 6.0 32 bits" style="margin-left:20px;"> Debian 6.0 32 bits OldStable<br></td><td></td></tr>
<tr><td><input type="radio" name="sys" value="Debian 6.0 64 bits" style="margin-left:20px;"> Debian 6.0 64 bits OldStable<br></td><td></td></tr>
<tr><td><input type="radio" name="sys" value="Debian 7.0 32 bits" style="margin-left:20px;"> Debian 7.0 32 bits<br></td><td></td></tr>
<tr><td><input type="radio" name="sys" value="Debian 7.0 64 bits" style="margin-left:20px;"> Debian 7.0 64 bits<br></td><td></td></tr>
<tr><td width="300px"><input type="radio" name="sys" value="ArchLinux 2013 x86_64" style="margin-left:20px;"> ArchLinux 2013 x86_64 </td><td><b>(512 Mo RAM minimum)</b></td></tr>
<tr><td><input type="radio" name="sys" value="Linux Mint 14 64 bit" style="margin-left:20px;"> Linux Mint 14 64 bit </td><td><b>(512 Mo RAM minimum)</b></td></tr>
<tr><td><input type="radio" name="sys" value="Mandriva 2011 x86_64" style="margin-left:20px;"> Mandriva 2011 x86_64 </td><td><b>(512 Mo RAM minimum)</b></td></tr>
<tr><td><input type="radio" name="sys" value="OpenSuse x86_64" style="margin-left:20px;"> OpenSuse x86_64 </td><td><b>(512 Mo RAM minimum)</b></td></tr>
<tr><td><input type="radio" name="sys" value="Ubuntu 12.10 Desktop" style="margin-left:20px;"> Ubuntu 12.10 Desktop </td><td><b>(512 Mo RAM minimum)</b></td></tr>
<tr><td><input type="radio" name="sys" value="Ubuntu 12.04 Desktop" style="margin-left:20px;"> Ubuntu 12.04 Desktop </td><td><b>(512 Mo RAM minimum)</b></td></tr>
<tr><td><input type="radio" name="sys" value="Ubuntu 10.10 Desktop" style="margin-left:20px;"> Ubuntu 10.10 Desktop </td><td><b>(512 Mo RAM minimum)</b></td></tr>
</table>
</div>
<?php
if ($p == "vps2013_6" or $p == "vps2013_5" or $p == "vps2013_4" or $p == "vps2013_3" or $p == "vps2013_2" or $p == "vps2013_1" or $p == "vps1")
{
?>
<br><br>
<table>
<tr><td><input type="checkbox" name="disk"></td><td style="padding-left:5px">+50 Go d'espace disque supplémentaire : 2 € / mois</td></tr>
<tr><td><input type="checkbox" name="backup"></td><td style="padding-left:5px">Backup journalié sur disque externe : 5 € / mois</td></tr>
</table>

<?php
}
?>
<br>
<br>
<input type="submit" value="Continuer" class="boiteFormulaire3"/></form>
<?php
if ($p == "vps1")
{
	echo "<br><br><center><small><font color='red'>Attention, certaines distributions nécessitent un serveur avec 512 Mo de RAM.</font></small></center>";
}
	?>
<?php
}
if ($p == "css1" or $p == "css2" or $p == "css3")
{
?>
Souhaitez vous installer <b>Panel admin in game sourcemod</b> :<br><br>
<form action="command.php?p=<?php echo"$p";?>" method="post">
<select name="sys">
<option value="non">Non</option>
<option value="oui">Oui</option>
</select>
<br><br>
<input type="submit" value="Continuer" class="boiteFormulaire3"/></form>
<?php
}
if ($p == "sd14_1" or $p == "sd14_2" or $p == "sd14_3" or $p == "sd13_4" or $p == "sd14_5")
{
?>
Veuillez choisir le système d'exploitation de votre choix :<br><br>
<form action="command.php?p=<?php echo"$p";?>" method="post">
<select name="sys">
<option value="">Choisissez...</option>
<option value="centos 5.2">CentOS 5.2</option>
<option value="Debian 5.0">Debian 5.0</option>
<option value="Debian 6.0">Debian 6.0</option>
<option value="Ubuntu 8.04">Ubuntu 8.04</option>
<option value="Ubuntu 8.10">Ubuntu 10.10</option>
<option value="plesk">PLESK 9.5 (centos) (+licence  1 domaine offerte)</option>
<option value="Ubuntu 8.10.desktop">Ubuntu 10.04 Desktop</option>
<option value="Ubuntu 10.04 Desktop">ArchLinux 2009.08</option>
<option value="Windows Server 2003 r2">Windows Server 2008 Core Web Edition (+23€)</option>
<option value="Windows Server 2008 standard">Windows Server 2008 R2 Core Standard Edition (+40€)</option>
<option value="Windows Server 2008 enterprise">Windows Server 2008 R2 Core Entreprise Edition (+115€)</option>
<option value="Windows Server 2008 datacentre">Windows Server 2008 R2 Core Datacenter Edition (+103€)</option>
</select>
<br>
<input type="submit" value="Continuer" class="boiteFormulaire3"/></form>
<?php
}
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



