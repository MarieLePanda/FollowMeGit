<?php
	$page_title = "Follow Me - Page projet ";
	
	include_once ($_SERVER['DOCUMENT_ROOT'] . '/FollowMeGit/fragments/shared/headerSite.php');
	include_once ($_SERVER['DOCUMENT_ROOT'] . '/FollowMeGit/data/sqlFunction.php');
	include_once ($_SERVER['DOCUMENT_ROOT'] . '/FollowMeGit/Object/Project.php');
	include_once ($_SERVER['DOCUMENT_ROOT'] . '/FollowMeGit/Object/User.php');
	include_once ($_SERVER['DOCUMENT_ROOT'] . '/FollowMeGit/Object/Task.php');
	include_once ($_SERVER['DOCUMENT_ROOT'] . '/FollowMeGit/Object/Statut.php');
	include_once ($_SERVER['DOCUMENT_ROOT'] . '/FollowMeGit/Object/Priorite.php');
	echo("ID DU PROJET --> ".$_GET['id']);
	$unUser = new User($_SESSION['user_id'],null,null,null);
	$project = new Project($_GET['id'], null, $unUser->getId());
	$statuts = SqlFunction::statut($project);
	$priorite = SqlFunction::priorite($project);
?>
	<div id= "buttons">
		<ul id="side-menu">
			<ol><a href="#">Ajouter Collaborateur</a></ol>
			<ol><a href="#">Suprimer Collaborateur</a></ol>
			<ol><a href="#">Ajout une tache</a></ol>
			<ol><a href="#">Modifier une tache</a></ol>
			<ol><a href="#">Supprimer une tache</a></ol>
			<ol><a href="#">Visualiser historique</a></ol>
		</ul>
	</div>
	<div id="center">
		<div id="TitreProjet"> Project Zero </div>
		<TABLE id="tableau" BORDER="2">
			<TR>
				<TH></TH>
				<?php
					foreach ($statuts as $s) {
				?>
					<TH> <div id="entree"><?php echo $s->getName() . "statut"?></div> </TH>
				<?php 
					}
				?>
			</TR>
			<?php
				foreach ($priorite as $p){
			?>
			<TR>
				<TH> <div id="entree"> <?php echo $p->getName() . "priorite"?> </div> </TH>
				<?php 
					foreach ($statuts as $s){
				?>
				<TD> 
					<?php 
						$tache = SqlFunction::listTask($project);
						foreach ($tache as $t){
							if($t->getStatut() == $s->getId() && $t->getPriorite() == $p->getId()){
					?>
					<!-- <br /> -->
					<div id="tache">
							<?php
								echo($t->getName() . "\n " ."");
							?>
					</div>
						<?php
							}
						}?><br/>
				</TD>
				<?php
					}
				?>
			</TR>
			
			<?php
				}
			?>
		
		</TABLE>
	</div>
		<?php include ($_SERVER['DOCUMENT_ROOT'] . '/FollowMeGit/fragments/shared/footer.php'); ?>
	</div>