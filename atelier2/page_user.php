<?php
session_start();

// Vérifier le cookie + le rôle "user"
if (
    empty($_COOKIE['authToken']) 
    empty($_SESSION['authToken']) 
    $_COOKIE['authToken'] !== $_SESSION['authToken'] ||
    ($_SESSION['role'] ?? '') !== 'user'
) {
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Page USER</title>
</head>
<body>
    <h1>Bienvenue sur la page USER</h1>
    <p>Vous êtes connecté en tant que <strong>user</strong> (mot de passe : <strong>utilisateur</strong>). Le cookie est valable 1 minute.</p>

    <p><a href="logout.php">Se déconnecter</a></p>
</body>
</html>
﻿
Karminho
.karma74
 
 
