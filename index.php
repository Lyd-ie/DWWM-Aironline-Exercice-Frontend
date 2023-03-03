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

  // On récupère le prenom du lecteur
  $FirstName = $_POST['prenom'];

  // On récupère l'age du lecteur
  $age = $_POST['age'];

  // On récupère l'email
  $email = $_POST['email'];

  // On fixe le statut du lecteur à 1 par défaut (actif)
  $status = 1;

  // On prépare la requête d'insertion en base de données de toutes ces valeurs dans la table tblreaders
  $query = $dbh->prepare("INSERT INTO inscription(LastName, FirstName, Age, Email, Status) VALUES (:LastName, :FirstName, :Age, :Email, :Status)");

  // On bind les paramètres
  $query->bindParam(':LastName', $name, PDO::PARAM_STR);
  $query->bindParam(':FirstName', $FirstName, PDO::PARAM_STR );
  $query->bindParam(':Age', $age, PDO::PARAM_INT);
  $query->bindParam(':Email', $email, PDO::PARAM_STR);
  $query->bindParam(':Status', $status, PDO::PARAM_INT);

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
                <img src="assets/logos_aironline/logo3_fond_noir.svg" alt="logo Aironline">
            </div>
            <div>
                <p>DECOLLAGE DANS</p>
                <!-- COMPTE A REBOURS ICI -->
            </div>
        </section>
        <section>
            <div>
                <h3>DISCIPLINES</h3>
            </div>
            <div>
                <div>
                    <h2>DISTANCE</h2>
                    <P>Pas de carburant. Pas de moteur. Juste un avion en papier réalisé avec une feuille A4 et la capacité de le lancer plus loin que quiconque. Tu as droit à trois essais lors de l’une des qualifications et seul ton meilleur lancé sera retenu. Seul le pilote ayant parcouru la plus longue distance avec son avion lors de la finale participera à la finale nationale.</p>
                    <p>Peux-tu faire mieux que la championne en titre Pascaline ?</p>
                </div>
                <div>
                    <h2>TEMPS DE VOL</h2>
                    <P>Plie-le, calibre-le et vérifie l'aérodynamisme avant de lancer ton avion en papier pour réaliser le plus long temps de vol.Tu as droit à trois essais lors de l’une des qualifications et seul ton meilleur lancer sera retenu. Seul le ou la pilote qui aura effectué le vol le plus long lors de la finale pourra participer à la finale nationale. En 2022, Kévin a remporté le titre de champion de Temps de vol avec une performance de 13,33 secondes.</p>
                    <P>Peux-tu le détrôner ?</p>
                </div>
                <div>
                    <h2>VOLTIGE</h2>
                    <P>Si tu as un talent secret pour les acrobaties aériennes ça nous intéresse ! Pour cette compétition, tu as trois essais devant les juges qui t’accorderons une note artistique. Seule la plus haute des trois notes est retenue Fais preuve de créativité avec tes avions et figures. Les pilotes  qui recevront le plus de votes des juges accéderont à la finale nationale.</p>
                    <P>Peux-tu faire mieux que la dernière championne, Caro ?</p>
                </div>
        </section>
        <section>
            <img src="assets/avions&icones/avion2.svg" alt="avion en papier rouge">
            <button>INSCRIPTION</button>
        </section>
        <section>
            <div>
                <h3>TRANSPORT</h3>
                <img src="assets/transport.jpg">
            </div>
        </section>
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
                    <input type="checkbox" name="catDist"><label for="catDist">Catégorie “DISTANCE”</label>
                  </div>

                  <div>  
                    <input type="checkbox" name="catTDV"><label for="catTDV">Catégorie “TEMPS DE VOL”</label>
                  </div>

                  <div>
                    <input type="checkbox" name="catVolt"><label for="catVolt">Catégorie “VOLTIGE”</label>
                  </div>

                  <div>
                    <input type="checkbox" name="autoMail"><label for="autoMail">Rappel automatique par mail</label>
                  </div>

                  <div>
                    <input type="checkbox" name="CGU"><label for="CGU">j’accepte les conditions  d’utilisations</label>
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