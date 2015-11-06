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
        require_once('../Model/RSS.class.php');
        require_once('../Model/Nouvelles.class.php');
        require_once('../Model/DAO.class.php');
        $dao = new DAO;

        // Test de la classe DAO
$urls = $dao->readAllRSS();

foreach($urls as $key){
        // Test si l'URL existe dans la BD

        $url = $key['url'];
        $rss = $dao->readRSSfromURL($url);

        if ($rss == NULL) {
          echo $url." n'est pas connu\n";
          echo "On l'ajoute ... \n";
          $rss = $dao->createRSS($url);
        } else {
            echo "rss est déjà connu par la bdd  |  ";
        }
        // Mise à jour du flux
        $rss->update();
        $dao->updateRSS($rss);
        foreach ($rss->nouvelles() as $key) {
                $nvl = new Nouvelles;
                $nvl->update($key);
                $o = $dao->readNouvellefromTitre($nvl->titre(), $rss->id());
                
                if ($o == NULL) {
                        echo $nvl->titre()." n'est pas connu\n";
                        echo "On l'ajoute ... \n";
                        $o = $dao->createNouvelle($nvl, $rss->id());
                } else {
                        echo "\n La nouvelle est déjà connu par la bdd";
                }
                $dao->updateImageNouvelle($nvl);
        }
}
        ?>
    </body>
</html>
