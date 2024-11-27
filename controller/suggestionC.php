<?php
include 'C:\xampp\htdocs\projetweb\config\config.php';

class SuggestionC {
    

    // Récupérer toutes les suggestions
    public function listSuggestions() {
        $db = config::getConnexion();
        if ($db) {
            echo "Connexion réussie !"; // Message pour confirmer la connexion
        }
        $sql = "SELECT * FROM suggestions";
        try {
            $list = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
            return $list;
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
    function deletesuggestion($id)
    {
        $sql = "DELETE FROM suggestions WHERE id_suggestion = :id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $id);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }
    function addSuggestion($suggestion)
    {
        $sql = "INSERT INTO suggestions (contenu, date_soumission, statut, type_feedback, id_utilisateur) 
                VALUES (:contenu, CURRENT_TIMESTAMP, 'en attente', :type_feedback, :id_utilisateur)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $result = $query->execute([
                'contenu' => $suggestion->getContenu(),
                'type_feedback' => $suggestion->getTypeFeedback(),
                'id_utilisateur' => $suggestion->getIdUtilisateur()
            ]);
            
            if ($result) {
                return true;
            } else {
                var_dump($query->errorInfo()); // Pour le débogage
                return false;
            }
        } catch (Exception $e) {
            echo 'Erreur : ' . $e->getMessage();
            return false;
        }
    }
    
    public function updateSuggestion($suggestion, $id) {
        var_dump($_POST); // Vérifie si les données du formulaire arrivent ici
        var_dump($suggestion); 
        try {
            $db = config::getConnexion();
    
            $query = $db->prepare(
                'UPDATE suggestions SET 
                    contenu = :contenu,
                    type_feedback = :type_feedback,
                    statut = :statut,
                    id_utilisateur = :id_utilisateur
                WHERE id_suggestion = :id'
            );
    
            $query->execute([
                'contenu' => $suggestion->getContenu(),
                'type_feedback' => $suggestion->getTypeFeedback(),
                'statut' => $suggestion->getStatut(),
                'id_utilisateur' => $suggestion->getIdUtilisateur(),
                'id' => $id
            ]);
            
            var_dump($query->errorInfo()); // Affiche les erreurs SQL, le cas échéant
            
            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage(); 
        }
    }
    
    
    function showSuggestion($id)
    {
        $sql = "SELECT * FROM suggestions WHERE id_suggestion = :id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute(['id' => $id]);
    
            $suggestion = $query->fetch(); // Fetch the single suggestion record
    
            if ($suggestion) {
                return $suggestion; // Return the suggestion if it exists
            } else {
                // Handle case when no suggestion was found
                return null; // Or handle it in another way, e.g., throw an exception
            }
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    


    
}
?>
