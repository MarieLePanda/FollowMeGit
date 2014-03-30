<?php
/* ------------------------------------------------------------------------------------ */
/*						APPEL CREATION D'UN UTILISATEUR									*/
/* ------------------------------------------------------------------------------------ */
session_start();
include ($_SERVER['DOCUMENT_ROOT'] . '/follow/data/SqlFunction.php');
include ($_SERVER['DOCUMENT_ROOT'] . '/follow/Object/User.php');
$email = $_POST['email'];
$pseudo = $_POST['pseudo'];
$mdp = $_POST['mdp'];
$id = '';

$user = new User($id, $pseudo, $email, $mdp);
$user->subscribe();
$user = $user->connection();
setcookie('userObject',serialize($user));
$_SESSION['user_id'] = $user->getId();
header("location:/follow/index.php"); 

?>
