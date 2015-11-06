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
        <?php include("menu_back_office.view.php"); ?>
        <h3>Ajouter un nouveau flux</h3>
        <form action="../Controler/back_office.ctrl.php" >
            <table><tr><td>Url :</td>
                    <td><input type="url" name="flux" /></td>
                <td></td><td>
                    <input type="submit" value="Ajouter" />
                    <input type="hidden" name="arg" value="addFlux" />
                </td></tr>
            
        </form>

    </body>
</html>
