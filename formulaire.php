<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de l'administrateur</title>
</head>
<style>
            .centrer_le_formilaire {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}
.pour_le_contenu{
    width: 400px;
    margin: 0 auto;
}
.pour_label{
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}
.pour_input{
    width: 100%;
    padding: 5px;
    margin-bottom: 10px;
}
.pour_submit{
    background-color: #4caf55;
    color: white;
    padding: 10px 20px;
    border: none;
    cursor: pointer;
}
.pour_le_contenu {
    width: 400px;
    margin: 0 auto;
}
</style>
<body>
    <div class="pour_le_contenu">
        <h1>Ajouter de nouvelle livre</h1>
        <div class="pour-le-contenu">
            <form action="insertion.php" method="POST" class="pour_le_contenu" enctype="multipart/form-data">
                <label class="pour_label" for="marque">Marque:</label>
                <input class="pour_input" name="marque" type="text" placeholder="Marque" required>
                <label class="pour_label" for="model">Model:</label>
                <input class="pour_input" name="model" type="text" placeholder="Model" required>
                <label class="pour_label" for="km">Km:</label>
                <input class="pour_input" name="Km" type="number" placeholder="Km" required>
                <label class="pour_label" for="energi">Energie:</label>
                <div class="pour-le-contenu">
                    <select class="pour_input" >
                      <option >Diesel</option>
                      <option value="1">Essence</option>
                      <option value="1">Electrique</option>
                      <option value="1">Hybride</option>
                      <option value="1">Hybride rechageable</option>
                    </select>
                <label class="pour_label" for="anné">Années:</label>
                <input class="pour_input" type="number" name="anné" placeholder="Année" required>
                <label class="pour_label" for="boite">Boîte de vitesse:</label>
                <div class="pour-le-contenu">
                    <select class="pour_input" >
                      <option >Automatique</option>
                      <option value="1">Mannuel</option>
                    </select>
                <label class="pour_label" for="prix">Prix:</label>
                <input class="pour_input" type="number" name="prix" placeholder="Prix" required>
                <label class="pour_label" for="nbportes">Nombre de portes:</label>
                <input class="pour_input" type="number" name="nbportes" placeholder="Nombre de portes" required>
                <button class="pour_submit" type="submit" name="connexion" value="Ajouter">Ajouter une voiture</button>
            </form>
        </div>
    </div>
    
   
    
</body>
</html>