<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/PROJETWEB/config.php'); // Inclure le fichier pour la connexion à la base de données
require_once ($_SERVER['DOCUMENT_ROOT'] . '/PROJETWEB/Model/clubs.php');
class Clubc
{
    // Fonction pour ajouter un club
    public function addClub($club)
    {
        $sql = "INSERT INTO `clubs et associations` (nom_club, description, date_creation, categorie, lieu, logo, lien) 
                VALUES (:nom_club, :description, :date_creation, :categorie, :lieu, :logo, :lien)";
        
        $db = config::getConnexion(); // Obtenir la connexion à la base de données

        try {
            $query = $db->prepare($sql);
            $query->execute([
                'nom_club' => $club->getNomClub(),
                'description' => $club->getDescription(),
                'date_creation' => $club->getDateCreation(),
                'categorie' => $club->getCategorie(),
                'lieu' => $club->getLieu(),
                'logo' => $club->getLogo(),
                'lien' => $club->getLien(),
            ]);
        } catch (Exception $e) {
            echo 'Erreur : ' . $e->getMessage();
        }
    }

    // Fonction pour récupérer tous les clubs
    public function getAllClubs()
    {
        $sql = "SELECT * FROM `clubs et associations`";
        $db = config::getConnexion();

        try {
            $list = $db->query($sql);
            return $list; // Retourne tous les clubs sous forme de tableau
        } catch (Exception $e) {
            echo 'Erreur : ' . $e->getMessage();
            return [];
        }
    }

    // Fonction pour récupérer un club par ID
    public function getClubById($id_club)
    {
        $sql = "SELECT * FROM `clubs et associations` WHERE id_club = :id_club";
        $db = config::getConnexion();

        try {
            $query = $db->prepare($sql);
            $query->execute(['id_club' => $id_club]);
            return $query->fetch(); // Retourne un seul club
        } catch (Exception $e) {
            echo 'Erreur : ' . $e->getMessage();
            return null;
        }
    }

    public function getNomClubById($id_club)
    {
        $db = config::getConnexion();
        $sql = "SELECT nom_club FROM `clubs et associations` WHERE id_club = :id_club";
        try {
            $query = $db->prepare($sql);
            $query->execute(['id_club' => $id_club]);
            return $query->fetchColumn(); // Retourne le nom du club
        } catch (Exception $e) {
            echo 'Erreur : ' . $e->getMessage();
            return null;
        }
    }

    // Fonction pour mettre à jour un club
    public function updateClub($club)
    {
        try {
            $db = config::getConnexion();
            $sql = "UPDATE `clubs et associations` SET 
                    nom_club = :nom_club,
                    description = :description,
                    date_creation = :date_creation,
                    categorie = :categorie,
                    lieu = :lieu,
                    logo = :logo,
                    lien = :lien
                    WHERE id_club = :id_club";
            
            $query = $db->prepare($sql);
            return $query->execute([
                'id_club' => $club->getIdClub(),
                'nom_club' => $club->getNomClub(),
                'description' => $club->getDescription(),
                'date_creation' => $club->getDateCreation(),
                'categorie' => $club->getCategorie(),
                'lieu' => $club->getLieu(),
                'logo' => $club->getLogo(),
                'lien' => $club->getLien()
            ]);
            
        } catch (Exception $e) {
            error_log('Erreur : ' . $e->getMessage());
            return false;
        }
    }

    // Fonction pour supprimer un club
    public function deleteClub($id_club)
    {
        $sq1 = "DELETE FROM `clubs et associations` WHERE id_club = :id_club"; // Requête adaptée à votre table
        $db = config::getConnexion();

        $req = $db->prepare($sq1); // Préparation de la requête
        $req->bindValue(':id_club', $id_club); // Lier la valeur du paramètre :id_club

        try {
            $req->execute(); // Exécution de la requête
            echo "Le club avec l'ID $id_club a été supprimé avec succès !"; // Message de succès
        } catch (Exception $e) {
            echo 'Erreur : ' . $e->getMessage(); // Gérer l'erreur en cas d'échec
        }
    }

    // Fonction pour afficher les formations d'un club
    public function afficherFormations($id_club) {
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                "SELECT id_formation, nom_formation, description, organisme, prix, 
                        image, lien, id_club, date 
                 FROM formations 
                 WHERE id_club = :id_club"
            );
            $query->execute(['id_club' => $id_club]);
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die('Erreur: '.$e->getMessage());
        }
    }
    public function incrementClicks($id_club) {
        $db = config::getConnexion(); // Obtenir la connexion à la base de données
        $sql = "UPDATE `clubs et associations` SET clicks = clicks + 1 WHERE id_club = :id_club"; // Assurez-vous que le nom de la table est correct
        
        try {
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':id_club', $id_club, PDO::PARAM_INT);
            
            // Vérifier si la requête est bien exécutée
            if ($stmt->execute()) {
                echo "Mise à jour réussie : " . $stmt->rowCount() . " ligne(s) affectée(s).";
            } else {
                echo "Erreur lors de la mise à jour.";
            }
            
        } catch (Exception $e) {
            error_log('Erreur lors de l\'incrémentation des clics : ' . $e->getMessage());
            echo 'Erreur lors de l\'incrémentation des clics : ' . $e->getMessage();
        }
    }
    
    
    
}


?>