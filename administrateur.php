<?php
session_start();

// Vérifiez si l'utilisateur est connecté et s'il est administrateur
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header("Location: connexion.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Administrateur</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .admin-container {
            background-color: white;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
        }
        h2 {
            margin-bottom: 20px;
            color: #333;
        }
        a {
            display: block;
            margin-top: 20px;
            color: #333;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="admin-container">
        <h2>Bienvenue, Administrateur</h2>
        <p>Vous êtes connecté en tant qu'administrateur.</p>
        <a href="fichier1.php">Accéder à la page fichier1</a>
    </div>
</body>
</html>