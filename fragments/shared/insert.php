<?php
/* ------------------------------------------------------------------------------------ */
/*						APPEL CREATION D'UN UTILISATEUR									*/
/* ------------------------------------------------------------------------------------ */
include ($_SERVER['DOCUMENT_ROOT'] . '/follow/data/SqlFunction.php');
$email = $_POST['email'];
$pseudo = $_POST['pseudo'];
$mdp = $_POST['mdp'];
$id = '';
inscription($id,$pseudo,$email,$mdp);
?>
