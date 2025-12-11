<?php
session_start();

// Vérifier que l'utilisateur est bien "user"
if (!isset($_COOKIE['authToken'], $_COOKIE['username']) || $_COOKIE['username'] !== 'user') {
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Page Utilisateur</title>
</head>
<body>
    <h1>Bienvenue sur la page Utilisateur (Atelier 2)</h1>
    <p>Vous êtes connecté en tant que : <strong>user</strong>.</p>

    <a href="logout.php">Se déconnecter</a>
</body>
</html>
