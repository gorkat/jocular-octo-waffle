<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

    require_once('../Model/DAO.class.php');
    require_once '../Model/RSS.class.php';
    $dao = new DAO;
    session_start();
    $abo = $dao->readAbofromUser($_SESSION['username']);
    $data['abo'] = $dao->readAbofromUser($_SESSION['username']); // on récupère tous les abonnements de l'utilisateur
    
    
    if(isset($_GET['flux'])){
        $url = $_GET['flux'];
        
        $currentRss = $dao->readRSSfromURL($url);
        $id = $currentRss->id();
        $_SESSION['currentRSS'] = $_GET['flux'];
        $data['img'] = $dao->readImgFromRSS($id);
    }
    
    
    if(isset($_GET['maj'])){ // Si l'utilisateur clique sur le bouton Rafaraichir
    /*---------------- Mise à jour des nouvelles du flux -----------------*/
    $url = $_SESSION['currentRSS'];
    $rss = $dao->readRSSfromURL($url);
    // Mise à jour du flux
    $rss->update();
    $dao->updateRSS($rss);

        foreach ($rss->nouvelles() as $key) {   // On cherche à insérer les nouvelles "fraîches" dans la bdd
                $nvl = new Nouvelles;
                $nvl->update($key);
                $o = $dao->readNouvellefromTitre($nvl->titre(), $rss->id());    // On regarde si la nouvelle est déjà dans la base

                if ($o == NULL) {                                               // Si elle n'y figure pas,
                        $o = $dao->createNouvelle($nvl, $rss->id());            // On l'y ajoute
                        $dao->updateImageNouvelle($o);                          // On télécharge son image
                }
        }
        
        $currentRss = $dao->readRSSfromURL($url);
        $id = $currentRss->id();
        $data['img'] = $dao->readImgFromRSS($id);
    /*--------------------------------------------------------------------*/        
    }
    
    if ($data['abo'] == null) {
        $data['rssNotFollowed'] = $dao->readAllRSS();
    } else {
        $data['rssNotFollowed'] = $dao->retrieveRSSnotFollowedByUser($_SESSION['username']);
    }
    
    session_write_close();
    include("../Views/flux.php");
    
