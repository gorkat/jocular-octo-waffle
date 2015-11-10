<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="../Views/Styles/menu_login_style.css" />
        <title></title>
    </head>
    <body>
        <section id="window">
            <div>
                <p>LOGIN</p>
            </div>
            <div id="inputs">
                <form action="../Controler/logging.ctrl.php"/>
                    <input type="text" value="username" name="login" onfocus="this.value='';"/>
                    <input type="text" value="password" name="password" onfocus="this.value='';this.type='password';"/>
                
            </div>
            <div>
                    <input id="ok" type="submit" value="Ok" />
                </form>
                <p><a href="../Controler/inscription.ctrl.php">sign up</a></p>
                <p><a href="#">lost password</a></p>
            </div>
        </section>
    </body>
</html>
