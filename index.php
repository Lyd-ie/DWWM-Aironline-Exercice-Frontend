<?php 
// Configuration de la connexion
define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASS','root');
define('DB_NAME','aironline');

try
{
    // Connexion a la base
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
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro&display=swap" rel="stylesheet"> 
        <link type="text/css" rel="stylesheet" href="style.css">
        <link rel="shortcut icon" href="" type="image/x-icon">
    </head>
    <body>
        <section class="header">
            <img class="AO" src="assets/logos_aironline/logo2_fond_noir.svg" alt="logo Aironline">
            <div class="logos">
                <img src="assets/avions&icones/facebook.svg" alt="logo Facebook">
                <img src="assets/avions&icones/instagram.svg" alt="logo Instagram">
            </div>
            <div class="page-title">
                <img src="assets/logos_aironline/nom_de_levent.svg" alt="Paperwings Championship by AirOnline">
            </div>
            <div class="decollage blackBG">
                <p>DECOLLAGE DANS</p>
                <div class="countdown">COMPTE A REBOURS ICI</div>
            </div>
        </section>
        <section>
            <div class="disciplines-title blackBG">
                <h3>DISCIPLINES</h3>
            </div>
            <div class="disciplines redBG">
                <div class="whiteBG">
                    <h2>DISTANCE</h2>
                    <P>Pas de carburant. Pas de moteur. Juste un avion en papier réalisé avec une feuille A4 et la capacité de le lancer plus loin que quiconque. Tu as droit à trois essais lors de l’une des qualifications et seul ton meilleur lancé sera retenu. Seul le pilote ayant parcouru la plus longue distance avec son avion lors de la finale participera à la finale nationale.</p>
                    <p>Peux-tu faire mieux que la championne en titre Pascaline ?</p>
                </div>
                <div class="whiteBG">
                    <h2>TEMPS DE VOL</h2>
                    <P>Plie-le, calibre-le et vérifie l'aérodynamisme avant de lancer ton avion en papier pour réaliser le plus long temps de vol.Tu as droit à trois essais lors de l’une des qualifications et seul ton meilleur lancer sera retenu. Seul le ou la pilote qui aura effectué le vol le plus long lors de la finale pourra participer à la finale nationale. En 2022, Kévin a remporté le titre de champion de Temps de vol avec une performance de 13,33 secondes.</p>
                    <P>Peux-tu le détrôner ?</p>
                </div>
                <div class="whiteBG">
                    <h2>VOLTIGE</h2>
                    <P>Si tu as un talent secret pour les acrobaties aériennes ça nous intéresse ! Pour cette compétition, tu as trois essais devant les juges qui t’accorderons une note artistique. Seule la plus haute des trois notes est retenue Fais preuve de créativité avec tes avions et figures. Les pilotes  qui recevront le plus de votes des juges accéderont à la finale nationale.</p>
                    <P>Peux-tu faire mieux que la dernière championne, Caro ?</p>
                </div>
        </section>
        <section class="bouton-inscription">
            <div><img src="assets/avions&icones/avion2.svg" alt="avion en papier rouge"></div>
            <button>INSCRIPTION</button>
        </section>
        <section class="infos">
            <div>
                <h3>TRANSPORT</h3>
                <img src="assets/transport.jpg">
            </div>
            <div>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2794.9895402699312!2d5.95657511576848!3d45.53041603704324!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x478baeadf7664831%3A0x777d29b04260c513!2s110%20Rue%20des%20Tenettes%2C%2073190%20Saint-Baldoph!5e0!3m2!1sfr!2sfr!4v1678103364074!5m2!1sfr!2sfr" width="500" height="500" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <div>
                <h3>HORAIRE</h3>
                <p class>Enregistrement à partir de 10 h jusqu’à 12 h</p>
                <p>1er lancé à 14 h pour les qualifications “ DISTANCE ” <br>
                1er lancé à 16 h pour les qualifications “ TEMPS DE VOL ” <br>
                1er lancé à 18 h pour les qualifications “ VOLTIGE ”</p>
                <p>ANIMATIONS (enfants, ados, adultes) TOUTE LA JOURNEE <br>
                Restauration et rafraichissement sur place</p>
                <p>Toute sortie est définitive</p>
            </div>            
        </section>
        <section class="vignettes redBG">
            <div class="whiteBG">
                <a href="https://ikonal.com/plans-avions-papier" alt="comment faire un avion en papier" target="_blank"><img src="assets/vignette1.jpg" alt="un avion en papier"></a>
                <p>12 plans pour réussir son avion en papier</p>
            </div>
            <div class="whiteBG">
                <a href="https://youtu.be/OHwuee3q8fg" alt="record du monde vol d'avion en papier" target="_blank"><img src="assets/vignette2.jpg" alt="vignette vidéo youtube"></a>
                <p>How John Collins Broke the Longest Paper Airplane Flight World Record</p>
            </div>
            <div class="whiteBG">
                <a href="http://www.camillejourdain.fr/wp-content/uploads/2009/10/evasion_mode_d_emploi.pdf" alt="art du voyage immobile" target="_blank"><img src="assets/vignette3.jpg" alt="pliage d'un avion en papier"></a>
                <p>L'art du voyage immobile</p>
            </div>
        </section>
        <section class="partenaires redBG">
            <div class="flex-row">
                <img src="assets/partenaires/chinaexpress.jpg" alt="China Express">
                <img src="assets/partenaires/clairefontaine.jpg" alt="Clairefontaine">
                <img src="assets/partenaires/douceurbio.jpg" alt="O'DouceurBio">
                <img src="assets/partenaires/pizzahut.jpg" alt="Pizza Hut">
            </div>
            <div class="flex-column">
                <img src="assets/partenaires/airfrance.jpg" alt="Air France">
                <img src="assets/partenaires/aeroport.jpg" alt="Aéroport">
            </div>
        </section>
        <section class="inscription redBG ">
          
            <form class="formulaire" method="POST" action="index.php">

                <div class="input">
                    
                      <input class="nom" type="text" name="nom" placeholder="NOM du PARTICIPANT......................................................................................................." required>
                    

                    <div>
                      <input class="prenom" type="text" name="prenom" placeholder="PRENOM............................................................................................ "required><input class="age" type="text" name="age" placeholder="AGE........................" required>
                    </div>
                
                  
                      <input class="email" type="text" name="email" placeholder="Adresse mail..................................................................................@..............................."required>
                  
                </div>

                <div class="checkbox">

                  <div class="catDist">
                    <input  type="checkbox" name="catDist" value="1"><label for="catDist">Catégorie “DISTANCE”</label>
                  </div>

                  <div class="catTDV">
                    <input type="checkbox" name="catTDV" value="1"><label for="catTDV">Catégorie “TEMPS DE VOL”</label>
                  </div>

                  <div class="catVolt">
                    <input type="checkbox" name="catVolt" value="1"><label for="catVolt">Catégorie “VOLTIGE”</label>
                  </div>

                  <div class="autoMail">
                    <input type="checkbox" name="autoMail"><label for="autoMail">Rappel automatique par mail</label>
                  </div>

                  <div class="CGU">
                    <input type="checkbox" name="CGU" required='required'><label for="CGU" >j’accepte les  <a href="./CGU.html" target="_blank">Conditions générales d'utilisation </a> </label>
                  </div>

                </div>

               
                  <img class="image" src="./assets/avions&icones/avion1.svg" alt="avion en papier">
                

                <div class="button">
                  <button id="retour" type="submit" name="retour">RETOUR</button>

                  <button class="valider" type="submit" name="valider">VALIDER</button>
                </div>

            </form>
          

</section>
        <footer class="blackBG">
            <div>
                <a href=#>Configuration des cookies</a>
                <a href=#>Politique de confidentialité</a>
                <a href=#>Mentions légales</a>
            </div>
            <div>
                <a href=#>Contactez-nous</a>
                <a href=#>Conditions Générales</a>
                <a href=#>Médias</a>
            </div>
            <div>
                <img src="assets/avions&icones/avion2.svg" alt="avion en papier rouge">
            </div>
        </footer>
    </body>
              
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