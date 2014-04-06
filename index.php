<?php
/* ------------------------------------------------------------------------------------ */
/*										PAGE INDEX										*/
/* ------------------------------------------------------------------------------------ */ 
session_start();
$page_title = "Follow Me - Index";

include ($_SERVER['DOCUMENT_ROOT'] . '/FollowMeGit/fragments/shared/header.php');
include ($_SERVER['DOCUMENT_ROOT'] . '/FollowMeGit/fragments/shared/presentation.php');
if(empty($_SESSION)){
	include ($_SERVER['DOCUMENT_ROOT'] . '/FollowMeGit/fragments/shared/inscription.php');
}
?>

<?php

include ($_SERVER['DOCUMENT_ROOT'] . '/FollowMeGit/fragments/shared/footer.php');

?>

