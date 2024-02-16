<?php
session_start();

require_once '../config.php';
require_once '../models/Entreprise.php';
require_once "../models/Trajet.php";

// Vérifier si le formulaire de déconnexion a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logout'])) {
    // Détruire toutes les variables de session
    session_unset();
    // Détruire la session
    session_destroy();
    // Rediriger vers la page de connexion
    header('Location: controller-signin.php');
    exit();
}

// Vérifiez si l'utilisateur est connecté en vérifiant la présence de la variable de session 'id_utilisateur'
if (!isset($_SESSION['user'])) {
    // Si l'utilisateur n'est pas connecté, redirigez-le vers la page de connexion
    header('Location: controller-signin.php');
    exit(); // Assurez-vous de terminer le script après une redirection
}

// Appeler la fonction pour récupérer les utilisateurs
$utilisateurs_json = Entreprise::getAllUtilisateur($_SESSION['user']['id_entreprise']);
$utilisateurs = json_decode($utilisateurs_json, true); // true pour obtenir un tableau associatif

// Appeler la fonction pour récupérer les utilisateurs actifs
$Totalutilisateurs_json = Entreprise::getAllActif($_SESSION['user']['id_entreprise']);
$Totalutilisateurs = json_decode($Totalutilisateurs_json, true); // true pour obtenir un tableau associatif

// Appeler la fonction pour récupérer tous les trajets
$totalTrajets_json = Entreprise::getAllTrajet($_SESSION['user']['id_entreprise']);
$totalTrajets = json_decode($totalTrajets_json, true); // true pour obtenir un tableau associatif

// Appeler la fonction pour récupérer les cinq derniers trajets
$lastFiveTrajets_json = Entreprise::getFiveLastTrajet($_SESSION['user']['id_entreprise']);
$lastFiveTrajets = json_decode($lastFiveTrajets_json, true); // true pour obtenir un tableau associatif

$statstransports = Entreprise::getTransportStats($_SESSION['user']['id_entreprise']);

// Inclure la page de vue HOME
include_once '../views/view-home.php';
