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
        <section>
            <?php
            echo "<table>";
                foreach($data['abo'] as $key){
                    echo '<tr><td><a href ="afficher_nouvelles.ctrl.php?flux='.$key['url'].'">'.$key['url']."</a></td>";
                    echo '<td><input type="submit" value="Se désabonner" name="action"/></td></tr>';
                }
            echo "</table>";
            echo "<table>";
                foreach($data['rss'] as $key){
                    echo '<tr><td><a href ="afficher_nouvelles.ctrl.php?flux='.$key['url'].'">'.$key['url']."</a></td>";
                    echo '<td><input type="submit" value="S\'abonner" name="action"/></td></tr>';
                }
            echo "</table>";
            ?>
        </section>
    </body>
</html>
