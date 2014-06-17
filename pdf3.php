<?php
mysql_connect("localhost", "root", "***");
mysql_select_db("db252300216");
require("conf.php");
$db_link = @mysql_connect($sql_serveur,$sql_user,$sql_passwd);

$id = mysql_real_escape_string($_GET['id']);
$pseudo = mysql_real_escape_string($_GET['pseudo']);

$requete=mysql_db_query($sql_bdd,"select * FROM heberg_membres WHERE pseudo=\"$pseudo\"",$db_link) or die(mysql_error());
if(mysql_num_rows($requete)==0) exit;

$prenom=mysql_result($requete,0,"prenom");
$nom=mysql_result($requete,0,"nom");
$email=mysql_result($requete,0,"email");
$tel=mysql_result($requete,0,"tel");
$p=mysql_result($requete,0,"produit");

$requete2=mysql_db_query($sql_bdd,"select * FROM heberg_fact WHERE idd_bdc=\"$id\"",$db_link) or die(mysql_error());
if(mysql_num_rows($requete2)==0) exit;

$date=mysql_result($requete2,0,"date");
$idd_bdc=mysql_result($requete2,0,"idd_bdc");
$id_trans=mysql_result($requete2,0,"id_trans");

$requete3=mysql_db_query($sql_bdd,"select * FROM heberg_bdc WHERE idd=\"$idd_bdc\" AND pseudo=\"$pseudo\"",$db_link) or die(mysql_error());
if(mysql_num_rows($requete3)==0) exit;

$p=mysql_result($requete3,0,"produit");
$prixttc=mysql_result($requete3,0,"prixttc");
$prixht = round($prixttc / 1.196,2);

$info=mysql_result($requete3,0,"info");
if ($info == "renew") $info = "Renouvellement";
else $info = "Création";

$numfact = explode(' ', $date);
$numfact = explode('/', $numfact[0]);
$numfact = $numfact[2].$numfact[1].$numfact[0].'.'.strtoupper($id);


$content ="<style type=\"text/css\">
<!--
table { vertical-align: top; }
tr    { vertical-align: top; }
td    { vertical-align: top; }
}
-->
</style>
<page backcolor=\"#FEFEFE\" backimg=\"./res/bas_page.png\" backimgx=\"center\" backimgy=\"bottom\" backimgw=\"100%\" backtop=\"0\" backbottom=\"30mm\" footer=\"date;heure;page\" style=\"font-size: 12pt\">
    <bookmark title=\"Lettre\" level=\"0\" ></bookmark>

	<div style=\"position:absolute\"><img src=\"images/logo-facture.jpg\"></div>
	<table align=\"right\">
		<tr>
";
if ($id_trans == "allopass") {
$content .= "
		<td>Récapitulatif :</td>
			<td align=\"right\">$numfact</td>
		</tr>
";
}
else
{
$content .= "
		<td>Facture acquittée :</td>
			<td align=\"right\">$numfact</td>
		</tr>
";
}

$content .= "
		<tr>
			<td>Date de paiement :</td>
			<td align=\"right\">$date</td>
		</tr>
	</table>
	<br>
	<div style=\"position:relative\">
	<table>
		<tr>
			<td><b>Id Client :</b></td>
			<td align=\"right\"><b>$pseudo</b></td>
		</tr>
		<tr>
			<td>Nom :</td>
			<td align=\"right\">$nom $prenom</td>
			
		</tr>
		<tr>
			<td>E-mail :</td>
			<td align=\"right\">$email</td>
		</tr>
		<tr>
			<td>Tel. :</td>
			<td align=\"right\">$tel</td>
		</tr>
	</table>
	</div>

	<br><br><br><br>
	<div style=\"font-size:30px\">$p</div>
	<br>
	<div style=\"width:100%;position:relative;\">
		<div style=\"position:absolute;width:60%;border:1px solid black;text-align:center\">Désignation</div>
		<div style=\"position:absolute;left:60%;width:20%;border:1px solid black;text-align:center\">Quantité</div>
		<div style=\"position:absolute;left:80%;width:20%;border:1px solid black;text-align:center\">Prix HT</div>
	</div>
	
	<div style=\"width:100%;position:relative;\">
		<div style=\"position:absolute;height:25px;width:60%;border:1px solid black;padding-top:6px;text-align:center\">$info $p <small>($id_trans)</small></div>
";
if ($id_trans == "allopass") {
$content .= "
		<div style=\"position:absolute;height:25px;left:60%;width:20%;border:1px solid black;padding-top:6px;text-align:center\">1</div>
		<div style=\"position:absolute;height:25px;left:80%;width:20%;border:1px solid black;padding-top:6px;text-align:center\"><i>cf. allopass</i></div>
	</div>
";
}
else {
$content .= "
		<div style=\"position:absolute;height:25px;left:60%;width:20%;border:1px solid black;padding-top:6px;text-align:center\">1</div>
		<div style=\"position:absolute;height:25px;left:80%;width:20%;border:1px solid black;padding-top:6px;text-align:center\">$prixht</div>
	</div>
	<br><br>
	<b>TVA :</b> 19.6 %<br>
	<b>Total TTC :</b> $prixttc €
";
}
$content .=
"
	<br><br><br><br>
<hr>
<div style=\"text-align:center\">
<small>
<b>GHEBERG SARL</b> 17 Avenue henri barbusse 33700 MERIGNAC - France<br>
E-mail : contact@gheberg.eu - Web : http://www.gheberg.eu<br>
Au capital de 1000€ - RCS de Bordeaux :749 988 408 00011 - Code APE : 6311Z
</small>
</div>
";




$content .= "</page>";

require_once(dirname(__FILE__).'/html2pdf/html2pdf.class.php');
$html2pdf = new HTML2PDF('P', 'A4', 'fr');
$html2pdf->writeHTML($content);
$html2pdf->Output('facture.pdf');
?>