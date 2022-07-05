<?php
session_start();
$_SESSION['id_login'] = $_POST['id'];
$_SESSION['mdp_login'] = sha1($_POST['mdp']);
include('BDD_id.php');

if (empty($_POST['id']) || empty($_POST['mdp'])){ //Empêche l'accès par URL
        header("Location: ./page_connexion.php");
        exit();
}
else {
	$reponse = $bdd->query("SELECT identifiant, mot_de_passe FROM identifiants");
    while ($donnees = $reponse->fetch()) {  

    	if ($donnees['identifiant']==$_SESSION['id_login'] && $donnees['mot_de_passe']==$_SESSION['mdp_login']) 
        {   //Si pas de session, n'accède pas à la page "Compte"
            $id_login = $_SESSION['id_login'];
            $reponse = $bdd->query("SELECT nom, prenom, identifiant, mot_de_passe, classe FROM identifiants WHERE identifiant = '$id_login'");
            while ($donnees = $reponse->fetch()) {
                $_SESSION['nom'] = $donnees['nom'];
                $_SESSION['prenom'] = $donnees['prenom'];
                $_SESSION['identifiant'] = $donnees['identifiant'];
                $_SESSION['mot_de_passe'] = $donnees['mot_de_passe'];
                $_SESSION['classe'] = $donnees['classe'];
            }
    		header("Location: ./");
    		exit();
    	}
    }
    //Si identifiants pas bon
    $_SESSION['id_login'] = NULL;
    $_SESSION['message_erreur'] = 1;
    header("Location: ./page_connexion.php");
    exit();
}?>