<!doctype html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<title></title>
	<meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
        <link rel="stylesheet" href="../Views/styles.css">
</head>
<body >
	
	<div id="page">
		<div id="menu">
			<nav>
				<ul>
                                    <li ><a href="../Views/index.html">Accueil</a></li>
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
		
		
            <div id="profils">
                <h3>Mes Flux</h3>
                            <?php
                                foreach($data['abo'] as $key){
                                    echo '<form action="../Controler/afficher_flux.ctrl.php">';
                                    echo '<input type="hidden" value="'.$key['url'].'" name="flux">';
                                    echo '<input type="submit" value="'.$key['nom'].'" name="cat"/>';
                                    echo "</form>";
                                }
                                    echo '<form id="maj"action="../Controler/afficher_flux.ctrl.php">';
                                    echo '<input type="submit" value="Rafraichir" name="maj"/>';
                                    echo '</form>';
                            ?>
            </div>

			<div id="films">
                            <div id="blocksfilmsLigneBas">
	
                                    <?php
                                    
                                        if(isset($data['img'])) {
                                            $i = 1;
                                            
                                            foreach($data['img'] as $key){
                                                echo '<div class="blockFilm">';
                                                        echo '<div class="image"><a href="../Controler/afficher_nouvelle.ctrl.php?id='.$key['id'].'"><img src="'.$key['image'].'"/></a></div>';
                                                        echo '<div class="titre">';
                                                                echo '<p class="titre">'.$key['titre'].'</p>';
                                                                echo '<p class="date">'.$key['date'].'</p>';
                                                        echo '</div>';
                                                echo '</div>';
                                                if(($i%4) == 0){
                                                        echo '<div class="rafraichir">';
//                                                                echo '<form action="../Controler/afficher_flux.ctrl.php">';
//                                                                echo '<input type="submit" value="Rafraichir" name="maj"/>';
//                                                                echo '</form>';
                                                        echo '</div>';
                                                        
                                                    echo'</div>';
                                                    echo '<div id="blocksfilmsLigneBas">';
                                                }
                                                $i++;
                                            }
                                        }
                                    ?>
		<footer>
			
		</footer>
	</div>
</body>
</html>