<?php
require_once '../../../Controller/bourseC.php';
require_once '../../../Model/bourses.php';

try {
    // Vérifier si l'ID est fourni
    if (!isset($_GET['id']) || empty($_GET['id'])) {
        throw new Exception("ID de la bourse non spécifié");
    }

    $id = intval($_GET['id']);
    $bourseC = new bourseC();

    // Récupérer les informations du bourse pour obtenir le nom de l'image
    $bourse = $bourseC->getBourseById($id);
    
    if (!$bourse) {
        throw new Exception("bourse non trouvé");
    }

    // Supprimer l'image associée si elle existe
    if (!empty($bourse['image'])) {
        $imagePath = "../../../uploads/" . $bourse['image'];
        if (file_exists($imagePath)) {
            if (!unlink($imagePath)) {
                throw new Exception("Erreur lors de la suppression de l'image");
            }
        }
    }

    // Supprimer le bourse de la base de données
    if (!$bourseC->supprimerBourse($id)) {
        throw new Exception("Erreur lors de la suppression du bourse");
    }

    // Rediriger avec un message de succès
    header("Location: listebourse.php?success=delete");
    exit();

} catch (Exception $e) {
    // Log l'erreur pour le débogage
    error_log("Erreur de suppression de la bourse : " . $e->getMessage());
    
    // Rediriger avec un message d'erreur
    header("Location: listebourse.php?error=delete&message=" . urlencode($e->getMessage()));
    exit();
}
?>