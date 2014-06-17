<?php
//connexion base de donnees

require("conf.php");
$db_link = @mysql_connect($sql_serveur,$sql_user,$sql_passwd);

//securisation injection sql
$idd=mysql_real_escape_string($_GET['DATAS']);

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
    <h2>Sauvegarde automatique</h2>

<?php
//DEBUT TEST
  $RECALL = $_GET["RECALL"];
  if( trim($RECALL) == "" )
  {
$test = "1";
  }
  $RECALL = urlencode( $RECALL );
  $AUTH = urlencode( "226116/893338/2083861" );
  $roo = @file( "https://payment.allopass.com/api/checkcode.apu?code=$RECALL&auth=$AUTH" );

  if( substr($roo[0],0,2) != "OK" ) 
  {
$test = "1";
  }

else { $test = "0"; }

//FIN DU TEST

$dated = date('d');
$datem = date('m');
$heure = date('H:i:s');
$ip = $_SERVER['REMOTE_ADDR'];
$nouvellem = $datem + "1";
if ($nouvellem > "12") {$nouvellem = "01";}
$nouvelle = "$dated/$nouvellem";

require("conf.php");
$db_link = @mysql_connect($sql_serveur,$sql_user,$sql_passwd);
if ($test == "0") {
$requete2=mysql_db_query($sql_bdd,"select * from heberg_sauvegarde_allopass where code=\"$RECALL\"",$db_link) or die(mysql_error());
if(mysql_num_rows($requete2)==0)
	{
$requete3=mysql_db_query($sql_bdd,"select * from heberg_sauvegarde where pseudo=\"$pseudo\"",$db_link) or die(mysql_error());
	if(mysql_num_rows($requete3)==0)
	{
	mysql_db_query($sql_bdd,"insert into heberg_sauvegarde values ('', '$pseudo', '$nouvelle')",$db_link) or die(mysql_error());
	}
	else
	{
	$daterequete3=mysql_result($requete3,0,"date");
	$renew = explode("/", $daterequete3);
	$nouvellerenew = $renew[1] + "1";
	$nouvelledate = "$renew[0]/$nouvellerenew";
	
	mysql_connect("localhost", "root", "***");
	mysql_select_db("db252300216");
	mysql_query("UPDATE heberg_sauvegarde SET date='$nouvelle' where pseudo='$pseudo'");
	}
	   
$Destinataire = "$email";
$Sujet = "[Gheberg] Offre sauvegarde";
$From='From: "GHeberg"<contact@gheberg.eu>'."\n"; 
$From .= "MIME-version: 1.0\n";
$From .= "Content-type: text/html; charset= iso-8859-1\n";
$Message = "Bonjour $prenom, <br>Vous venez de souscrire à une offre de sauvegarde pour votre produit. Votre souscription est valable jusqu'au $nouvelle .<br><br>Merci et a bientot!<br>L'équipe GHeberg.eu";
mail($Destinataire,$Sujet,$Message,$From);
mysql_db_query($sql_bdd,"insert into heberg_sauvegarde_allopass values ('', '$RECALL')",$db_link) or die(mysql_error());

mysql_db_query($sql_bdd,"insert into heberg_log values ('', '$pseudo', '$date $heure', '$ip', 'Offre de sauvegarde : $nouvelle', '$idd')",$db_link) or die(mysql_error());
mysql_db_query($sql_bdd,"insert into heberg_admin values ('', '$pseudo', '$nouvelle', 'backup on')",$db_link) or die(mysql_error());

echo "
Merci, votre commande vient d'être prise en compte. Votre option sera activé sous 48 heures. Si vous souhaitez obtenir une sauvegarde de votre site, merci de contacter le support technique.<br><br>
";
	}
	else{
echo "
<h1>Commande refusé,</h1>
Votre commande est refusée !<br><br>Ceci peu venir de différente raisons :<br><li>Vous avez actualiser cette page</li><li>La requête au serveur Allopass à échouée</li><br><br>Pour tout problème, n'hésitez pas à nous contacter.</center>
   ";
	}}
	
	if ($test == "1") {
echo "
<h1>Commande refusée,</h1>
Votre commande est refusée !<br><br>Ceci peu venir de différente raisons :<br><li>Vous avez actualiser cette page</li><li>La requête au serveur Allopass à échouée</li><br><br>Pour tout problème, n'hésitez pas à nous contacter.</center>
   ";
	}
	
?>
	
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
