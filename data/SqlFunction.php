<?php
class SqlFunction{
/* ------------------------------------------------------------------------------------ */
/*                                    REQUETAGE SQL                                        */
/* ------------------------------------------------------------------------------------ */
/* ------------------------------------------------------------------------------------ */
/*                         CONNEXION BASE DE DONNEES                                        */
/* ------------------------------------------------------------------------------------ */
    public static function connexion(){
        try{
            $db = new PDO('mysql:host=localhost;dbname=testfollow1', "root", "root");
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $db;
        }catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        }
    }
/* ------------------------------------------------------------------------------------ */
/*                         CREATION D'UN UTILISATEUR                                        */
/* ------------------------------------------------------------------------------------ */
    public static function subscribe($user){
        try{
        	$db = SqlFunction::connexion();
            $insert_user = $db->prepare(
            'INSERT INTO utilisateur (pseudo_user,email_user,mdp_user) VALUES (:pseudo_user,:email_user,:mdp_user)'
            );
            $insert_user->bindParam(':pseudo_user', $user->getName());
            $insert_user->bindParam(':email_user', $user->getEmail());
            $insert_user->bindParam(':mdp_user', $user->getPwd());
            $insert_user->execute();
    
        /*<script>
        alert('***** Vous avez bien ete enregistre ****');
        setTimeout('location=(\"../../index.php\")' ,0);
        </script>*/
   
        }catch(PDOException $e){
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        }
    }
    
     public static function connectionUser($user){
        try{
	            $db = SqlFunction::connexion();
	            $insert_user = $db->prepare(
	                "SELECT * FROM utilisateur WHERE pseudo_user = :pseudo_user AND mdp_user = :mdp_user"
	            );
	            $insert_user->bindParam(':pseudo_user', $user->getName());
	            $insert_user->bindParam(':mdp_user', $user->getPwd());
	            $insert_user->execute();
	            $donnees = $insert_user->fetchAll();
	            $user = new User($donnees[0]['id_user'], $donnees[0]['pseudo_user'], $donnees[0]['email_user'], $donnees[0]['mdp_user']);
	            return $user;
            }
        catch(PDOException $e){
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        }
    }
/* ------------------------------------------------------------------------------------ */
/*                     RETOURNE IDENTIFIANT DE LA SESSION                                    */
/* ------------------------------------------------------------------------------------ */
    public static function cookieUser($unPseudo){
        try{
            $db = SqlFunction::connexion();
            $rep = $db->prepare(
                "SELECT id_user FROM utilisateur WHERE pseudo_user = ?"
            );
            if ($rep->execute(array($unPseudo))) {
                $donnees = $rep->fetchAll();
                return $donnees[0]['id_user'];
            }
        $db = null;
        }catch(PDOException $e){
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        }
    }
   	
/* ------------------------------------------------------------------------------------ */
/*                             CREATION D'UN PROJET                                        */
/* ------------------------------------------------------------------------------------ */
    public static function createProject($project, $user){
        	
    	try {
    		$db = SqlFunction::connexion();
	        $insert_user = $db->prepare('INSERT INTO projet(libelle_projet,id_userMaster) VALUES(:libelle_projet,:id_userMaster)');
	       	$insert_user->bindParam(':libelle_projet', $project->getName());
	        $insert_user->bindParam(':id_userMaster', $user->getId());
			$insert_user->execute();
			
    	}
    	 catch(PDOException $e) {
                print "Erreur !: " . $e->getMessage() . "<br/>";
            	die();
        	}
           /*<script>
            alert('***** Le projet a bien ete creer ****');
            setTimeout('location=(\"../../fragments/shared/pagePerso.php\")' ,0);
        </script>*/

     }
 
/* ------------------------------------------------------------------------------------ */
/*                                 LISTER DES PROJETS                                        */
/* ------------------------------------------------------------------------------------ */
    public static function viewProject($user){
        try{
            $db = SqlFunction::connexion();
            $resultats=$db->prepare('SELECT DISTINCT projet.num_projet, projet.libelle_projet, projet.id_userMaster FROM projet,utilisateur WHERE id_userMaster = :id_userMaster'); // on va chercher tous les membres de la table qu'on trie par ordre croissant
            $resultats->bindParam(':id_userMaster', $user->getid());
			$resultats->execute();
			/*
                $projectArray(array_count_values($data));
    			$i = 0;
    			foreach($d as $data)
    			{
    				$projectArray[$i] = new Project($data[$i]['num_projet'], $data[$i]['libelle_projet'], $data[$i]['id_userMaster']);
    				$i++;
    			}
            */
			return $resultats->fetchAll();
        }
        catch(PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
        	die();
        }
    }

/* ------------------------------------------------------------------------------------ */
/*                         LISTE DES COLONNES DE TACHES                                    */
/* ------------------------------------------------------------------------------------ */
     public static function listeColonne($num_projet, $id_userMaster){
        $db = SqlFunction::connexion();
        try {
            $reponse = $db->prepare('SELECT DISTINCT statut.*
            FROM statut, projet, utilisateur
            WHERE statut.num_projetRef = projet.num_projet
            AND statut.id_userMaster = projet.id_userMaster
            AND statut.num_projetRef = :num_projet
            AND statut.id_userMaster = :id_userMaster
            GROUP BY statut.id_statut');

            $reponse->execute(array(':num_projet'=>$num_projet,':id_userMaster'=> $id_userMaster));
            return $reponse->fetchAll();
        }catch (PDOException $e) {
            echo "Erreur !: " . $e->getMessage() . "<br/>";
        }
    }
/* ------------------------------------------------------------------------------------ */
/*                     RENVOIS LA LISTE DES LIGNES DE TACHES                                */
/* ------------------------------------------------------------------------------------ */
	public static function listeLigne($num_projet, $id_userMaster){
	    $db = SqlFunction::connexion();
	    try {
	        $reponse = $db->prepare('SELECT priorite.*
	        FROM priorite, projet, utilisateur
	        WHERE priorite.num_projetRef = projet.num_projet
	        AND priorite.id_userMaster = projet.id_userMaster
	        AND priorite.num_projetRef = :num_projet
	        AND priorite.id_userMaster = :id_userMaster
	        GROUP BY priorite.id_priorite');
	        $reponse->execute(array(':num_projet'=>$num_projet,':id_userMaster'=> $id_userMaster));
	        return $reponse->fetchAll();
        } catch (PDOException $e) {
            echo "Erreur !: " . $e->getMessage() . "<br/>";
        }
    }
/* ------------------------------------------------------------------------------------ */
/*                             LISTE DES TACHES                                        */
/* ------------------------------------------------------------------------------------ */
    public static function listeTache($id_priorite, $num_projet, $id_userMaster, $id_statut){
        $db = SqlFunction::connexion();
        try {
            $reponse = $db->prepare('select tache.* 
            from tache, projet, statut, priorite
            where tache.id_statut = statut.id_statut
            AND tache.num_projet = projet.num_projet
            AND tache.id_userMaster = projet.id_userMaster
            AND tache.id_priorite = priorite.id_priorite
            AND tache.id_priorite = :id_priorite
            and tache.num_projet = :num_projet
            and tache.id_userMaster = :id_userMaster
            and tache.id_statut = :id_statut');

            $reponse->execute(array(':id_priorite'=>$id_priorite, ':num_projet'=>$num_projet,':id_userMaster'=> $id_userMaster, ':id_statut'=>$id_statut));
            return $reponse->fetchAll();
        }catch (PDOException $e) {
            echo "Erreur !: " . $e->getMessage() . "<br/>" . $e->getLine();
        }
    }
}