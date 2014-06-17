<?php
$p = htmlentities($_GET['p'],ENT_QUOTES);
$info = htmlentities($_GET['info'],ENT_QUOTES);
$choix = htmlentities($_POST['radio'],ENT_QUOTES);
$backup = htmlentities($_GET['backup'],ENT_QUOTES);
$disk = htmlentities($_GET['disk'],ENT_QUOTES);
if ($p != "vps2013_6" and $p != "vps2013_5" and $p != "vps2013_4" and $p != "vps2013_3" and $p != "vps2013_2" and $p != "vps2013_1" and $p != "low" and $p != "mb1" and $p != "voip1" and $p != "voip2" and $p != "m1" and $p != "m2" and $p != "m3" and $p != "vps11" and $p != "vps1" and $p != "vps2" and $p != "vps3" and $p != "vps4" and $p != "vps5" and $p != "vps6" and $p != "vps7" and $p != "h1" and $p != "h2" and $p != "h3"  and $p != "sd14_1" and $p != "sd14_2" and $p != "sd14_3" and $p != "sd14_4" and $p != "sd14_5" and $p != "cloud1" and $p != "cloud2" and $p != "cloud3")
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
<script type="text/javascript" src="testpseudo.js"></script> 
<script type="text/javascript" src="inscription.js"></script> 
<style type="text/css"> 
#weak, #medium
{
	border-right:solid 1px #DEDEDE;
}
 
#sm
{
	margin:0px;
	padding:0px;
	height:14px;
	font-family:Tahoma, Arial, sans-serif;
	font-size:9px;
}
 
#sm ul
{
	border:0px;
	margin:0px;
	padding:0px;
	list-style-type:none;
	text-align:center;
}
 
#sm ul li
{
	display:block;
	float:left;
	text-align:center;
	padding:0px 0px 0px 0px;
	margin:0px;
	height:14px;
}
 
.nrm
{
	width:84px;
	color:#adadad;
	text-align:center;
	padding:2px;
	background-color:#F1F1F1;
	display:block;
	vertical-align:middle;
}
 
.red
{
	width:84px;
	color:#FFFFFF;
	text-align:center;
	padding:2px;
	background-color:#FF6F6F;
	display:block;
	vertical-align:middle;
}
 
.yellow
{
	width:84px;
	color:#FFFFFF;
	text-align:center;
	padding:2px;
	background-color:#FDB14D;
	display:block;
	vertical-align:middle;
}
 
.green
{
	width:84px;
	color:#FFFFFF;
	text-align:center;
	padding:2px;
	background-color:#A0DA54;
	display:block;
	vertical-align:middle;
}
</style> 
<script type="text/javascript"> 
function evalPwd(s)
{
	var cmpx = 0;
	
	if (s.length < 6)
	{
	if (s.length > 0)
	{
		cmpx++;
	}}
	
	if (s.length >= 6)
	{
		cmpx++;
		
		if (s.search("[A-Z]") != -1)
		{
			cmpx++;
		}
		
		if (s.search("[0-9]") != -1)
		{
			cmpx++;
		}
		
		if (s.length >= 8 || s.search("[\x20-\x2F\x3A-\x40\x5B-\x60\x7B-\x7E]") != -1)
		{
			cmpx++;
		}
	}
	
	if (cmpx == 0)
	{
		document.getElementById("weak").className = "nrm";
		document.getElementById("medium").className = "nrm";
		document.getElementById("strong").className = "nrm";
	}
	else if (cmpx == 1)
	{
		document.getElementById("weak").className = "red";
		document.getElementById("medium").className = "nrm";
		document.getElementById("strong").className = "nrm";
	}
	else if (cmpx == 2)
	{
		document.getElementById("weak").className = "yellow";
		document.getElementById("medium").className = "yellow";
		document.getElementById("strong").className = "nrm";
	}
	else
	{
		document.getElementById("weak").className = "green";
		document.getElementById("medium").className = "green";
		document.getElementById("strong").className = "green";
	}
}
</script> 
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


						
<h6>Commande / Inscription</h6>
<?php
if ($choix == "2" or $p == "voip1" or $p == "voip2" or $p == "cloud1" or $p == "cloud2" or $p == "cloud3")
{
?>
<p>
<fieldset id="fieldset"><legend>Informations</legend> 
<p>Votre produit : <b><?php echo $p;?></b></p>
<p>Veuillez entrer vos informations personnelles pour la création d'un nouveau compte.</p>
<form action="command3.php?p=<?php echo "$p";?>&choix=2&info=<?php echo"$info";?>&disk=<?php echo $disk; ?>&backup=<?php echo $backup;?>" method="post" name="inscription"> 
</fieldset>
<fieldset id="fieldset"><legend>Compte</legend> 
<label>Pseudo</label><input type="text" name="pseudo" size="40" id="pseudo" onKeyUp="verifPseudo(this.value)"><span id="pseudobox"></span><br><br>
<label>Mot de passe</label><input type="password" name="passe" size="40"><br><br>
<label>Nom</label><input type="text" name="nom" size="40"><br><br>
<label>Prénom</label><input type="text" name="prenom" size="40"><br><br>
<label>Email</label><input type="text" name="email" size="40"><br><br>
<label>Tel</label><input type="text" name="tel" size="40"><br><br>
<label>N° + Rue</label><input type="text" name="rue" size="50px"><br><br>
<label>Code postal</label><input type="text" name="cp"><br><br>
<label>Ville</label><input type="text" name="ville"><br><br>

<?php
if ($p == "voip1" or $p == "voip2")
{
?>
<label>Zone locale : </label><select name="ligne">
	<option value="09">Numero non géographique (09)</option>
	<option value="bayonne" >Bayonne (05)
		                </option>
<option value="bobigny" >Bobigny (01)
		                </option>
<option value="bordeaux" >Bordeaux (05)
		                </option>
<option value="boulogne" >Boulogne-Billancourt (01)
		                </option>
<option value="caen" >Caen (02)
		                </option>
<option value="cergy" >Cergy (01)
		                </option>
<option value="corbeil" >Corbeil-Essonnes (01)
		                </option>
<option value="creteil" >Créteil (01)
		                </option>
<option value="dijon" >Dijon (03)
		                </option>
<option value="grenoble" >Grenoble (04)
		                </option>
<option value="havre" >Le Havre (02)
		                </option>
<option value="lens" >Lens (03)
		                </option>
<option value="lille" >Lille (03)
		                </option>
<option value="lyon" >Lyon (04)
		                </option>
<option value="marseille" >Marseille (04)
		                </option>
<option value="metz" >Metz (03)
		                </option>
<option value="montpellier" >Montpellier (04)
		                </option>
<option value="nanterre" >Nanterre (01)
		                </option>
<option value="nantes" >Nantes (02)
		                </option>
<option value="nice" >Nice (04)
		                </option>
<option value="paris" >Paris (01)
		                </option>
<option value="rennes" >Rennes (02)
		                </option>
<option value="rouen" >Rouen (02)
		                </option>
<option value="etienne" >Saint-Etienne (04)
		                </option>
<option value="strasbourg" >Strasbourg (03)
		                </option>
<option value="toulon" >Toulon (04)
		                </option>
<option value="toulouse" >Toulouse (05)
		                </option>
<option value="tours" >Tours (02)</option>
<option value="valenciennes" >Valenciennes (03)</option>
</select><br><br>
<?php
}
?>

<label><input type="checkbox" name="checkbox" value="checkbox"></label>J'accepte <a href="cgu_heberg.html" target="_blank">les conditions générales de vente et d'utilisation</a><br>
<br><label>Code promo :</label><input type="text" name="promo"><br>
<?php
if ($p != "vps2013_6" or $p != "vps2013_5" or $p != "vps2013_4" or $p != "vps2013_3" or $p != "vps2013_2" or $p != "vps2013_1" or $p == "vps1" or $p == "vps2" or $p == "vps3" or $p == "vps4" or $p == "vps5" or $p == "vps6" or $p == "vps7" or $p == "vps11")
{
$ip = $_SERVER["REMOTE_ADDR"];
echo "<br><center><font color=\"red\"><b>Toutes attaques depuis notre réseau entrenera systematiquement des poursuites judiciaire.<br>Pour information, votre ip ($ip) est enregistrée.</b></font></center>";
}
?>
<br><input type="submit" value="Envoyer" class="boiteFormulaire3" style="margin-left:60px;"/></form>
</fieldset>
<?php
}
else {
?>
<p>Votre produit : <b><?php echo $p;?></b></p>
Veuillez entrer vos identifiants Gratuit-Domaine.eu ci-dessous.<br><br>
<form action="command3.php?p=<?php echo "$p";?>&choix=1&info=<?php echo"$info";?>&disk=<?php echo $disk; ?>&backup=<?php echo $backup;?>" method="post" name="inscription"> 
Pseudo : <i>(votre site sera de la forme pseudo.gheberg.eu)</i><br><input type="text" name="pseudo" size="40"><br>
Mot de passe :<br><input type="password" name="passe" size="40"><br>
<br><input type="checkbox" name="checkbox" value="checkbox">J'accepte <a href="cgu_heberg.html" target="_blank">les conditions générales de vente et d'utilisation</a><br>
<br><input type="submit" value="Envoyer" class="boiteFormulaire3"/></form>
<?php
}
?>
</p>
						
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



