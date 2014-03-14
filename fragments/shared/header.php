<?php
/* ------------------------------------------------------------------------------------ */
/*									HAUT DE PAGE 'INDEX'								*/
/* ------------------------------------------------------------------------------------ */
?>
<html>
	<head>
	   <title><?= $page_title ?></title>
	   <!-- link the main style -->
	   <link rel="stylesheet" type="text/css" href="/follow/res/style.css"/>
	</head>
	<body>
	<div id="page">
	<div id="content-header">
	<form method="POST" action="fragments/shared/verifSession.php" onsubmit="return validerConnex()" id="fm_con">
	<ul id="main-menu">
		<a id="logo" href="#">Follow Me</a>
		<?php
		if(empty($_SESSION['user_id'])){
		?>
			<li>
				<input id="pseudoco" name="pseudoco" type="text" placeholder="pseudo"/>
				<br/>
				<input id="mdpco" name="mdpco" type="password" placeholder="Mot de passe"/>
			</li>
			<li><input id="sub" type="submit" value="Connexion"/></li>
		<?php 
		}else{
		?>
			<li><?php echo($_SESSION['user_id']); ?></li>
			<li><a href="fragments/shared/pagePerso.php">Projet</a></li>
			<li><a href="fragments/shared/deconnexion.php">Deconnexion</a></li>
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