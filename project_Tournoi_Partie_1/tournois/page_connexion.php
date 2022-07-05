<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style_page_connexion.css">
	<link rel="stylesheet" type="text/css" media="only screen and (max-width: 980px)" href="style_page_connexion_mobile.css" />
	<title>Connexion</title>
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
			echo "  <div>
						<section class='left_header'>
							<a href='./'>Accueil</a>
							<a href='./page_historique.php'>Historique</a>
						</section>";
		}
	?>
</header>

<body>
	<?php 
	if (isset($_SESSION['message_erreur']) && $_SESSION['message_erreur']==1)
	{
		echo "<section class='parent'>
		<section class='enfant'>
			<h3>Connexion</h3>
			<strong class='message_erreur'>Identifiant ou mot de passe incorrect.</strong>
			<form method='post' action='check_connexion.php'>
				<input class='input_login' type='text' id='inputclick' name='id' placeholder='Identifiant' autocomplete='off' required>
				<label class='control-label' for='inputclick' >Identifiant</label>

				<input class='input_login' type='password' id='inputclick2' name='mdp' placeholder='Mot de passe' autocomplete='off' required>
				<label class='control-label' for='inputclick2'>Mot de passe</label>
				<br>
				<input class='submit' value='' type='submit'>
			</form>
		</section>
		</section>";
		$_SESSION['message_erreur']=0;
	}
	else {
		echo "<section class='parent'>
		<section class='enfant'>
			<h3>Connexion</h3>

			<form method='post' action='check_connexion.php'>
				<input class='input_login' type='text' id='inputclick' name='id' placeholder='Identifiant' autocomplete='off' required>
				<label class='control-label' for='inputclick' >Identifiant</label>

				<input class='input_login' type='password' id='inputclick2' name='mdp' placeholder='Mot de passe' autocomplete='off' required>
				<label class='control-label' for='inputclick2'>Mot de passe</label>
				<br>
				<input class='submit' value='' type='submit'>
			</form>
		</section>
		</section>";
	}
	
	?>

	

</body>
</html>