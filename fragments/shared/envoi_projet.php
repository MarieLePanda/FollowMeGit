<?php
/* ------------------------------------------------------------------------------------ */
/*								APPEL CREATION PROJET									*/
/* ------------------------------------------------------------------------------------ */
		include ($_SERVER['DOCUMENT_ROOT'] . '/FollowMeGit/data/SqlFunction.php');
		include ($_SERVER['DOCUMENT_ROOT'] . '/FollowMeGit/Object/Project.php');
		include ($_SERVER['DOCUMENT_ROOT'] . '/FollowMeGit/Object/User.php');
		echo($_SESSION['user_id']);
		$unUser = new User(13,null,null,null);
		$unProjet = new Project(null,$_POST['name_prj'],$unUser->getId());
		SqlFunction::createProject($unProjet,$unUser);
?>