<?php  
session_start();
// Connexion sans BDD pour check n'importe quelle BDD
try {
    $bdd = new PDO('mysql:host=localhost;charset=utf8; port=3306', 'root', '');   
    echo "Étape 1 : OK<br>";
} 
catch (Exception $e) {
	die('Erreur1 : ' . $e->getMessage());   
}
// écrit bien tournoi_interclasse_annee_sport
$bddname = str_replace(' ','_','inscription_'.$_SESSION['intitule']." ".$_SESSION['sport']);
$bddname = str_replace('-','_',$bddname);
echo $bddname."<br>";
$bdd->exec("CREATE DATABASE IF NOT EXISTS ".$bddname);
$bdd = null;

// Crée une table dans la BBD du toirnoi ou l'élève s'est inscrit si la table n'existe pas
try {
    $bdd = new PDO('mysql:host=localhost;dbname='.$bddname.';charset=utf8; port=3306', 'root', '');    

 	$sql = "CREATE TABLE IF NOT EXISTS participant(
	    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	    nom VARCHAR(30) NOT NULL,
	    prenom VARCHAR(30) NOT NULL,
	    classe VARCHAR(10) NOT NULL)";

	$bdd->exec($sql);
	echo "<br>Étape 2 : OK, Table ".$bddname." created successfully";
	} 
catch (Exception $e) {
	die('Erreur2 : ' . $e->getMessage());   
}
$bdd = null;

// Ajoute le participant dans la table du tournoi crée
try {
	$bdd = new PDO('mysql:host=localhost;dbname='.$bddname.';charset=utf8; port=3306', 'root', '');
	$deja_indcrit=0;
	$i=0;
	$reponse = $bdd->query("SELECT nom, prenom FROM participant");
	   	 	while ($donnees = $reponse->fetch()) {
	   			$nom[$i] = $donnees['nom'];
	   	 		$prenom[$i] = $donnees['prenom'];
	   	 		if (($_SESSION['nom'].$_SESSION['prenom'])==($nom[$i].$prenom[$i])) {
	   	 			$deja_indcrit=1;
	   	 		} $i++;
			}
			if ($deja_indcrit==0) {
				$sql = "INSERT INTO participant (nom, prenom, classe) VALUES (?,?,?)";
				$stmt= $bdd->prepare($sql);
				$stmt->execute([$_SESSION['nom'], $_SESSION['prenom'], $_SESSION['classe']]);
				$_SESSION['inscription_value'] = 1;
				header('Location: ./');
			} else {
				$_SESSION['inscription_value'] = 2;
				header('Location: ./');
			}
	}
catch (Exception $e) {
	die('Erreur3 : ' . $e->getMessage());   
}

?>