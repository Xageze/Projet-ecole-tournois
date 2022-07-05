<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style_page_compte.css">
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
								<a class='dropdown_compte' href='http://./page_compte.php'>Compte</a><br><br>
								<a class='dropdown_deconnexion' href='http://./deconnexion.php'>Déconnexion</a>
						</section>
					</section>
					</div>";
		}
		//Si pas connecté
		else {
			echo "  <div>
						<section class='left_header'>
							<a href='http://./'>Accueil</a>
							<a href='http://./page_historique.php'>Historique</a>
						</section>
						
						<section class='right_header'>
							<a href='http://./page_connexion.php'>Connexion</a><br>
						</section>
					</div>";
		}
	?>
</header>

<body>
	<section class="section_parent">
		<section class="section_enfant">
			<?php 
	   	 	echo "<h3 class='nom_prenom'>" . strtoupper($_SESSION['nom']) . ' ' . ucfirst($_SESSION['prenom']) . "</h3>";
	   	 	echo "<p>Identifiant</p>" . "<input type='text' disabled='disabled' value=".$_SESSION['identifiant'].">";
	   	 	echo "<p>Mot de passe</p>" . "<input type='password' disabled='disabled' value=".$_SESSION['mot_de_passe'].">";
	   	 	echo "<p>Classe</p>" . "<input type='text' disabled='disabled' value=".$_SESSION['classe'].">";
			?>				
		</section>
	</section>
</body>
</html>