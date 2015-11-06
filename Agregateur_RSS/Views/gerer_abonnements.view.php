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
					<li><a href="../Controler/afficher_flux.ctrl.php" >Mes flux</a></li>
                                        <li  class="active" class="grandeTitre"><a href="../Controler/gerer_abonnements.ctrl.php?action=afficher" >Abonnements</a></li>
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
		
		
			
                        
        <?php
            echo '<table class="abo">';
            echo '<tr><th>Mes abonnements</th><th></th><th></th></tr>';
            echo '<tr><th>Titre du Flux</th><th>Url</th><th>Action</th></tr>';
                foreach($data['abo'] as $key){
                    echo '<form action="../Controler/gerer_abonnements.ctrl.php">';
                    echo '<tr><td>'.$key['titre'].'</td>';
                    echo '<td>'.$key['nom'].'</td>';
                    echo '<input type="hidden" value="'.$key['url'].'" name="flux">';
                    echo '<td><input type="submit" value="Se désabonner" name="action"/></td></tr>';                    
                    echo "</form>";
                }
            echo '</table>';
            echo '<table class="abo">';
            echo '<tr><th>Les autres flux</th><th></th><th></th></tr>';
            echo '<tr><th>Titre du Flux</th><th>Nom</th><th>Action</th></tr>';
                foreach($data['rssNotFollowed'] as $key){
                    echo '<form action="../Controler/gerer_abonnements.ctrl.php">';
                    echo '<tr><td>'.$key['titre'].'</td>';
                    echo '<td><input class="textInput" type="text" name="nom" min="1"/></td>';
                    echo '<td><input type="hidden" value="'.$key['url'].'" name="flux">';
                    echo '<input type="submit" value="S\'abonner" name="action"/></td></tr>';
                    echo "</form>";
                }
            echo "</table>";
            
        ?>
            
    </body>
</html>
