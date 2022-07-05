<?php
try 
{
    $bdd = new PDO('mysql:host=localhost;dbname=gestion_tournois;charset=utf8; port=3306', 'root', '');    
} 
catch (Exception $e) 
{
    die('Erreur : ' . $e->getMessage());   
}
?>