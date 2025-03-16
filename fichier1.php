<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des utilisateurs</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <style>
        /* Style pour la lightbox */
        #lightbox {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            z-index: 1000;
            text-align: center;
        }

        #lightbox img {
            max-width: 90%;
            max-height: 90%;
            margin-top: 5%;
        }
    </style>
</head>
<body>

<div class="container my-5">
    <h2>Liste des clients</h2>
    <a class="btn btn-primary" href="creer.php" role="button">Nouveau client</a>
    <br><br>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Prenom</th>
                <th>Nom</th>
                <th>Login</th>
                <th>Mot de passe</th> 
                <th>Photo</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php
            // Code PHP pour afficher les utilisateurs
            
    $servername = "localhost";
    $username = "mareme";
    $password = "passer";
    $database = "utilisateurs";

    // Connexion à la base de données
    $connection = new mysqli($servername, $username, $password, $database);

    // Vérification de la connexion
    if ($connection->connect_error) {
        die("Connexion échouée : " . $connection->connect_error);
    }

    // Requête pour récupérer les données de la table Users
    $sql = "SELECT * FROM Users";
    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "
            <tr>
                <td>{$row['id']}</td>
                <td>{$row['Nom']}</td>
                <td>{$row['Prenom']}</td>
                <td>{$row['Login']}</td>
                <td>{$row['Mot_de_passe']}</td>
                <td>
                    <button class='btn btn-info btn-sm' onclick='openImage(\"{$row['photo']}\")'>Voir la photo</button>
                </td>
                <td>
                    <a class='btn btn-primary btn-sm' href='modifier.php?id={$row['id']}'>Modifier</a>
                    <a class='btn btn-danger btn-sm' href='supprimer.php?id={$row['id']}'>Supprimer</a>
                </td>
            </tr>";
        }
    } else {
        echo "<tr><td colspan='7' class='text-center'>Aucun client trouvé</td></tr>";
    }

    // Fermer la connexion
    $connection->close();
?>
        
        </tbody>
    </table>
</div>

<!-- Lightbox pour afficher l'image agrandie -->
<div id="lightbox" onclick="closeImage()">
    <img id="lightbox-img" src="" alt="Image agrandie">
</div>

<script>
    function openImage(imageSrc) {
        document.getElementById('lightbox-img').src = imageSrc;
        document.getElementById('lightbox').style.display = 'block';
    }

    function closeImage() {
        document.getElementById('lightbox').style.display = 'none';
    }
</script>

</body>
</html>