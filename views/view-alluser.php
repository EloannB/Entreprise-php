<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="../node_modules/materialize-css/dist/css/materialize.css">
    <link rel="stylesheet" href="../assets/style/style.css">
    <title>Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <nav class="top-nav #64b5f6 blue lighten-2">
        <div class="container">
            <div class="nav-wrapper">
                <div class="row">
                    <div class="col s12 m10 offset-m1">
                        <h1 class="header text-align: center">Liste Utilisateurs</h1>
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
            <p class="profile-info-item, text-align: center"><b>Nom :</b> <?php echo $_SESSION['user']['nom_entreprise']; ?></p>
            <p class="profile-info-item, text-align: center"><b>Courriel :</b> <?php echo $_SESSION['user']['mail_entreprise']; ?></p>
            <p class="profile-info-item, text-align: center"><b>Adresse :</b> <?php echo $_SESSION['user']['adresse_entreprise']; ?></p>
            <p class="profile-info-item, text-align: center"><b>Adresse Postal :</b> <?php echo $_SESSION['user']['postal_entreprise']; ?></p>
            <p class="profile-info-item, text-align: center"><b>Ville :</b> <?php echo $_SESSION['user']['ville_entreprise']; ?></p>
            <!-- Ajouter le formulaire de déconnexion -->
            <form method="post" style="display:inline;">
                <input type="hidden" name="logout" value="1">
                <div class="center-align">
                    <a href="controller-home.php" class="btn logout-button">Retour Dashboard</a>
                </div>
                <div class="center-align">
                    <button type="submit" class="btn logout-button">Déconnexion</button>
                </div>
            </form>
        </ul>
    </div>

    <div id="home" class="section">
        <div class="container">
            <div class="col s12 m6">
                <div class="card blue-grey darken-1">
                    <div class="card-content white-text">
                        <?php
                        // Vérifier si des utilisateurs ont été récupérés
                        if (!empty($allUtilisateur)) {
                            // Afficher les utilisateurs
                            foreach ($allUtilisateur as $utilisateur) {
                                echo "<div style='display: flex; align-items: center;'>";
                                // Condition pour afficher la photo de l'utilisateur actuel ou une image par défaut
                                $utilisateurPhotoPath = !empty($utilisateur['photo_participant']) ? "http://formulaire-php.test/assets/uploads/{$utilisateur['photo_participant']}" : "../imageDefaut.png";
                                echo "<img src='$utilisateurPhotoPath' alt='photo_participant' style='max-width: 30%; border-radius: 50%; margin-top: 10px; height: 80px; width: 80px; object-fit: cover;'>";
                                echo "<p style='margin-left: 20px;'>{$utilisateur['pseudo_participant']}</p>";
                                echo "<p style='margin-left: 5px;'>/ {$utilisateur['mail_participant']}</p>";
                                echo '<div class="switch" style="margin-left: 20px;">';
                                echo "<label class='switches'>";
                                echo "Desactiver";
                                echo '<input type="checkbox">';
                                echo '<span class="lever"></span>';
                                echo 'Activer';
                                echo "</label>";
                                echo "</div>";
                                echo "</div>";
                            }
                        } else {
                            echo "<p>Aucun utilisateur trouvé.</p>";
                        }

                        ?>
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