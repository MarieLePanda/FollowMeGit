<?php
/* ------------------------------------------------------------------------------------ */
/*								APPEL CREATION PROJET									*/
/* ------------------------------------------------------------------------------------ */
		session_start();
		include ($_SERVER['DOCUMENT_ROOT'] . '/follow/data/SqlFunction.php');
		$libelle = $_POST['name_prj'];
		nouveauProjet($libelle,$_SESSION['user_id']);
?>