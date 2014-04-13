<?php
/* ------------------------------------------------------------------------------------ */
/*					APPEL RECUPERATION IDENTIFIANT DE SESSION							*/
/* ------------------------------------------------------------------------------------ */
include($_SERVER['DOCUMENT_ROOT'].'/FollowMeGit/data/SqlFunction.php');
include ($_SERVER['DOCUMENT_ROOT'] . '/FollowMeGit/Object/User.php');
session_start();
$user = new User(null, $_POST['pseudoco'], null, $_POST['mdpco']);
echo("Le nom de l'utilisateur est : ".$user->getName()." et son mot de passe est : ".$user->getPwd());
$user = $user->connection();
echo("Le nom de l'utilisateur est : ".$user->getName()." et son mot de passe est : ".$user->getPwd());
$_SESSION['user_id'] = $user->getId();
?>