<?php
include 'C:\xampp\htdocs\projetweb\config\config.php';

class ReponseSuggestionC {

    // Récupérer toutes les réponses
    public function listReponses() {
        $db = config::getConnexion();
        $sql = "SELECT * FROM reponse_suggestion";
        try {
            $list = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
            return $list;
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    // Ajouter une réponse
    public function addReponse($reponse) {
        $sql = "INSERT INTO reponse_suggestion (reponse, date_reponse, id_suggestion) 
                VALUES (:reponse, :date_reponse, :id_suggestion)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $result = $query->execute([
                'reponse' => $reponse->getReponse(),
                'date_reponse' => $reponse->getDateReponse(),
                'id_suggestion' => $reponse->getIdSuggestion()
            ]);
            return $result;
        } catch (Exception $e) {
            error_log('Erreur dans addReponse : ' . $e->getMessage());
            return false;
        }
    }

    // Supprimer une réponse
    public function deleteReponse($id) {
        $sql = "DELETE FROM reponse_suggestion WHERE id_rep_sugges = :id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute(['id' => $id]);
            echo "Réponse supprimée avec succès.";
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    // Modifier une réponse
    public function updateReponse($reponse, $id) {
        try {
            $db = config::getConnexion();

            $query = $db->prepare(
                'UPDATE reponse_suggestion SET 
                    reponse = :reponse,
                    date_reponse = :date_reponse,
                    id_suggestion = :id_suggestion
                WHERE id_rep_sugges = :id'
            );

            $query->execute([
                'reponse' => $reponse->getReponse(),
                'date_reponse' => $reponse->getDateReponse(),
                'id_suggestion' => $reponse->getIdSuggestion(),
                'id' => $id
            ]);

            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }

    // Afficher une réponse spécifique
    public function showReponse($id) {
        $sql = "SELECT * FROM reponse_suggestion WHERE id_rep_sugges = :id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute(['id' => $id]);

            $reponse = $query->fetch(); // Récupère un seul enregistrement

            if ($reponse) {
                return $reponse; // Retourne la réponse si elle existe
            } else {
                // Gère le cas où aucune réponse n'a été trouvée
                return null;
            }
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
}
?>
