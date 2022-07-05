<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style_page_histo_tournoi.css">
	<title>Accueil</title>
</head>
<header>
	<?php 
		session_start();
		//Si connecté
		if (isset($_SESSION['id_login'])) {
			echo "  <div>
					<section class='left_header'>						
						<a href='./'>Accueil</a>
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
							<a href='./'>Accueil</a>
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
	// Récupère l'ID du tournoi ou on a cliqué
	include('BDD_tournois.php');
	$i=0;
	$reponse = $bdd->query("SELECT ID FROM tournoi WHERE intitule = '".$_POST['tournoi_intitule']."' AND sport='".$_POST['tournoi_sport']."'");
	while ($donnees = $reponse->fetch()) {
	   	 $id_tournoi[$i] = $donnees['ID'];
	   	 $i++;
	}
	$i=0;
	$reponse = $bdd->query("SELECT Equipe_1, Equipe_2, Score_Equipe_1, Score_Equipe_2 FROM matchs WHERE ID_Tournoi = '".$id_tournoi[0]."'");
	while ($donnees = $reponse->fetch()) {
	   	 $equipe1[$i] = $donnees['Equipe_1'];
	   	 $equipe2[$i] = $donnees['Equipe_2'];
	   	 $score_equipe1[$i] = $donnees['Score_Equipe_1'];
	   	 $score_equipe2[$i] = $donnees['Score_Equipe_2'];
	   	 $i++;
	}
	if (isset($equipe1)) {
	echo "<section class='tournoi_parent'>
		<section class='tournoi_enfant_TERMINE'>
		<p><label>Historique</label><br><br>" . $_POST['tournoi_intitule'] . " / " . $_POST['tournoi_sport'] . "</p>
		<section class='affichage_score'>";

	for ($i=0; $i<count($equipe1); $i++) {
		if ($score_equipe1[$i] > $score_equipe2[$i])
		{
			echo "<strong class='potit_match'>MATCH ".($i+1)."</strong><br>
			<section class=sect_inline_equipe1_win>
				<label>".$equipe1[$i]."</label>
			</section>
			<section class=sect_inline_score1_win>
				<label>". $score_equipe1[$i]."</label>
			</section>
			-
			<section class=sect_inline_score2_lose>
				<label>". $score_equipe2[$i]."</label>
			</section>
			<section class=sect_inline_equipe2_lose>
				<label>".$equipe2[$i]."</label>
			</section><br><br>";
		}
		else if ($score_equipe2[$i] > $score_equipe1[$i]) 
		{
			echo "<strong class='potit_match'>MATCH ".($i+1)."</strong><br>
			<section class=sect_inline_equipe1_lose>
				<label>".$equipe1[$i]."</label>
			</section>
			<section class=sect_inline_score1_lose>
				<label>". $score_equipe1[$i]."</label>
			</section>
			-
			<section class=sect_inline_score2_win>
				<label>". $score_equipe2[$i]."</label>
			</section>
			<section class=sect_inline_equipe2_win>
				<label>".$equipe2[$i]."</label>
			</section><br><br>";
		}
		else {
			echo "<strong class='potit_match'>MATCH ".($i+1)."</strong><br>
			<section class=sect_inline_equipe1>
				<label>".$equipe1[$i]."</label>
			</section>
			<section class=sect_inline_score1>
				<label>". $score_equipe1[$i]."</label>
			</section>
			-
			<section class=sect_inline_score2>
				<label>". $score_equipe2[$i]."</label>
			</section>
			<section class=sect_inline_equipe2>
				<label>".$equipe2[$i]."</label>
			</section><br><br>";
		}
		
	}
	echo "</section>
		</section>
	</section>";
	}
	else {
		echo "<br><br><br><br><br><h3>Aucun match trouvé...</h3>";
	}




	
	?>

</body>
</html>