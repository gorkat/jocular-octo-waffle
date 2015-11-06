<!doctype html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<title></title>
	<meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
	<link rel="stylesheet" href="../Views/styles.css">
</head>
<body>
	
	<div id="page">
		<div id="menu">
			<nav>
				<ul>
					<li><a href="../Views/index.html">Accueil</a></li>
					<li class="active"><a href="../Controler/afficher_flux.ctrl.php" >Mes flux</a></li>
                                        <li class="grandeTitre"><a href="../Controler/gerer_abonnements.ctrl.php?action=afficher" >Abonnements</a></li>
                                        <li class="grandeTitre"><a href="../Controler/logging.ctrl.php" >Deconnexion</a></li>
				</ul>
			</nav>
			<div id="recherche">
				<input id="search" type="text" />
			</div>
			<div id="Plus"></div>
	
		</div>
		
		<div id="banniere">
		
		</div>
		
		
			<div id="profils"></div>
                        
                        
                            <?php 
                                echo '<article id="nouvelle">';
                                    echo '<h1 id="titreNvl">'.$data['titre']."</h1>";
                                    echo '<img id="imgNvl" src="'.$data['image'].'">';
                                    echo '<p id="descNvl">'.$data['desc'].'</p>';
                                    echo '<p id="dateNvl">'.$data['date'].'</p>';
                                    echo '<a id="url" href="'.$data['url'].'">Lire plus sur le site ></a>';
                                    echo '<hr>';
                                echo '</article>';
                            ?>
                        <footer>
                            <form action="../Controler/afficher_nouvelle.ctrl.php">
                                <input type="hidden" value="<?= $data['id'] ?>" name="idCourante"/>
                                <input type="submit" value="Precedent" name="prec" />
                            </form>
                            <form action="../Controler/afficher_nouvelle.ctrl.php">
                                <input type="hidden" value="<?= $data['id'] ?>" name="idCourante"/>
                                <input type="submit" value="Suivant" name="suiv" />
                            </form>
                        </footer>                            
</body>
</html>