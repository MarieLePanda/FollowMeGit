<?php 
	session_start();
	$page_title = "Follow Me - Page projet ";

	include ($_SERVER['DOCUMENT_ROOT'] . '/follow/fragments/shared/headerSite.php');
	$idProjet = $_GET['id'];
	$id_userMaster = 1;
	include ($_SERVER['DOCUMENT_ROOT'] . '/follow/data/sqlFunction.php');
	$colonnes = listeColonne($idProjet,1);
	$lignes = listeLigne($idProjet, 1);
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
