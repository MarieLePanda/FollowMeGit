<?php
/* ------------------------------------------------------------------------------------ */
/*								APPEL CREATION PROJET									*/
/* ------------------------------------------------------------------------------------ */
		session_start();
		include ($_SERVER['DOCUMENT_ROOT'] . '/FollowMeGit/data/SqlFunction.php');
		$libelle = $_POST['name_prj'];
		nouveauProjet($libelle,$_SESSION['user_id']);
?>