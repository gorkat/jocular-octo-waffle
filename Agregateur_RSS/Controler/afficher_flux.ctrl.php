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
        $currentRss = $dao->readRSSfromURL($_GET['flux']);
        $id = $currentRss->id();

        $data['img'] = $dao->readImgFromRSS($id);
    }
    if ($data['abo'] == null) {
        $data['rssNotFollowed'] = $dao->readAllRSS();
    } else {
        $data['rssNotFollowed'] = $dao->retrieveRSSnotFollowedByUser($_SESSION['username']);
    }
    session_write_close();
    include("../Views/flux.php");