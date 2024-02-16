<?php
// Inclusion du fichier contenant la classe DBconnect pour la connexion à la base de données
require_once('utils/DBconnect.php');

try {
    // Tentative d'obtention de l'instance de connexion à la base de données via le singleton DBconnect
    $connexion = DBconnect::getInstance(
        "mysql:host=localhost;dbname=courspdo",
        "root",
        ""
    );

    // Définition de la requête SQL pour insérer une nouvelle personne dans la table 'persons'
    $query = "INSERT INTO products ( `name`, `numProd`, `price`, `description`) 
    VALUES ('Phone' , 'AR205' , 20.5 , 'toto2@gmail.com'); ";

    // Préparation de la requête SQL
    $stmt = $connexion->getConnexion()->prepare($query);

    // Exécution de la requête SQL préparée
    if ($stmt->execute()) {
        // Affichage d'un message si l'insertion s'est déroulée avec succès
        echo "Phone est dans la bdd ! ";
    }
} catch (PDOException $e) {
    // Gestion des exceptions PDO : affichage du message d'erreur en cas d'échec
    echo $e->getMessage();
}
