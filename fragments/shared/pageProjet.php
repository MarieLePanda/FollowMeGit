<?php
	$page_title = "Follow Me - Page projet ";
	
	include_once ($_SERVER['DOCUMENT_ROOT'] . '/FollowMeGit/fragments/shared/headerSite.php');
	include_once ($_SERVER['DOCUMENT_ROOT'] . '/FollowMeGit/data/SqlFunction.php');
	include_once ($_SERVER['DOCUMENT_ROOT'] . '/FollowMeGit/Object/Project.php');
	include_once ($_SERVER['DOCUMENT_ROOT'] . '/FollowMeGit/Object/User.php');
	include_once ($_SERVER['DOCUMENT_ROOT'] . '/FollowMeGit/Object/Task.php');
	include_once ($_SERVER['DOCUMENT_ROOT'] . '/FollowMeGit/Object/Statut.php');
	include_once ($_SERVER['DOCUMENT_ROOT'] . '/FollowMeGit/Object/Priorite.php');
	$unUser = new User($_SESSION['user_id'],null,null,null);
	$project = new Project($_GET['id'], null, $unUser->getId());
	$statuts = SqlFunction::statut($project);
	$priorite = SqlFunction::priorite($project);
	$nomProjet = SqlFunction::getNameProject($project);
?>
	<div id= "buttons">
		<ul id="side-menu">
			<?php
				echo("<ol><a onClick='onClickButtonAddTask(".$project->getId().");'>Ajouter Collaborateur</a></ol>");
			?>
			<ol><a href="#" onClick="MyWindow=window.open('formulaire.php','Supprimer Collaborateur','height=300,width=650,top=300,left=300'); return false;">Suprimer Collaborateur</a></ol>
			<ol><a href="#" onClick="MyWindow=window.open('formulaire.php','Ajouter une tâche','height=300,width=650,top=300,left=300'); return false;">Ajout une tache</a></ol>
			<ol><a href="#" onClick="MyWindow=window.open('formulaire.php','Modifier une tâche','height=300,width=650,top=300,left=300'); return false;">Modifier une tache</a></ol>
			<ol><a href="#" onClick="MyWindow=window.open('formulaire.php','Supprimer une tâche','height=300,width=650,top=300,left=300'); return false;">Supprimer une tache</a></ol>
			<ol><a href="#" onClick="MyWindow=window.open('formulaire.php','Visualiser Historique','height=300,width=650,top=300,left=300'); return false;">Visualiser historique</a></ol>
		</ul>
	</div>
	<div id="center">
		<div id="TitreProjet"><?php echo $nomProjet ?></div>
		<TABLE id="tableau" BORDER="2">
			<TR>
				<TH></TH>
				<?php
					foreach ($statuts as $s) {
				?>
					<TH> <div id="entree"><?php echo $s->getName()?></div> </TH>
				<?php 
					}
				?>
			</TR>
			<?php
				foreach ($priorite as $p){
			?>
			<TR>
				<TH> <div id="entree"> <?php echo $p->getName()?> </div> </TH>
				<?php 
					foreach ($statuts as $sq){
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
								echo("<div id='uneTache' onClick='onClickTache(".$project->getId().",".$s->getId().",".$p->getId().",".$t->getId().");' class=".$t->getId()." name".$t->getName().">".$t->getName()."</div>");
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
    <?php
        $jsDependencies[] = "/FollowMeGit/res/js/test.js";
    ?>
<script>
	function onClickTache(idProjet,idStatut,idPriorite,idTache){
		setTimeout('location=(\"modificationTache.php?idProjet='+idProjet+'&idTache='+idTache+'&idPriorite='+idPriorite+'&idStatut='+idStatut+'\")');	
		//alert("L'ID du statut est : " + idStatut + "\n " + "L'ID de la priorite est : " + idPriorite + "\n" + "L'ID de la tache est : "+ idTache);
	}
	function onClickButtonAddTask(idProjet){
		setTimeout('location=(\"formulaire.php?idProjet='+idProjet+'\")');	
		//alert("L'ID du statut est : " + idStatut + "\n " + "L'ID de la priorite est : " + idPriorite + "\n" + "L'ID de la tache est : "+ idTache);
	}
</script>