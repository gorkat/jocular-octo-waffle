<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

    require_once('../Model/DAO.class.php');
    require_once('../Model/RSS.class.php');

    $dao = new DAO;
    
    if(isset($_GET['newAbo'])){
        $rss = $dao->readRSSfromURL($_GET['newAbo']);
        session_start();
        $_SESSION['rss'] = $rss;
        $cut = explode(":", $rss->titre());
        $cat = $cut[0];
        $_SESSION['cat'] = $cat;
        $data['cat'] = $cat;
        $data['titre'] = $rss->titre();
        $data['url'] = $rss->url();
        session_write_close();
        include("../Views/create_abo.view.php");
    }
    
    if(isset($_GET['nom'])){
        session_start();
        $dao->createAbofromUser($_SESSION['username'], $_SESSION['rss']->id(), $_GET['nom'], $_SESSION['cat']);
        session_write_close();
        include("../Controler/afficher_flux.ctrl.php");
    }