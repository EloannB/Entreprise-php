<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/style/style.css">
    <title>Profil</title>
    <style>
        #updateProfileForm {
            display: none;
        }
    </style>
</head>

<body>

    <div id="profil">
        <h1>Profil</h1>

        <div id="profileInfo" class="user-profile">
            <p class="profile-info-item">Nom de l'Entreprise: <?php echo $_SESSION['user']['nom_entreprise']; ?></p>
            <?php
            // Vérifie si l'image de profil est définie
            if (!empty($_SESSION['user']['photo_participant'])) {
                $photoPath = "../assets/uploads/" . $_SESSION['user']['photo_entreprise'];
            } else {
                // Image par défaut si aucune image de profil n'est définie
                $photoPath = "../imageDefaut.png";
            }
            ?>
            <img src="<?= $photoPath ?>" alt="Photo de profil" class="profile-image">
            <p class="profile-info-item">Nom : <?php echo $_SESSION['user']['nom_entreprise']; ?></p>
            <p class="profile-info-item">Courriel : <?php echo $_SESSION['user']['mail_entreprise']; ?></p>
            <p class="profile-info-item">Adresse : <?php echo $_SESSION['user']['adresse_entreprise']; ?></p>
            <p class="profile-info-item">Adresse Postal : <?php echo $_SESSION['user']['postal_entreprise']; ?></p>
            <p class="profile-info-item">Ville : <?php echo $_SESSION['user']['ville_entreprise']; ?></p>
            <a href="controller-home.php" class="profile-info-link">Retour à l'accueil</a>
            <button id="editProfileBtn" class="profile-info-button">Modifier le profil</button>
        </div>


        <!-- Formulaire de mise à jour du profil -->
        <form id="updateProfileForm" action="controller-updateprofil.php" method="post" enctype="multipart/form-data" novalidate>

            <input type="text" id="nom" name="nom" placeholder="Nom" value="<?= htmlspecialchars($_POST['nom'] ?? '') ?>" required>
            <p class="error"><?= $erreurs["nom"] ?? '' ?></p>

            <input type="email" id="courriel" name="courriel" placeholder="Courriel" value="<?= htmlspecialchars($_POST['courriel'] ?? '') ?>" required>
            <p class="error"><?= $erreurs["courriel"] ?? '' ?></p>

            <input type="password" id="mot_de_passe" name="mot_de_passe" placeholder="Mot de passe" required>
            <p class="error"><?= $erreurs["mot_de_passe"] ?? '' ?></p>

            <input type="password" id="conf_mot_de_passe" name="conf_mot_de_passe" placeholder="Confirmer le mot de passe" required>
            <p class="error"><?= $erreurs["conf_mot_de_passe"] ?? '' ?></p>

            <input type="text" id="siret" name="siret" placeholder="Siret" value="<?= htmlspecialchars($_POST['siret'] ?? '') ?>" required>
            <p class="error"><?= $erreurs["siret"] ?? '' ?></p>

            <input type="text" id="adresse" name="adresse" placeholder="Adresse" value="<?= htmlspecialchars($_POST['adresse'] ?? '') ?>" required>
            <p class="error"><?= $erreurs["adresse"] ?? '' ?></p>

            <input type="text" id="postal" name="postal" placeholder="Adresse postal" value="<?= htmlspecialchars($_POST['postal'] ?? '') ?>" required>
            <p class="error"><?= $erreurs["postal"] ?? '' ?></p>

            <input type="text" id="ville" name="ville" placeholder="Ville" value="<?= htmlspecialchars($_POST['ville'] ?? '') ?>" required>
            <p class="error"><?= $erreurs["ville"] ?? '' ?></p>

            <label for="profile_image" class="formul-label">Changer la photo de profil :</label>
            <input type="file" id="profile_image" name="profile_image" accept="image/*" class="form-input">

            <?php
            // Vérifie si l'image de profil est définie
            if (!empty($_SESSION['user']['photo_participant'])) {
                $photoPath = "../assets/uploads/" . $_SESSION['user']['photo_participant'];
            } else {
                // Image par défaut si aucune image de profil n'est définie
                $photoPath = "../imageDefaut.png";
            }
            ?>

            <img src="<?= $photoPath ?>" alt="Photo de profil" class="profile-image">

            <button type="submit" class="majBtn">Mettre à jour</button>
            <button type="button" class="cancelBtn" id="cancelBtn">Annuler</button>
        </form>

        <!-- Formulaire suppression du profil -->
        <form action="controller-suppcompte.php" method="post">
            <button class="supCompte" type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer votre compte ?')">Supprimer mon compte</button>
        </form>

    </div>

    <script>
        // Récupérez les éléments du DOM
        const editProfileBtn = document.getElementById('editProfileBtn');
        const profileInfo = document.getElementById('profileInfo');
        const updateProfileForm = document.getElementById('updateProfileForm');
        const cancelUpdateBtn = document.getElementById('cancelBtn');

        // Afficher le formulaire de modification si des erreurs sont présentes
        if (<?= !empty($errors) ? 'true' : 'false' ?>) {
            updateProfileForm.style.display = 'block';
            profileInfo.style.display = 'none';
        }

        // Ajoutez un gestionnaire d'événements pour le clic sur le bouton "Modifier le profil"
        editProfileBtn.addEventListener('click', () => {
            // Masquez les informations du profil
            profileInfo.style.display = 'none';
            // Affichez le formulaire de mise à jour du profil
            updateProfileForm.style.display = 'block';
        });

        // Ajoutez un gestionnaire d'événements pour le clic sur le bouton "Annuler"
        cancelUpdateBtn.addEventListener('click', () => {
            // Affichez les informations du profil
            profileInfo.style.display = 'block';
            // Masquez le formulaire de mise à jour du profil
            updateProfileForm.style.display = 'none';
        });
    </script>
</body>

</html>