<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Vos Flux</title>
        <link rel="stylesheet" type="text/css" href="../Views/Styles/style.css">
    </head>
    <body>
        <?php include("menu.php")?>
            <nav id="categories">
            <?php
                foreach($data['abo'] as $key){
                    echo '<form action="../Controler/afficher_flux.ctrl.php">';
                    echo '<input type="hidden" value="'.$key['url'].'" name="flux">';
                    echo '<input type="submit" value="'.$key['categorie'].'" name="cat"/>';
                    echo "</form>";
                }
            echo "</nav>";
            echo "<section>";
            if(isset($data['img'])){
                foreach ($data['img'] as $key){
                    echo '<a href="../Controler/afficher_nouvelle.ctrl.php?id='.$key['id'].'"><img src="'.$key['image'].'"/></a>';
                }
            }
            echo "<table>";
                foreach($data['rssNotFollowed'] as $key){
                    echo '<form action="../Controler/user_actions.ctrl.php">';
                    echo '<tr><td>'.$key['titre'].'</td>';
                    echo '<input type="hidden" value="'.$key['url'].'" name="newAbo">';
                    echo '<td><input type="submit" value="S\'abonner"/></td></tr>';
                    echo "</form>";
                }
            echo "</table>";
            
            ?>
        </section>
    </body>
</html>