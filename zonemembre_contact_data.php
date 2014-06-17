<?php
$script=$_GET['script'];
$case=$_POST['case'];

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
$pseudo=mysql_result($requete,0,"pseudo");
$nom=mysql_result($requete,0,"nom");
$prenom=mysql_result($requete,0,"prenom");

$requetededie=mysql_db_query($sql_bdd,"select * from heberg_dedie where pseudo=\"$pseudo\"",$db_link);
if(mysql_num_rows($requete)!=0)
{
  $vnc = mysql_result($requetededie,0,"vnc");
  $ip = mysql_result($requetededie,0,"ip");
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
<fieldset id="fieldset"><legend><h1>Rapport d'intervention</h1></legend>
<?php
try {
 $soap = new SoapClient("https://www.ovh.com/soapi/soapi-re-1.46.wsdl");
 $session = $soap->login("***-ovh", "***","fr", false);
 $result = $soap->ticketGet($session, $_GET['id']);
 $soap->logout($session);
 } catch(SoapFault $fault) {}
 
 $vnc2 = explode(".", $result->domain);
 if ($vnc != $vnc2[0]) die("Error : please contact administrator : contact@gheberg.eu");
 
$search = array('***-ovh', '***-ovh', '***-OVH', '***', '***', 'ovh.net', 'kimsufi.com', 'ovh', 'OVH', 'Dans le cas ou ces connexions seraient legitimement', 'effectuees depuis', 'votre serveur, nous vous demandons de personnaliser le', 'reverse du', 'serveur : http://guides.gheberg.com/PersonnalisationDeReverse', 'Vous pouvez avoir un apercu global des machines', 'actuellement en defaut', 'et en intervention sur tout le reseau a cette adresse:', 'http://travaux.gheberg.eu/vms/', $vnc);
$replace = array('gheberg', 'gheberg', 'gheberg', 'gheberg', 'gheberg', 'gheberg.eu','gheberg.eu','gheberg', 'GHEBERG', '', '', '', '', '', '', '', '', '', $ip);
 
 $i=0;
 while(isset($result->messages[$i]))
 {
  $result->messages[$i]->message = str_replace($search,$replace,$result->messages[$i]->message);
  $result->messages[$i]->from = str_replace($search,$replace,$result->messages[$i]->from);
  
  echo '<table class="cadre" border="0" cellpadding="3" cellspacing="1" width="600px" style="margin-left:100px">
<tr class="titre">
  <td class="titre" width="800px"><strong>R&eacute;ponse de '.$result->messages[$i]->from.',</strong></td>
</tr>
<tr class="cadre">
  <td valign="top">
	<div><pre>'.$result->messages[$i]->message.'</pre></div>

	
  </td>
</tr>
</table><br>';
  $i++;
 }
 ?>


</fieldset>
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



