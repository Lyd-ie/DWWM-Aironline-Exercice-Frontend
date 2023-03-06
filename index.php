<?php 
// Configuration de la connexion
define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASS','root');
define('DB_NAME','aironline');

try
{
    // Connexion � la base
    $dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER, DB_PASS);
}
catch (PDOException $e)
{
	// Echec de la connexion
    exit("Error: " . $e->getMessage());
}

if(isset($_POST['valider'])) {

  // On récupère le nom saisi par le lecteur
  $name = $_POST['nom'];

  // ON recupere les options choisis
  $catDist = '0';
  if(isset($_POST['catDist'])){
    $catDist = $_POST['catDist'];
  }
 
  $catTDV = '0';
  if(isset($_POST['catTDV'])){
    $catTDV = $_POST['catTDV'];
  }
  $catVolt = '0';
  if(isset($_POST['catVolt'])){
    $catVolt = $_POST['catVolt'];
  }
  // On récupère le prenom du lecteur
  $FirstName = $_POST['prenom'];

  // On récupère l'age du lecteur
  $age = $_POST['age'];

  // On récupère l'email
  $email = $_POST['email'];

  // On fixe le statut du lecteur à 1 par défaut (actif)
  $status = 1;

  // On prépare la requête d'insertion en base de données de toutes ces valeurs dans la table tblreaders
  $query = $dbh->prepare("INSERT INTO inscription(LastName, FirstName, Age, Email, Status, catDist, catTDV, catVolt)
                          VALUES (:LastName, :FirstName, :Age, :Email, :Status, :catDist, :catTDV, :catVolt)");

  // On bind les paramètres
  $query->bindParam(':LastName', $name, PDO::PARAM_STR);
  $query->bindParam(':FirstName', $FirstName, PDO::PARAM_STR );
  $query->bindParam(':Age', $age, PDO::PARAM_INT);
  $query->bindParam(':Email', $email, PDO::PARAM_STR);
  $query->bindParam(':Status', $status, PDO::PARAM_INT);
  $query->bindParam(':catDist', $catDist, PDO::PARAM_INT);
  $query->bindParam(':catTDV', $catTDV, PDO::PARAM_INT);
  $query->bindParam(':catVolt', $catVolt, PDO::PARAM_INT);

  // On éxecute la requête
  $query->execute();

  // On récupère le dernier id inséré en bd (fonction lastInsertId)
  $last_id = $dbh->lastInsertId();

  //POPUP DE RETOUR, alert provisoir pour test
  if($last_id) {
    echo '<script>alert("Merci pour votre inscription,Rendez-vous le 26 avril à l’aéroport");</script>';
} 
}

?>



<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>AIR ONLINE - Paper Wings Championship</title>
        <link type="text/css" rel="stylesheet" href="style.css">
        <link rel="shortcut icon" href="" type="image/x-icon">
    </head>
    <body>
        <section>
            <div>
                <img src="assets/logos_aironline/logo2_fond_noir.svg" alt="logo Aironline">
                <img src="assets/avions&icones/facebook.svg" alt="logo Facebook">
                <img src="assets/avions&icones/instagram.svg" alt="logo Instagram">
            </div>
            <div>
                <h1>PAPER WINGS CHAMPIONSHIP</h1>
            </div>
        </section>
        <section>prez disciplines</section>
        <section>bouton inscription</section>
        <section>infos directions</section>
        <section>vignettes</section>
        <section>partenaires</section>
        <section class="inscription redBG">
          <div> 
            <form method="POST" action="index.php">

                <div>
                  <div>
                      <input class="nom" type="text" name="nom" placeholder="NOM du PARTICIPANT......................................................................................................." required>
                  </div>

                  <div>
                      <input class="prenom" type="text" name="prenom" placeholder="PRENOM............................................................................................ "required><input class="age" type="text" name="age" placeholder="AGE........................" required>
                  </div>
                
                  <div>
                      <input class="email" type="text" name="email" placeholder="Adresse mail..................................................................................@..............................."required>
                  </div>
                </div>

                <div>
                  <div>
                    <input  type="checkbox" name="catDist" value="1"><label for="catDist">Catégorie “DISTANCE”</label>
                  </div>

                  <div>  
                    <input type="checkbox" name="catTDV" value="1"><label for="catTDV">Catégorie “TEMPS DE VOL”</label>
                  </div>

                  <div>
                    <input type="checkbox" name="catVolt" value="1"><label for="catVolt">Catégorie “VOLTIGE”</label>
                  </div>

                  <div>
                    <input type="checkbox" name="autoMail"><label for="autoMail">Rappel automatique par mail</label>
                  </div>

                  <div>
                    <input type="checkbox" name="CGU" required='required'><label for="CGU" >j’accepte les  <a href="./CGU.html" target="_blank">Conditions générales d'utilisation </a> </label>
                  </div>
                </div>

                <div>
                  <img src="./assets/avions&icones/avion1.svg" alt="avion en papier">
                </div>

                <div>
                  <button type="submit" name="valider">VALIDER</button>
                </div>

            </form>

              <div>
                <button id="retour" type="submit" name="retour">RETOUR</button>
              </div>
            </div>

                  

              
                
              
  </section>
          <footer>footer</footer>

          <script>
        let retour = document.getElementById('retour');
        function goodBye() {
          alert("Désolé de vous voir partir");
        }
        retour.addEventListener("click", goodBye);
      </script>
      </body>
      
</HTML>