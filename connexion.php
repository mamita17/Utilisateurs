<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $admin = trim($_POST['admin']);
    $mpass = trim($_POST['mpass']);

    if ($admin == 'admin' && $mpass == 'privilege') {
        $_SESSION['admin'] = true;
        header('Location: administrateur.php');
        exit;
    } else {
        $errorMessage = 'Erreur de connexion';
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Administrateur</title>
    <style>
        body {
            
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 400px;
        }
        h1 {
            color: #333;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }
        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .form-group input:focus {
            background-color: #f0f0f0;
        }
        .btn {
            background-color: #333;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }
        .btn:hover {
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
        .link {
            display: block;
            margin-top: 20px;
            color: #333;
            text-decoration: none;
        }
        .link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>ESPACE RESERVE UNIQUEMENT A L'ADMINISTRATEUR</h1>
       
        <?php if (!empty($errorMessage)): ?>
            <div class="error"><?= htmlspecialchars($errorMessage) ?></div>
        <?php endif; ?>
        <form action="connexion.php" method="post" class="fo">
            <div class="form-group">
                <label for="admin">Nom administrateur :</label>
                <input type="text" id="admin" name="admin" placeholder="Nom administrateur" required>
            </div>
            <div class="form-group">
                <label for="mpass">Mot de passe :</label>
                <input type="password" id="mpass" name="mpass" placeholder="Entrer le mot de passe" required>
            </div>
            <button type="submit" class="btn">Se connecter</button>
        </form>
    </div>
</body>
</html>