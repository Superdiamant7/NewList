<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="shortcut icon" href="imgs/logo2.png" type="image/x-icon">
    <script src="js/functions.js"></script>
    <link rel="stylesheet" href="css/signUp.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>S'inscrire</title>
</head>
<body>  
    <form method="POST" id="signUpForm" onsubmit="return false;">
        <h1 id="signUpTitreForm">S'inscrire</h1>
        <p id="signUpUsernameText">Identifiant:</p>
        <input id="signUpUsername" name="username" type="text" maxlength="40" minlength="3" required placeholder="Entrez un identifiant">
        <p id="usernameAlreadyUsed">Le nom d'utilisateur est déjà utilisé</p>
        <p id="signUpPasswordText">Mot de passe:</p>
        <input id="signUpPassword" name="password" type="password" maxlength="40" minlength="5" required placeholder="Entrez un mot de passe">
        <input id="signUpPasswordRepeat" name="passwordRepeat" type="password" maxlength="40" minlength="5" required placeholder="Répétez votre mot de passe">
        <p id="passwordError">Le mot de passe ne correspond pas</p>
        <button id="signUpButtonForm" type="submit">S'inscrire</button>
        <script>
            // Si les mots de passe ne correspondent pas: on empêche la soumission du formulaire et alerte l'utilisateur
            I("signUpButtonForm").onclick = function () {
                if (I("signUpPassword").value != I("signUpPasswordRepeat").value) {
                    I("passwordError").style.visibility = "visible"
                // Sinon on envoie le formulaire
                } else {
                    I("signUpForm").onsubmit = "true"
                }
            }
        </script>
    </form>
    <a id="signUpLink" href="index.php">Vous avez déjà un compte ? Connectez vous ici</a>
</body>
</html>

<?php
    require_once 'sql.php';
    $dbc = new PDO("mysql:host=$host;dbname=$db;charset=utf8", "$user", "$pass");

    if (isset($_POST['username']) && isset($_POST['password']))
    {
        $newUsername = htmlentities($_POST['username']);
        $newPassword = password_hash(htmlentities($_POST['password']), PASSWORD_DEFAULT);

        $result = $dbc->prepare("SELECT * FROM users WHERE username = \"$newUsername\"");
        $result->execute();
        $row = $result->fetch();

        if ($row['username'] !== NULL)
        {
            ?> <script>
                    I("usernameAlreadyUsed").style.visibility = "visible"
            </script> <?php ;
        } else {
            $result = $dbc->prepare("INSERT INTO users (username, password) VALUES (\"$newUsername\", \"$newPassword\")");
            $result->execute();
            header("Location: home.php");
        }
    }
?>