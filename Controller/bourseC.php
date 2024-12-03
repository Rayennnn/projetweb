<?php
require_once __DIR__ . '/../config.php';

class BourseC {
    private $pdo;

    public function __construct() {
        $this->pdo = Config::getConnexion();
    }

    public function ajouterBourse($bourse) {
        try {
            $query = "INSERT INTO bourse (nom_bourse, description, organisme, date_limite, age_limite, niveau_etude, pays, lien, image, id_prog) 
                      VALUES (:nom_bourse, :description, :organisme, :date_limite, :age_limite, :niveau_etude, :pays, :lien, :image, :id_prog)";
            
            $stmt = $this->pdo->prepare($query);
            
            $stmt->execute([
                'nom_bourse' => $bourse->getNomBourse(),
                'description' => $bourse->getDescription(),
                'organisme' => $bourse->getOrganisme(),
                'date_limite' => $bourse->getDateLimite(),
                'age_limite' => $bourse->getAgeLimite(),
                'niveau_etude' => $bourse->getNiveauEtude(),
                'pays' => $bourse->getPays(),
                'lien' => $bourse->getLien(),
                'image' => $bourse->getImage(),
                'id_prog' => $bourse->getIdProg()
            ]);
            
            return true;
        } catch (PDOException $e) {
            echo 'Erreur: ' . $e->getMessage();
            return false;
        }
    }

    public function afficherBourses() {
        try {
            $query = "SELECT * FROM bourse";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Erreur: ' . $e->getMessage();
            return [];
        }
    }
   
    

    public function getBourseById($id) {
        try {
            $query = "SELECT * FROM bourse WHERE id = :id";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute(['id' => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception('Erreur lors de la récupération : ' . $e->getMessage());
        }
    }

    public function modifierBourse($bourse) {
        try {
            $query = "UPDATE bourse 
                     SET nom_bourse = :nom_bourse,
                         description = :description,
                         organisme = :organisme,
                         date_limite = :date_limite,
                         age_limite = :age_limite,
                         niveau_etude = :niveau_etude,
                         pays = :pays,
                         lien = :lien,
                         id_prog = :id_prog";
            
            $params = [
                'id' => $bourse->getId(),
                'nom_bourse' => $bourse->getNomBourse(),
                'description' => $bourse->getDescription(),
                'organisme' => $bourse->getOrganisme(),
                'date_limite' => $bourse->getDateLimite(),
                'age_limite' => $bourse->getAgeLimite(),
                'niveau_etude' => $bourse->getNiveauEtude(),
                'pays' => $bourse->getPays(),
                'lien' => $bourse->getLien(),
                'id_prog' => $bourse->getIdProg()
            ];

            if ($bourse->getImage()) {
                $query .= ", image = :image";
                $params['image'] = $bourse->getImage();
            }

            $query .= " WHERE id = :id";
            
            $stmt = $this->pdo->prepare($query);
            return $stmt->execute($params);
        } catch (PDOException $e) {
            echo 'Erreur: ' . $e->getMessage();
            return false;
        }
    }

    public function supprimerBourse($id) {
        try {
            // Vérifier si la bourse existe
            $bourse = $this->getBourseById($id);
            if (!$bourse) {
                throw new Exception("Bourse non trouvée");
            }

            // Supprimer l'enregistrement
            $query = "DELETE FROM bourse WHERE id = :id";
            $stmt = $this->pdo->prepare($query);
            
            if ($stmt->execute(['id' => $id])) {
                return true;
            }
            return false;
        } catch (PDOException $e) {
            throw new Exception('Erreur lors de la suppression : ' . $e->getMessage());
        }
    }

    public function rechercherBourses($searchTerm) {
        // Exemple de code pour rechercher des bourses dans la base de données
        $query = "SELECT * FROM bourse WHERE nom_bourse LIKE :searchTerm";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['searchTerm' => '%' . $searchTerm . '%']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>