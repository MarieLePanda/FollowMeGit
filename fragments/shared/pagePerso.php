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
    include ($_SERVER['DOCUMENT_ROOT'] . '/FollowMeGit/fragments/shared/headerSite.php');
    include ($_SERVER['DOCUMENT_ROOT'] . '/FollowMeGit/data/SqlFunction.php');
    $projets = viewProject($_SESSION['user_id']);
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
        <?php }?>
    
    <?php
        $jsDependencies[] = "/follow/res/js/test.js";
    ?>
    <?php
        include ($_SERVER['DOCUMENT_ROOT'] . '/follow/fragments/shared/footer.php');
}
?>