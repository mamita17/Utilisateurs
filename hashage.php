<?php
$connection = new mysqli('localhost', 'mareme', 'passer', 'utilisateurs');

if ($connection->connect_error) {
    die("Erreur de connexion à la base de données : " . $connection->connect_error);
}

$sql = "SELECT id, Mot_de_passe FROM Users";
$result = $connection->query($sql);

if ($result->num_rows > 0) {
    while ($user = $result->fetch_assoc()) {
        $hashed_password = password_hash($user['Mot_de_passe'], PASSWORD_DEFAULT);

        $update_sql = "UPDATE Users SET Mot_de_passe = ? WHERE id = ?";
        $stmt = $connection->prepare($update_sql);
        if ($stmt === false) {
            echo "Erreur dans la préparation de la requête : " . $connection->error;
        } else {
            $stmt->bind_param("si", $hashed_password, $user['id']);
            $stmt->execute();
            echo "Mot de passe mis à jour pour l'utilisateur ID " . $user['id'] . "<br>";
            $stmt->close();
        }
    }
} else {
    echo "Aucun utilisateur trouvé.";
}

$connection->close();
?>