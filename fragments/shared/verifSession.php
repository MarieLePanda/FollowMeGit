<?php
/* ------------------------------------------------------------------------------------ */
/*					APPEL RECUPERATION IDENTIFIANT DE SESSION							*/
/* ------------------------------------------------------------------------------------ */
include($_SERVER['DOCUMENT_ROOT'].'/follow/data/SqlFunction.php');
include ($_SERVER['DOCUMENT_ROOT'] . '/follow/Object/User.php');
session_start();
$user = new User(null, $_POST['pseudoco'], null, $_POST['mdpco']);
$user = $user->connection();
$_SESSION['user_id'] = $user->getId();
?>
<script>
	setTimeout('location=(\"../../index.php\")' ,0);
</script>