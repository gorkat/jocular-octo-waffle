<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" type="text/css" href="../Views/Styles/style.css" />
    </head>
    <body>
        <?php include("menu.php"); //Inclusion d'un morceau de page contenant le menu pour une plus grande facilité de modification de celui ci.?>
        <p>Bonjour <?= $data['user'] ?> ! </p>
        <p>Bonne visite sur rss_VIP.com !</p>
    </body>
</html>
