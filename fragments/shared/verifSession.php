<?php
/* ------------------------------------------------------------------------------------ */
/*					APPEL RECUPERATION IDENTIFIANT DE SESSION							*/
/* ------------------------------------------------------------------------------------ */
include($_SERVER['DOCUMENT_ROOT'].'/follow/data/SqlFunction.php');
session_start();

$_SESSION['user_id'] = cookieUser($_POST['pseudoco']);
//$user = currentUser($_POST['pseudoco']);
setcookie("user", $user);

?>
<script>
	setTimeout('location=(\"../../index.php\")' ,0);
</script>