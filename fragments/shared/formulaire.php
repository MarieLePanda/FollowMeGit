<?php
			session_start();
			include($_SERVER['DOCUMENT_ROOT'].'/FollowMeGit/data/SqlFunction.php');
			include ($_SERVER['DOCUMENT_ROOT'] . '/FollowMeGit/Object/User.php');
			include ($_SERVER['DOCUMENT_ROOT'] . '/FollowMeGit/Object/Project.php');
			$project = SqlFunction::returnProject($_GET['idProjet']);
			//$projectStatus = SqlFunction::priorite($project);
?>
	<div id="Center">
		<h1><?php echo $project->getName() ?></h1>
		<form method="POST" id="general" action="formulaireTask.php" onsubmit="return valider();">
			<br /><input type="text" id="nom_tache" name="nom_tache" placeholder="nom de tache"/><br/>
			<SELECT name="statut" size="1">

				<?php foreach ($projectStatus as $t){
					?>
					<option value=<?php echo $t->getId(); ?>> <?php echo $t->getName(); ?></option>

				<?php }?>
			</SELECT>
			<br /><input type="text" id="priority" name="priority" placeholder="priority"/><br/>
			<br /><input type="text" id="Texte" name="contenu_text" placeholder="Entrer du texte"/><br/>
			<br /><input type="submit" id="sub" name="sub" onclick="" value="Create tache"/>
		</form>
	</div>