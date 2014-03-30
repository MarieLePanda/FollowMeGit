<?php
/* ------------------------------------------------------------------------------------ */
/*							FORMULAIRE D'INSCRIPTION									*/
/* ------------------------------------------------------------------------------------ */
//session_start();
?>
<div id="inscription">
	<form method="POST" id="general" action="fragments/shared/insert.php" onsubmit="return valider()">
		<br /><input type="text" id="email" name="email" placeholder="E-mail"/><br/>
		<br /><input type="text" id="pseudo" name="pseudo" placeholder="Nom utilisateur"/><br/>
		<br /><input type="password" id="mdp" name="mdp" placeholder="Mot de passe"/><br/>
		<br /><input type="submit" id="sub" name="sub" onclick="envoyer();" value="S'inscrire"/>
		<!--<div id="btnInscrire"></div> -->
	</form>
</div>
	<script>
		var email = document.getElementById('general').email;
		var pseudo = document.getElementById('general').pseudo;
		var mdp = document.getElementById('general').mdp;
		function valider(unChamp){
		  // si la valeur du champ prenom est non vide
		  if(email.value == "") {
				alert("Email nulle");
		   return false;
		  }else if (pseudo.value == ""){   
		   alert("Pseudo nul");
		   return false;
		  }else if (mdp.value == ""){
		  	alert("Mot de passe nul");
		  	return false;
		  }else {
		  	bonmail(email.value);
		    return true;
		  }
		}
		function bonmail(unMail)
		{
			var reg = new RegExp('^[a-z0-9]+([_|\.|-]{1}[a-z0-9]+)*@[a-z0-9]+([_|\.|-]{1}[a-z0-9]+)*[\.]{1}[a-z]{2,6}$', 'i');
			if(reg.test(unMail))
			{
				return(true);
			}
			else
			{
				alert("Adresse Mail invalide !");
				setTimeout('location=(\"../../index.php\")' ,0);
				return(false);
			}
		}
</script>
