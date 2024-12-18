<?php
require_once __DIR__ . '/../config.php';

class BourseC {
    private $pdo;

    public function __construct() {
        $this->pdo = Config::getConnexion();
    }

    public function ajouterBourse($bourse) {
        try {
            $query = "INSERT INTO bourse (nom_bourse, description, organisme, date_limite, age_limite, niveau_etude, pays, lien, image, prog, frais) 
                      VALUES (:nom_bourse, :description, :organisme, :date_limite, :age_limite, :niveau_etude, :pays, :lien, :image, :prog, :frais)";
            
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
                'prog' => $bourse->getProg(),
                'frais' =>$bourse->getfrais()
            ]);
            
            return true;
        } catch (PDOException $e) {
            echo 'Erreur lors de l\'ajout de la bourse : ' . $e->getMessage();
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
                         frais = :frais";
                         
            
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
                'frais' =>$bourse->getfrais(),
                
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

    public function verifierProgramme($id_prog) {
        $query = "SELECT COUNT(*) FROM programme WHERE id_prog = :id_prog";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id_prog', $id_prog);
        $stmt->execute();
        
        return $stmt->fetchColumn() > 0; // Retourne true si le programme existe
    }

    public function afficherBoursesAvecProgrammes($searchTerm = '') {
        try {
            $query = "SELECT b.*, p.nom_prog, p.description AS prog_description
                      FROM bourse b
                      INNER JOIN programme p ON b.prog = p.id_prog";

            if (!empty($searchTerm)) {
                $query .= " WHERE b.nom_bourse LIKE :searchTerm";
            }

            $stmt = $this->pdo->prepare($query);

            if (!empty($searchTerm)) {
                $stmt->bindValue(':searchTerm', '%' . $searchTerm . '%');
            }

            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Erreur: ' . $e->getMessage();
            return []; // Retournez un tableau vide en cas d'erreur
        }
    }

    public function getBourses() {
        try {
            $query = "SELECT * FROM bourse"; // Requête pour récupérer toutes les bourses
            $stmt = $this->pdo->prepare($query);
            $stmt->execute();
            
            // Récupérer les résultats et créer des objets Bourse
            $bourses = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $bourse = new Bourse();
                $bourse->setNomBourse($row['nom_bourse']);
                $bourse->setDescription($row['description']);
                $bourse->setOrganisme($row['organisme']);
                $bourse->setDateLimite($row['date_limite']);
                $bourse->setAgeLimite($row['age_limite']);
                $bourse->setNiveauEtude($row['niveau_etude']);
                $bourse->setPays($row['pays']);
                $bourse->setFrais($row['frais']);
                $bourse->setLien($row['lien']);
                $bourse->setImage($row['image']);
                $bourse->setProg($row['prog']); // Assurez-vous que prog est défini
    
                $bourses[] = $bourse; // Ajouter l'objet Bourse au tableau
            }
            
            // Débogage : Vérifiez le nombre de bourses récupérées
            echo "Nombre de bourses récupérées : " . count($bourses); // Ajoutez cette ligne pour déboguer
            
            return $bourses; // Retourner le tableau d'objets Bourse
        } catch (PDOException $e) {
            echo 'Erreur lors de la récupération des bourses : ' . $e->getMessage();
            return []; // Retourner un tableau vide en cas d'erreur
        }
    }
}
?>