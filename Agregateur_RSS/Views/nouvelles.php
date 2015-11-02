<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Acceuil</title>
        <link rel="stylesheet" type="text/css" href="../Views/Styles/style.css">
    </head>
    <body>

        <?php include("menu.php"); //Inclusion d'un morceau de page contenant le menu pour une plus grande facilité de modification de celui ci.?> 

            <?php 
                echo '<article id="nouvelle">';
                    echo "<h1>".$data['titre']."<h1>";
                    echo '<img src="'.$data['image'].'">';
                    echo '<p>'.$data['desc'].'</p>';
                    echo '<p>'.$data['date'].'</p>';
                    echo '<a href="'.$data['url'].'">Lire plus sur le site ></a>';
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
