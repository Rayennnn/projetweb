<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/PROJETWEB/config.php'); // Inclure le fichier pour la connexion à la base de données
require_once($_SERVER['DOCUMENT_ROOT'] . '/PROJETWEB/Model/formations.php');

class Formationc
{
    // Fonction pour ajouter une formation
    public function addFormation($formation)
    {
        $sql = "INSERT INTO `formations` (nom_formation, description, organisme, prix, image, lien, id_club) 
                VALUES (:nom_formation, :description, :organisme, :prix, :image, :lien, :id_club)";
        
        $db = config::getConnexion(); // Obtenir la connexion à la base de données

        try {
            $query = $db->prepare($sql);
            $query->execute([
                'nom_formation' => $formation->getNomFormation(),
                'description' => $formation->getDescription(),
                'organisme' => $formation->getOrganisme(),
                'prix' => $formation->getPrix(),
                'image' => $formation->getImage(),
                'lien' => $formation->getLien(),
                'id_club' => $formation->getIdClub(),
            ]);
        } catch (Exception $e) {
            echo 'Erreur : ' . $e->getMessage();
        }
    }

    // Fonction pour récupérer toutes les formations
    public function getAllFormations()
    {
        $sql = "SELECT * FROM `formations`";
        $db = config::getConnexion();

        try {
            $list = $db->query($sql);
            return $list; // Retourne toutes les formations sous forme de tableau
        } catch (Exception $e) {
            echo 'Erreur : ' . $e->getMessage();
            return [];
        }
    }

    // Fonction pour récupérer une formation par ID
    public function getFormationById($id_formation)
    {
        $sql = "SELECT * FROM `formations` WHERE id_formation = :id_formation";
        $db = config::getConnexion();

        try {
            $query = $db->prepare($sql);
            $query->execute(['id_formation' => $id_formation]);
            return $query->fetch(); // Retourne une seule formation
        } catch (Exception $e) {
            echo 'Erreur : ' . $e->getMessage();
            return null;
        }
    }

    // Fonction pour mettre à jour une formation
    public function updateFormation($formation)
    {
        try {
            $db = config::getConnexion();
            $sql = "UPDATE formations SET 
                    nom_formation = :nom_formation,
                    description = :description,
                    organisme = :organisme,
                    prix = :prix,
                    image = :image,
                    lien = :lien,
                    id_club = :id_club,
                    date = :date_formation  
                    WHERE id_formation = :id_formation";
            
            $query = $db->prepare($sql);
            $query->execute([
                'id_formation' => $formation->getIdFormation(),
                'nom_formation' => $formation->getNomFormation(),
                'description' => $formation->getDescription(),
                'organisme' => $formation->getOrganisme(),
                'prix' => $formation->getPrix(),
                'image' => $formation->getImage(),
                'lien' => $formation->getLien(),
                'id_club' => $formation->getIdClub(),
                'date_formation' => $formation->getDateFormation()
            ]);
            
            return true;
        } catch (Exception $e) {
            echo 'Erreur: ' . $e->getMessage();
            return false;
        }
    }

    // Fonction pour supprimer une formation
    public function deleteFormation($id_formation)
    {
        $sql = "DELETE FROM `formations` WHERE id_formation = :id_formation";
        $db = config::getConnexion();

        try {
            $query = $db->prepare($sql);
            $query->execute(['id_formation' => $id_formation]);
            echo "La formation avec l'ID $id_formation a été supprimée avec succès !";
        } catch (Exception $e) {
            echo 'Erreur : ' . $e->getMessage();
        }
    }
    public function getNextFormationDate() {
    $sql = "SELECT MIN(date) as next_date FROM formations";
    $db = config::getConnexion();

    try {
        $query = $db->query($sql);
        return $query->fetch(PDO::FETCH_ASSOC)['next_date'];
    } catch (Exception $e) {
        die('Erreur: '.$e->getMessage());
    }
    }
    public function getNextFormationDetails() {
        $sql = "SELECT id_formation, nom_formation, image, date FROM formations ORDER BY date ASC LIMIT 1";
        $db = config::getConnexion();

        try {
            $query = $db->query($sql);
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die('Erreur: '.$e->getMessage());
        }
    }
    public function deleteFormationdate($id_formation) {
        $db = config::getConnexion();
        $sql = "DELETE FROM formations WHERE id_formation = :id_formation";
    
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':id_formation', $id_formation, PDO::PARAM_INT);
            $query->execute();
        } catch (Exception $e) {
            die('Erreur: '.$e->getMessage());
        }
    }
}


?>
