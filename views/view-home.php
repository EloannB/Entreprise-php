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
                <div class="center-align">
                    <button type="submit" class="btn logout-button">Déconnexion</button>
                </div>
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
                            <span class="card-title">Les 5 derniers trajets :</span>
                            <?php
                            // Appeler la fonction pour récupérer les trajets
                            $fiveTrajets = Entreprise::getFiveLastTrajet($_SESSION['user']['id_entreprise']);

                            // Vérifier si des trajets ont été récupérés
                            if (!empty($fiveTrajets)) {
                                // Afficher les trajets
                                foreach ($fiveTrajets as $trajet) {
                                    echo "<p><strong>Date :</strong> {$trajet['date_trajet']}</p>";
                                    echo "<p><strong>Pseudo :</strong> {$trajet['pseudo_participant']}</p>";
                                    echo "<p><strong>Type :</strong> {$trajet['type_transport']}</p>";
                                    echo "<p><strong>Distance :</strong> {$trajet['distance_trajet']} km</p>";
                                    echo "<p><strong>Temps :</strong> {$trajet['temps_trajet']}</p>";
                                    echo "<hr>";
                                }
                            } else {
                                echo "<p>Aucun trajet trouvé.</p>";
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
                                    echo "<div style='display: flex; align-items: center;'>";
                                    // Condition pour afficher la photo de l'utilisateur actuel ou une image par défaut
                                    $utilisateurPhotoPath = !empty($utilisateur['photo_participant']) ? "http://formulaire-php.test/assets/uploads/{$utilisateur['photo_participant']}" : "../imageDefaut.png";
                                    echo "<img src='$utilisateurPhotoPath' alt='photo_participant' style='max-width: 30%; border-radius: 50%; margin-top: 10px; height: 80px; width: 80px; object-fit: cover;'>";
                                    echo "<p style='margin-left: 10px;'>{$utilisateur['pseudo_participant']}</p>";
                                    echo "</div>";
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
                            <span class="card-title">Stats moyens de transports</span>
                            <canvas id="doughnutChart" width="400" height="400"></canvas>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <script src="../node_modules/materialize-css/dist/js/materialize.js"></script>
    <script>
        // Récupérer les données PHP dans une variable JavaScript
        var transportStats = <?php echo json_encode($statstransports); ?>;

        // Initialiser les tableaux pour les étiquettes, les données et les couleurs
        var labels = [];
        var data = [];
        var backgroundColors = [];
        var borderColors = [];

        // Générer des couleurs aléatoires
        function generateRandomColor() {
            var r = Math.floor(Math.random() * 256);
            var g = Math.floor(Math.random() * 256);
            var b = Math.floor(Math.random() * 256);
            return 'rgba(' + r + ',' + g + ',' + b + ')';
        }

        // Itérer à travers les données de transport
        transportStats.forEach(function(stat) {
            labels.push(stat.type_transport);
            data.push(stat.stats);
            var randomColor = generateRandomColor();
            backgroundColors.push(randomColor);
            borderColors.push(randomColor.replace('0.2', '1')); // Utilisez une opacité plus élevée pour la bordure
        });

        // Générer le graphique Doughnut
        var ctx = document.getElementById('doughnutChart').getContext('2d');
        var doughnutChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Nombre de trajets',
                    data: data,
                    backgroundColor: backgroundColors,
                    borderColor: borderColors,
                    borderWidth: 1
                }]
            },
            options: {
            plugins: {
                legend: {
                    labels: {
                        color: 'white' // Changer la couleur de la légende
                    }
                }
            }
        }

        });

        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('.sidenav');
            var instances = M.Sidenav.init(elems);
        });
    </script>
</body>

</html>