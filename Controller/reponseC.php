<?php
require_once(__DIR__ . '/../Config.php');
require_once(__DIR__ . '/../Model/reponse.php');

class reponseC{

    function ajouterreponse($reponses){
        $sql="INSERT INTO reponse (id_user,date,id_question,choix_rp)
			VALUES (:id_user,:date,:id_question,:choix_rp)";
			$db = config::getConnexion();
			try{
				$query = $db->prepare($sql);
				$query->execute([
                    'id_user' => $reponses->getid_user(),
                    'date' => $reponses->getdate(),
                    'id_question' => $reponses->getid_question,
                    'choix_rp' => $reponses->getchoix_rp()
				]);		
			}
			catch (Exception $e){
				echo 'Erreur: '.$e->getMessage();
			}	
    }

    function afficherreponse(){
        $db =config::getConnexion();
			try{
				$query = $db ->prepare ('select * FROM reponse');
				$query ->execute();
				$result = $query ->fetchAll(); 
				return $result;
			}
            catch(PDOException $e){
				echo 'Erreur: '.$e->getMessage();
			}
    }

    function supprimerreponse($id) {
        $sql1 = "DELETE FROM question WHERE id = :id";
        $sql2 = "DELETE FROM reponse WHERE id = :id";
        $db = config::getConnexion();
    
      
        $req1 = $db->prepare($sql1);
        $req1->bindValue(':id', $id);
        try {
            $req1->execute();
        } catch (Exception $e) {
            echo 'Erreur: ' . $e->getMessage();
        }
    
       
        $req2 = $db->prepare($sql2);
        $req2->bindValue(':id', $id);
        try {
            $req2->execute();
        } catch (Exception $e) {
            echo 'Erreur: ' . $e->getMessage();
        }
    }
    

    function modifierreponse($reponses,$id){
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'UPDATE question SET 
                    titre= :titre, 
                    id_auteur=:id__auteur,
                    date=:date,
                    auteur=:auteur
                   id_event = evenement.id
                FROM question
                WHERE reponse.nom_evenement = evenement.nom
                WHERE id = :id'
            );
            $query->execute([
                'id_user' => $reponses->getid_user(),
                'date' => $reponses->getdate(),
                'id_question' => $reponses->getid_question(),
                'choix_rp' => $reponses->getchoix_rp(),
                'id'=>$id
            ]);
        }
        catch (PDOException $e){
            echo 'Erreur: '.$e->getMessage();
        }
    }   

    function getreponse($id){
        $db = config::getConnexion();
        try{
            $req=$db->prepare("SELECT * FROM reponse where id=:id");
            $req->execute([
                "id" => $id
            ]);
            return $req->fetch(); 
        }
        catch (PDOException $e){
            die('Erreur: '.$e->getMessage());
        }
    }
}


    
/*
 function Triesalle(){
        $sql="SELECT * FROM salles order by dateE";
        $pdo = config::getConnexion();
        try{
            $liste = $pdo->query($sql);
            return $liste;
        }
        catch(Exception $e){
            die('Erreur:' . $e->getMessage());
        }
    }
    function recherche($search_value)
    {
        $sql="SELECT * FROM salles where   (id_salle like '$search_value' or nomE like '%$search_value%' or typeE like '%$search_value%' or dateE like '%$search_value%') ";

        //global $pdo;
        $pdo =Config::getConnexion();

        try{
            $result=$pdo->query($sql);

            return $result;

        }
        catch (Exception $e){
            die('Erreur: '.$e->getMessage());
        }
    }



*/

?>