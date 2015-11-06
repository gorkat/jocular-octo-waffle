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
        <title>Mon espace personnel</title>
    </head>
    <body>
        <?php include("menu.php"); ?>
        <p>Login : <?= $data['infos']['login'] ?></p>
        <table id="perso">
            <form action="../Controler/my_space.ctrl.php" >
                <tr><th>Changer mes informations personnelles</th><th>Informations actuelles</th><th>Mettre à Jour</th></tr>
                <tr><td>Adresse mail : </td><td><?= $data['infos']['mail'] ?></td><td><input type="email" name="mail"/><input type="submit" value="Valider"/></td></tr>
            </form>
            <form action="../Controler/my_space.ctrl.php" >
                <tr><td>Changer mon mot de passe : </td><td>********</td><td><input type="password" name="password1"/><input type="password" name="password2" /><input type="submit" value="Valider"/></td></tr>
            </form>
        </table>
    </body>
</html>
