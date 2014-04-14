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
        	$hashed_password = $user->getPwd();
            $db = SqlFunction::connexion();
        	$name = $user->getName();
        	$mail = $user->getEmail();
        	
            $insert_user = $db->prepare(
            'INSERT INTO utilisateur (pseudo_user,email_user,mdp_user) VALUES (:pseudo_user,:email_user,:mdp_user)'
            );
            $insert_user->bindParam(':pseudo_user', $name);
            $insert_user->bindParam(':email_user', $user->getEmail());
            $insert_user->bindParam(':mdp_user', $hashed_password);
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
                $name = $user->getName();
                $pass = $user->getPwd();
                $insert_user->bindParam(':pseudo_user', $name);
                $insert_user->bindParam(':mdp_user', $pass);
                $insert_user->execute();
                $donnees = $insert_user->fetchAll();
                if ($insert_user->fetchAll() == 0){
                    echo "Erreur dans SqlFunction.php .";                
                    return false;
                }
                $user = new User($donnees[0]['id_user'], $donnees[0]['pseudo_user'], $donnees[0]['email_user'], $donnees[0]['mdp_user']);
                echo("DANS LA FONCTION CONNECTIONUSER DE SQLFUNCTION ---> ".$donnees[0]['id_user']);
                return $user;
                
        	
            }
        catch(PDOException $e){
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        }
    }
    
	/* ------------------------------------------------------------------------------------ */
	/*                         VERIFE SI UTILISATEUR N'EXISTE DEJA                          */
	/* ------------------------------------------------------------------------------------ */
	
	    public static function doesUserExiste($user){
	        try{
	            $db = SqlFunction::connexion();
	            
	            // Je verifie avant si lutilisateur existe
	            $check_if_user_exists = $db->prepare(
	                "SELECT * from utilisateur WHERE pseudo_user = :pseudo_user"
	            );
	            $name = $user->getName();
	            $check_if_user_exists->bindParam(':pseudo_user', $name);
	            $check_if_user_exists->execute();
	            if(count($check_if_user_exists->fetchAll()) >= count(0)){
	                echo " <br /> Le pseudo -> " . $user->getName() . " <- est d�j� utiliser !!";
	                return false;
	            } else {
	                echo " <br /> Le pseudo -> " . $user->getName() . " <- n'est pas utiliser !!";
	            return $user;
	            }
	            // -- -- -- -- -- -- -- -- -- -- -- -- --
	        }catch(PDOException $e){
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
        	echo("WHEEEEEEEEEEEEEEE");
    	try {
    		$db = SqlFunction::connexion();
            $nameP = $project->getName();
            $idU = $user->getId();
	        $insert_user = $db->prepare('INSERT INTO projet(libelle_projet,id_userMaster) VALUES(:libelle_projet,:id_userMaster)');
	       	$insert_user->bindParam(':libelle_projet', $nameP);
	        $insert_user->bindParam(':id_userMaster', $idU);
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
        $id = $user->getId();
        try{
            $db = SqlFunction::connexion();

            $resultats=$db->prepare('SELECT DISTINCT projet.num_projet, projet.libelle_projet, projet.id_userMaster FROM projet,utilisateur WHERE id_userMaster = :id_userMaster '); // on va chercher tous les membres de la table qu'on trie par ordre croissant
            echo $user->getId();
            $resultats->bindParam(':id_userMaster', $id);
			$resultats->execute();	
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

     public static function statut($project){

        $db = SqlFunction::connexion();
        try {
            $resultats = $db->prepare('SELECT *
				FROM statut
				WHERE num_projetRef = :num_projet
				AND id_userMaster = :id_userMaster
            	GROUP BY statut.id_statut'); 

            $projectId = $project->getId();
            $userId = $project->getIdUserMaster();
            $resultats->bindParam(':num_projet', $projectId);
            $resultats->bindParam(':id_userMaster', $userId);
			$resultats->execute();	

            $donnees = $resultats->fetchAll();
            $arrayStatuts = array();

            $i = 0;
            foreach ($donnees as $d){
            	$arrayStatuts[$i] = new statut($d['id_statut'], $d['libelle_statut']);
            	$i++;
            }
            
            return $arrayStatuts;
            
        }catch (PDOException $e) {
            echo "Erreur !: " . $e->getMessage() . "<br/>";
        }
    }
/* ------------------------------------------------------------------------------------ */
/*                     RENVOIS LA LISTE DES LIGNES DE TACHES                                */
/* ------------------------------------------------------------------------------------ */
	public static function priorite($project){
		$db = SqlFunction::connexion();
        try {
            $resultats = $db->prepare('SELECT *
				FROM priorite
				WHERE num_projetRef = :num_projet
				AND id_userMaster = :id_userMaster
            	GROUP BY priorite.id_priorite');
            $projectId = $project->getId();
            $userId = $project->getIdUserMaster();
            $resultats->bindParam(':num_projet', $projectId);
            $resultats->bindParam(':id_userMaster', $userId);
			$resultats->execute();	

            $donnees = $resultats->fetchAll();
            $arrayPriorite = array();
            $i = 0;
            foreach ($donnees as $d){
            	$arrayPriorite[$i] = new priorite($d['id_priorite'], $d['libelle_priorite']);
            	$i++;
            }
            
            return $arrayPriorite;
            
        }catch (PDOException $e) {
            echo "Erreur !: " . $e->getMessage() . "<br/>";
        }
    }
/* ------------------------------------------------------------------------------------ */
/*                             LISTE DES TACHES                                        */
/* ------------------------------------------------------------------------------------ */
    public static function listTask($project){
        $db = SqlFunction::connexion();
        try {
            $resultats = $db->prepare('SELECT *
				FROM tache
				WHERE num_projet = :num_projet
				AND id_userMaster = :id_userMaster
            	GROUP BY tache.id_tache');
            $projectId = $project->getId();
            $userId = $project->getIdUserMaster();
            $resultats->bindParam(':num_projet', $projectId);
            $resultats->bindParam(':id_userMaster', $userId);
			$resultats->execute();	

            $donnees = $resultats->fetchAll();
            $arrayTask = array();
            $i = 0;
            foreach ($donnees as $d){
            	$arrayTask[$i] = new Task($d['id_tache'], $d['libelle_tache'], $d['id_statut'], $d['id_priorite']);
            	$i++;
            }
         }catch (PDOException $e) {
            echo "Erreur !: " . $e->getMessage() . "<br/>";
         }
            return $arrayTask;

    }


    public static function createTask($task, $user, $project){
        	$nameTask = $task->getName();
        	$prioriteTask = $task->getPriorite();
        	$statutTask = $task->getStatut();
        	$idUser = $user->getId();
        	$idUserMaster = $project->$idUserMaster();
        	
    	try {
    		$db = SqlFunction::connexion();
            $nameP = $project->getName();
            $idU = $user->getId();
	        $insert = $db->prepare('INSERT INTO tache(libelle_tache, id_user, id_statut, id_priorite, id_userMaster) VALUES(:libelle_tache, :id_user, :id_statut, :id_priorite, :id_userMaster');
	       	$insert->bindParam(':libelle_tache', $nameTask);
	        $insert->bindParam(':id_user', $idUser);
	        $insert->bindParam(':id_statut', $statutTask);
	        $insert->bindParam(':id_priorite', $prioriteTask);
	        $insert->bindParam(':id_userMaster', $idUserMaster);
			$insert->execute();
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
     public static function getNameProject($project){
        $db = SqlFunction::connexion();
        try {
            $resultats = $db->prepare('SELECT libelle_projet
                FROM projet
                WHERE num_projet = :num_projet');
            $projectId = $project->getId();
            $resultats->bindParam(':num_projet', $projectId);
            $resultats->execute();
            $donnees = $resultats->fetchAll();
            return $donnees[0]['libelle_projet'];
         }catch (PDOException $e) {
            echo "Erreur !: " . $e->getMessage() . "<br/>";
         }
    }
    public static function returnProject($idProject){
        
        try{
            $db = SqlFunction::connexion();

            $resultats=$db->prepare('SELECT DISTINCT projet.num_projet, projet.libelle_projet, projet.id_userMaster FROM projet,utilisateur WHERE num_projet :numProjet '); // on va chercher tous les membres de la table qu'on trie par ordre croissant
            echo $user->getId();
            $resultats->bindParam(':numProjet', $idProject);
            $resultats->execute();  
            $data = $resultats->fetchAll();
            return new Project($data[0]['num_projet'], $data[0]['libelle_projet'], $data[0]['id_userMaster']);
        }
        catch(PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        }
    }
    
    public static function returnUser($idUser){
        
        try{
            $db = SqlFunction::connexion();

            $resultats=$db->prepare('SELECT * FROM utilisateur WHERE id_user :idUser '); // on va chercher tous les membres de la table qu'on trie par ordre croissant
            echo $user->getId();
            $resultats->bindParam(':idUser', $idUser);
            $resultats->execute();  
            $data = $resultats->fetchAll();
            return new User($data[0]['id_user'], $data[0]['pseudo_user'], $data[0]['email_user'], $data[0]['mdp_user']);
        }
        catch(PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        }
    }

}
?>
