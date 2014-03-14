<?php
include_once ($_SERVER['DOCUMENT_ROOT'] . '/follow/objet/User.php');;
/* ------------------------------------------------------------------------------------ */
/*									REQUETAGE SQL										*/
/* ------------------------------------------------------------------------------------ */



/* ------------------------------------------------------------------------------------ */
/* 						CONNEXION BASE DE DONNEES										*/
/* ------------------------------------------------------------------------------------ */
	function connexion(){
		try{
			$db = new PDO('mysql:host=localhost;dbname=testfollow1', "root", "");
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return $db;
		}catch (PDOException $e) {
	    	print "Erreur !: " . $e->getMessage() . "<br/>";
	    	die();
		}
	}
/* ------------------------------------------------------------------------------------ */
/* 						CREATION D'UN UTILISATEUR										*/
/* ------------------------------------------------------------------------------------ */
	function inscription($id,$pseudo,$email,$mdp){
		try{
			$db = connexion();
			$insert_user = $db->prepare(
			'INSERT INTO utilisateur (id_user,pseudo_user,email_user,mdp_user) VALUES (:id_user,:pseudo_user,:email_user,:mdp_user)'
			);
			$insert_user->bindParam(':id_user', $id);
			$insert_user->bindParam(':pseudo_user', $pseudo);
			$insert_user->bindParam(':email_user', $email);
			$insert_user->bindParam(':mdp_user', $mdp);
			$insert_user->execute();
	?>
		<script>
		alert('***** Vous avez bien ete enregistre ****');
		setTimeout('location=(\"../../index.php\")' ,0);
		</script>
	<?php
		}catch(PDOException $e){
			print "Erreur !: " . $e->getMessage() . "<br/>";
			die();
		}
	}	
	
/* ------------------------------------------------------------------------------------ */
/* 					RETOURNE IDENTIFIANT DE LA SESSION									*/
/* ------------------------------------------------------------------------------------ */
	function cookieUser($unPseudo){
		try{
			$db = connexion();
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
/* 					RETOURNE L'UTILISATEUR DE LA SESSION									*/
/* ------------------------------------------------------------------------------------ */
	function currentUser($unPseudo){
		try{
			$db = connexion();
			$rep = $db->prepare(
				"SELECT * FROM utilisateur WHERE pseudo_user = ?"
			);
			if ($rep->execute(array($unPseudo))) {
				$dataUser = $rep->fetchAll();
				//$user = new User($dataUser[0]['id_user'], $dataUser[0]['pseudo_user'], $dataUser[0]['email_user'], $dataUser[0]['mdp_user']);
				return $dataUser;
			}
		$db = null;
		return $user;
		}catch(PDOException $e){
			print "Erreur !: " . $e->getMessage() . "<br/>";
			die();
		}
	}
/* ------------------------------------------------------------------------------------ */
/* 								LISTER DES PROJETS										*/
/* ------------------------------------------------------------------------------------ */
	function viewProject($id_user){
		
		try{
			$db = connexion();
			$resultats=$db->prepare('SELECT * FROM projet,utilisateur WHERE id_user = ? AND id_userMaster = ? '); // on va chercher tous les membres de la table qu'on trie par ordre croissant
			$resultats->execute(array($id_user, $id_user));
			return $resultats->fetchAll();

			}catch(PDOException $e) {
    			print "Erreur !: " . $e->getMessage() . "<br/>";
    			die();
			}
	}
/* ------------------------------------------------------------------------------------ */
/* 							CREATION D'UN PROJET										*/
/* ------------------------------------------------------------------------------------ */
	function nouveauProjet($unLibelle, $unUserMaster){
		$db = connexion();
 		$req = $db->prepare(
 			'INSERT INTO projet(num_projet,libelle_projet,id_userMaster) VALUES(:num_projet,:libelle_projet,:id_userMaster)'
 		);
 		$req->execute(array(
			'num_projet' => '',
		    'libelle_projet' => $unLibelle,
    		'id_userMaster' => $unUserMaster
       	));
?>
       	<script>
			alert('***** Le projet a bien ete creer ****');
			setTimeout('location=(\"../../fragments/shared/pagePerso.php\")' ,0);
		</script>
<?php
 	}
 	
/* ------------------------------------------------------------------------------------ */
/* 							MODDIFIER UN PROJET											*/
/* ------------------------------------------------------------------------------------ */
 		function updateProject($project){
 			
 		}
/* ------------------------------------------------------------------------------------ */
/* 							SUPPRIMER UN PROJET											*/
/* ------------------------------------------------------------------------------------ */
 	function dropProject($project, $idUserMaster)
 	{
 		
 	}
/* ------------------------------------------------------------------------------------ */
/* 							CREER UNE TACHE												*/
/* ------------------------------------------------------------------------------------ */
 	function insertTask($task)
 	{
 		
 	}	
/* ------------------------------------------------------------------------------------ */
/* 						LISTE DES COLONNES DE TACHES									*/
/* ------------------------------------------------------------------------------------ */
 	function listeColonne($num_projet, $id_userMaster){
		$db = connexion();
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
/* 					RENVOIS LA LISTE DES LIGNES DE TACHES								*/
/* ------------------------------------------------------------------------------------ */
function listeLigne($num_projet, $id_userMaster){
	$db = connexion();
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
/* 							LISTE DES TACHES										*/
/* ------------------------------------------------------------------------------------ */
	function listeTache($id_priorite, $num_projet, $id_userMaster, $id_statut){
		$db = connexion();
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
/* ------------------------------------------------------------------------------------ */
/*									DEVELOPPER PAR :									*/
/*			NIYITEGEKA Pascal															*/
/*						GIRARDIN Lucas													*/
/*									KLARMAN Ivan 										*/
/* ------------------------------------------------------------------------------------ */
?>
