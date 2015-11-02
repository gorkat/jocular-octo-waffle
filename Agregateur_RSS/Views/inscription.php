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
            <table class="log">
                <form action="../Controler/inscription.ctrl.php">
                    <tr><td>Nom d'utilisateur :</td>
                            <td><input type="text" name="login"/>
                    </td></tr>

                    <tr><td>Votre email :</td>
                            <td><input type="email" name="mail" />
                    </td></tr>
                
                    <tr><td>Mot de passe :</td>
                            <td><input type="password" name="password1" />
                    </td></tr>
                    
                    <tr><td>Confirmez le mot de passe :</td>
                            <td><input type="password" name="password2" />
                    </td></tr>
                
                    <tr><td></td>
                        <td><input type="submit" value="S'inscrire">
                    </td></tr>
            </table>
        </section>
    </body>
</html>
