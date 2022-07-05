<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style_page_inscription.css">
	<link rel="stylesheet" type="text/css" media="only screen and (max-width: 980px)" href="style_page_inscription_mobile.css" />
	<script src="https://kit.fontawesome.com/a076d05399.js"></script>
	<script type="text/javascript" src="script.js"></script>
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
			echo header('Location: ./page_connexion.php');
		}
	?>
</header>

<body>

	<section class='parent'>
		<section class='enfant'>
			<?php
			$_SESSION['intitule'] = $_POST['intitule'];
			$_SESSION['sport'] = $_POST['sport']; 
			?>
			<h3>Inscription au tournoi <?php echo "<br>" . $_SESSION['intitule']." ".$_SESSION['sport'] ?></h3>

			<form method='post' action='php_function.php'>

				<?php
				$bddname = str_replace(' ','_','inscription_'.$_SESSION['intitule']." ".$_SESSION['sport']);
				$bddname = str_replace('-','_',$bddname);
				try {
					$bdd = new PDO('mysql:host=localhost;dbname='.$bddname.';charset=utf8; port=3306', 'root', '');
					$i=0;
					$reponse = $bdd->query("SELECT nom, prenom FROM participant");
			   	 	while ($donnees = $reponse->fetch()) {
			   			$nom[$i] = $donnees['nom'];
			   			$prenom[$i] = $donnees['prenom'];
			   			$i++;
					}
				}
				catch (Exception $e) {
					die('Erreur3 : ' . $e->getMessage());   
				}
				echo "<section class='center'>
					<input type='checkbox' id='click'>
					<label for='click' class='click-me'>Voir les participants</label>
					<section class='content'>
						<section class='header-popup'>
							<h2>Participants</h2>
							<label for='click' class='fas fa-times'></label>
						</section>
						<p>";
				for ($i=0; $i<count($nom); $i++) {
					echo strtoupper($nom[$i])." ".ucfirst($prenom[$i])."<br>";
				}
				echo "</p>
					</section>
				</section>";











				?>


				
							
						










				<section class="section_input">
					<div class=tooltip>
						<span class="tooltiptext">Annuler l'inscription</span>
						<input type="submit" class='submit_annuler' name='annuler' onclick="annuler()" value="">
					</div>
					<div class=tooltip>
						<span class="tooltiptext">S'inscrire</span>
						<input type="submit" class='submit_inscription' name='inscription' onclick="inscription()" value="">
					</div>
				</section>
			</form>
		</section>
	</section>
</body>
</html>	