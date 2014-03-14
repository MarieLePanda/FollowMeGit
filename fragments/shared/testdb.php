<?php	
		$db = new PDO('mysql:host=localhost;dbname=testfollow1', "root", "");
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$resultats=$db->query("SELECT num_projet FROM projet"); // on va chercher tous les membres de la table qu'on trie par ordre croissant
		$resultats->setFetchMode(PDO::FETCH_OBJ); // on dit qu'on veut que le résultat soit récupérable sous forme d'objet
		while( $ligne = $resultats->fetch() ) // on récupère la liste des membres
		{
        	echo 'Projet : '.$ligne->num_projet.'<br />'; // on affiche les membres
		}
		$resultats->closeCursor(); // on ferme le curseur des résultats
 ?>