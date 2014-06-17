<?php
require("conf.php");
mysql_connect($sql_serveur,$sql_user,$sql_passwd);

$i=0;
$j=0;

	$requete = mysql_query("SELECT * FROM heberg_ip where libre='0' order by ip")or die(mysql_error());
	 
	while($donnees = mysql_fetch_array($requete))
	{
		$ip = nl2br(stripslashes($donnees['ip']));
		$pseudo = nl2br(stripslashes($donnees['nom']));
		echo '<br>'.$ip;
		
		$requete2=mysql_query("select * from heberg_membres where pseudo=\"$pseudo\"")or die(mysql_error());
		if(mysql_num_rows($requete2)==0)
			{
			echo ' '.$pseudo.'<br>';
			//mysql_query("UPDATE heberg_ip SET libre='1' WHERE ip=\"$ip\"");
			}

			$i++;
	}
	
	
	echo "<hr>";
	$requete3 = mysql_query("SELECT * FROM heberg_membres where produit like 'vps%'")or die(mysql_error());
	 
	while($donnees = mysql_fetch_array($requete3))
	{
	$j++;
	}
	
	
	echo '<br>'.$i;
	echo '<br>'.$j;
	
	/*
	$requete = mysql_query("SELECT * FROM heberg_membres where produit like 'vps%'")or die(mysql_error());
	 
	while($donnees = mysql_fetch_array($requete))
	{
		$pseudo = nl2br(stripslashes($donnees['pseudo']));
		
		$requete2=mysql_query("select * from heberg_ip where nom=\"$pseudo\"")or die(mysql_error());
		if(mysql_num_rows($requete2)==0)
			{
			echo ' '.$pseudo.'<br>';
			}
		
	}
	*/