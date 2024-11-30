<?php
require_once '../../../Controller/programmeC.php';
require_once '../../../Model/programme.php';

try {
    // Vérifier si l'ID est fourni
    if (!isset($_GET['id_prog']) || empty($_GET['id_prog'])) {
        throw new Exception("ID du programme non spécifié");
    }

    $id_prog = intval($_GET['id_prog']);
    $programmeC = new ProgrammeC();

    // Récupérer les informations du programme pour obtenir le nom de l'image
    $programme = $programmeC->getProgrammeById($id_prog);
    
    if (!$programme) {
        throw new Exception("Programme non trouvé");
    }

    // Supprimer l'image associée si elle existe
    if (!empty($programme['image'])) {
        $imagePath = "../../../uploads/" . $programme['image'];
        if (file_exists($imagePath)) {
            if (!unlink($imagePath)) {
                throw new Exception("Erreur lors de la suppression de l'image");
            }
        }
    }

    // Supprimer le programme de la base de données
    if (!$programmeC->supprimerProgramme($id_prog)) {
        throw new Exception("Erreur lors de la suppression du programme");
    }

    // Rediriger avec un message de succès
    header("Location: index.php?success=delete");
    exit();

} catch (Exception $e) {
    // Log l'erreur pour le débogage
    error_log("Erreur de suppression du programme : " . $e->getMessage());
    
    // Rediriger avec un message d'erreur
    header("Location: index.php?error=delete&message=" . urlencode($e->getMessage()));
    exit();
}
?>