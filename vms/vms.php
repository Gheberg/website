<?php
require("conf.php");
$db_link = @mysql_connect($sql_serveur,$sql_user,$sql_passwd);
mysql_connect("localhost", "vpsm", "***");
mysql_select_db("vpsm");


$reponse1 = mysql_query("SELECT * FROM vps WHERE (vmid<1400 AND vmid>1300) OR (vmid<50 AND vmid>400) OR (vmid<300 AND vmid>200) ORDER BY vmid");
$reponse2 = mysql_query("SELECT * FROM vps WHERE (vmid<900 AND vmid>800) OR (vmid<1200 AND vmid>1100) OR (vmid<1700 AND vmid>1600) OR vmid>10000 ORDER BY vmid");
$reponse3 = mysql_query("SELECT * FROM vps WHERE (vmid<1500 AND vmid>1400) ORDER BY vmid");
$reponse4 = mysql_query("SELECT * FROM vps WHERE (vmid<1300 AND vmid>1200) OR (vmid<1600 AND vmid>1500) ORDER BY vmid");
$reponse5 = mysql_query("SELECT * FROM vps WHERE vmid<2000 AND vmid>1900 ORDER BY vmid");
$reponse6 = mysql_query("SELECT * FROM vps WHERE vmid<2100 AND vmid>2000 ORDER BY vmid");

$nbe = mysql_num_rows($reponse1);$nbe = $nbe / 4;
?>

<html>
	<head>
	<meta name="keywords" content="heberg gratuit, hebergement gratuit,hébergement gratuit,hébergement,gratuit,hébergeur gratuit,hebergeur gratuit,hebergement mutualise,hébergement mutualisé,hébergeur free,hebergeur free, hébergeur php, hebergeur php" />
	<meta name="description" content="Visual Monitoring System" />
		<link rel="stylesheet" type="text/css" href="style.css"/>
		<link rel="stylesheet" type="text/css" href="../style-projects-jquery.css" />   
		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript" src="js/jquery.lightbox-0.5.js"></script>
		<link rel="stylesheet" type="text/css" href="css/jquery.lightbox-0.5.css" media="screen" />
		    <script type="text/javascript">
			$(function() {
				$('#gallery a').lightBox();
			});
			</script>
	<meta http-equiv="refresh" content="120 ; url='./vms.php'">
    <meta http-equiv="cache-control" content="no-cache">

	</head>
	<body>
	<h3>Visual Monitoring System (realtime, France) - GHEBERG</h3>
		<?php
			for($i=0;$i<6;$i++)
			{										
				?>
				
				<table border="0" cellpadding="1" cellspacing="1">
					<?php

										if($i==0) {echo"<tr><th>chic</th></tr>";}
										elseif($i==1) {echo"<tr><th>fafa &nbsp;</th></tr>";}
										elseif($i==2) {echo"<tr><th>n101 &nbsp;</th></tr>";}
										elseif($i==3) {echo"<tr><th>n102 &nbsp;</th></tr>";}
										elseif($i==4) {echo"<tr><th>n103 &nbsp;</th></tr>";}
										elseif($i==5) {echo"<tr><th>n104 &nbsp;</th></tr>";}
										
						for($j=0;$j<$nbe;$j++)
						{
							?>
							<tr><?php
										for($k=0;$k<4;$k++)
										{
										if($i==0) {$donnees = mysql_fetch_array($reponse1);$nbe = mysql_num_rows($reponse1);$nbe = $nbe / 4;}
										elseif($i==1) {$donnees = mysql_fetch_array($reponse2);$nbe = mysql_num_rows($reponse2);$nbe = $nbe / 4;}
										elseif($i==2) {$donnees = mysql_fetch_array($reponse3);$nbe = mysql_num_rows($reponse3);$nbe = $nbe / 4;}
										elseif($i==3) {$donnees = mysql_fetch_array($reponse4);$nbe = mysql_num_rows($reponse4);$nbe = $nbe / 4;}
										elseif($i==4) {$donnees = mysql_fetch_array($reponse5);$nbe = mysql_num_rows($reponse5);$nbe = $nbe / 4;}
										elseif($i==5) {$donnees = mysql_fetch_array($reponse6);$nbe = mysql_num_rows($reponse6);$nbe = $nbe / 4;}
							

										if (empty($donnees['vmid'])){$k=4;$j=$nbe;}
										else{
											if ($donnees['status'] == 1)
											{
											?>
											<td width='1' bgcolor="#00CC33" align='center' valign='center' style="font-size:10pt"><?php echo $donnees['vmid'];?></td>
											<?php
											}
											else{
											
											$nom=$donnees['nom'];

											$requete=mysql_db_query($sql_bdd,"select * from heberg_membres where pseudo=\"$nom\"",$db_link) or die(mysql_error());
											@$date=mysql_result($requete,0,"date");
											
		
$jour = date('d');
$mois = date('m');
$ref = $mois * 100 + $jour;
$exp = explode("/",$date);
$exp[1] += 1;
if ($exp[1] > 12) {$exp[1] = 1;}
$date_test = $exp[1] * 100 + $exp[0];


if ($date_test < $ref or $mois == 01)
{
?>
<td width='1' bgcolor="#00CC33" align='center' valign='center' style="font-size:10pt;"><?php echo $donnees['vmid'];?></td>
<?php
}
else
{
?>
<td width='1' bgcolor="red" align='center' valign='center' style="font-size:10pt;"><?php echo $donnees['vmid'];?></td>
<?php
}


											?>
											
											<?php
											}
											}
										}
										?><td width="3"></td>
							</tr><?php
						}?>
				</table><?php
			}
		?>
		
<br><br><br>
<table>
<tr><td width='3' bgcolor="red" align='center' valign='center' style="font-size:10pt;"></td><td>Serveur(s) arrété(s)</td></tr>
<tr><td width='3' bgcolor="#00CC33" align='center' valign='center' style="font-size:10pt;"></td><td>Serveur(s) en ligne</td></tr>
</table>	

<div id="gallery">
<table border="0">
<tr>
<th>
fafa
</th>
<th>
chic
</th>
<th>
node 101
</th>
<th>
node 102
</th>
<th>
node 103
</th>
<th>
node 104
</th>
</tr>
<tr>

<td>
<a href="eth.php?serv=1" title="Fafa">
<img src="eth.php?serv=1" width="100">
</a>
</td>
<td>
<a href="eth.php?serv=2" title="Chic">
<img src="eth.php?serv=2" width="100">
</a>
</td>
<td>
<a href="eth.php?serv=3" title="Node101">
<img src="eth.php?serv=3" width="100">
</a>
</td>
<td>
<a href="eth.php?serv=4" title="Node102">
<img src="eth.php?serv=4" width="100">
</a>
</td>
<td>
<a href="eth.php?serv=5" title="Node103">
<img src="eth.php?serv=5" width="100">
</a>
</td>
<td>
<a href="eth.php?serv=6" title="Node104">
<img src="eth.php?serv=6" width="100">
</a>
</td>
</tr>
<tr>
<td>
<a href="cpu.php?serv=1" title="Fafa">
<img src="cpu.php?serv=1" width="100">
</a>
</td>
<td>
<a href="cpu.php?serv=2" title="Chic">
<img src="cpu.php?serv=2" width="100">
</a>
</td>
<td>
<a href="cpu.php?serv=3" title="Node101">
<img src="cpu.php?serv=3" width="100">
</a>
</td>
<td>
<a href="cpu.php?serv=4" title="Node102">
<img src="cpu.php?serv=4" width="100">
</a>
</td>
<td>
<a href="cpu.php?serv=5" title="Node103">
<img src="cpu.php?serv=5" width="100">
</a>
</td>
<td>
<a href="cpu.php?serv=6" title="Node104">
<img src="cpu.php?serv=6" width="100">
</a>
</td>
</tr>
<tr>
<td>
<a href="mem.php?serv=1" title="Fafa">
<img src="mem.php?serv=1" width="100">
</a>
</td>
<td>
<a href="mem.php?serv=2" title="Chic">
<img src="mem.php?serv=2" width="100">
</a>
</td>
<td>
<a href="mem.php?serv=3" title="Node101">
<img src="mem.php?serv=3" width="100">
</a>
</td>
<td>
<a href="mem.php?serv=4" title="Node102">
<img src="mem.php?serv=4" width="100">
</a>
</td>
<td>
<a href="mem.php?serv=5" title="Node103">
<img src="mem.php?serv=5" width="100">
</a>
</td>
<td>
<a href="mem.php?serv=6" title="Node104">
<img src="mem.php?serv=6" width="100">
</a>
</td>
</tr>
</table>
</div>
<div style="position:absolute; top:480px">
Outils :<br>
<a href="http://speedtest.gheberg.eu">SpeedTest</a><br>
<a href="http://demo.gheberg.eu">Stockage fichiers</a>
</div>
</body>
</html>
