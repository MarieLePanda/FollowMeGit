<?php
/* ------------------------------------------------------------------------------------ */
/*								APPEL CREATION PROJET									*/
/* ------------------------------------------------------------------------------------ */
		session_start();
		include ($_SERVER['DOCUMENT_ROOT'] . '/FollowMeGit/data/SqlFunction.php');
		include ($_SERVER['DOCUMENT_ROOT'] . '/FollowMeGit/Object/Project.php');
		include ($_SERVER['DOCUMENT_ROOT'] . '/FollowMeGit/Object/User.php');
		$unUser = new User($_SESSION['user_id'],null,null,null);
		$unProjet = new Project(null,$_POST['name_prj'],$unUser->getId());
		SqlFunction::createProject($unProjet,$unUser);
?>
<script>
	setTimeout('location=(\"../../index.php\")' ,0);
</script>