<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/style/style.css">
    <title>Formulaire connexion</title>
</head>

<body>
    <div id="formulaire" style="margin: 115px auto;">
        <form action="../controllers/controller-signin.php" method="post" novalidate>
            <h1>Veuillez vous connecter</h1>
            <div class="mb-3">
                <label for="form2Example1" class="form-label">Saisir votre adresse mail</label>
                <input type="email" id="courriel" name="courriel" placeholder="Courriel" value="<?= htmlspecialchars($_POST['courriel'] ?? '') ?>" required>
                <p class="error"><?= $erreurs["courriel"] ?? '' ?></p>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Saisir votre mot de passe</label>
                <input type="password" id="mot_de_passe" name="mot_de_passe" placeholder="Mot de passe" required>
                <p class="error"><?= $erreurs["mot_de_passe"] ?? '' ?></p>
            </div>
            <div class="text-center" style="padding-bottom: 20px">
                <a href="">Mot de passe oublié</a>
            </div>
            <button type="submit">Connexion</button>
            <div class="text-center">
                <p>Pas encore inscris ? <a href="../controllers/controller-signup.php">Inscrivez-vous</a></p>
            </div>
        </form>
    </div>
</body>

</html>