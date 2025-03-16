<?php
session_start();

// Vérifiez si l'utilisateur est connecté et s'il est administrateur
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header("Location: connexion.php");
    exit;
}

// Informations de connexion à la base de données
$servername = "localhost";
$username = "mareme";
$password = "passer";
$database = "utilisateurs";

// Connexion à la base de données
$connection = new mysqli($servername, $username, $password, $database);

// Vérification de la connexion
if ($connection->connect_error) {
    die("Échec de la connexion : " . $connection->connect_error);
}

// Initialisation des variables
$id = "";
$prenom = "";
$nom = "";
$login = "";
$mot = "";
$photo = "";
$successMessage = "";
$errorMessage = "";

// Vérification de la méthode utilisée (GET pour afficher les infos, POST pour les modifier)
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET["id"])) {
        header("Location: fichier1.php");
        exit;
    }

    $id = $_GET["id"];

    // Récupérer les données de l'utilisateur à modifier
    $sql = "SELECT * FROM Users WHERE id = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if (!$row) {
        header("Location: fichier1.php");
        exit;
    }

    // Remplir les variables avec les données récupérées
    $prenom = $row['Prenom'];
    $nom = $row['Nom'];
    $login = $row['Login'];
    $mot = $row['Mot_de_passe'];
    $photo = $row['photo'];

} else {
    // Traitement du formulaire en mode POST
    $id = $_POST["id"];
    $prenom = $_POST["prenom"];
    $nom = $_POST["nom"];
    $login = $_POST["login"];
    $mot = $_POST["mot"];
    $photo = $_POST["photo"];

    do {
        // Vérifier si les champs sont remplis
        if (empty($prenom) || empty($nom) || empty($login) || empty($mot) || empty($photo)) {
            $errorMessage = "Veuillez bien remplir le formulaire";
            break;
        }

        // Hacher le mot de passe
        $hashed_password = password_hash($mot, PASSWORD_DEFAULT);

        // Mise à jour des données dans la base
        $sql = "UPDATE Users SET Prenom = ?, Nom = ?, Login = ?, Mot_de_passe = ?, photo = ? WHERE id = ?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("sssssi", $prenom, $nom, $login, $hashed_password, $photo, $id);
        $result = $stmt->execute();

        if (!$result) {
            $errorMessage = "Requête invalide : " . $connection->error;
            break;
        }

        $successMessage = "Modification effectuée avec succès";
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
    <title>Modification des informations</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container my-5">
        <h2>Modification des informations</h2>

        <!-- Affichage du message d'erreur si nécessaire -->
        <?php if (!empty($errorMessage)): ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong><?= htmlspecialchars($errorMessage); ?></strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        
        <!-- Formulaire de modification -->
        <form method="post">
            <input type="hidden" name="id" value="<?= htmlspecialchars($id); ?>">
            
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Prénom</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="prenom" value="<?= htmlspecialchars($prenom); ?>">
                </div>
            </div>
            
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Nom</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="nom" value="<?= htmlspecialchars($nom); ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Login</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="login" value="<?= htmlspecialchars($login); ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Mot de passe</label>
                <div class="col-sm-6">
                    <input type="password" class="form-control" name="mot" value="<?= htmlspecialchars($mot); ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Photo (chemin d'accès)</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="photo" value="<?= htmlspecialchars($photo); ?>">
                </div>
            </div>
            
            <!-- Affichage du message de succès si nécessaire -->
            <?php if (!empty($successMessage)): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong><?= htmlspecialchars($successMessage); ?></strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
            
            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Modifier</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="fichier1.php" role="button">Annuler</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>