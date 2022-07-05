<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style_Index.css">
	<!-- <link rel="stylesheet" type="text/css" media="only screen and (max-width: 980px)" href="style_index_mobile.css" /> -->
	<script src="script.js"></script>
	<title>Accueil</title>
</head>
<header>
	<?php 
		session_start();
		//Si connecté
		if (isset($_SESSION['id_login'])) {
			echo "  <div>
					<section class='left_header'>						
						<a href='./page_historique.php'>Historique</a>
					</section>

					<section class='right_header'>				
						<a>".ucwords($_SESSION['prenom'])."
						<svg width='18' height='12' viewBox='0 0 8 5' class='arrow-down' fill='#0BC4E2' xmlns='http://www.w3.org/2000/svg'><path d='M0.707109 1.70711L3.29289 4.29289C3.68342 4.68342 4.31658 4.68342 4.70711 4.29289L7.29289 1.70711C7.92286 1.07714 7.47669 0 6.58579 0H1.41421C0.523309 0 0.0771438 1.07714 0.707109 1.70711Z'></path></svg></a>
						<section class='dropdown-content'>
								<a class='dropdown_compte' href='./page_compte.php'>Compte</a><br><br>
								<a class='dropdown_deconnexion' href='./deconnexion.php'>Déconnexion</a>
						</section>
					</section>
					</div>";
		}
		//Si pas connecté
		else {
			echo "  <div>
						<section class='left_header'>
							<a href='./page_historique.php'>Historique</a>
						</section>

						<section class='right_header'>
							<a href='./page_connexion.php'>Connexion</a><br>
						</section>
					</div>";
		}
	?>
</header>

<body>
	<?php
	if (!isset($_SESSION['inscription_value']))
		
	{
		$_SESSION['inscription_value']=0;
	}
	switch ($_SESSION['inscription_value']) { //Renvoie une popup pour l'état de l'inscription
		case '0':
			break;
		case '1':
			echo "<script type='text/javascript'>alert('Vous êtes maintenant inscrit')</script>";
			$_SESSION['inscription_value']=0;
			break;
		case '2':
			echo "<script type='text/javascript'>alert('Vous êtes déjà inscrit')</script>";
			$_SESSION['inscription_value']=0;
			break;
		case '3':
			echo "<script type='text/javascript'>alert('Vous vous êtes désinscrit')</script>";
			$_SESSION['inscription_value']=0;
			break;
		default:
			break;
	}
	?>
	<section class="tournoi_parent">
		<?php //Reqette tournois Ouvert, fermé & en cours
			include('BDD_tournois.php');
			$i=0;
			$reponse = $bdd->query("SELECT Intitule, Etat, Sport FROM tournoi WHERE Etat = 'EN COURS' ORDER BY `tournoi`.`date` ASC");
	   	 	while ($donnees = $reponse->fetch()) {
	   	 		$intitule[$i] = $donnees['Intitule'];
	   	 		$etat[$i] = $donnees['Etat'];
	   	 		$sport[$i] = $donnees['Sport'];
	   	 		$i++;
	   	 	}
			$reponse = $bdd->query("SELECT Intitule, Etat, Sport FROM tournoi WHERE Etat = 'OUVERT' ORDER BY `tournoi`.`Date` ASC");
	   	 	while ($donnees = $reponse->fetch()) {
	   	 		$intitule[$i] = $donnees['Intitule'];
	   	 		$etat[$i] = $donnees['Etat'];
	   	 		$sport[$i] = $donnees['Sport'];
	   	 		$i++;
	   	 	}
	   	 	$reponse = $bdd->query("SELECT Intitule, Etat, Sport FROM tournoi WHERE Etat = 'TERMINÉ' ORDER BY `tournoi`.`Date` ASC");
	   	 	while ($donnees = $reponse->fetch()) {
	   	 		$intitule[$i] = $donnees['Intitule'];
	   	 		$etat[$i] = $donnees['Etat'];
	   	 		$sport[$i] = $donnees['Sport'];
	   	 		$i++;
	   	 	}
	   	 	if (isset($intitule)) {
	   	 	for ($i=0; $i<count($intitule); $i++) {
	   	 		switch ($etat[$i]) {
	   	 			case 'EN COURS':
	   	 				echo "<form method='post' action='page_tournoi_en_cours.php'>
	   	 				<section class='tournoi_enfant_EN_COURS'>" . "<p><label>[Tournoi en cours] </label><br>" . $intitule[$i] . " / " . $sport[$i] . "</p>";
	   	 				switch (strtolower($sport[$i])) {
	   	 					case 'volley':
	   	 						echo "<img src='ressources/fond_volleyball.png'><br>";
	   	 						break;
	   	 					case 'handball':
	   	 						echo "<img src='ressources/fond_handball.png'><br>";
	   	 						break;
	   	 					case 'basket':
	   	 						echo "<img src='ressources/fond_basketball.png'><br>";
	   	 						break;
	   	 					case 'badminton':
	   	 						echo "<img src='ressources/fond_badminton.png'><br>";
	   	 						break;
	   	 					case 'ping-pong':
	   	 						echo "<img src='ressources/fond_ping-pong.jpg'><br>";
	   	 						break;
	   	 					case 'genshin impact':
	   	 						echo "<img src='ressources/fond_genshin.jpg'><br>";
	   	 						break;
	   	 					case 'mhr':
	   	 						echo "<img src='ressources/fond_mizutsune.jpg'><br>";
	   	 						break;
	   	 					default :
	   	 						echo "<img src='ressources/fond_inscription.jpg'><br>";
	   	 						break;
	   	 				}
	   	 				echo "<input type='text' value='".$intitule[$i]."' name='tournoi_intitule'>"
			   	 		."<input type='text' value='".$sport[$i]."' name='tournoi_sport'>"
			   	 		."<input class='submit' value='Visionner' type='submit'></section></form>";
	   	 				break;
	   	 			case 'TERMINÉ':
	   	 				echo "<form method='post' action='page_tournoi_en_cours.php'>
	   	 				<section class='tournoi_enfant_TERMINE'>" . "<p><label>[Inscriptions terminées]</label><br>" . $intitule[$i] . " / " . $sport[$i] . "</p>";
	   	 				switch (strtolower($sport[$i])) {
	   	 					case 'volley':
	   	 						echo "<img src='ressources/fond_volleyball.png'><br>";
	   	 						break;
	   	 					case 'handball':
	   	 						echo "<img src='ressources/fond_handball.png'><br>";
	   	 						break;
	   	 					case 'basket':
	   	 						echo "<img src='ressources/fond_basketball.png'><br>";
	   	 						break;
	   	 					case 'badminton':
	   	 						echo "<img src='ressources/fond_badminton.png'><br>";
	   	 						break;
	   	 					case 'ping-pong':
	   	 						echo "<img src='ressources/fond_ping-pong.jpg'><br>";
	   	 						break;
	   	 					case 'genshin impact':
	   	 						echo "<img src='ressources/fond_genshin.jpg'><br>";
	   	 						break;
	   	 					case 'mhr':
	   	 						echo "<img src='ressources/fond_mizutsune.jpg'><br>";
	   	 						break;
	   	 					default :
	   	 						echo "<img src='ressources/fond_inscription.jpg'><br>";
	   	 						break;
	   	 				}
	   	 				echo "</section></form>";
	   	 				break;
	   	 			case 'OUVERT':
	   	 				echo "<form method='post' action='page_inscription.php'>
	   	 				<section class='tournoi_enfant_OUVERT'>" . "<p><label>[Inscriptions ouvertes] </label><br>" . $intitule[$i] . " / " . $sport[$i] . 
	   	 				"<input class='intitule_value' name='intitule' value='" . $intitule[$i] . "'hidden>
	   	 				 <input class='sport_value' name='sport' value='" . $sport[$i] . "'hidden>
	   	 				</p>";
	   	 				switch (strtolower($sport[$i])) {
	   	 					case 'volley':
	   	 						echo "<img src='ressources/fond_volleyball.png'><br>";
	   	 						break;
	   	 					case 'handball':
	   	 						echo "<img src='ressources/fond_handball.png'><br>";
	   	 						break;
	   	 					case 'basket':
	   	 						echo "<img src='ressources/fond_basketball.png'><br>";
	   	 						break;
	   	 					case 'badminton':
	   	 						echo "<img src='ressources/fond_badminton.png'><br>";
	   	 						break;
	   	 					case 'ping-pong':
	   	 						echo "<img src='ressources/fond_ping-pong.jpg'><br>";
	   	 						break;
	   	 					case 'genshin impact':
	   	 						echo "<img src='ressources/fond_genshin.jpg'><br>";
	   	 						break;
	   	 					case 'mhr':
	   	 						echo "<img src='ressources/fond_mizutsune.jpg'><br>";
	   	 						break;
	   	 					default :
	   	 						echo "<img src='ressources/fond_inscription.jpg'><br>";
	   	 						break;
	   	 				}
	   	 				echo "<input class='submit' value='Inscription' type='submit'></section></form>";
	   	 				break; 
	   	 			default: 
	   	 				break;
	   	 		}
	   	 	}
	   	 	}
	   	 	else {
	   	 		echo "<h1>Aucun tournoi disponible pour l'instant...</h1>";
	   	 	}
   	 	?>	
	</section>				
</body>
</html>