<?php
	session_start();
	include ($_SERVER['DOCUMENT_ROOT'] . '/FollowMeGit/fragments/shared/headerSite.php');
    include ($_SERVER['DOCUMENT_ROOT'] . '/FollowMeGit/data/SqlFunction.php');
    $statuts = SqlFunction::getStatut($_GET['idProjet']);
    $priorite = SqlFunction::getPriorite($_GET['idProjet']);
?>
<meta charset='utf-8'>
<form method="POST" action="#">
	<ul>
		<li><b>ID DU STATUT</b></li><li><input disabled="true" type="text" value="<?php echo $_GET['idStatut'] ?>" placeholder="id statut"/></li>
	<br />
	<br />
	<li><b>PRIORITE</b></li>
	<li>
		<select>
			<?php 
				foreach($priorite as $t){
					echo("<option id=".$t['id_priorite']." name=".$t['libelle_priorite'].">".$t['libelle_priorite']."</option>");
				}
			?>
		</select>
	</li>
	<br />
	<br />
	<li>
		<b>STATUT</b></li>
		<li>
		<select>
			<?php 
				foreach($statuts as $s){
					echo("<option id=".$s['id_statut']." name=".$s['libelle_statut'].">".$s['libelle_statut']."</option>");
				}
			?>
		</select>
	</li>
	<br />
	<br />
	<li><b>Prendre en compte les modifications ?</b></li><li><input type="submit" value="OUI" /><input onClick="redirect();" type="submit" value="NON"/></li>
</form>
<?php
   $jsDependencies[] = "/FollowMeGit/res/js/test.js";

?>
<style>
	ul,li{
		list-style-type: none;
	}
</style>
<script>
function redirect(){
	setTimeout('location=(\"../../index.php\")' ,0);
}
</script>