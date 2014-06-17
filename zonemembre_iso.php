<?php
if ($_GET['action'] == "iso")
{
	$url = $_POST['url'];
	$verif = 0;
	if (filter_var($url, FILTER_VALIDATE_URL)) $verif = 1;
}
else $verif = 1;

//connexion bases de donnees
require("conf.php");
require("conf_vps.php");
$db_link = @mysql_connect($sql_serveur,$sql_user,$sql_passwd);
$db_link_vps = mysql_connect($sql_serveur_vps,$sql_user_vps,$sql_passwd_vps);

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
$date=mysql_result($requete,0,"date");
$pseudo=mysql_result($requete,0,"pseudo");
$passe=mysql_result($requete,0,"passe");

$atten = 0;
$requete3=mysql_db_query($sql_bdd_vps,"select * from isoperso where pseudo=\"$pseudo\" and etat=\"0\"",$db_link_vps) or die(mysql_error());
if(mysql_num_rows($requete3)!=0) $atten = 1;

$requete1=mysql_db_query($sql_bdd_vps,"select * from vps where nom=\"$pseudo\"",$db_link_vps) or die(mysql_error());
if(mysql_num_rows($requete1)==0)
	{
	exit;
	}
else
	{
	$vmid=mysql_result($requete1,0,"vmid");
	}

if ($_GET['action'] == "iso" and $atten == 0 and $verif == 1)	
mysql_db_query($sql_bdd_vps,"insert into isoperso values ('', '$pseudo', '$vmid', '$url', '0')",$db_link_vps) or die(mysql_error());
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
<script language="JavaScript"> 
	a=0;
	function compte(){
		document.getElementById("cpt").innerHTML=a;
		
		
		check = file('zonemembre_iso_check.php?idd=<?php echo"$idd";?>');
		
		if (check == "OK") {
			a=a;
			obj=document.getElementById('check');
			obj2=document.getElementById('loading');
			obj.style.display="block";
			obj2.style.display="none";
			document.getElementById("cpt2").innerHTML=a;
		}
		else if (a >= 1200 || check == "NOK") {
			a=a;
			obj=document.getElementById('loading');
			obj2=document.getElementById('nocheck');
			obj.style.display="none";
			obj2.style.display="block";
			document.getElementById("cpt3").innerHTML=a;
		}
		else if (check == "LOAD") {
			a=a+1;
		}
		else {
			check = "nok";
		}
	}
	
	function file(fichier)
	{
		if(window.XMLHttpRequest) // FIREFOX
		xhr_object = new XMLHttpRequest();
		else if(window.ActiveXObject) // IE
		xhr_object = new ActiveXObject("Microsoft.XMLHTTP");
		else
		return(false);
		xhr_object.open("GET", fichier, false);
		xhr_object.send(null);
		if(xhr_object.readyState == 4) return(xhr_object.responseText);
		else return(false);
	}

</script>
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
<?php
if ($_GET['action'] == "iso" or $atten == 1){
?>
<script type="text/javascript">
go=setInterval("compte()",1000);
</script>

<fieldset id="fieldset"><legend><h1>Etape 2/2</h1></legend> 
<div id="loading"><table align="center"><tr><td><img src="images/ajax-loader.gif"></td><td> Téléchargement en cours : <span id="cpt">0</span> s
</font></td></tr></table><br>
</div>

<div id="check" style="display:none"><table align="center"><tr><td><img src="images/check.png"></td><td>Modification effectuée ! (<span id="cpt2"></span> s)</td></tr></table><br><br>Vous pouvez dès maintenant Rebooter votre serveur <a href="zonemembre_product.php?idd=<?php $idd; ?>">ici</a>.<br>En utilisant la connexion VNC, lors du reboot, appuyer sur la touche F12 de votre clavier pour démarrer sur le CD-ROM.</div>

<div id="nocheck" style="display:none"><table align="center"><tr><td><img src="images/uncheck2.png"></td><td>Modification échouée ! (<span id="cpt3"></span> s)</td></tr></table><br>Vous pouvez contacter le support technique en ouvrant un ticket incident (rubrique Assistance).</a></div>
</fieldset>

<?php
if ($verif == 0) {
?>
<fieldset id="fieldsetrouge"> 
<center>
<b>Erreur :</b> Format de l'URL incorrect.
</center>
</fieldset>
<?php
}
}
else {
?>
<fieldset id="fieldsetrouge"> 
<center>
Cette page vous permet d'uploader une image ISO dans le lecteur CD-ROM de votre VPS.<br><br>
<b>Attention :</b> Si votre serveur est actuellement installé sous Debian, vous ne pouvez pas utiliser cette fonctionnalité.<br>Vous devez réinstaller votre machine sous une autre distribution.
</center>
</fieldset>
<br>
<fieldset id="fieldset"><legend><h1>Etape 1/2</h1></legend> 
Vous devez insérer l'URL où se trouve l'image ISO que vous souhaitez placer dans votre lecteur CD-ROM.<br><br>
<form action="zonemembre_iso.php?action=iso&idd=<?php echo"$idd";?>" method="post">
URL : <input type="text" name="url" value="http://urldusite.com/image.iso" style="width:300px">
<br><br>
<input type="submit" value="Envoyer" class="boiteFormulaire3">
</form>
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



