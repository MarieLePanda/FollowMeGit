<?php
/* ------------------------------------------------------------------------------------ */
/*							HAUT DE PAGE 'PAGE PERSO'									*/
/* ------------------------------------------------------------------------------------ */
	session_start();
?>
<html>
<head>
  <title><?= $page_title ?></title>
  <!-- link the main style -->
  <link rel="stylesheet" type="text/css" href="/follow/res/stylePagePerso.css"/>
</head>
<body>
<div id="page">
<div id="content-header">
	<ul id="main-menu">
	<a id="logo" href="/">Follow Me</a>
	<li><?php echo("<h1>".$_SESSION['user_id']."</h1>");?></li>
	<li><a href="../../index.php">Accueil</a></li>
	<li><a href="deconnexion.php">Deconnexion</a></li>

	</ul>
</div>
<div id="content">