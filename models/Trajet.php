<?php

class Trajet
{
    /** 
     * Methode permettant d'ajouter un trajet a la BDD 
     * @param string $dateTrajet Date du trajet de l'utilisateur  
     * @param string $distanceParcourue Distance parcourue par l'utilisateur 
     * @param string $dureeTrajet Durée du trajet de l'utilisateur 
     * @param string $imageTrajet Image du trajet de l'utilisateur ( optionnnel )
     * @param int $idVehicule Identifiant du vehicule selectionné
     * @param int $idUtilisateur identifiant de l'utilisateur   
     * 
     * @return void 
     */

    public static function ajouterTrajet(
        string $dateTrajet,
        string $distanceParcourue,
        string $dureeTrajet,
        string $imageTrajet,
        string $idVehicule,
        string $idUtilisateur
    ) {
        try {
            // Création d'un objet $db selon la classe PDO
            $db = new PDO("mysql:host=localhost;dbname=" . DBNAME, DBUSERNAME, DBPASSWORD);

            $sql = "INSERT INTO `trajet`(`date_trajet`, `distance_trajet`, `temps_trajet`, `photo_trajet`, `id_transport`, `id_utilisateur`) VALUES (:date_trajet,:distance_trajet,:temps_trajet,:photo_trajet,:id_vehicule,:id_utilisateur);";

            $query = $db->prepare($sql);

            $query->bindValue(":date_trajet", $dateTrajet, PDO::PARAM_STR);
            $query->bindValue(":distance_trajet", $distanceParcourue, PDO::PARAM_STR);
            $query->bindValue(":temps_trajet", $dureeTrajet, PDO::PARAM_STR);
            $query->bindValue(":photo_trajet", $imageTrajet, PDO::PARAM_STR);
            $query->bindValue(":id_vehicule", $idVehicule, PDO::PARAM_INT);
            $query->bindValue(":id_utilisateur", $idUtilisateur, PDO::PARAM_INT);

            // on execute la requête
            $query->execute();
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            die();
        }
    }

    /** 
     * Methode permettant de supprimer un trajet de la BDD 
     * @param string $dateTrajet Date du trajet de l'utilisateur  
     * @param string $distanceParcourue Distance parcourue par l'utilisateur 
     * @param string $dureeTrajet Durée du trajet de l'utilisateur 
     * @param string $imageTrajet Image du trajet de l'utilisateur ( optionnnel )
     * @param int $idVehicule Identifiant du vehicule selectionné
     * @param int $idUtilisateur identifiant de l'utilisateur   
     * 
     * @return void 
     */

     public static function supprimerTrajet(int $id_trajet): void
{
    try {
        // Création d'un objet $db selon la classe PDO
        $db = new PDO("mysql:host=localhost;dbname=" . DBNAME, DBUSERNAME, DBPASSWORD);

        $sql = "DELETE FROM `trajet` WHERE id_trajet = :id_trajet";

        $query = $db->prepare($sql);

        $query->bindParam(":id_trajet", $id_trajet, PDO::PARAM_INT);

        // on execute la requête
        $query->execute();
    } catch (PDOException $e) {
        echo 'Erreur : ' . $e->getMessage();
        die();
    }
}   

    public static function getHistoriqueTrajet($idUtilisateur)
    {
        try {
            // Création d'un objet $db selon la classe PDO
            $db = new PDO("mysql:host=localhost;dbname=" . DBNAME, DBUSERNAME, DBPASSWORD);

            $sql = "SELECT * , DATE_FORMAT(date_trajet, '%d/%m/%Y') AS date_fr FROM `trajet` NATURAL JOIN `transport` WHERE `id_utilisateur` = :id_utilisateur";

            $query = $db->prepare($sql);

            $query->bindValue(":id_utilisateur", $idUtilisateur, PDO::PARAM_INT);

            // on execute la requête
            $query->execute();

            $result = $query->fetchAll(PDO::FETCH_ASSOC);

            return $result;
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            die();
        }
    }
}