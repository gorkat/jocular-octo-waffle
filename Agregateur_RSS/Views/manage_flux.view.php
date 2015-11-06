<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="../Views/Styles/style.css" />
        <title></title>
    </head>
    <body>
        <?php include("menu_back_office.view.php"); ?>
        <?php
            echo '<table class="abo">';
            echo '<tr><th>Titre du Flux</th><th>Nom</th><th>Action</th></tr>';
                foreach($data['RSS'] as $key){
                    echo '<form action="../Controler/back_office.ctrl.php">';
                    echo '<tr><td>'.$key['titre'].'</td>';
                    echo '<td>'.$key['url'].'</td>';
                    echo '<input type="hidden" value="manageFlux" name="arg">';
                    echo '<input type="hidden" value="'.$key['url'].'" name="flux">';
                    echo '<td><input type="submit" value="Supprimer"/></td></tr>';                    
                    echo "</form>";
                }
            echo '</table>';
        ?>
    </body>
</html>
