<?php

session_start();

require_once "../config.php";
require_once "../models/Entreprise.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $erreurs = array();


    // On regarder si les champs sont vides
    if (empty($_POST["courriel"])) {
        $erreurs['courriel'] = "Mail obligatoire.";
    }

    if (empty($_POST["mot_de_passe"])) {
        $erreurs['mot_de_passe'] = "Mot de passe obligatoire.";
    }

    if (empty($erreurs)) {
        $courriel = htmlspecialchars($_POST['courriel']);
        $mot_de_passe = htmlspecialchars($_POST['mot_de_passe']);

        if (Entreprise::checkMailExists($courriel)) {
            $entrepriseInfos = entreprise::getInfos($courriel);

            // On vérifie le mot de passe
            if (password_verify($mot_de_passe, $entrepriseInfos['mdp_entreprise'])) {
                $_SESSION['user'] = $entrepriseInfos;
                header('Location: controller-home.php');
                exit(); // Assurez-vous de terminer le script après une redirection
            } else {
                $erreurs['mot_de_passe'] = "Mot de passe incorrect.";
            }
        } else {
            $erreurs['courriel'] = "Adresse mail incorrecte.";
        }
    }

}
include_once '../views/view-signin.php';