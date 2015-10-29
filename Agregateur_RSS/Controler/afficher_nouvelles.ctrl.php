<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

    require_once('../Model/RSS.class.php');
    require_once('../Model/Nouvelles.class.php');
    require_once('../Model/DAO.class.php');
    
    $url = $_GET['flux'];
    $dao = new DAO;
    $rss = $dao->readRSSfromURL($url);
    // Mise à jour du flux
    
    $nvls = $dao->returnNouvellesFromRSS($rss->id());

    include("../Views/nouvelles.php");
    
    foreach($nvls as $key) {
        echo "<article>";
            echo "<h1>".$key->titre()."<h1>";
                    echo '<img src="'.'.'.$key->image().'">';
                    echo '<p>'.$key->description().'</p>';
                    echo '<p>'.$key->date().'</p>';
                    echo '<a href="'.$key->lien().'">Lire plus sur le site ></a>';
                    echo '<hr>';
        echo '</article>';
    }
    echo "</section>";