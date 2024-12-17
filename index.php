<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TOUF Sarl</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/3010b1eaf1.js" crossorigin="anonymous"></script>
</head>
<body>
    
    <!-- header  -->
    <header>
        <!-- menu responsive -->
        
        <div class="menu_toggle">
            <span></span>
        </div>

        <div class="logo">
            <p><span>TOUF</span>Sarl</p>
        </div>
        <ul class="menu">
            <li><a href="#home">Accueil</a></li>
            <li><a href="#cars">Véhicules</a></li>
            <li><a href="#services">Services</a></li>
            <li><a href="#contact">Contact</a></li>
        </ul>
        <button class="login_btn"><a href="recherche.php">Rechercher</a></button>
        <button class="login_btn"><a href="ok.php">Se connecter</a></button>
        
    </header>
    <!-- section Accueil -->
     
    <section id="home">
        <div class="left">
            <h1>Achetez <span>votre voiture</span> d'occasion comme neuf !</h1>
            <p>TOUF SARL met à votre disposition ses experts automobiles pour une solution de leasing de voiture adaptée à vos besoins.</p>
            <a href="#">Acheter maintenant</a>
        </div>
        <div class="right">
            <img src="images/img1.png" alt="Voiture">
        </div>
    </section>




 <!-- section véhicules -->
<section id="cars">
    <h1 class="section_title">Nos véhicules</h1>
    <div class="images">
        <ul>
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


            // Requête pour récupérer les données des véhicules
            $sql = "SELECT * FROM voiture";
            $result = mysqli_query($connect, $sql);

            // Vérifier s'il y a des résultats
            if (mysqli_num_rows($result) > 0) {
                // Parcourir les résultats et afficher les véhicules
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

            } else {
                echo "Aucun véhicule trouvé.";
            }

            // Fermer la connexion à la base de données
            mysqli_close($connect);
            ?>
        </ul>
    </div>
</section>

<style>
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
</style>

<script>
    // Carrousel d'images
    var carousels = document.querySelectorAll('.carousel');
    carousels.forEach(function (carousel) {
        var scrollInterval = null;

        function startScrolling() {
            scrollInterval = setInterval(function () {
                carousel.scrollLeft += 1;
                if (carousel.scrollLeft % carousel.clientWidth === 0) {
                    clearInterval(scrollInterval);
                    setTimeout(startScrolling, 3000);
                }
            }, 20);
        }

        startScrolling();
    });
</script>
    
   <!-- section services -->
<section id="services">
    <h1 class="section_title">Nos Services</h1>
    <div class="list_services">
        <div class="service">
            <i class="fa-solid fa-screwdriver-wrench"></i>
            <h3>Immobilier</h3>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Debitis illum natus iste, dicta maiores ipsam.</p>
            <a href="#" class="read_more">En savoir plus</a>
        </div>
        <div class="service">
            <i class="fa-solid fa-screwdriver-wrench"></i>
            <h3>Vente des meubles</h3>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Debitis illum natus iste, dicta maiores ipsam.</p>
            <a href="#" class="read_more">En savoir plus</a>
        </div>
        <div class="service">
            <i class="fa-solid fa-screwdriver-wrench"></i>
            <h3>Location de voiture</h3>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Debitis illum natus iste, dicta maiores ipsam.</p>
            <a href="#" class="read_more">En savoir plus</a>
        </div>
    </div>
</section>

<!-- section contact -->
<section id="contact">
    <h1 class="section_title">Nous Contacter</h1>
    <div class="localisation_contact_div">
        <div class="localisation">
            <h3>Notre Adresse</h3>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d10499.966567606692!2d2.285747998068967!3d48.85836977022069!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e66e2964e34e2d%3A0x8ddca9ee380ef7e0!2sTour%20Eiffel!5e0!3m2!1sfr!2sfr!4v1644955637071!5m2!1sfr!2sfr" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
        <div class="form_contact">
            <h3>Envoyer un message</h3>
            <form action="#">
                <input type="text" placeholder="Nom">
                <input type="email" placeholder="Adresse Mail">
                <input type="text" placeholder="Objet">
                <textarea name="" id="" cols="30" rows="10" placeholder="Message"></textarea>
                <input type="submit" value="Envoyer">
            </form><br><br><br><br>
        </div>
    </div>
</section>

<footer>
    <p>site conçu par malthus&copy; 2022 </p>
    <ul>
        <li style="--clr">
            <a href="#">
                <i class="fa-brands fa-facebook" style="color: #ff0050;"></i>
            </a>
        </li>
        <li style="--clr">
            <a href="#">
                <i class="fa-brands fa-tiktok"></i>
            </a>
        </li>
        <li style="--clr">
            <a href="#">
                <i class="fa-brands fa-whatsapp"></i>
            </a>
        </li>
        <li style="--clr">
            <a href="#">
                <i class="fa-brands fa-instagram"></i>
            </a>
        </li>
    </ul>
</footer>

<script>
    //menu responsive code JS
    var menu_toggle = document.querySelector('.menu_toggle');
    var menu = document.querySelector('.menu');
    var menu_toggle_span = document.querySelector('.menu_toggle span');

    menu_toggle.onclick = function() {
        menu_toggle.classList.toggle('active');
        menu_toggle_span.classList.toggle('active');
        menu.classList.toggle('active');
    }
</script>

<style>
    footer {
  display: flex;
  justify-content: space-between;
  align-items: center;
  position: fixed;
  bottom: 0;
  left: 0;
  width: 100%;
  padding: 10px;
}

footer p {
  margin: 50;
}

footer ul {
  display: flex;
  list-style-type: none;
  padding: 0;
  margin: 0;
}

footer ul li {
  margin-right: 10px;
}
</style>