<?php
try 
{
    $bdd = new PDO('mysql:host=192.168.111.1;dbname=gestion_tournois;charset=utf8; port=3306', 'adminTournoi', 'atSBT03');    
} 
catch (Exception $e) 
{
    die('Erreur : ' . $e->getMessage());   
}
?>