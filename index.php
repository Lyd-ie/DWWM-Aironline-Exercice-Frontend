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

if(isset($_POST['submit'])) {

  // On récupère le nom saisi par le lecteur
  $name = $_POST['nom'];

  // On récupère le prenom du lecteur
  $firstName = $_POST['prenom'];

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
                <form action="POST" action="index.php">

                <div>
                    <input class="nom" type="text" name="nom" placeholder="NOM du PARTICIPANT.......................................................................................................">
                </div>

                <div>
                    <input class="prenom" type="text" name="prenom" placeholder="PRENOM............................................................................................ "><input type="text" name="age" placeholder="AGE........................">
                </div>
                
                <div>
                    <input class="email" type="text" name="email" placeholder="Adresse mail..................................................................................@...............................">
                </div>

                <button  type="submit" name="submit" >Valider</button>
                
            </form>
            </div>
</section>
        <footer>footer</footer>
    </body>
</HTML>