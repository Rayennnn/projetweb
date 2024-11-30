<?php
require_once '../../../Controller/bourseC.php';

if (isset($_GET['id'])) {
    try {
        $bourseC = new BourseC();
        if ($bourseC->supprimerBourse($_GET['id'])) {
            header('Location: index.php?success=delete');
        } else {
            throw new Exception("Erreur lors de la suppression");
        }
    } catch (Exception $e) {
        header('Location: index.php?error=delete&message=' . urlencode($e->getMessage()));
    }
} else {
    header('Location: index.php?error=noid');
}
exit();
?>