<?php
	session_start();
	include ($_SERVER['DOCUMENT_ROOT'] . '/FollowMeGit/fragments/shared/headerSite.php');
    include ($_SERVER['DOCUMENT_ROOT'] . '/FollowMeGit/data/SqlFunction.php');
?>
<meta charset='utf-8'>
<form method="POST" action="envoi_modif_task.php">
	<ul>
		<li><b>ID DU STATUT</b></li><li><input type="text" value="<?php echo $_GET['idStatut'] ?>" placeholder="id statut"/></li>
	<br />
	<br />
	<li><b>PRIORITE</b></li>
	<li><select><option> Priorité</option>
			<?php 
				echo("<option id='1' value='uneValeur'></option>");
			?>
	</select></li>
	<br />
	<br />
	<li>
		<b>STATUT</b></li>
		<li>
		<select>
			<option> Statut</option>
			<?php 
				echo("<option id='1' value='uneValeur'></option>");
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