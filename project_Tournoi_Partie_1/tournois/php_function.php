<?php
    session_start();
    // Quand l'utilisateur clique sur le boutton Annuler l'inscription
    if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['annuler']))
    {
        annuler();
    }
    function annuler()
    {
        $bddname = str_replace(' ','_','inscription_'.$_SESSION['intitule']." ".$_SESSION['sport']);

        $bdd = new PDO('mysql:host=192.168.111.1;dbname='.$bddname.';charset=utf8; port=3306', 'admin', 'ansitiSBT03');

        $reponse = $bdd->query("SELECT id, nom, prenom FROM participant");

        while ($donnees = $reponse->fetch()) {  
            if (strtolower($donnees['nom']." ".$donnees['prenom']) == strtolower($_SESSION['nom']." ".$_SESSION['prenom'])) {
                $sql = "DELETE FROM participant WHERE id=".$donnees['id'];
                $bdd->query($sql);
                $_SESSION['inscription_value'] = 3;
                header("Location: ./");
                break;
            }
            else {
                header("Location: ./");
            }
        }
        header("Location: ./");
    }







    // Quand l'utilisateur clique sur le boutton s'inscrire
    if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['inscription']))
    {
        inscription();
    }
    function inscription()
    {   //Retourne sur le check inscription pour effectuer l'inscription
        header("Location: ./check_inscription");
    }
?>