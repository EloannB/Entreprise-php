<?php

// Initialisation de la session
session_start();
// Inclure la configuration et les modèles nécessaires
require_once "../config.php";
require_once "../models/Trajet.php";
require_once '../models/Entreprise.php';

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user'])) {
    header('Location: controller-signin.php');
    exit();
}

// Vérifier si le formulaire de mise à jour a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $erreurs = array();
    // Récupérer les données du formulaire
    $nom = htmlspecialchars($_POST['nom']);
    $courriel = htmlspecialchars($_POST['courriel']);
    $mot_de_passe = htmlspecialchars($_POST['mot_de_passe']);
    $conf_mot_de_passe = htmlspecialchars($_POST['conf_mot_de_passe']);
    $siret = htmlspecialchars($_POST['siret']);
    $adresse = htmlspecialchars($_POST['adresse']);
    $postal = htmlspecialchars($_POST['postal']);
    $ville = htmlspecialchars($_POST['ville']);

    if (empty($nom)) {
        $erreurs["nom"] = "Nom obligatoire";
    } else if (!ctype_alpha($nom)) {
        $erreurs["nom"] = "Le nom est invalide.";
    }

    if (empty($courriel)) {
        $erreurs["courriel"] = "Courriel obligatoire";
    } else if (!filter_var($courriel, FILTER_VALIDATE_EMAIL)) {
        $erreurs["courriel"] = "L'adresse e-mail est invalide.";
    } else if (Entreprise::checkMailExists($_POST["courriel"])) {
        $erreurs["courriel"] = 'Mail déja utilisé';
    }

    if (empty($mot_de_passe)) {
        $erreurs["mot_de_passe"] = "Mot de passe obligatoire";
    } else if (strlen($mot_de_passe) < 8 || $mot_de_passe !== $conf_mot_de_passe) {
        $erreurs["mot_de_passe"] = "Le mot de passe est invalide.";
    }

    if (empty($siret)) {
        $erreurs["siret"] = "Siret obligatoire";
    } else if (strlen($siret) != 14) {
        $erreurs["siret"] = "Le siret est invalide. Il doit contenir 14 caractères.";
    } else if (Entreprise::checkSiretExists($_POST["siret"])) {
        $erreurs["siret"] = 'Siret déja utilisé';
    }

    if (empty($adresse)) {
        $erreurs["adresse"] = "Adresse obligatoire";
    } else if (!ctype_alpha($adresse)) {
        $erreurs["adresse"] = "L'adresse est invalide.";
    };

    if (empty($postal)) {
        $erreurs["postal"] = "Adresse postal obligatoire";
    } else if (strlen($postal) != 5) {
        $erreurs["postal"] = "Le postal est invalide. Il doit contenir 5 caractères.";
    }

    if (empty($ville)) {
        $erreurs["ville"] = "Ville obligatoire";
    } else if (!ctype_alpha($ville)) {
        $erreurs["ville"] = "Le ville est invalide.";
    };

    // Vérifier si l'image est réellement une image
    if (isset($_FILES["profile_image"]) && $_FILES["profile_image"]["error"] == 0) {
        $target_dir = "../assets/uploads/";
        $target_file = $target_dir . basename($_FILES["profile_image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $check = getimagesize($_FILES["profile_image"]["tmp_name"]);
        if ($check === false) {
            $uploadOk = 0;
        }
        
        if ($uploadOk == 1) {
            if (move_uploaded_file($_FILES["profile_image"]["tmp_name"], $target_file)) {
                // Mettre à jour le chemin de l'image dans la base de données
                Entreprise::updateEntrepriseProfileImage($user_id, $_FILES["profile_image"]["name"]);
            }
        }
    }
   
    if (empty($erreurs)) {

        // Mettre à jour les informations du profil
        Entreprise::updateEntrepriseProfile($nom, $courriel, $mot_de_passe, $siret, $adresse, $postal, $ville);

        $_SESSION['user'] = Entreprise::getInfos($adresseMail);
    } 
}

// Rediriger vers la page de profil
// header('Location: controller-profil.php');
// exit();

include_once '../views/view-profil.php';