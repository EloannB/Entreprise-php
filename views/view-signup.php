<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="../node_modules/materialize-css/dist/css/materialize.css">
    <link rel="stylesheet" href="../assets/style/style.css">
    <title>Inscription</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<body>

    <?php if ($showform) { ?>

        <div id="formulaire" class="container">
            <form action="controller-signup.php" method="post" novalidate>
                <h1 class="center-align">Formulaire d'inscription</h1>
                <div class="input-field">
                    <input type="text" id="nom" name="nom" class="validate" placeholder="Nom" value="<?= ($_POST['nom'] ?? '') ?>" required>
                    <span class="error"><?= $erreurs["nom"] ?? '' ?></span>
                </div>
                <div class="input-field">
                    <input type="email" id="courriel" name="courriel" class="validate" placeholder="Courriel" value="<?= ($_POST['courriel'] ?? '') ?>" required>
                    <span class="error"><?= $erreurs["courriel"] ?? '' ?></span>
                </div>
                <div class="input-field">
                    <input type="password" id="mot_de_passe" name="mot_de_passe" class="validate" placeholder="Mot de passe" required>
                    <span class="error"><?= $erreurs["mot_de_passe"] ?? '' ?></span>
                </div>
                <div class="input-field">
                    <input type="password" id="conf_mot_de_passe" name="conf_mot_de_passe" class="validate" placeholder="Confirmer le mot de passe" required>
                    <span class="error"><?= $erreurs["conf_mot_de_passe"] ?? '' ?></span>
                </div>
                <div class="input-field">
                    <input type="number" id="siret" name="siret" class="validate" placeholder="Siret" value="<?= ($_POST['siret'] ?? '') ?>" required>
                    <span class="error"><?= $erreurs["siret"] ?? '' ?></span>
                </div>
                <div class="input-field">
                    <input type="text" id="adresse" name="adresse" class="validate" placeholder="Adresse" value="<?= ($_POST['adresse'] ?? '') ?>" required>
                    <span class="error"><?= $erreurs["adresse"] ?? '' ?></span>
                </div>
                <div class="input-field">
                    <input type="text" id="postal" name="postal" class="validate" placeholder="Adresse postal" value="<?= ($_POST['postal'] ?? '') ?>" required>
                    <span class="error"><?= $erreurs["postal"] ?? '' ?></span>
                </div>
                <div class="input-field">
                    <input type="text" id="ville" name="ville" class="validate" placeholder="Ville" value="<?= ($_POST['ville'] ?? '') ?>" required>
                    <span class="error"><?= $erreurs["ville"] ?? '' ?></span>
                </div>
                <label>
                    <input type="checkbox" name="cgu" <?= isset($_POST['cgu']) ? 'checked' : '' ?> class="filled-in" required>
                    <span>J'accepte les conditions générales d'utilisation (CGU)</span>
                </label>
                <p class="error"><?= $erreurs["cgu"] ?? '' ?></p>
                <div class="center-align">
                    <button class="btn waves-effect waves-light" type="submit" name="action">S'enregistrer
                        <i class="material-icons right">send</i>
                    </button>
                </div>
                <div class="row center-align">
                    <p>Vous avez déjà un compte ? <a href="../controllers/controller-signin.php">Connectez-vous</a></p>
                </div>
            </form>
        </div>
    <?php } else { ?>

        <div style='display: flex; align-items: center; justify-content: center; height: 100vh;'>
            <div class='user-summary' style='border: 1px solid #ccc; padding: 20px; max-width: 400px;'>
                <p style='color:green;'>Inscription réussie ! Un mail de confirmation a été envoyé.</p>
                <div style='padding: 20px;'>
                    <a href='../controllers/controller-signin.php' class='btn waves-effect waves-light'>Connexion</a>
                </div>
            </div>
        </div>
    <?php } ?>
    <script src="../node_modules/materialize-css/dist/js/materialize.js"></script>
</body>

</html>