<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Interface administrateur</title>
        <link rel="stylesheet" type="text/css" href="../Views/Styles/style.css" />
    </head>
    <body>
        
        <?php
            include("menu_back_office.view.php");
            
            
            echo '<table id="usersTab"><tr><th>Login</th><th>Mot de passe</th><th>Adresse mail</th><th>Actions</th></tr>';
            
            foreach($data['users'] as $key => $value) {
                echo '<form action="../Controler/back_office.ctrl.php">';
                echo '<tr><th>'.$value['login'].'</th><td>'.$value['mp'].'</td><td>'.$value['mail'].
                        '</td><td><input type="hidden" name="user" value="'.$value['login'].'"/>'
                        . '<input type="text" class="textInput" name="newMP"/><input type="submit" value="Changer mot de passe" name="action"/>'
                        . '<input type="submit" value="Supprimer" name="action"/></td></tr>';
                echo '</form>';
                
            }
            
            echo "</table>"
        ?>
        
    </body>
</html>