<?php
// Connexion à la base de données
$server = "localhost";
$username = "root";
$password = "";
$dbname = "test";

$connect = mysqli_connect($server, $username, $password, $dbname);

// Vérifier la connexion
if (!$connect) {
    die("La connexion à la base de données a échoué : " . mysqli_connect_error());
}

// Traitement de la soumission du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les informations de la voiture depuis le formulaire
    $marque = mysqli_real_escape_string($connect, $_POST["marque"]);
    $modele = mysqli_real_escape_string($connect, $_POST["modele"]);
    $km = intval($_POST["km"]);
    $energie = mysqli_real_escape_string($connect, $_POST["energi"]);
    $type = mysqli_real_escape_string($connect, $_POST["type"]);
    $annee = intval($_POST["annee"]);
    $boite = mysqli_real_escape_string($connect, $_POST["boite"]);
    $prix = intval($_POST["prix"]);
    $nbportes = intval($_POST["nbportes"]);

    // Vérifier s'il y a des fichiers téléchargés
    if (isset($_FILES["image"])) {
        $images = array();

        // Parcourir les fichiers téléchargés
        foreach ($_FILES["image"]["tmp_name"] as $key => $tmp_name) {
            $image_name = $_FILES["image"]["name"][$key];
            $image_tmp = $_FILES["image"]["tmp_name"][$key];

            // Vérifier si le fichier a été téléchargé avec succès
            if ($image_tmp != "") {
                // Déplacer le fichier téléchargé vers un répertoire de destination
                $targetDir = "images/";
                $targetFile = $targetDir . basename($image_name);

                // Vérifier si le déplacement du fichier a réussi
                if (move_uploaded_file($image_tmp, $targetFile)) {
                    $images[] = $targetFile;
                } else {
                    echo "Erreur lors du téléchargement de l'image : " . $image_name;
                }
            }
        }

        // Enregistrer les informations de la voiture dans la base de données
        $sql = "INSERT INTO voiture (marque, modele, km, energi, type, annee, boite, prix, nbportes) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($connect, $sql);
        mysqli_stmt_bind_param($stmt, "ssisssssi", $marque, $modele, $km, $energie, $type, $annee, $boite, $prix, $nbportes);

        if (mysqli_stmt_execute($stmt)) {
            $voiture_id = mysqli_insert_id($connect);
            
            // Ajouter les photos pour la voiture
            foreach ($images as $key => $image) {
                $sql = "INSERT INTO photo (voiture_id, chemin_photo) VALUES (?, ?)";
                $stmt = mysqli_prepare($connect, $sql);
                mysqli_stmt_bind_param($stmt, "is", $voiture_id, $image);

                if (mysqli_stmt_execute($stmt)) {
                    echo "Photo " . ($key + 1) . " ajoutée avec succès<br>";
                } else {
                    echo "Erreur lors de l'ajout de la photo " . ($key + 1) . " : " . mysqli_error($connect) . "<br>";
                }
            }

            echo "La voiture a été ajoutée avec succès.";
        } else {
            echo "Erreur lors de l'ajout de la voiture : " . mysqli_error($connect);
        }
    }
}
?>



<div class="container">
    <div class="form_wrapper">
        <form method="POST" enctype="multipart/form-data">
            <div class="form_group">
                <label for="marque">Marque :</label>
                <input type="text" name="marque" id="marque" required>
            </div>
            <div class="form_group">
                <label for="modele">Modèle :</label>
                <input type="text" name="modele" id="modele" required>
            </div>
            <div class="form_group">
                <label for="km">Kilométrage :</label>
                <input type="number" name="km" id="km" required>
            </div>
            <div class="form_group">
                <label for="energi">Énergie :</label>
                <input type="text" name="energi" id="energi" required>
            </div>
            <div class="form_group">
                <label for="type">Type :</label>
                <input type="text" name="type" id="type" required>
            </div>
            <div class="form_group">
                <label for="annee">Année :</label>
                <input type="number" name="annee" id="annee" required>
            </div>
            <div class="form_group">
                <label for="boite">Boîte :</label>
                <input type="text" name="boite" id="boite" required>
            </div>
            <div class="form_group">
                <label for="prix">Prix :</label>
                <input type="number" name="prix" id="prix" required>
            </div>
            <div class="form_group">
                <label for="nbportes">Nombre de portes :</label>
                <input type="number" name="nbportes" id="nbportes" required>
            </div>
            <div class="form_group">
                <label for="image">Photo :</label>
                <input type="file" name="image[]" id="image" required multiple>            </div>
            <button type="submit">Ajouter</button>
        </form>
    </div>
</div>

<style>
    .container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .form_wrapper {
        padding: 20px;
        border: 2px double #000;
        border-radius: 10px;
        max-width: 500px;
        width: 100%;
        box-sizing: border-box;
        margin-top: 400px;
    }

    .form_group {
        margin-bottom: 20px;
    }

    label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
    }

    input[type="text"],
    input[type="number"],
    input[type="file"] {
        width: 100%;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    button[type="submit"] {
        padding: 10px 20px;
        background-color: #87CEEB;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    button[type="submit"]:hover {
        background-color: #6495ED;
    }
</style>
