<?php
require_once(__DIR__ . '/../config.php');
require_once(__DIR__ . '/../Model/reponse.php');

class reponseC{


    /////////////////////////////////////////////////////   Ajout   //////////////////////////////////////////////////////////////////////

    function ajoutereponse($reponse){
        $sql="INSERT INTO reponse (id_user,date,id_question,choix_rp)
			VALUES (:id_user,:date,:id_question,:choix_rp)";
			$db = config::getConnexion();
			try{
				$query = $db->prepare($sql);
				$query->execute([
                    'id_user' => $reponse->getId_user(),
                    'date' => $reponse->getDate(),
                    'id_question' => $reponse->getId_question(),
                    'choix_rp' => $reponse->getChoix_rp()
                    
				]);		
			}
			catch (Exception $e){
				echo 'Erreur: '.$e->getMessage();
			}	
    }


    /////////////////////////////////////////////////////   Afficher   //////////////////////////////////////////////////////////////////////


           function affichereponse(){
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
    public function listereponse($id_reponse) {
        $db = config::getConnexion();
        try {
            $liste = $db->prepare('SELECT r.id_user , r.id_question ,r.date , r.choix_rp 
            FROM reponse r
            WHERE id_reponse=:id_reponse');
            $liste->execute(['id_reponse' => $id_reponse]);
    
            return $liste;
        } catch(Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }


    function getreponse($id_reponse){
        $db = config::getConnexion();
        try{
            $req=$db->prepare("SELECT * FROM reponse where id_reponse=:id_reponse");
            $req->execute([
                "id_reponse" => $id_reponse
            ]);
            return $req->fetch(); 
        }
        catch (PDOException $e){
            die('Erreur: '.$e->getMessage());
        }
    }





    public function getReponsesByQuestionId($questionId) {
        $db = config::getConnexion();
        try {
            $query = $db->prepare('SELECT * FROM reponse WHERE id_question = :id_question');
            $query->execute(['id_question' => $questionId]);
            return $query->fetchAll();
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }



    /////////////////////////////////////////////////////   Supprimer   //////////////////////////////////////////////////////////////////////




    function supprimereponse($id_reponse){
        $sql="DELETE FROM reponse WHERE id_reponse= :id_reponse";
        $db = config::getConnexion();
        $req=$db->prepare($sql);
        $req->bindValue(':id_reponse',$id_reponse);
        try{
            $req->execute();
        }
        catch (Exception $e){
            echo 'Erreur: '.$e->getMessage();
        }
    }




    /////////////////////////////////////////////////////   Modifier   //////////////////////////////////////////////////////////////////////



    public function modifiereponse($reponse, $id_reponse) {
        $sql = "UPDATE reponse 
                SET id_user = :id_user, 
                    date = :date, 
                    id_question = :id_question, 
                    choix_rp = :choix_rp 
                WHERE id_reponse = :id_reponse";
        
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':id_user', $reponse->getId_user());
            $query->bindValue(':date', $reponse->getDate());
            $query->bindValue(':id_question', $reponse->getId_question());
            $query->bindValue(':choix_rp', $reponse->getChoix_rp());
            $query->bindValue(':id_reponse', $id_reponse, PDO::PARAM_INT); // Assurez-vous que l'ID est bien passé
            $query->execute();
        } catch (Exception $e) {
            echo 'Erreur : ' . $e->getMessage();
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
}
?>