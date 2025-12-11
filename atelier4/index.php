<?php
// Atelier 4 : Authentification simple via le header HTTP (Basic Auth)

/**
 * Étape 1 : vérifier si le navigateur a envoyé des identifiants.
 * S'il n'y a rien, on demande une authentification.
 */
if (!isset($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW'])) {
    demander_authentification();
}

// Récupérer l'utilisateur et le mot de passe envoyés par le navigateur
$user = $_SERVER['PHP_AUTH_USER'];
$pass = $_SERVER['PHP_AUTH_PW'];

// Déterminer le rôle de l'utilisateur en fonction des identifiants
$role = null;

// Profil admin : admin / secret
if ($user === 'admin' && $pass === 'secret') {
    $role = 'admin';

// Profil user : user / utilisateur
} elseif ($user === 'user' && $pass === 'utilisateur') {
    $role = 'user';
}

// Si les identifiants ne correspondent à aucun profil valide
if ($role === null) {
    demander_authentification();
}

/**
 * Fonction pour renvoyer une demande d'authentification au navigateur
 * et arrêter le script.
 */
function demander_authentification(): void {
    header('WWW-Authenticate: Basic realm="Atelier 4 - Authentification requise"');
    header('HTTP/1.0 401 Unauthorized');
    echo "<h1>Authentification requise</h1>";
    echo "<p>Vous devez vous authentifier pour accéder à cette page.</p>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Atelier 4 – Authentification HTTP</title>
</head>
<body>

    <h1>Atelier 4 : Authentification simple via le header HTTP</h1>

    <p>
        Vous êtes connecté en tant que :
        <strong><?php echo htmlspecialchars($user); ?></strong>
        (rôle : <strong><?php echo htmlspecialchars($role); ?></strong>)
    </p>

    <hr>

    <h2>Section visible par tous les utilisateurs connectés</h2>
    <p>
        Cette partie est visible pour <strong>admin</strong> et pour <strong>user</strong>.
    </p>

    <?php if ($role === 'admin'): ?>
        <hr>
        <h2>Section réservée à l'administrateur</h2>
        <p>
            ⚠️ Cette section est visible <strong>uniquement</strong si vous êtes connecté en tant qu'<strong>admin</strong>.
        </p>
        <ul>
            <li>Accès aux paramètres sensibles</li>
            <li>Gestion des utilisateurs</li>
            <li>Statistiques avancées</li>
        </ul>
    <?php endif; ?>

    <?php if ($role === 'user'): ?>
        <hr>
        <h2>Section spécifique à l'utilisateur simple</h2>
        <p>
            Vous êtes connecté en tant que <strong>user</strong>.  
            Vous ne voyez pas la section administrateur.
        </p>
    <?php endif; ?>

    <hr>
    <p>
        Pour changer d'utilisateur, fermez la fenêtre privée ou effacez les identifiants (ou changez d'onglet privé).
    </p>

</body>
</html>
