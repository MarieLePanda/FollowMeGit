<?php
/* ------------------------------------------------------------------------------------ */
/*                                VUE LISTE PROJET UTILISATEUR                            */
/* ------------------------------------------------------------------------------------ */
if(!empty($_SESSION)){
?>
    <script>
        setTimeout('location=(\"testsession.php\")' ,0);
    </script>
<?php
}else{
    $page_title = "Follow Me - Page perso ";
<<<<<<< HEAD
    include ($_SERVER['DOCUMENT_ROOT'] . '/FollowMeGit/object/User.php');
    include ($_SERVER['DOCUMENT_ROOT'] . '/FollowMeGit/fragments/shared/headerSite.php');
    include ($_SERVER['DOCUMENT_ROOT'] . '/FollowMeGit/data/SqlFunction.php');
    $unUser = new User($_SESSION['user_id'],null,null,null);
    $projets = SqlFunction::viewProject($unUser);
=======
    include_once ($_SERVER['DOCUMENT_ROOT'] . '/FollowMeGit/fragments/shared/headerSite.php');
	include_once ($_SERVER['DOCUMENT_ROOT'] . '/FollowMeGit/data/sqlFunction.php');
	include_once ($_SERVER['DOCUMENT_ROOT'] . '/FollowMeGit/Object/Project.php');
	include_once ($_SERVER['DOCUMENT_ROOT'] . '/FollowMeGit/Object/User.php');
	include_once ($_SERVER['DOCUMENT_ROOT'] . '/FollowMeGit/Object/Task.php');
	include_once ($_SERVER['DOCUMENT_ROOT'] . '/FollowMeGit/Object/Statut.php');
	include_once ($_SERVER['DOCUMENT_ROOT'] . '/FollowMeGit/Object/Priorite.php');
    //$user = unserialize($_COOKIE['userObject']);
    $user = new User($_SESSION['user_id'], NULL, NULL, NULL);
    $projets = SqlFunction::viewProject($user);
>>>>>>> FETCH_HEAD
    ?>
    <div id="TitreListeProjet">
    Liste de vos projets en cours
    </div>
    <img onclick="return afficher();" id="generateForm" src="../../res/img/plus.png" />
        <form method="POST" id="form_create_projet" action="envoi_projet.php">
                Creer un projet
            <br />
            <input type="text" placeholder="Nom du Projet" id="name_prj" name="name_prj"/>
            <br />
            <a onclick="return afficher();"><input type="submit" value="Creer" id="sub"/></a>
        </form>
        <div id='content-projet'>
        <?php foreach ($projets as $ligne){?>
        <ul type="none" id="ligneProjet">
            <li>
                <a id='lien' onclick='recup_num_projet("<?php echo $ligne['num_projet'] ?>");return false;' href='pageProjet.php'>
                    <span id="nomProjet"><b>Projet <?php echo $ligne['libelle_projet'] ?>
                        </b> <br /> Numero de projet : <?php echo $ligne['num_projet'] ?>
                    </span>
                    <cite><?php echo $ligne['pseudo_user'] ?></cite>
                </a>
            </li>
        </ul>
        <?php }
        ?>
    
    <?php
        $jsDependencies[] = "/follow/res/js/test.js";
    ?>
    <?php
        include ($_SERVER['DOCUMENT_ROOT'] . '/FollowMeGit/fragments/shared/footer.php');
}
?>