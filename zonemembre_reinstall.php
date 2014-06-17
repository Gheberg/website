<?php
//connexion base de donnees
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


$requete3=mysql_db_query($sql_bdd_vps,"select * from tasks where vid=\"$vmid\" and type=\"4\" order by id desc",$db_link_vps) or die(mysql_error());
if(mysql_num_rows($requete3)!=0)
	{
		$status=mysql_result($requete3,0,"status");
		if ($status == "3") $atten = 1;
		else $atten = 0;
	}
else
	{
		$atten = 0;
	}


if ($_GET['action'] == "reinstall" and $atten == 0){
$requete1=mysql_db_query($sql_bdd_vps,"select * from vps where nom=\"$pseudo\"",$db_link_vps) or die(mysql_error());
if(mysql_num_rows($requete1)==0)
	{
	exit;
	}
else
	{
	$vmid=mysql_result($requete1,0,"vmid");
	}
	
mysql_db_query($sql_bdd_vps,"insert into tasks values ('', '$vmid', '4', '0', '0')",$db_link_vps) or die(mysql_error());
$requete2=mysql_db_query($sql_bdd_vps,"select * from tasks where vid=\"$vmid\" order by id desc",$db_link_vps) or die(mysql_error());
$id=mysql_result($requete2,0,"id");
$os_id = mysql_real_escape_string($_POST['system']);
if ($p == "vps11" and $os_id != 4 and $os_id != 5 and $os_id != 9 and $os_id != 10) $os_id = 4;

mysql_db_query($sql_bdd_vps,"insert into reinstall values ('', '$id', '$os_id', '$passe')",$db_link_vps) or die(mysql_error());

if ($os_id == "1" or $os_id == "2" or $os_id == "3") $tyty = 2;
else $tyty = 1;

$requete4=mysql_db_query($sql_bdd_vps,"UPDATE vps set type='$tyty', os_id='$os_id' WHERE nom='$pseudo'",$db_link_vps) or die(mysql_error());

}
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

	a=0;
	function compte(){
		document.getElementById("cpt").innerHTML=a;
		
		
		check = file('zonemembre_reinstall_check.php?idd=<?php echo"$idd";?>');
		
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
				<h6>Réinstallation automatique</h6>
<br>
<?php
if ($_GET['action'] == "reinstall" or $atten == 1){
?>
<script type="text/javascript">
go=setInterval("compte()",1000);
</script>

<fieldset id="fieldset"><legend><h1>Etape 3/3</h1></legend> 
<div id="loading"><table align="center"><tr><td><img src="images/ajax-loader.gif"></td><td> Réinstallation en cours : <span id="cpt">0</span> s
</font></td></tr></table><br>
</div>

<div id="check" style="display:none"><table align="center"><tr><td><img src="images/check.png"></td><td>Réinstallation effectuée ! (<span id="cpt2"></span> s)</td></tr></table><br>Vous pouvez dès maintenant paramétrer votre serveur en suivant ce guide : <a href="https://www.gheberg.eu/tuto_reinstall.php" target="_blank">https://www.gheberg.eu/tuto_reinstall.php</a></div>

<div id="nocheck" style="display:none"><table align="center"><tr><td><img src="images/uncheck2.png"></td><td>Réinstallation échouée ! (<span id="cpt3"></span> s)</td></tr></table><br>Veuillez contacter le support technique en ouvrant un ticket incident (rubrique Assistance).</a></div>
</fieldset>

<?php
}
else{
?>
<fieldset id="fieldsetrouge"> 
<center>
Cette page vous permet de lancer une réinstallation complète de votre serveur<br>
C'est une procédure irréversible, aucunes données ne sera récupérable.
</center>
</fieldset>
<br>
<fieldset id="fieldset"><legend><h1>Etape 1/3 : Choix du système</h1></legend> 
<form action="zonemembre_reinstall.php?action=reinstall&idd=<?php echo"$idd";?>" method="post">
<table><tr><td><img src="images/sd_win.jpg"></td><td><input type="radio" name="radio" OnClick="affich(1);"> Systèmes Windows</td></tr><br>
<tr><td><img src="images/sd_linux.jpg"></td><td><input type="radio" name="radio" OnClick="affich(2);"> Systèmes Linux</td></tr></table><br>

<div id="1" style="display:none">
<br><p>GHEBERG vous offre le choix entre les systèmes suivants :</p>
<?php
if ($p != "vps11")
{
?>
<input type="radio" name="system" value="1" style="margin-left:20px;" OnClick="affich(3);"> Windows Server 2003 R2<br>
<input type="radio" name="system" value="2" style="margin-left:20px;" OnClick="affich(3);"> Windows Server 2008 R2 <b>(VPS2 minimum)</b><br>
<?php
}
else echo "Vous utilisez actuellement l'offre <b>VPS 1.11</b>, seul <b>DEBIAN</b> est possible.";
?>
</div>
<div id="2" style="display:none">
<br><p>GHEBERG vous offre le choix entre les systèmes suivants :</p>
<?php
if ($p != "vps11")
{
?>
<table>
<tr><td width="300px"><input type="radio" name="system" value="16" style="margin-left:20px;" OnClick="affich(3);"> ArchLinux 2013 x86_64 </td><td><b>(512 Mo RAM minimum)</b></td></tr>
<tr><td><input type="radio" name="system" value="17" style="margin-left:20px;" OnClick="affich(3);"> Linux Mint 14 64 bit </td><td><b>(512 Mo RAM minimum)</b></td></tr>
<tr><td><input type="radio" name="system" value="13" style="margin-left:20px;" OnClick="affich(3);"> Mandriva 2011 x86_64 </td><td><b>(512 Mo RAM minimum)</b></td></tr>
<tr><td><input type="radio" name="system" value="14" style="margin-left:20px;" OnClick="affich(3);"> OpenSuse x86_64 </td><td><b>(512 Mo RAM minimum)</b></td></tr>
<tr><td><input type="radio" name="system" value="18" style="margin-left:20px;" OnClick="affich(3);"> Ubuntu 12.10 Desktop </td><td><b>(512 Mo RAM minimum)</b></td></tr>
<tr><td><input type="radio" name="system" value="19" style="margin-left:20px;" OnClick="affich(3);"> Ubuntu 12.04 Desktop </td><td><b>(512 Mo RAM minimum)</b></td></tr>
<tr><td><input type="radio" name="system" value="3" style="margin-left:20px;" OnClick="affich(3);"> Ubuntu 10.10 Desktop </td><td><b>(512 Mo RAM minimum)</b></td></tr>
<tr><td><input type="radio" name="system" value="8" style="margin-left:20px;" OnClick="affich(3);"> Ubuntu 10.04 Console</td><td></td></tr>
</table>
<?php
}
?>
<input type="radio" name="system" value="4" style="margin-left:20px;" OnClick="affich(3);"> Debian 5.0 32 bits Deprecated<br>
<input type="radio" name="system" value="9" style="margin-left:20px;" OnClick="affich(3);"> Debian 5.0 64 bits Deprecated<br>
<input type="radio" name="system" value="5" style="margin-left:20px;" OnClick="affich(3);"> Debian 6.0 32 bits OldStable<br>
<input type="radio" name="system" value="10" style="margin-left:20px;" OnClick="affich(3);"> Debian 6.0 64 bits OldStable<br>
<input type="radio" name="system" value="20" style="margin-left:20px;" OnClick="affich(3);"> Debian 7.0 32 bits<br>
<input type="radio" name="system" value="21" style="margin-left:20px;" OnClick="affich(3);"> Debian 7.0 64 bits<br>
<?php
if ($p != "vps11")
{
?>
<input type="radio" name="system" value="6" style="margin-left:20px;" OnClick="affich(3);"> Plesk 9.5 (ubuntu)<br>
<input type="radio" name="system" value="7" style="margin-left:20px;" OnClick="affich(3);"> Plesk 10 (ubuntu)<br>
<?php
}
?>
</div>

</fieldset>
<br>
<div id="3" style="display:none">
<fieldset id="fieldset"><legend><h1>Etape 2/3</h1></legend>
<font color="red">La réinstallation peut durer jusqu'à 20 minutes.</font><br>
Veuillez suivre ce guide afin d'effectuer <b>le paramétrage réseau</b> de votre serveur : <a href="https://www.gheberg.eu/tuto_reinstall.php" target="_blank">https://www.gheberg.eu/tuto_reinstall.php</a><br>
<br><input type="submit" value="Réinstaller" onclick="if (! confirm('Etes-vous sur de vouloir réinstaller votre serveur ?')) { return false;}">
</form>
</fieldset>
</div>
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



