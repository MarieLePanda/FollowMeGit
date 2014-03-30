<?php
/* ------------------------------------------------------------------------------------ */
/*										PAGE INDEX										*/
/* ------------------------------------------------------------------------------------ */ 
session_start();
$page_title = "Follow Me - Index";

include ($_SERVER['DOCUMENT_ROOT'] . '/follow/fragments/shared/header.php');
include ($_SERVER['DOCUMENT_ROOT'] . '/follow/fragments/shared/presentation.php');
if(empty($_SESSION)){
	include ($_SERVER['DOCUMENT_ROOT'] . '/follow/fragments/shared/inscription.php');
}
?>

<?php

include ($_SERVER['DOCUMENT_ROOT'] . '/follow/fragments/shared/footer.php');

?>

