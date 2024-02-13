<?php

require_once '../config.php';
require_once '../models/Entreprise.php';

$showform = true;
// Vérifier si le formulaire a été validé
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

    // Valider les champs
    if (!isset($_POST['cgu'])) {
        $erreurs["cgu"] = "Vous devez accepter les conditions générales d'utilisation.";
    }

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
    } else if (!is_numeric($siret)) {
        $erreurs["siret"] = 'Le numéro de siret ne doit contenir que des chiffres.';
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

    $recaptcha_secret = '6LfN-3ApAAAAAPOGIU3RQ6Bzg4VMIRY4VKzpU_mz';

    // Vérifier si le reCAPTCHA a été soumis
    if(isset($_POST['g-recaptcha-response'])){
        // Récupérer la réponse du reCAPTCHA
        $captcha_response = $_POST['g-recaptcha-response'];
        // Effectuer une requête POST à l'API de validation reCAPTCHA
        $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$recaptcha_secret&response=$captcha_response");
        $responseKeys = json_decode($response, true);
        // Vérifier si la réponse est valide
        if(intval($responseKeys["success"]) !== 1) {
            // Le reCAPTCHA n'a pas été validé
            $erreurs["g-recaptcha-response"] = "Veuillez valider le reCAPTCHA avant de soumettre le formulaire.";
        }
    }
    
    // Si il n'y a pas d'erreurs
    if (empty($erreurs)) {

        Entreprise::create($nom, $courriel, $mot_de_passe, $siret, $adresse, $postal, $ville);


        // Inclure la connexion à la base de données
        // $sql_entreprise = 'SELECT * FROM `entreprise`';

        // Préparation de la requète
        // $query = $db->prepare($sql_entreprise);

        // Executer la requète
        // $query->execute();

        // Stocker le résultat
        // $result = $query->fetchAll(PDO::FETCH_ASSOC);

        // var_dump($result);


        // Cacher le formulaire 
        $showform = false;
    }
}


include_once '../views/view-signup.php';
