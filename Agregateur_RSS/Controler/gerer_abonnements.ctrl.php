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
    $data['abo'] = $dao->readAbofromUser($_SESSION['username']);                         // on récupère tous les abonnements de l'utilisateur
    $data['rssNotFollowed'] = $dao->retrieveRSSnotFollowedByUser($_SESSION['username']); // Trouve les Flux auxquels l'utilisateur n'est pas abonné
    
    session_write_close();
    
    if(isset($_GET['action']) && $_GET['action'] == "afficher") {
        include("../Views/gerer_abonnements.view.php");
    }
    
        if(isset($_GET['action']) && $_GET['action'] == "S'abonner" && isset($_GET['nom'])){
        $rss = $dao->readRSSfromURL($_GET['flux']); // on récupère l'objet RSS avec le flux passé en paramètre
        $cut = explode(":", $rss->titre());
        $cat = $cut[0];
        $nom = $_GET['nom'];
        $rss_id = $rss->id();
        session_start();
        $dao->createAbofromUser($_SESSION['username'], $rss_id, $nom, $cat);
        session_write_close();
        $data['abo'] = $dao->readAbofromUser($_SESSION['username']);                         // on récupère tous les abonnements de l'utilisateur
        $data['rssNotFollowed'] = $dao->retrieveRSSnotFollowedByUser($_SESSION['username']); // Trouve les Flux auxquels l'utilisateur n'est pas abonné
        include("../Views/gerer_abonnements.view.php");
        } else if (isset($_GET['action']) and $_GET['action'] == "S'abonner" and isset($_GET['nom'])) {
            include("../Views/gerer_abonnements.view.php");
            echo '<p>Veuillez spécifier un nom pour votre nouvel abonnement !</p>';
        }
    
        if(isset($_GET['action']) && $_GET['action'] == "Se désabonner"){
        $rss = $dao->readRSSfromURL($_GET['flux']);
        $id=$rss->id();
        session_start();
        $user=$_SESSION['username'];
        session_write_close();
        $dao->deleteAbofromUserandRSS($user, $id);
        $data['abo'] = $dao->readAbofromUser($_SESSION['username']);                         // on récupère tous les abonnements de l'utilisateur
        $data['rssNotFollowed'] = $dao->retrieveRSSnotFollowedByUser($_SESSION['username']); // Trouve les Flux auxquels l'utilisateur n'est pas abonné
        include("../Views/gerer_abonnements.view.php");
    }