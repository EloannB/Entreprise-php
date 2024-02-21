<?php
session_start();

require_once '../config.php';
require_once '../models/Entreprise.php';

if (isset($_GET['validate']) && isset($_SESSION['user'])) {
    Entreprise::getInfosUtilisateur($_GET['validate']);

    if (Entreprise::getInfosUtilisateur($_GET['validate'])['id_entreprise'] == $_SESSION['user']['id_entreprise']) {
        Entreprise::validateUser($_GET['validate']);
    }
}

if (isset($_GET['invalidate']) && isset($_SESSION['user'])) {
    Entreprise::getInfosUtilisateur($_GET['invalidate']);

    if (Entreprise::getInfosUtilisateur($_GET['invalidate'])['id_entreprise'] == $_SESSION['user']['id_entreprise']) {
        Entreprise::desactivUser($_GET['invalidate']);
    }
}
