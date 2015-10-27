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
        require_once('./Model/RSS.class.php');
        require_once('./Model/Nouvelles.class.php');
        require_once('./Model/DAO.class.php');


        // Test de la classe DAO


        // Test si l'URL existe dans la BD
        $url = 'http://www.lemonde.fr/m-actu/rss_full.xml';
        $dao = new DAO;
        $rss = $dao->readRSSfromURL($url);
//        print_r($rss);
//        var_dump($rss);

        if ($rss == NULL) {
          echo $url." n'est pas connu\n";
          echo "On l'ajoute ... \n";
          $rss = $dao->createRSS($url);
        } else {
            echo "rss est déjà connu par la bdd";
        }
//        // Mise à jour du flux
//        var_dump($rss);
        $rss->update();
//        print_r($rss);
        $dao->updateRSS($rss);
        foreach ($rss->nouvelles() as $key) {
          $nvl = new Nouvelles;
          $nvl->update($key);
          $dao->createNouvelle($nvl,1);
        }
        ?>
    </body>
</html>
