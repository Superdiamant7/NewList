<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="shortcut icon" href="imgs/logo2.png" type="image/x-icon">
    <script src="js/functions.js"></script>
    <link rel="stylesheet" href="css/index.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Se connecter</title>
</head>
<body>
    <form method="POST" id="connectionForm">
        <h1 id="connectionTitreForm">Se connecter</h1>
        <p id="connectionUsernameText">Identifiant:</p><input id="connectionUsername" name="username" type="text" maxlength="40" minlength="3" required placeholder="Entrez votre indentifiant">
        <p id="connectionPasswordText">Mot de passe:</p><input id="connectionPassword" name="password" type="password" maxlength="40" minlength="5" required 
placeholder="Entrez votre mot de passe">
        <button id="connectionButtonForm" type="submit">Se connecter</button>
    </form>
    <a id="connectionLink" href="signUp.php">Vous n'avez pas de compte ? Créez en un maintenant ici</a>
</body>
</html>

<?php 

require_once "functions.php";

if (isset($_POST['username']) && isset($_POST['password']))
{
    $username = htmlentities($_POST['username']);
    $userPassword = htmlentities($_POST['password']);

    $result = SQL("SELECT * FROM users WHERE username = \"$username\"");
    $row = $result->fetch();

    if (password_verify($userPassword, $row['password']))
    {
        header("Location: home.php");
    } else {
        echo "<p style='
        position: absolute; 
        top: 43.5%;
        left: 42%;
        color: red;'>Votre nom d'utilisateur ou nom de passe est invalide !</p>";
    }
}