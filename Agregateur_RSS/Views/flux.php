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
        <section>
            <hr>
            <article>
                <h1><?= $data['titre'] ?><h1>
                        <img src="<?= $data['img']?>">
                        <p><?= $data['desc'] ?></p>
                        <p><?= $data['date'] ?>
                        <a href="<?= $data['lien']?>">Lire plus sur le site ></a>
                        <hr>
            </article>
        <?php

        ?>
        </section>
    </body>
</html>
