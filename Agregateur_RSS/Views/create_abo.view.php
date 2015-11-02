<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="../Views/Styles/style.css">
        <title>Nouvel abonnement</title>
    </head>
    <body>
        <?php include("menu.php")?>
        
        <section>
            <form action="../Controler/user_actions.ctrl.php">
                <p>Titre : <?= $data["titre"]?> <br> Url : <?=$data["url"] ?> <br> Catégorie : <?=$data['cat'] ?> </p>
                    <p>Nom de l'abonnement :
                        <input type="text" name="nom" />
                    </p>
                    <input type="submit" value="Confirmer">
            </form>
        </section>
        
    </body>
</html>
