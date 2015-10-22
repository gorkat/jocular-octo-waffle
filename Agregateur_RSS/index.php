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
    </head>
    <body>
        <?php
        require_once('./RSS.class.php');
        require_once('./Nouvelles.class.php');
        // Mise à jour du flux
        $rss->update();
        $dao->updateRSS($rss);

        foreach ($rss->nouvelles() as $key) {
          $nvl = new Nouvelles;
          $nvl->update($key);
          var_dump($nvl);
          $dao->createNouvelle($nvl,1);
        }
        ?>
    </body>
</html>
