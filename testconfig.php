<?php
// Inclure le fichier de configuration
require_once 'config.php';

try {
    // Appeler la méthode getConnexion pour tester la connexion
    $pdo = Config::getConnexion();
    echo "Connexion réussie à la base de données ! 🎉"; // Succès
} catch (Exception $e) {
    // En cas d'erreur, afficher un message avec les détails de l'erreur
    echo "Erreur de connexion : " . $e->getMessage();
}
?>