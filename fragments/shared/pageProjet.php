<?php 
	$page_title = "Follow Me - Page projet ";

	include_once ($_SERVER['DOCUMENT_ROOT'] . '/FollowMeGit/fragments/shared/headerSite.php');
	include_once ($_SERVER['DOCUMENT_ROOT'] . '/FollowMeGit/data/sqlFunction.php');
	include_once ($_SERVER['DOCUMENT_ROOT'] . '/FollowMeGit/Object/Project.php');
	include_once ($_SERVER['DOCUMENT_ROOT'] . '/FollowMeGit/Object/User.php');
	include_once ($_SERVER['DOCUMENT_ROOT'] . '/FollowMeGit/Object/Task.php');
	include_once ($_SERVER['DOCUMENT_ROOT'] . '/FollowMeGit/Object/Statut.php');
	include_once ($_SERVER['DOCUMENT_ROOT'] . '/FollowMeGit/Object/Priorite.php');
	
	$project = new Project(1, "follow", 0);
	$user = new User(0, "panda", "panda@gmail.com", "panda");
	$colonnes = SqlFunction::statut($project, $user);
	$lignes = listeLigne(1, 0);
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
								foreach ($colonnes as $c) {
							?> 
								<TH> <div id="entree"><?php echo $c['libelle_statut'] ?></div>  </TH> 
								
							<?php }?>
						</TR> 
						
						<?php 
							foreach ($lignes as $l){ 
							?>
							<TR> 
								<TH> <div id="entree"> <?php echo $l['libelle_priorite']?> </div>  </TH> 
								<?php foreach ($colonnes as $c){
								?>
								<TD> <?php $tache = listeTache($l['id_priorite'], $idProjet, $id_userMaster, $c['id_statut']); 
								if(!empty($tache)){
									foreach ($tache as $t){
										?>
										<!-- <br /> -->
										<div id="tache">
											<?php
											 echo($t['libelle_tache'] . "\n " ."");
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
				<?php include ($_SERVER['DOCUMENT_ROOT'] . '/follow/fragments/shared/footer.php'); ?>
</div>
