<?php

$pseudo=$_POST['pseudo'];
$script=$_GET['script'];

if ($_GET['action'] == "logout")
{
header('WWW-Authenticate: Basic realm="Acces protege"');
header('HTTP/1.0 401 Unauthorized');
}

require("conf.php");
mysql_connect($sql_serveur,$sql_user,$sql_passwd);

if ($_GET['action'] == "hotline")
{
$change = $_GET['hotline'];
if ($change == "ON") $change = 2;
else $change = 1;
mysql_query("UPDATE hotline set etat='$change' where id='1'");
$date = date('d/m/Y');
$heure = date('H:i:s');
mysql_query("INSERT into heberg_admin_log (login,date,action) VALUES ('thomas','$date $heure','HOTLINE => $change')");
}

$ticket=mysql_query("select count(*) from ticket2 WHERE resolu='0'");
$ticket=mysql_result($ticket, 0);
$commande = mysql_query("SELECT count(*) FROM heberg_admin WHERE info like 'creer %'");
$commande=mysql_result($commande, 0);
$hotline=mysql_query("select * from hotline where id='1'");
$hotline=mysql_result($hotline, 0, "etat");
if ($hotline == 1) $hotline = "ON";
else $hotline = "OFF";

if ($action == "dossier")
{
	$pseudo=$_GET['pseudo'];
	$dossier=$_POST['dossier'];

	$requete=mysql_query("select * from heberg_dossier where pseudo='$pseudo'");
	if(mysql_num_rows($requete)==0)
		{
		mysql_query("insert into heberg_dossier values ('', '$pseudo', '$dossier')");
		}
	mysql_query("UPDATE heberg_dossier set text='$dossier' where pseudo='$pseudo'");
}

?>
<!DOCTYPE html> 
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
	
	<title>GHEBERG -administration-</title>

	<link type="text/css" href="style.css" rel="stylesheet" /> <!-- the layout css file -->
	<link type="text/css" href="css/jquery.cleditor.css" rel="stylesheet" />
	
	<script type='text/javascript' src='js/jquery-1.4.2.min.js'></script>	<!-- jquery library -->
	<script type='text/javascript' src='js/jquery-ui-1.8.5.custom.min.js'></script> <!-- jquery UI -->
	<script type='text/javascript' src='js/cufon-yui.js'></script> <!-- Cufon font replacement -->
	<script type='text/javascript' src='js/ColaborateLight_400.font.js'></script> <!-- the Colaborate Light font -->
	<script type='text/javascript' src='js/easyTooltip.js'></script> <!-- element tooltips -->
	<script type='text/javascript' src='js/jquery.tablesorter.min.js'></script> <!-- tablesorter -->
	
	<!--[if IE 8]>
		<script type='text/javascript' src='js/excanvas.js'></script>
		<link rel="stylesheet" href="css/IEfix.css" type="text/css" media="screen" />
	<![endif]--> 
 
	<!--[if IE 7]>
		<script type='text/javascript' src='js/excanvas.js'></script>
		<link rel="stylesheet" href="css/IEfix.css" type="text/css" media="screen" />
	<![endif]--> 
	
	<script type='text/javascript' src='js/visualize.jQuery.js'></script> <!-- visualize plugin for graphs / statistics -->
	<script type='text/javascript' src='js/iphone-style-checkboxes.js'></script> <!-- iphone like checkboxes -->
	<script type='text/javascript' src='js/jquery.cleditor.min.js'></script> <!-- wysiwyg editor -->

	<script type='text/javascript' src='js/custom.js'></script> <!-- the "make them work" script -->
	
			<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script type="text/javascript">
$(function() {
	var seriesOptions = [],
		yAxisOptions = [],
		seriesCounter = 0,
		names = ['bdc', 'fact', 'allo'],
		colors = Highcharts.getOptions().colors;

	$.each(names, function(i, name) {

		$.getJSON('https://www.gratuit-domaine.eu/admin2/test/donnees.php?filename='+ name.toLowerCase() +'&c',	function(data) {

			seriesOptions[i] = {
				name: name,
				data: data
			};

			// As we're loading the data asynchronously, we don't know what order it will arrive. So
			// we keep a counter and create the chart when all the data is loaded.
			seriesCounter++;

			if (seriesCounter == names.length) {
				createChart();
			}
		});
	});



	// create the chart when all data is loaded
	function createChart() {

		chart = new Highcharts.StockChart({
		    chart: {
		        renderTo: 'containerstat'
		    },
		    
		title: {
			text: 'Stat Facturation'
		},

		    rangeSelector: {
		        selected: 2
		    },

		    yAxis: {
		    	labels: {
		    		formatter: function() {
		    			return (this.value);
		    		}
		    	},
		    	plotLines: [{
		    		value: 0,
		    		width: 2,
		    		color: 'silver'
		    	}]
		    },
		    
		    plotOptions: {
		    	series: {
		    		
		    	}
		    },
		    
		    tooltip: {
		    	pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b> ({point.change}%)<br/>',
		    	valueDecimals: 2
		    },
		    
		    series: seriesOptions
		});
	}

});

                </script>

	<link rel="stylesheet" href="./stattest/development-bundle/themes/base/jquery.ui.all.css">
	<script src="./stattest/development-bundle/jquery-1.7.2.js"></script>
	<script src="./stattest/development-bundle/ui/jquery.ui.core.js"></script>
	<script src="./stattest/development-bundle/ui/jquery.ui.widget.js"></script>
	<script src="./stattest/development-bundle/ui/jquery.ui.datepicker.js"></script>
	
</head>

<body>

	<div id="container">
		<div id="bgwrap">
			<div id="primary_left">
        
				<div id="logo">
					<a href="dashboard.html" title="Dashboard"><img src="https://www.gheberg.eu/images/logo.gif" alt="" width="90%"/></a>
				</div> <!-- logo end -->

				<?php include("menu.php"); ?>

			</div> <!-- sidebar end -->

			<div id="primary_right">
				<div class="inner">

					<h1>Bienvenue </h1>

					<ul class="dash">

						
						<li class="fade_hover tooltip" title="Tickets ouverts">
						<span class="bubble"><?php echo $ticket - 3; ?></span>
							<a href="ticket.php">
								<img src="assets/icons/dashboard/3.png" alt="" /> 
								<span>Tickets</span>
							</a>
						</li>

						<li class="fade_hover tooltip" title="Commandes en cours">
						<span class="bubble"><?php echo $commande; ?></span>
							<a href="commande_heberg.php">
								<img src="assets/icons/dashboard/21.png" alt="" />
								<span>Commandes</span>
							</a>
						</li>
						
						<li class="fade_hover tooltip" title="Activer ou Désactiver la hotline">
						<span class="bubble"><?php echo $hotline; ?></span>
							<a href="stat.php?action=hotline&hotline=<?php echo $hotline; ?>">
								<img src="assets/icons/dashboard/123.png" alt="" />
								<span>Hotline</span>
							</a>
						</li>
						
						<li class="fade_hover tooltip" title="Mettre fin à sa session">
							<a href="index.php?action=logout">
								<img src="assets/icons/dashboard/118.png" alt="" />
								<span>Déconnexion</span>
							</a>
						</li>

					</ul> <!-- end dashboard items -->
					
		<hr />
					<h1>Statistiques de facturation</h1>
					<div style="clearboth"></div>

<div id="containerstat" style="height: 500px; min-width: 500px"></div>

<script src="./stattest/js/highstock.js"></script>
<script src="./stattest/js/modules/exporting.js"></script>
 <hr />
 					<h1>Graphiques serveurs</h1>
					<div style="clearboth"></div>
 <?php

try {
 $soap = new SoapClient("https://www.ovh.com/soapi/soapi-re-1.13.wsdl");

 //login
 $session = $soap->login("***-ovh", "***","fr", false);


 //dedicatedMrtgInfo
$result4 = $soap->dedicatedMrtgInfo($session, "ns21945.ovh.net", "traffic", "day", "213.251.187.31");
$result14 = $soap->dedicatedMrtgInfo($session, "ns222693.ovh.net", "traffic", "day", "46.105.110.114");
$result18 = $soap->dedicatedMrtgInfo($session, "ks306074.kimsufi.com", "traffic", "day", "94.23.219.76");
$result102 = $soap->dedicatedMrtgInfo($session, "ks396020.kimsufi.com", "traffic", "day", "176.31.103.193");
$result103 = $soap->dedicatedMrtgInfo($session, "ks3093795.kimsufi.com", "traffic", "day", "94.23.246.222");
$result104 = $soap->dedicatedMrtgInfo($session, "ks307423.kimsufi.com", "traffic", "day", "94.23.230.197");

 //clients servers
 
 









$rclient1 = $soap->dedicatedMrtgInfo($session, "ks359529.kimsufi.com", "traffic", "day", "91.121.158.32");
$rclient2= $soap->dedicatedMrtgInfo($session, "ks357023.kimsufi.com", "traffic", "day", "91.121.144.156");
$rclient3= $soap->dedicatedMrtgInfo($session, "ks3000358.kimsufi.com", "traffic", "day", "37.59.39.137");
$rclient4 = $soap->dedicatedMrtgInfo($session, "ns385513.ovh.net", "traffic", "day", "46.105.127.214");
$rclient5 = $soap->dedicatedMrtgInfo($session, "ks363471.kimsufi.com", "traffic", "day", "91.121.180.24");
$rclient6 = $soap->dedicatedMrtgInfo($session, "ks28468.kimsufi.com", "traffic", "day", "91.121.95.8");
$rclient7 = $soap->dedicatedMrtgInfo($session, "ns3265196.ovh.net", "traffic", "day", "37.59.52.86");
$rclient8 = $soap->dedicatedMrtgInfo($session, "ks364407.kimsufi.com", "traffic", "day", "91.121.209.21");
$rclient9 = $soap->dedicatedMrtgInfo($session, "ks305898.kimsufi.com", "traffic", "day", "91.121.222.120");
$rclient10 = $soap->dedicatedMrtgInfo($session, "ks3098758.kimsufi.com", "traffic", "day", "94.23.48.141");
$rclient11 = $soap->dedicatedMrtgInfo($session, "ks355746.kimsufi.com", "traffic", "day", "91.121.137.144");
$rclient12 = $soap->dedicatedMrtgInfo($session, "ks3311787.kimsufi.com", "traffic", "day", "5.135.163.117");
$rclient13 = $soap->dedicatedMrtgInfo($session, "ks3323849.kimsufi.com", "traffic", "day", "94.23.231.116");
$rclient14 = $soap->dedicatedMrtgInfo($session, "ks208859.kimsufi.com", "traffic", "day", "37.59.52.86");
$rclient15 = $soap->dedicatedMrtgInfo($session, "ns383262.ovh.net", "traffic", "day", "46.105.103.167");

 $soap->logout($session);
}

catch(SoapFault $fault) {}
 
foreach ($result4 as $w4) {
$image4 = $result4->image;
} 
foreach ($result14 as $w14) {
$image14 = $result14->image;
} 
foreach ($result18 as $w18) {
$image18 = $result18->image;
} 
foreach ($result102 as $w102) {
$image102 = $result102->image;
} 
foreach ($result103 as $w103) {
$image103 = $result103->image;
} 
foreach ($result104 as $w104) {
$image104 = $result104->image;
} 




foreach ($rclient1 as $c1) {
$client1 = $rclient1->image;
} 
foreach ($rclient2 as $c2) {
$client2 = $rclient2->image;
} 
foreach ($rclient3 as $c3) {
$client3 = $rclient3->image;
} 
foreach ($rclient4 as $c4) {
$client4 = $rclient4->image;
} 
foreach ($rclient5 as $c5) {
$client5 = $rclient5->image;
} 
foreach ($rclient6 as $c6) {
$client6 = $rclient6->image;
} 
foreach ($rclient7 as $c7) {
$client7 = $rclient7->image;
} 
foreach ($rclient8 as $c8) {
$client8 = $rclient8->image;
} 
foreach ($rclient9 as $c9) {
$client9 = $rclient9->image;
} 
foreach ($rclient10 as $c10) {
$client10 = $rclient10->image;
} 
foreach ($rclient11 as $c11) {
$client11 = $rclient11->image;
} 
foreach ($rclient12 as $c12) {
$client12 = $rclient12->image;
} 
foreach ($rclient13 as $c13) {
$client13 = $rclient13->image;
} 
foreach ($rclient14 as $c14) {
$client14 = $rclient14->image;
} 
foreach ($rclient15 as $c15) {
$client15 = $rclient15->image;
} 
?>
<table align="center" bgcolor="#FFFFFF">

<tr><td border="1"><b>Rack (hébergement) :</b></td><td><b>Chic</b></td></tr>
<tr><td><img src="<?php echo"$image4";?>"></td><td><img src="<?php echo"$image14";?>"></td></tr>
<tr><td><b>Node 101</b></td><td>Node104</td></tr>
<tr><td><img src="<?php echo"$image18";?>"></td><td><img src="<?php echo"$image104";?>"></td></tr>
<tr><td><b>Node 102</b></td><td><b>Node 103</b></td></tr>
<tr><td><img src="<?php echo"$image102";?>"></td><td><img src="<?php echo"$image103";?>"></td></tr>
</table>
<br>
<table align="center" bgcolor="#FFFFFF">
<tr><td><img src="<?php echo"$client1";?>"></td><td><img src="<?php echo"$client2";?>"></td></tr>
<tr><td><img src="<?php echo"$client3";?>"></td><td><img src="<?php echo"$client4";?>"></td></tr>
<tr><td><img src="<?php echo"$client5";?>"></td><td><img src="<?php echo"$client6";?>"></td></tr>
<tr><td><img src="<?php echo"$client7";?>"></td><td><img src="<?php echo"$client8";?>"></td></tr>
<tr><td><img src="<?php echo"$client9";?>"></td><td><img src="<?php echo"$client10";?>"></td></tr>
<tr><td><img src="<?php echo"$client11";?>"></td><td><img src="<?php echo"$client12";?>"></td></tr>
<tr><td><img src="<?php echo"$client13";?>"></td><td><img src="<?php echo"$client14";?>"></td></tr>
<tr><td><img src="<?php echo"$client15";?>"></td><td></td></tr>
</table>

<hr />

	<h1>Visual Monitoring System (realtime, France) - GHEBERG</h1>
		<?php
require_once("conf_vps.php");
$db_link_vps = @mysql_connect($sql_serveur_vps,$sql_user_vps,$sql_passwd_vps);

mysql_select_db('vpsm',$db_link_vps);

$reponse1 = mysql_query("SELECT * FROM vps WHERE (vmid<1700 AND vmid>1600) OR (vmid<700 AND vmid>600) OR (vmid<999 AND vmid>900) OR (vmid<1300 AND vmid>1200) OR (vmid > 300 AND VMID < 400)ORDER BY vmid");
$reponse2 = mysql_query("SELECT * FROM vps WHERE (vmid<900 AND vmid>800) OR (vmid<200 AND vmid>100) ORDER BY vmid");
$reponse3 = mysql_query("SELECT * FROM vps WHERE (vmid<1200 AND vmid>1100) OR (vmid<700 AND vmid>600) OR (vmid<600 AND vmid>500) OR vmid>10000 ORDER BY vmid");
$reponse4 = mysql_query("SELECT * FROM vps WHERE (vmid<1400 AND vmid>1300) OR (vmid<500 AND vmid>400) ORDER BY vmid");
$reponse5 = mysql_query("SELECT * FROM vps WHERE vmid<1600 AND vmid>1500 ORDER BY vmid");
$reponse6 = mysql_query("SELECT * FROM vps WHERE vmid<1500 AND vmid>1400 ORDER BY vmid");
$reponse7 = mysql_query("SELECT * FROM vps WHERE vmid<1300 AND vmid>1200 ORDER BY vmid");

mysql_close();


require("conf.php");
mysql_connect($sql_serveur,$sql_user,$sql_passwd);

$nbe = mysql_num_rows($reponse1);$nbe = $nbe / 4;

		for($i=0;$i<7;$i++)
			{										
				?>
				
				<div style="position:relative;float: left"><table border="0">
					<?php
										if($i==0) {echo"<tr><th>noob</th></tr>";}
										elseif($i==1) {echo"<tr><th>fafa &nbsp;</th></tr>";}
										elseif($i==2) {echo"<tr><th>mush &nbsp;</th></tr>";}
										elseif($i==3) {echo"<tr><th>chic &nbsp;</th></tr>";}
										elseif($i==4) {echo"<tr><th>leon &nbsp;</th></tr>";}
										elseif($i==5) {echo"<tr><th>101 &nbsp;</th></tr>";}
										elseif($i==6) {echo"<tr><th>102 &nbsp;</th></tr>";}
										
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
										elseif($i==6) {$donnees = mysql_fetch_array($reponse7);$nbe = mysql_num_rows($reponse7);$nbe = $nbe / 4;}

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

											$requete=mysql_query("select * from heberg_membres where pseudo='$nom'");
											@$date=mysql_result($requete,0,"date");
											
		
$jour = date('d');
$mois = date('m');
$ref = $mois * 100 + $jour;
$exp = explode("/",$date);
$exp[1] += 1;
if ($exp[1] > 12) {$exp[1] = 1;}
$date_test = $exp[1] * 100 + $exp[0];

if ($mois == 12 and $exp[1] == 1) //decembre bug
{
}
else
{
if ($date_test < $ref)
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
}

											?>
											
											<?php
											}
											}
										}
										?><td width="3"></td>
							</tr><?php
						}?>
				</table></div><?php
			}
		?>
	

					<div class="clearboth"></div>
				</div> <!-- inner -->
			</div> <!-- primary_right -->
		</div> <!-- bgwrap -->
	</div> <!-- container -->
</body>
</html>
