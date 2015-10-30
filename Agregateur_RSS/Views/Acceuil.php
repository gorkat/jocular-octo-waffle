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
        <link rel="stylesheet" type="text/css" href="../Views/Styles/style.css" />
    </head>
    <body>
        <?php include("menu_login.php"); //Inclusion d'un morceau de page contenant le menu pour une plus grande facilité de modification de celui ci.?> 
        <section>
            <p>Vous êtes sur la page d'Acceuil de l'agregateur RSS de Nous ;) </p>
            <p>Veuillez vous logger pour consulter vos flux, ou le cas échéant vous inscrire ;)</p>
            
            <form action="../Controler/logging.ctrl.php">
                <p>Nom d'utilisateur :
                    <input type="text" name="login"/>
                </p>
                <p>Mot de Passe :
                    <input type="password" name="password"/>
                </p>
                    <input type="submit" value="Se connecter">
  </form>
        </section>
    </body>
</html>
