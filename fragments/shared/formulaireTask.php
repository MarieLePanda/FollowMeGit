<?php
/* ------------------------------------------------------------------------------------ */
/*					APPEL RECUPERATION IDENTIFIANT DE SESSION							*/
/* ------------------------------------------------------------------------------------ */
session_start();
include($_SERVER['DOCUMENT_ROOT'].'/FollowMeGit/data/SqlFunction.php');
include ($_SERVER['DOCUMENT_ROOT'] . '/FollowMeGit/Object/User.php');
include ($_SERVER['DOCUMENT_ROOT'] . '/FollowMeGit/Object/Project.php');
include ($_SERVER['DOCUMENT_ROOT'] . '/FollowMeGit/Object/Task.php');
$unUser = new User($_SESSION['user_id'],null,null,null);
$user = SqlFunction::returnUser($_SESSION['user_id']);
$project = SqlFunction::returnProject($user);
$projectStatus = SqlFunction::priorite($project);
$task = new Task(null,$_POST['nom_tache'],$_POST['status'],$_POST['']);
?>
<script>
	setTimeout('location=(\"../../index.php\")' ,0);
</script>
