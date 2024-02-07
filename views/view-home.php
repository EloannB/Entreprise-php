<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="../node_modules/materialize-css/dist/css/materialize.css">
    <link rel="stylesheet" href="../assets/style/style.css">
    <title>Dashboard</title>
</head>

<body>
    <nav class="top-nav #64b5f6 blue lighten-2">
        <div class="container">
            <div class="nav-wrapper">
                <div class="row">
                    <div class="col s12 m10 offset-m1">
                        <h1 class="header text-align: center">Dashboard</h1>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="container">
            <a href="#" data-target="nav-mobile" class="top-nav sidenav-trigger full hide-on-large-only"><i class="material-icons">menu</i></a>
        </div>
        <ul id="nav-mobile" class="sidenav sidenav-fixed">
            <li class="logo">
                <div class="user-info">
                    <?php
                    if (!empty($_SESSION['user']['photo_entreprise'])) {
                        $photoPath = "../assets/uploads/" . $_SESSION['user']['photo_entreprise'];
                    } else {
                        $photoPath = "../imageDefaut.png";
                    }
                    ?>
                    <img src="<?= $photoPath ?>" class="responsive-img" alt="Photo de profil">
                </div>
            </li>
            <p class="profile-info-item, text-align: center">Nom : <?php echo $_SESSION['user']['nom_entreprise']; ?></p>
            <p class="profile-info-item, text-align: center">Courriel : <?php echo $_SESSION['user']['mail_entreprise']; ?></p>
            <p class="profile-info-item, text-align: center">Adresse : <?php echo $_SESSION['user']['adresse_entreprise']; ?></p>
            <p class="profile-info-item, text-align: center">Adresse Postal : <?php echo $_SESSION['user']['postal_entreprise']; ?></p>
            <p class="profile-info-item, text-align: center">Ville : <?php echo $_SESSION['user']['ville_entreprise']; ?></p>
            <!-- Ajouter le formulaire de déconnexion -->
            <form method="post" style="display:inline;">
                <input type="hidden" name="logout" value="1">
                <button type="submit" class="logout-button">Déconnexion</button>
            </form>
        </ul>
    </div>


    <div class="container">
        <div id="home" class="section">
            <h3>Bonjour <?php echo $_SESSION['user']['nom_entreprise']; ?></h3>
            <p>Date du jour : <?php echo date('d/m/Y'); ?></p>
            <div class="row">
                <div class="col s12 m6">
                    <div class="card blue-grey darken-1">
                        <div class="card-content white-text">
                            <span class="card-title">Total des Utilisateurs :</span>
                            <?php
                            // Appeler la fonction pour récupérer les utilisateurs
                            $utilisateurs = Entreprise::getAllUtilisateur($_SESSION['user']['id_entreprise']);

                            // Vérifier si des utilisateurs ont été récupérés
                            if (!empty($utilisateurs)) {
                                // Afficher les utilisateurs
                                foreach ($utilisateurs as $utilisateur) {
                                    echo "<p>{$utilisateur['Total']} Utilsateur(s)</p>";
                                }
                            } else {
                                echo "<p>Aucun utilisateur trouvé.</p>";
                            }
                            ?>
                        </div>
                    </div>
                </div>

                <div class="col s12 m6">
                    <div class="card blue-grey darken-1">
                        <div class="card-content white-text">
                            <span class="card-title">Total des Utilisateurs Actifs :</span>
                            <?php
                            // Appeler la fonction pour récupérer les utilisateurs
                            $Totalutilisateurs = Entreprise::getAllActif($_SESSION['user']['id_entreprise']);

                            // Vérifier si des utilisateurs ont été récupérés
                            if (!empty($Totalutilisateurs)) {
                                // Afficher les utilisateurs
                                foreach ($Totalutilisateurs as $Totalutilisateurs) {
                                    echo "<p>{$Totalutilisateurs['TotalActif']} Utilsateur(s)</p>";
                                }
                            } else {
                                echo "<p>Aucun utilisateur trouvé.</p>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col s12 m6">
                    <div class="card blue-grey darken-1">
                        <div class="card-content white-text">
                            <span class="card-title">Total des Trajets :</span>
                            <?php
                            // Appeler la fonction pour récupérer les trajets
                            $Totaltrajets = Entreprise::getAllTrajet($_SESSION['user']['id_entreprise']);

                            // Vérifier si des trajets ont été récupérés
                            if (!empty($Totaltrajets)) {
                                // Afficher les trajets
                                foreach ($Totaltrajets as $Totaltrajets) {
                                    echo "<p>{$Totaltrajets['TotalTrajet']} Trajet(s)</p>";
                                }
                            } else {
                                echo "<p>Aucun utilisateur trouvé.</p>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col s12 m6">
                    <div class="card blue-grey darken-1">
                        <div class="card-content white-text">
                            <span class="card-title">Les 5 derniers utilisateurs :</span>
                            <?php
                            // Appeler la fonction pour récupérer les utilisateurs
                            $fiveUtilisateur = Entreprise::getFiveLastUtilisateur($_SESSION['user']['id_entreprise']);

                            // Vérifier si des utilisateurs ont été récupérés
                            if (!empty($fiveUtilisateur)) {
                                // Afficher les utilisateurs
                                foreach ($fiveUtilisateur as $utilisateur) {
                                    echo "<img src='http://formulaire-php.test/assets/uploads/{$utilisateur['photo_participant']}' alt='photo_participant' style='max-width: 30%'>";
                                    echo "<p>{$utilisateur['pseudo_participant']}</p>";
                                }
                            } else {
                                echo "<p>Aucun utilisateur trouvé.</p>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col s12 m6">
                    <div class="card blue-grey darken-1">
                        <div class="card-content white-text">
                            <span class="card-title">Les 5 derniers trajets :</span>
                            <p>Affichez ici les stats</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="../node_modules/materialize-css/dist/js/materialize.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('.sidenav');
            var instances = M.Sidenav.init(elems);
        });
    </script>
</body>

</html>