<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/style/style.css">
    <title>Inscription</title>
</head>

<body>

    <?php if ($showform) { ?>

        <div id="formulaire">
            <form action="controller-signup.php" method="post" novalidate>
                <h1>Formulaire d'inscription</h1>
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
                <label>
                    <input type="checkbox" name="cgu" <?= isset($_POST['cgu']) ? 'checked' : '' ?> required>
                    J'accepte les conditions générales d'utilisation (CGU)
                </label>
                <p class="error"><?= $erreurs["cgu"] ?? '' ?></p>
                <button type="submit">S'enregistrer</button>
                <div class="text-center">
                <p>Vous avez déjà un compte ? <a href="../controllers/controller-signin.php">Connectez-vous</a></p>
            </div>
            </form>
        </div>
    <?php } else { ?>

        <div style='display: flex; align-items: center; justify-content: center; height: 100vh;'>
            <div class='user-summary' style='border: 1px solid #ccc; padding: 20px; max-width: 400px;'>
                <p style='color:green;'>Inscription réussie ! Un mail de confirmation a été envoyé.</p>
                <div style='padding: 20px;'>
                    <a href='../views/view-signin.php' class='button'>Connexion</a>
                </div>
            </div>
        </div>
    <?php } ?>

</body>

</html>