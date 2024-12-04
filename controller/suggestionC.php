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
    public function addSuggestion($suggestion) {
        try {
            $pdo = config::getConnexion();
            
            $sql = "INSERT INTO suggestions (contenu, date_soumission, statut, type_feedback, id_utilisateur) 
                    VALUES (:contenu, :date_soumission, :statut, :type_feedback, :id_utilisateur)";
            
            $query = $pdo->prepare($sql);
            
            $result = $query->execute([
                'contenu' => $suggestion->getContenu(),
                'date_soumission' => $suggestion->getDateSoumission(),
                'statut' => $suggestion->getStatut(),
                'type_feedback' => $suggestion->getTypeFeedback(),
                'id_utilisateur' => $suggestion->getIdUtilisateur()
            ]);
            
            return $result;
            
        } catch (PDOException $e) {
            error_log("Erreur PDO dans addSuggestion: " . $e->getMessage());
            throw new Exception("Erreur base de données: " . $e->getMessage());
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
    
    public function getStatistiques() {
        try {
            $pdo = config::getConnexion();
            
            // Récupérer le nombre total de suggestions
            $sql_total = "SELECT COUNT(*) as total FROM suggestions";
            $query_total = $pdo->query($sql_total);
            $total = $query_total->fetch()['total'];
            
            if ($total == 0) {
                return [
                    'total' => 0,
                    'traitée' => ['count' => 0, 'percentage' => 0],
                    'rejetée' => ['count' => 0, 'percentage' => 0],
                    'en_attente' => ['count' => 0, 'percentage' => 0],
                    'par_type' => [
                        'suggestion' => ['count' => 0, 'percentage' => 0],
                        'reclamation' => ['count' => 0, 'percentage' => 0]
                    ]
                ];
            }

            // Requête pour compter les suggestions par statut
            $sql_stats = "SELECT 
                statut, 
                COUNT(*) as count,
                (COUNT(*) * 100.0 / $total) as percentage
                FROM suggestions 
                GROUP BY statut";
            
            $query_stats = $pdo->query($sql_stats);
            $stats_by_status = $query_stats->fetchAll(PDO::FETCH_ASSOC);
            
            // Requête pour compter par type de feedback
            $sql_types = "SELECT 
                type_feedback, 
                COUNT(*) as count,
                (COUNT(*) * 100.0 / $total) as percentage
                FROM suggestions 
                GROUP BY type_feedback";
            
            $query_types = $pdo->query($sql_types);
            $stats_by_type = $query_types->fetchAll(PDO::FETCH_ASSOC);
            
            // Organiser les résultats
            $statistics = [
                'total' => $total,
                'traitée' => ['count' => 0, 'percentage' => 0],
                'rejetée' => ['count' => 0, 'percentage' => 0],
                'en_attente' => ['count' => 0, 'percentage' => 0],
                'par_type' => [
                    'suggestion' => ['count' => 0, 'percentage' => 0],
                    'reclamation' => ['count' => 0, 'percentage' => 0]
                ]
            ];
            
            // Remplir les statistiques par statut
            foreach ($stats_by_status as $stat) {
                $status = strtolower(str_replace(' ', '_', $stat['statut']));
                $statistics[$status] = [
                    'count' => $stat['count'],
                    'percentage' => round($stat['percentage'], 1)
                ];
            }
            
            // Remplir les statistiques par type
            foreach ($stats_by_type as $stat) {
                $type = strtolower($stat['type_feedback']);
                $statistics['par_type'][$type] = [
                    'count' => $stat['count'],
                    'percentage' => round($stat['percentage'], 1)
                ];
            }
            
            return $statistics;
            
        } catch (PDOException $e) {
            throw new Exception("Erreur lors du calcul des statistiques : " . $e->getMessage());
        }
    }
    


}
?>
