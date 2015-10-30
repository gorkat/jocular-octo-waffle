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
                
        <?php include("menu_login.php"); //Inclusion d'un morceau de page contenant le menu pour une plus grande facilité de modification de celui ci.?> 
        <section>
        <form action="../Controler/inscription.ctrl.php">
                <p>Nom d'utilisateur :
                <input type="text" name="login"/>
                </p>
                <p>Mot de passe :
                    <input type="password" name="password1" />
                </p>
                <p>Confirmez le mot de passe :
                    <input type="password" name="password2" />
                </p>
                <input type="submit" value="S'inscrire">
        </section>
    </body>
</html>
