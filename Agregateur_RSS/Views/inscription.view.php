<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="../Views/Styles/menu_inscription_style.css"/>
        <title></title>
    </head>
    <body>
        <section id="window">
            <div>
                <p>LOGIN</p>
            </div>
            <div id="inputs">
                <form action="../Controler/inscription.ctrl.php"/>
                    <input type="text" value="username" name="login"/>
                    <input type="mail" value="mail" name="mail" />
                    <input type="password" value="password1" name="password1"/>
                    <input type="password" value="password2" name="password2"/>
            </div>
            <div>
                 
                <input id="ok" type="submit" value="Ok" />
                </form>
                <p><a href="../Controler/logging.ctrl.php">sign in</a></p>
                <p><a href="#">lost password</a></p>
                
            </div>
        </section>
    </body>
</html>