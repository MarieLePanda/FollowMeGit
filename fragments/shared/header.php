<?php
/* ------------------------------------------------------------------------------------ */
/*									HAUT DE PAGE 'INDEX'								*/
/* ------------------------------------------------------------------------------------ */
?>
<html>
	<head>
	   <title><?php $page_title ?></title>
	   <!-- link the main style -->
	   <link rel="stylesheet" type="text/css" href="/follow/res/stylePagePerso.css"/>
	</head>
	<body>
	<div id="page">
	<div id="content-header">
	<form method="POST" action="fragments/shared/verifSession.php" onsubmit="return validerConnex()" id="fm_con">
	<ul id="main-menu">
		<a id="logo" href="../../index.php">Follow Me</a>
		<?php
		if(empty($_SESSION)){
		?>
			<li>
				<input id="pseudoco" name="pseudoco" type="text" placeholder="pseudo"/>
				<input id="mdpco" name="mdpco" type="password" placeholder="Mot de passe"/>
				<input id="sub" type="submit" value="Connexion"/></li>
		<?php 
		}else{
		?>
			<li><a href="fragments/shared/deconnexion.php">Deconnexion</a></li>
			<li><a href="fragments/shared/pagePerso.php">Projet</a></li>
		<?php
		}
		?>
	</ul>
</form>
</div>
	<script>
		var pseudoco = document.getElementById('fm_con').pseudoco;
		var mdpco = document.getElementById('fm_con').mdpco;
		function validerConnex(){
			if(pseudoco.value == ""){
				alert("Entrer un Pseudo !");
				return false;
			}else if(mdpco.value == ""){
				alert("Entrer un Mot de passe !");
				return false;
			}else if(mdpco.value.length < 5){
				alert("Mot de Passe Incorrecte !");
				return false;
			}else{
				return true;
			}
		}
	</script>
	<div id="content">