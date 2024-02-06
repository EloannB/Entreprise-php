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
    <nav class="top-nav">
        <div class="container">
            <div class="nav-wrapper">
                <div class="row">
                    <div class="col s12 m10 offset-m1">
                        <h1 class="header">Dashboard</h1>
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
                            <span class="card-title">Information</span>
                            <p>Ajoutez ici des informations importantes pour votre dashboard.</p>
                        </div>
                    </div>
                </div>
                <div class="col s12 m6">
                    <div class="card blue-grey darken-1">
                        <div class="card-content white-text">
                            <span class="card-title">Entreprise</span>
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