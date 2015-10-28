<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

    require_once('../Model/RSS.class.php');
    require_once('../Model/Nouvelles.class.php');
    require_once('../Model/DAO.class.php');

    $url = 'http://www.lemonde.fr/m-actu/rss_full.xml';
    $dao = new DAO;
    $rss = $dao->readRSSfromURL($url);
    // Mise à jour du flux
    
    $nvls = $dao->returnNouvellesFromRSS($rss->id());
    $i = 0;
    
    
    foreach($nvls as $key) {
        
        if($i < 1) {
            $data['titre'] = $key->titre();
            $data['desc'] = $key->description();
            $data['lien'] = $key->lien();
            $data['img'] = '.'.$key->image();
            $data['date'] = $key->date();
        }
        $i++;
    }

include("../Views/flux.php");


    