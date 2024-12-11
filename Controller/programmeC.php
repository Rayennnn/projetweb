<?php
require_once __DIR__ . '/../config.php';

class ProgrammeC {
    private $pdo;

    public function __construct() {
        $this->pdo = Config::getConnexion();
    }
    public function listProgrammesById($id_prog) {
        try {
            $query = "SELECT * FROM programme WHERE id_prog = :id_prog";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute(['id_prog' => $id_prog]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Erreur: ' . $e->getMessage();
            return [];
        }
    }
    public function rechercherProgrammes($searchTerm) {
        // Connexion à la base de données
        $db = config::getConnexion();
        
        // Préparer la requête SQL avec une jointure si nécessaire
        $query = "SELECT * FROM programme WHERE nom_prog LIKE :searchTerm OR organisme LIKE :searchTerm"; // Changer 'programmes' en 'programme'
        
        $stmt = $db->prepare($query);
        $stmt->execute(['searchTerm' => '%' . $searchTerm . '%']);
        
        // Récupérer les résultats
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function ajouterProgramme($programme) {
        try {
            $query = "INSERT INTO programme (nom_prog, description, organisme, date_limite, age_limite, niveau_etude, pays, lien, image) 
                      VALUES (:nom_prog, :description, :organisme, :date_limite, :age_limite, :niveau_etude, :pays, :lien, :image)";
            
            $stmt = $this->pdo->prepare($query);
            
            $stmt->execute([
                'nom_prog' => $programme->getNomProgramme(),
                'description' => $programme->getDescription(),
                'organisme' => $programme->getOrganisme(),
                'date_limite' => $programme->getDateLimite(),
                'age_limite' => $programme->getAgeLimite(),
                'niveau_etude' => $programme->getNiveauEtude(),
                'pays' => $programme->getPays(),
                'lien' => $programme->getLien(),
                'image' => $programme->getImage()
            ]);
            
            return true;
        } catch (PDOException $e) {
            echo 'Erreur: ' . $e->getMessage();
            return false;
        }
    }
    

    public function afficherProgrammes() {
        try {
            $query = "SELECT * FROM programme";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Erreur: ' . $e->getMessage();
            return [];
        }
    }
   

    public function getProgrammeById($id_prog) {
        try {
            $query = "SELECT * FROM programme WHERE id_prog = :id_prog";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([':id_prog' => $id_prog]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception('Erreur : ' . $e->getMessage());
        }
    }

    public function modifierProgramme($programme) {
        try {
            $query = "UPDATE programme 
                     SET nom_prog = :nom_prog,
                         description = :description,
                         organisme = :organisme,
                         date_limite = :date_limite,
                         age_limite = :age_limite,
                         niveau_etude = :niveau_etude,
                         pays = :pays,
                         lien = :lien";
            
            $params = [
                'id_prog' => $programme->getId(),
                'nom_prog' => $programme->getNomProgramme(),
                'description' => $programme->getDescription(),
                'organisme' => $programme->getOrganisme(),
                'date_limite' => $programme->getDateLimite(),
                'age_limite' => $programme->getAgeLimite(),
                'niveau_etude' => $programme->getNiveauEtude(),
                'pays' => $programme->getPays(),
                'lien' => $programme->getLien()
            ];

            if ($programme->getImage()) {
                $query .= ", image = :image";
                $params['image'] = $programme->getImage();
            }

            $query .= " WHERE id_prog = :id_prog";
            
            $stmt = $this->pdo->prepare($query);
            return $stmt->execute($params);
        } catch (PDOException $e) {
            echo 'Erreur: ' . $e->getMessage();
            return false;
        }
    }

    public function supprimerProgramme($id_prog) {
        try {
            // Vérifier si le programme existe avant la suppression
            $query = "SELECT * FROM programme WHERE id_prog = :id_prog";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([':id_prog' => $id_prog]);
            
            $programme = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if (!$programme) {
                throw new Exception("Programme non trouvé");
            }

            // Supprimer le programme
            $query = "DELETE FROM programme WHERE id_prog = :id_prog";
            $stmt = $this->pdo->prepare($query);
            
            if (!$stmt->execute([':id_prog' => $id_prog])) {
                throw new Exception("Erreur lors de la suppression");
            }
            
            return true;
        } catch (PDOException $e) {
            throw new Exception('Erreur lors de la suppression : ' . $e->getMessage());
        }
    }
  
    
}
?>