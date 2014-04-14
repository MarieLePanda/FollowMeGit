
    var subProjet = $('#sub'), 
    	nameProjet = $('#name_prj');

	subProjet.css({
		visibility : 'hidden'
	});
	nameProjet.css({
		visibility : 'hidden'
	});

    function afficher(){
        subProjet.css({
			visibility : 'visible'
		});
		nameProjet.css({
			visibility : 'visible'
		});
		return true;
    }
    function recup_num_projet(value){
		document.location.href="/FollowMeGit/fragments/shared/pageProjet.php?id="+value;
		document.location.href="/FollowMeGit/fragments/shared/modificationTache.php?id="+value;
    	console.log('OBJ', value);
//    	var toto = document.getElementById('lien').value;
    }

