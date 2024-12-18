<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/PROJETWEB/config.php'); // Inclure le fichier pour la connexion à la base de données
require_once($_SERVER['DOCUMENT_ROOT'] . '/PROJETWEB/Model/favoris.php');

class favorisc
{
public function toggleFavorite($user_id, $type, $item_id) {
    $db = config::getConnexion();
    
    // Vérifier si le favori existe déjà
    $sql = "SELECT * FROM favoris WHERE user_id = :user_id AND type = :type AND item_id = :item_id";
    $query = $db->prepare($sql);
    $query->bindValue(':user_id', $user_id, PDO::PARAM_INT);
    $query->bindValue(':type', $type, PDO::PARAM_STR);
    $query->bindValue(':item_id', $item_id, PDO::PARAM_INT);
    $query->execute();

    if ($query->rowCount() > 0) {
        // Si le favori existe, le supprimer
        $sql = "DELETE FROM favoris WHERE user_id = :user_id AND type = :type AND item_id = :item_id";
    } else {
        // Sinon, l'ajouter
        $sql = "INSERT INTO favoris (user_id, type, item_id) VALUES (:user_id, :type, :item_id)";
    }

    $query = $db->prepare($sql);
    $query->bindValue(':user_id', $user_id, PDO::PARAM_INT);
    $query->bindValue(':type', $type, PDO::PARAM_STR);
    $query->bindValue(':item_id', $item_id, PDO::PARAM_INT);
    return $query->execute();
}
public function getUserFavorites($user_id) {
    $db = config::getConnexion();
    $sql = "SELECT * FROM favoris WHERE user_id = :user_id";
    
    try {
        $query = $db->prepare($sql);
        $query->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        die('Erreur: '.$e->getMessage());
    }
}
public function isFavorite($user_id, $type, $item_id) {
    $db = config::getConnexion();
    $sql = "SELECT COUNT(*) FROM favoris WHERE user_id = :user_id AND type = :type AND item_id = :item_id";
    
    $query = $db->prepare($sql);
    $query->bindValue(':user_id', $user_id, PDO::PARAM_INT);
    $query->bindValue(':type', $type, PDO::PARAM_STR);
    $query->bindValue(':item_id', $item_id, PDO::PARAM_INT);
    $query->execute();
    
    return $query->fetchColumn() > 0; // Retourne true si le favori existe
}
public function getFavoriteFormationDates($user_id) {
    try {
        $db = config::getConnexion();
        // Récupérer les formations favorites en utilisant item_id
        $sql = "SELECT f.date, f.nom_formation 
                FROM formations f 
                INNER JOIN favoris fav ON f.id_formation = fav.item_id 
                WHERE fav.user_id = :user_id 
                AND fav.type = 'formation' 
                AND f.date IS NOT NULL 
                ORDER BY f.date";
        
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
        return [];
    }
}
}