<?php
session_start();

// Vérifiez si l'utilisateur est connecté et s'il est administrateur
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header("Location: connexion.php");
    exit;
}

$prenom = "";
$nom = "";
$login = "";
$mot_de_passe = "";
$photo = "";

$successMessage = "";
$errorMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $prenom = $_POST["prenom"];
    $nom = $_POST["nom"];
    $login = $_POST["login"];
    $mot_de_passe = $_POST["mot_de_passe"];
    
    // Gestion du téléchargement de la photo
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == UPLOAD_ERR_OK) {
        $photo_tmp_name = $_FILES['photo']['tmp_name'];
        $photo_name = basename($_FILES['photo']['name']);
        $photo_dir = 'photo/';
        $photo_path = $photo_dir . $photo_name;

        if (!move_uploaded_file($photo_tmp_name, $photo_path)) {
            $errorMessage = "Erreur lors du téléchargement de la photo.";
        }
    } else {
        $errorMessage = "Veuillez télécharger une photo.";
    }
    
    do {
        if (empty($prenom) || empty($nom) || empty($login) || empty($mot_de_passe) || empty($photo_path)) {
            $errorMessage = "Veuillez bien remplir le formulaire";
            break;
        }

        // Connexion à la base de données
        $connection = new mysqli('localhost', 'mareme', 'passer', 'utilisateurs');
        if ($connection->connect_error) {
            $errorMessage = "Erreur de connexion à la base de données : " . $connection->connect_error;
            break;
        }

        // Hacher le mot de passe
        $hashed_password = password_hash($mot_de_passe, PASSWORD_DEFAULT);

        // Ajouter un nouvel utilisateur
        $sql = "INSERT INTO Users (Prenom, Nom, Login, Mot_de_passe, photo) VALUES ('$prenom', '$nom', '$login', '$hashed_password', '$photo_path')";
        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "Donnée invalide : " . $connection->error;
            break;
        }

        // Réinitialiser les champs après succès
        $prenom = "";
        $nom = "";
        $login = "";
        $mot_de_passe = "";
        $photo_path = "";
        $successMessage = "Utilisateur créé avec succès";
        header("Location: fichier1.php");
        exit;
    } while (false);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un utilisateur</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
        }
        h2 {
            margin-bottom: 20px;
            color: #333;
        }
        label {
            display: block;
            margin-bottom: 8px;
            text-align: left;
            color: #333;
        }
        input[type="text"], input[type="password"], input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button {
            background-color: #333;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }
        button:hover {
            background-color: #555;
        }
        .error {
            color: red;
            margin-bottom: 20px;
        }
        .success {
            color: green;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Créer un nouvel utilisateur</h2>
        <?php if (!empty($errorMessage)): ?>
            <div class="error"><?= htmlspecialchars($errorMessage) ?></div>
        <?php endif; ?>
        <?php if (!empty($successMessage)): ?>
            <div class="success"><?= htmlspecialchars($successMessage) ?></div>
        <?php endif; ?>
        <form method="post" enctype="multipart/form-data">
            <label for="prenom">Prénom :</label>
            <input type="text" id="prenom" name="prenom" value="<?= htmlspecialchars($prenom) ?>" required>
            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" value="<?= htmlspecialchars($nom) ?>" required>
            <label for="login">Login :</label>
            <input type="text" id="login" name="login" value="<?= htmlspecialchars($login) ?>" required>
            <label for="mot_de_passe">Mot de passe :</label>
            <input type="password" id="mot_de_passe" name="mot_de_passe" value="<?= htmlspecialchars($mot_de_passe) ?>" required>
            <label for="photo">Photo :</label>
            <input type="file" id="photo" name="photo" required>
            <button type="submit">Créer</button>
        </form>
    </div>
</body>
</html>