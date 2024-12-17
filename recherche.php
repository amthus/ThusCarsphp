<!-- Inclusion de la bibliothèque Font Awesome -->
<link rel="stylesheet" href="./fontawesome/css/all.min.css">

<!-- Formulaire de recherche de voiture -->
<div class="container">
    <div class="form_wrapper">
        <form method="GET" action="">
            <div class="icon-container">
                <a href="index.php"><i class="fas fa-duotone fa-arrow-left "></i></a>
            </div>
            <div class="form_group">
                <label for="search">Rechercher une voiture :</label>
                <input type="text" name="search" id="search" required>
            </div>
            <button type="submit">Rechercher</button>
        </form>
    </div>
</div>

<!-- Section véhicules -->
<div class="resultats-conteneur">
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

    // Traitement de la recherche de voiture
    if (isset($_GET['search'])) {
        $searchTerm = mysqli_real_escape_string($connect, $_GET['search']);

        // Requête SQL pour rechercher les voitures correspondantes
        $sql = "SELECT * FROM voiture WHERE marque LIKE '%$searchTerm%' OR modele LIKE '%$searchTerm%'";
        $result = mysqli_query($connect, $sql);

        // Vérifier si des résultats ont été trouvés
        if (mysqli_num_rows($result) > 0) {
            echo '<section id="cars">';
            echo '<div class="images">';
            echo '<ul>';
            echo '<h2 >Résultats de la recherche</h2>';

            while ($row = mysqli_fetch_assoc($result)) {
                echo '<li class="car">';
                echo '<div id="carousel-' . $row["id"] . '" class="carousel">';

                // Requête pour récupérer les images de la voiture
                $imagesSql = "SELECT * FROM photo WHERE voiture_id = " . $row["id"] . " LIMIT 10";
                $imagesResult = mysqli_query($connect, $imagesSql);

                // Vérifier s'il y a des images
                if (mysqli_num_rows($imagesResult) > 0) {
                    while ($imageRow = mysqli_fetch_assoc($imagesResult)) {
                        echo '<img src="' . $imageRow["chemin_photo"] . '" alt="Image">';
                    }
                }
                echo '</div>';
                echo '<span>' . $row["marque"] . '</span>';
                echo '<span class="prix">' . $row["prix"] . '</span>';
                echo '<a href="#">ACHETER MAINTENANT</a>';
                echo '</li>';
            }

            echo '</ul>';
            echo '</div>';
            echo '</section>';
        } else {
            // Aucun résultat trouvé
            echo '<div class="alert">';
            echo '<p>Aucune voiture trouvée.</p>';
            echo '<p><a href="recherche.php"><span>Effectuer une nouvelle recherche</span></a></p>';
            echo '</div>';
        }
    }
    ?>
</div>

<style>
/* Styles CSS */
#cars {
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
}
.images {
    margin: 100px auto;
    padding: 0 8%;
}
.images ul {
    display: flex;
    flex-wrap: wrap;
    width: 100%;
}
.images li {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin: 2.665%;
    transition: 0.5s;
    height: 300px;
    width: 28%;
}

.images li div {
    width: 100%;
    height: 60%;
    margin-bottom: 5px;
    box-shadow: 0 0 10px rgba(0,0,0,0.3);

}
.images li div img {
    height: 100%;
    width: 100%;
}

.images li:hover {
    transform: scale(1.1);
}
.images li span {
    color: #000;
    font-size: 18px;
}
#cars li span.prix {
   color: #11a5ab;
   font-weight: bold;
   margin-bottom: 10px;
}
#cars li a {
    background-color: #11a5ab;
    color: #fff;
    padding: 5px 20px;
    font-size: 15px;}

.carousel {
    display: flex;
    overflow-x: scroll;
    scroll-behavior: smooth;
    scroll-snap-type: x mandatory;
    -webkit-overflow-scrolling: touch;
}

.carousel img {
    width: 100%;
    max-width: 300px;
    height: auto;
    scroll-snap-align: start;
}

.car {
    margin-bottom: 20px;
}

.icon-container {
    position: absolute;
    top: 10px;
    left: 10px;
    color: skyblue; 
    font-size: 40px;
    margin-left: 15px;
    
}

.container {
    display: flex;
    justify-content: center;
   align-items: center;
   margin-top: 50px;

}

.form_wrapper {
    width: 400px;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.form_group {
    margin-bottom: 10px;
}

label {
    display: block;
    margin-bottom: 5px;
}

input[type="text"] {
    width: 100%;
    padding: 5px;
    border: 1px solid #ccc;
    border-radius: 3px;
}

button {
    padding: 10px 20px;
    background-color: skyblue;
    color: white;
    border: none;
    border-radius: 3px;
    cursor: pointer;
}

.button-container {
    display: flex;
    justify-content: center;
    margin-top: 10px;
}


h2{
    margin-right: 75%;
    text-align: center;
    margin-bottom: 100px;
}

.alert {
    background-color: #f8d7da;
    color: #721c24;
    padding: 10px;
    border-radius: 5px;
    margin-top: 20px;
}

.alert p {
    margin: 0;
}
span {
    margin: 0;
    background-color: #11a5ab;
    overflow: hidden;
}

.alert a {
    color: #721c24;
    font-weight: bold;
}

.alert a:hover {
    text-decoration: underline;
}
</style>