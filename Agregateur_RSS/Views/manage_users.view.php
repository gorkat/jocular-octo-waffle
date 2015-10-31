<html>
    <head>
        <meta charset="UTF-8">
        <title>Interface administrateur</title>
        <link rel="stylesheet" type="text/css" href="../Views/Styles/style.css" />
    </head>
    <body>
        
        <?php
            include("menu_back_office.view.php");
            
            
            echo "<table><tr><th>Login</th><th>Mot de passe</th><th>Adresse mail</th></tr>";
            
//            print_r($data['users']); //[0] => Array ( [login] => admin [mp] => admin )
            foreach($data['users'] as $key => $value) {
                echo '<form action="../Controler/back_office.ctrl.php">';
                echo '<tr><th>'.$value['login'].'</th><td>'.$value['mp'].'</td><td>'.$value['mail'].
                        '</td><td><input type="hidden" name="user" value="'.$value['login'].'"/>'
                        . '<input type="text" name="newMP"/><input type="submit" value="Changer mot de passe" name="action"/></td>'
                        . '<td><input type="submit" value="Supprimer" name="action"/></td></tr>';
                echo '</form>';
                
            }
            
            echo "</table>"
        ?>
        
    </body>
</html>