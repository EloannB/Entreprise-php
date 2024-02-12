<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="../node_modules/materialize-css/dist/css/materialize.css">
    <link rel="stylesheet" href="../assets/style/style.css">
    <title>Formulaire connexion</title>
</head>

<body>
    <div id="formulaire" class="container" style="margin-top: 115px;">
        <form action="../controllers/controller-signin.php" method="post" novalidate>
            <h1 class="center-align">Veuillez vous connecter</h1>
            <div class="input-field">
                <input id="courriel" type="email" class="validate" name="courriel" value="<?= htmlspecialchars($_POST['courriel'] ?? '') ?>" required>
                <label for="courriel">Saisir votre adresse mail</label>
                <span class="error"><?= $erreurs["courriel"] ?? '' ?></span>
            </div>
            <div class="input-field">
                <input id="mot_de_passe" type="password" class="validate" name="mot_de_passe" required>
                <label for="mot_de_passe">Saisir votre mot de passe</label>
                <span class="error"><?= $erreurs["mot_de_passe"] ?? '' ?></span>
            </div>
            <div class="row center-align" style="padding-bottom: 20px;">
                <a href="#">Mot de passe oublié</a>
            </div>
            <div class="row center-align">
                <button class="btn waves-effect waves-light" type="submit" name="action">Connexion
                    <i class="material-icons right">send</i>
                </button>
            </div>
            <div class="row center-align">
                <p>Pas encore inscrit ? <a href="../controllers/controller-signup.php">Inscrivez-vous</a></p>
            </div>
        </form>
    </div>
    <script src="../node_modules/materialize-css/dist/js/materialize.js"></script>
</body>

</html>