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
    public function listereponse($id) {
        $db = config::getConnexion();
        try {
            $liste = $db->prepare('SELECT r.id_user , r.id_question ,r.date , r.choix_rp 
            FROM reponse r
            WHERE id=:id');
            $liste->execute(['id' => $id]);
    
            return $liste;
        } catch(Exception $e) {
            die('Error: ' . $e->getMessage());
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



    /////////////////////////////////////////////////////   Supprimer   //////////////////////////////////////////////////////////////////////




    function supprimereponse($id){
        $sql="DELETE FROM reponse WHERE id= :id";
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




    /////////////////////////////////////////////////////   Modifier   //////////////////////////////////////////////////////////////////////



    function modifiereponse($reponse,$id){
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'UPDATE reponse SET 
                    id_user= :id_user,
                    date=:date,
                    id_question= :id_question, 
                    choix_rp=:choix_rp
                WHERE id = :id'
            );
            $query->execute([
                'id_user' => $reponse->getId_user(),
                'date' => $reponse->getDate(),
                'id_question' => $reponse->getId_question(),
                'choix_rp' => $reponse->getChoix_rp(),
                'id'=>$id
            ]);
        }
        catch (PDOException $e){
            echo 'Erreur: '.$e->getMessage();
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