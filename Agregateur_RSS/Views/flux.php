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
                foreach($data as $key){
                    echo '<a href ="afficher_nouvelles.ctrl.php?flux='.$key.'">'.$key."</p>";
                }
            ?>
        </section>
    </body>
</html>
