<?php
/* ------------------------------------------------------------------------------------ */
/*						APPEL CREATION D'UN UTILISATEUR									*/
/* ------------------------------------------------------------------------------------ */
session_start();
include ($_SERVER['DOCUMENT_ROOT'] . '/FollowMeGit/data/SqlFunction.php');
include ($_SERVER['DOCUMENT_ROOT'] . '/FollowMeGit/Object/User.php');
$email = $_POST['email'];
$pseudo = $_POST['pseudo'];
$mdp = $_POST['mdp'];
$id = '';

$user = new User($id, $pseudo, $email, $mdp);
<<<<<<< HEAD
$does_user_existe = SqlFunction::doesUserExiste($user);
if($does_user_existe == $user){
	echo " On est good !!";
	$user->subscribe();
	// Une fois son compte crée,
	// il vaut mieux qu'il n'y accede pas tout de suite
	// il faut qu'il se connecte par le button connexion
	// $user->connection();
	//setcookie('userObject',serialize($user));
	// $_SESSION['user_id'] = $user->getId();
	echo "<script type='text/javascript'>alert('Compte Créer');</script>";
=======
$user->subscribe();
$user = $user->connection();
setcookie('userObject',serialize($user));
$_SESSION['user_id'] = $user->getId();
header("location:/FollowMeGit/index.php"); 
<<<<<<< HEAD
>>>>>>> FETCH_HEAD
=======
>>>>>>> FETCH_HEAD

}else{
		echo "<script type='text/javascript'>alert('Ce pseudo est déjà pris');</script>";
}
 
// header("location:/FollowMeGit/index.php");
?>
