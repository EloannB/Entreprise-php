<?php

class Entreprise
{

    /**
     * Méthode permettant de créer un profil d'une entreprise
     * @param string $id_entreprise Id de l'entreprise de l'entreprise
     * @param string $nom Nom de l'entreprise
     * @param string $courriel Adresse mail de l'entreprise
     * @param string $mot_de_passe Mot de passe de l'entreprise
     * @param string $siret Numéro de siret de l'entreprise
     * @param string $adresse Adresse de l'entreprise
     * @param string $postal Adresse postal de l'entreprise
     * @param string $ville Ville de l'entreprise
     * @param string $photo Photo de l'entreprise
     * 
     * @return void
     */
    public static function create(string $nom, string $courriel, string $mot_de_passe, int $siret, string $adresse, int $postal, string $ville)
    {
        try {

            // Conexion à la base de données
            $db = new PDO("mysql:host=localhost;dbname=" . DBNAME, DBUSERNAME, DBPASSWORD);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Stockage de la requete dans variable
            $sql = "INSERT INTO entreprise (nom_entreprise, mail_entreprise, mdp_entreprise, siret_entreprise, adresse_entreprise, postal_entreprise, ville_entreprise)
            VALUES (:nom_entreprise, :mail_entreprise, :mdp_entreprise, :siret_entreprise, :adresse_entreprise, :postal_entreprise, :ville_entreprise)";

            // Préparation de la requète
            $query = $db->prepare($sql);

            // Relier les valeurs aux marqueurs nominatifs
            $query->bindValue(':nom_entreprise', htmlspecialchars($nom), PDO::PARAM_STR);
            $query->bindValue(':mail_entreprise', htmlspecialchars($courriel), PDO::PARAM_STR);
            $query->bindValue(':mdp_entreprise', password_hash($mot_de_passe, PASSWORD_DEFAULT), PDO::PARAM_STR);
            $query->bindValue(':siret_entreprise', $siret, PDO::PARAM_INT);
            $query->bindValue(':adresse_entreprise', htmlspecialchars($adresse), PDO::PARAM_STR);
            $query->bindValue(':postal_entreprise', $postal, PDO::PARAM_INT);
            $query->bindValue(':ville_entreprise', htmlspecialchars($ville), PDO::PARAM_STR);

            $query->execute();
        } catch (PDOException $e) {
            echo 'Erreur :' . $e->getMessage();
            die();
        }
    }

    /**
     * Methode permettant de vérifier si un mail existe dans la base de donnée
     * 
     * @param string $email Adresse mail de l'utilisateur
     * 
     * @return bool
     */
    public static function checkMailExists(string $courriel): bool
    {
        // le try and catch permet de gérer les erreurs, nous allons l'utiliser pour gérer les erreurs liées à la base de données
        try {
            // Création d'un objet $db selon la classe PDO
            $db = new PDO("mysql:host=localhost;dbname=" . DBNAME, DBUSERNAME, DBPASSWORD);

            // stockage de ma requete dans une variable
            $sql = "SELECT * FROM `entreprise` WHERE `mail_entreprise` = :mail";

            // je prepare ma requête pour éviter les injections SQL
            $query = $db->prepare($sql);

            // on relie les paramètres à nos marqueurs nominatifs à l'aide d'un bindValue
            $query->bindValue(':mail', $courriel, PDO::PARAM_STR);

            // on execute la requête
            $query->execute();

            // on récupère le résultat de la requête dans une variable
            $result = $query->fetch(PDO::FETCH_ASSOC);

            // on vérifie si le résultat est vide car si c'est le cas, cela veut dire que le mail n'existe pas
            if (empty($result)) {
                return false;
            } else {
                return true;
            }
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            die();
        }
    }

    /**
     * Methode permettant de vérifier si un pseudo existe dans la base de donnée
     * 
     * @param string $pseudo Pseudo de l'utilisateur
     * 
     * @return bool
     */
    public static function checkSiretExists(string $siret): bool
    {
        // le try and catch permet de gérer les erreurs, nous allons l'utiliser pour gérer les erreurs liées à la base de données
        try {
            // Création d'un objet $db selon la classe PDO
            $db = new PDO("mysql:host=localhost;dbname=" . DBNAME, DBUSERNAME, DBPASSWORD);

            // stockage de ma requete dans une variable
            $sql = "SELECT * FROM `entreprise` WHERE `siret_entreprise` = :siret";

            // je prepare ma requête pour éviter les injections SQL
            $query = $db->prepare($sql);

            // on relie les paramètres à nos marqueurs nominatifs à l'aide d'un bindValue
            $query->bindValue(':siret', $siret, PDO::PARAM_STR);

            // on execute la requête
            $query->execute();

            // on récupère le résultat de la requête dans une variable
            $result = $query->fetch(PDO::FETCH_ASSOC);

            // on vérifie si le résultat est vide car si c'est le cas, cela veut dire que le mail n'existe pas
            if (empty($result)) {
                return false;
            } else {
                return true;
            }
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            die();
        }
    }

    /**
     * Methode permettant de récupérer les infos d'un utilisateur avec son mail comme paramètre
     * 
     * @param string $email Adresse mail de l'utilisateur
     * 
     * @return array Tableau associatif contenant les infos de l'utilisateur
     */
    public static function getInfos(string $courriel): array
    {
        try {
            // Création d'un objet $db selon la classe PDO
            $db = new PDO("mysql:host=localhost;dbname=" . DBNAME, DBUSERNAME, DBPASSWORD);

            // stockage de ma requete dans une variable
            $sql = "SELECT * FROM `entreprise` WHERE `mail_entreprise` = :mail";

            // je prepare ma requête pour éviter les injections SQL
            $query = $db->prepare($sql);

            // on relie les paramètres à nos marqueurs nominatifs à l'aide d'un bindValue
            $query->bindValue(':mail', $courriel, PDO::PARAM_STR);

            // on execute la requête
            $query->execute();

            // on récupère le résultat de la requête dans une variable
            $result = $query->fetch(PDO::FETCH_ASSOC);

            // on retourne le résultat
            return $result;
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            die();
        }
    }

    public static function updateEntrepriseProfile(string $nom, string $courriel, string $mot_de_passe, int $siret, string $adresse, int $postal, string $ville)
    {
        try {
            $db = new PDO("mysql:host=localhost;dbname=" . DBNAME, DBUSERNAME, DBPASSWORD);

            $sql = "UPDATE entreprise SET id_entreprise = :nom_entreprise, mail_entreprise = :mail_entreprise, adresse_entreprise = :adresse_entreprise, postal_entreprise = :postal_entreprise, ville_entreprise = :ville_entreprise WHERE id_utilisateur = :id_utilisateur";

            $query = $db->prepare($sql);

            $query->bindParam(":nom_entreprise", $nom, PDO::PARAM_STR);
            $query->bindParam(":mail_entreprise", $courriel, PDO::PARAM_STR);
            $query->bindParam(":adresse_entreprise", $adresse, PDO::PARAM_STR);
            $query->bindParam(":postal_entreprise", $postal, PDO::PARAM_INT);
            $query->bindParam(":ville_entreprise", $ville, PDO::PARAM_STR);
            $query->bindParam(":id_utilisateur", $id_utilisateur, PDO::PARAM_INT);

            $query->execute();
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            die();
        }
    }

    public static function updateEntrepriseProfileImage($id_entreprise, $image_user)
    {
        try {
            $db = new PDO("mysql:host=localhost;dbname=" . DBNAME, DBUSERNAME, DBPASSWORD);

            $sql = "UPDATE entreprise SET photo_entreprise = :image_user WHERE id_utilisateur = :id_utilisateur";

            $query = $db->prepare($sql);

            $query->bindParam(":image_user", $image_user, PDO::PARAM_STR);
            $query->bindParam(":id_utilisateur", $utilisateur_id, PDO::PARAM_INT);

            $query->execute();
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            die();
        }
    }

    public static function supprimerCompte(int $user_id): void
    {
        try {
            // Créer une connexion à la base de données
            $db = new PDO("mysql:host=localhost;dbname=" . DBNAME, DBUSERNAME, DBPASSWORD);

            // Supprimer l'utilisateur de la base de données
            $sql = "DELETE FROM `entreprise` WHERE `id_entreprise` = :id_entreprise";
            $query = $db->prepare($sql);
            $query->bindParam(":id_entreprise", $user_id, PDO::PARAM_INT);
            $query->execute();
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            die();
        }
    }

    /**
     * Methode permettant de récupérer tout les utilisateurs selon l'id d'entreprise
     * 
     * @return array Tableau associatif contenant les infos des utilisateurs
     */
    public static function getAllUtilisateur(int $id_entreprise): array
    {
        try {
            // Création d'un objet $db selon la classe PDO
            $db = new PDO("mysql:host=localhost;dbname=" . DBNAME, DBUSERNAME, DBPASSWORD);

            // stockage de ma requete dans une variable
            $sql = "SELECT COUNT(*) AS Total FROM `utilisateur` WHERE `id_entreprise` = :id_entreprise";

            // je prepare ma requête pour éviter les injections SQL
            $query = $db->prepare($sql);

            $query->bindParam(":id_entreprise", $id_entreprise, PDO::PARAM_INT);

            // on execute la requête
            $query->execute();

            // on récupère le résultat de la requête dans une variable
            $result = $query->fetchAll(PDO::FETCH_ASSOC);

            // on retourne le résultat
            return $result;
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            die();
        }
    }

    /**
     * Methode permettant de récupérer tout les utilisateurs selon l'id d'entreprise
     * 
     * @return array Tableau associatif contenant les infos des utilisateurs
     */
    public static function getAllActif(int $id_entreprise): array
    {
        try {
            // Création d'un objet $db selon la classe PDO
            $db = new PDO("mysql:host=localhost;dbname=" . DBNAME, DBUSERNAME, DBPASSWORD);

            // stockage de ma requete dans une variable
            $sql = "SELECT COUNT(DISTINCT utilisateur.id_utilisateur) AS TotalActif
            FROM `utilisateur`
            JOIN `trajet` ON utilisateur.id_utilisateur = trajet.id_utilisateur
            WHERE utilisateur.id_entreprise = :id_entreprise
            ";

            // je prepare ma requête pour éviter les injections SQL
            $query = $db->prepare($sql);

            $query->bindParam(":id_entreprise", $id_entreprise, PDO::PARAM_INT);

            // on execute la requête
            $query->execute();

            // on récupère le résultat de la requête dans une variable
            $result = $query->fetchAll(PDO::FETCH_ASSOC);

            // on retourne le résultat
            return $result;
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            die();
        }
    }

    /**
     * Methode permettant de récupérer tout les utilisateurs selon l'id d'entreprise
     * 
     * @return array Tableau associatif contenant les infos des utilisateurs
     */
    public static function getAllTrajet(int $id_entreprise): array
    {
        try {
            // Création d'un objet $db selon la classe PDO
            $db = new PDO("mysql:host=localhost;dbname=" . DBNAME, DBUSERNAME, DBPASSWORD);

            // stockage de ma requete dans une variable
            $sql = "SELECT COUNT(*) AS TotalTrajet
            FROM `trajet`
            JOIN `utilisateur` ON utilisateur.id_utilisateur = trajet.id_utilisateur
            WHERE utilisateur.id_entreprise = :id_entreprise;
            ";

            // je prepare ma requête pour éviter les injections SQL
            $query = $db->prepare($sql);

            $query->bindParam(":id_entreprise", $id_entreprise, PDO::PARAM_INT);

            // on execute la requête
            $query->execute();

            // on récupère le résultat de la requête dans une variable
            $result = $query->fetchAll(PDO::FETCH_ASSOC);

            // on retourne le résultat
            return $result;
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            die();
        }
    }

    /**
     * Methode permettant de récupérer tout les utilisateurs selon l'id d'entreprise
     * 
     * @return array Tableau associatif contenant les infos des utilisateurs
     */
    public static function getFiveLastUtilisateur(int $id_entreprise): array
    {
        try {
            // Création d'un objet $db selon la classe PDO
            $db = new PDO("mysql:host=localhost;dbname=" . DBNAME, DBUSERNAME, DBPASSWORD);

            // stockage de ma requete dans une variable
            $sql = "SELECT id_utilisateur, photo_participant, pseudo_participant FROM `utilisateur` WHERE id_entreprise = :id_entreprise ORDER BY id_utilisateur DESC LIMIT 5;";

            // je prepare ma requête pour éviter les injections SQL
            $query = $db->prepare($sql);

            $query->bindParam(":id_entreprise", $id_entreprise, PDO::PARAM_INT);

            // on execute la requête
            $query->execute();

            // on récupère le résultat de la requête dans une variable
            $result = $query->fetchAll(PDO::FETCH_ASSOC);

            // on retourne le résultat
            return $result;
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            die();
        }
    }
}
