<?php
session_start();

// Vérifiez si l'utilisateur est connecté et s'il est administrateur
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header("Location: connexion.php");
    exit;
}

// Vérifier si l'ID est bien envoyé via l'URL (GET)
if (isset($_GET["id"])) {
    $id = $_GET["id"];

    // Informations de connexion à la base de données
    $servername = "localhost";
    $username = "mareme";
    $password = "passer";
    $database = "utilisateurs";

    // Connexion à la base de données
    $connection = new mysqli($servername, $username, $password, $database);

    // Vérifier si la connexion a échoué
    if ($connection->connect_error) {
        die("Échec de la connexion : " . $connection->connect_error);
    }

    // Préparer la requête SQL pour supprimer l'enregistrement avec l'ID spécifié
    $sql = "DELETE FROM Users WHERE id = ?";
    $stmt = $connection->prepare($sql); // Préparer la requête pour éviter les injections SQL
    $stmt->bind_param("i", $id);  // Lier le paramètre ID (entier) à la requête
    $stmt->execute();  // Exécuter la requête

    // Vérifier si la suppression a réussi
    if ($stmt->affected_rows > 0) {
        echo "Utilisateur supprimé avec succès.";
    } else {
        echo "Erreur lors de la suppression de l'utilisateur.";
    }

    // Fermer la requête préparée et la connexion à la base de données
    $stmt->close();
    $connection->close();
} else {
    echo "ID non spécifié.";
}

// Rediriger l'utilisateur vers "fichier1.php" après la suppression
header("Location: fichier1.php");
exit(); // S'assurer que le script s'arrête après la redirection
?>