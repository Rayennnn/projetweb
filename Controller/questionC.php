<?php
require_once(__DIR__ . '/../config.php');
require_once(__DIR__ . '/../Model/question.php');



class questionC{



 /////..............................Ajouter............................../ 


    function ajouterquestion($question){
        $sql="INSERT INTO question (titre,id_auteur,type,date) 
            VALUES (:titre,:id_auteur,:type,:date)";
            $db = config::getConnexion();
            try{
                $query = $db->prepare($sql);
                $query->execute([
                    'titre' => $question->getTitre(),
                    'id_auteur' => $question->getId_auteur(),
                    'type' => $question->getType(),
                    'date' => $question->getDate()
                ]);     
            }
            catch (Exception $e){
                echo 'Erreur: '.$e->getMessage();
            }   
    }





 /////..............................Afficher............................../ 
 function affichequestion(){
    $db =config::getConnexion();
        try{
            $query = $db ->prepare ('select * FROM question');
            $query ->execute();
            $result = $query ->fetchAll(); 
            return $result;
        }
        catch(PDOException $e){
            echo 'Erreur: '.$e->getMessage();
        }
} 
 
public function listequestion($id) {
    $db = config::getConnexion();
    try {
        $liste = $db->prepare('SELECT  q.titre ,q.id_auteur , q.date , q.type
        FROM question q
        WHERE id=:id');
        $liste->execute(['id' => $id]);

        return $liste;
    } catch(Exception $e) {
        die('Error: ' . $e->getMessage());
    }
}



function getquestion($id){
    $db = config::getConnexion();
    try{
        $req=$db->prepare("SELECT * FROM question where id=:id");
        $req->execute([
            "id" => $id
        ]);
        return $req->fetch();
    }
    catch (PDOException $e){
        die('Erreur: '.$e->getMessage());
    }
}



/////..............................Supprimer............................../////    

function supprimerquestion($id){
    $sql="DELETE FROM question WHERE id= :id";
    $db = config::getConnexion();
    $req=$db->prepare($sql);
    $req->bindValue(':id',$id);
    try{
        $req->execute();
    }
    catch (Exception $e){
        echo 'Erreur: '.$e->getMessage();
    }
}



/////..............................Modifier..............................///// 
    
function modifierquestion($question,$id){
    try {
        $db = config::getConnexion();
        $query = $db->prepare(
            'UPDATE question SET 
                titre= :titre,
                date=:date,
                type= :type, 
                id_auteur=:id_auteur
            WHERE id = :id'
        );
        $query->execute([
            'titre' => $question->getTitre(),
            'date' => $question->getDate(),
            'type' => $question->getType(),
            'id_auteur' => $question->getId_auteur(),
            'id'=>$id
        ]);
    }
    catch (PDOException $e){
        echo 'Erreur: '.$e->getMessage();
    }
}

public function afficherQuestions() {
    $sql = "SELECT id, titre FROM question";
    $db = config::getConnexion();
    try {
        $query = $db->query($sql);
        return $query->fetchAll();
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}


function recherche($search_value)
{
    $pdo = Config::getConnexion();

    // Requête SQL sécurisée pour éviter les injections SQL
    $sql = "SELECT * FROM question 
            WHERE id LIKE :search_value 
               OR date LIKE :search_value
               OR id_auteur LIKE :search_value 
               OR type LIKE :search_value 
               OR titre LIKE :search_value";

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['search_value' => '%' . $search_value . '%']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Retourner les résultats sous forme de tableau associatif
    } catch (Exception $e) {
        die('Erreur: ' . $e->getMessage());
    }
}




}



?>
 