<?php
      // Test de la classe RSS
      require_once('RSS.class.php');

      // Une instance de RSS
      $rss = new RSS('http://www.lemonde.fr/m-actu/rss_full.xml');

      // Charge le flux depuis le réseau
      $rss->update();

      // Affiche le titre
      echo $rss->titre()."\n";
      echo "dernière mise à jour le : ".$rss->date()."\n";
?>