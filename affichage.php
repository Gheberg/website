<?php 
if($_GET['closed'] == 2)
				{	
					?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
										<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
										<head>
										<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
										</head>
										<body>
										<img src="logo.png" alt="Gheberg"/>
										<br /><br /><br />
										<strong>Le support commercial est actuellement ferm�. <br />Veuillez r�essayer plus tard !</strong><br />
										</body>
										</html><?php
				}
else
	{
	// A partir d'ici, voici tous les param�tres � configurer pour faire fonctionner le script.
	$host = "localhost"; //Mettre l'hote de connexion SQL entre les "".
	$dbname = "db252300216"; //Mettre le nom de la DB SQL entre les "".
	$user = "root"; //Mettre un nom d'utilisateur ayant acc�s � la DB entre les "".
	$password = "***"; //Mettre le mot de passe de l'utilisateur ayant acc�s � la DB ent

	$bdd = new PDO('mysql:host='.$host.';dbname='.$dbname.'', ''.$user.'', ''.$password.'');
	$ip = $_SERVER['REMOTE_ADDR']; 
	$requ = $bdd->prepare('SELECT ip FROM heberg_cache WHERE ip = ?');
	$requ->execute(array($ip));
	
	$request = $bdd->prepare('SELECT etat FROM etat');
	$request->execute(array());
	$resultat = $request->fetch();
	
	$ipf = 0;
	while($result = $requ->fetch())
	{
		$ipf++;
	}
	$online = $resultat['etat'];
	
	if($online == 2) 
		{ 
			header('Location:?closed=2'); 
		} 
		else 
			{ 

				if($_GET['send'] == 2)
					{
						if (preg_match("#[a-z]#i", $_POST['numero']) OR strlen($_POST['numero']) < 8 OR strlen($_POST['numero']) > 8 OR $ipf > 3 OR $_POST['numerobis'] == +336 OR $_POST['numerobis'] == 07 OR $_POST['numerobis'] == 06 OR $_POST['numerobis'] == +336)
							{
								if($ipf > 3)
									{	
										?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
										<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
										<head>
										<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
										</head>
										<body>
										<img src="logo.png" alt="Gheberg"/>
										<br /><br /><br />
										<strong>Vous avez d�pass� la limite d'appel autoris� chaque jour. Redirection automatique dans 5 secondes...</strong><br />
										<meta http-equiv="refresh" content="5; URL=affichage.php?">
										</body>
										</html>
										<?php
									}
								else
									{
										?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
										<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
										<head>
										<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
										</head>
										<body>
										<img src="logo.png" alt="Gheberg"/>
										<br /><br /><br />
										<strong>Vous avez entr� un mauvais num�ro. Redirection automatique dans 5 secondes...</strong><br />
										<meta http-equiv="refresh" content="5; URL=affichage.php?">
										</body>
										</html><?php
									}
							}
						else
							{	
								$requ = $bdd->prepare('INSERT INTO heberg_cache(ip) VALUES(:ip)');
								$requ->execute(array(
									'ip' => $ip
								));
								mail("aensoft@gratuit-domaine.com", "Nouveau utilisateur t�l�phonique en attente !", "Bonjour Aensoft,

								".$_POST['numerobis']." ".$_POST['numero']."");
								?>
								<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
								<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
								<head>
								<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
								</head>
								<body>
								<img src="logo.png" alt="Gheberg"/>
								<br /><br /><br />
								<strong>Connexion en cours de votre num�ro � notre r�seau... Veuillez ne pas quitter la page.</strong><br />
								<meta http-equiv="refresh" content="15; URL=affichage.php?enattente=2">
								</body>
								<html>
								<?php
							}
					}
					if($_GET['enattente'] == 2)
						{ ?>
							<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
							<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
							<head>
							<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
							</head>
							<body>
							<img src="logo.png" alt="Gheberg"/>
							<br /><br /><br />
							<strong>Vous venez d'�tre plac� en attente. Un op�rateur va vous r�pondre au plus vite... Veuillez ne pas quitter la page. Une fois votre op�rateur en ligne, vous pourrez quitter cette page.</strong><br />

							</body>
							</html>
							<?php
						}
						if($_GET['enattente'] != 2 AND $_GET['send'] != 2)
							{
								?>
									<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
									<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
									<head>
									<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
									</head>
									<body>
									<img src="logo.png" alt="Gheberg"/>
									<br /><br /><br />

									<i>Faites vous rappeler gratuitement et imm�diatement par un conseill� commercial via ce moyen.<br />(Exemple d'utilisation : Demande d'informations, commande de vps avec conseill�, commande de vps sur mesure, demande d'upgrade, autre ?)<br /><br /> Le support technique est strictement interdit ...</i><br /><br />

									Entrez ci-desssous votre num�ro de t�l�phone fixe. Nous n'acceptons que les num�ros Fran�ais(+33) venant d'une ligne fixe ! <br />
									<form action="?send=2" method="post">
									<select name="numerobis" id="pays">
									<option value="01">+33 1</option>
									<option value="02">+33 2</option>
									<option value="03">+33 3</option>
									<option value="04">+33 4</option>
									<option value="05">+33 5</option>
									<option value="09">+33 9</option>
									</select>
									<input type="text" name="numero"/>
									<input type="submit" value="Envoyer" />
									</form>
									</body>
									</html>
<?php 							}
			}

	}
?>
