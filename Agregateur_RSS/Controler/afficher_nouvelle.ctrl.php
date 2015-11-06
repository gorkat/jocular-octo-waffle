<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

    require_once('../Model/DAO.class.php');
    require_once('../Model/Nouvelles.class.php');
    
    $dao = New DAO;
    
    if(isset($_GET['prec'])){
        session_start();
        $currentRSS_id = $_SESSION['currentRSS_id'];
        session_write_close();
        $tab = $dao->findMinMaxNouvellesFromRSS($currentRSS_id);
        $minID = $tab['min(n.id)'];
        if($_GET['idCourante'] > $minID){
            $nouvelle = $dao->readNouvelleFromID($_GET['idCourante'] - 1);
            $data['titre'] = $nouvelle->titre();
            $data['image'] = $nouvelle->image();
            $data['url'] = $nouvelle->url();
            $data['date'] = $nouvelle->date();
            $data['desc'] = $nouvelle->description();
            $data['id'] = $nouvelle->id();
            include("../Views/afficher_nouvelle.view.php");
        } else {
            include("afficher_flux.ctrl.php");
        }
    }
    
    if(isset($_GET['suiv'])){
        session_start();
        $currentRSS_id = $_SESSION['currentRSS_id'];
        session_write_close();
        $tab = $dao->findMinMaxNouvellesFromRSS($currentRSS_id);
        $maxID = $tab['max(n.id)'];
        if($_GET['idCourante'] < $maxID){
            $nouvelle = $dao->readNouvelleFromID($_GET['idCourante'] + 1);
            $data['titre'] = $nouvelle->titre();
            $data['image'] = $nouvelle->image();
            $data['url'] = $nouvelle->url();
            $data['date'] = $nouvelle->date();
            $data['desc'] = $nouvelle->description();
            $data['id'] = $nouvelle->id();
            include("../Views/afficher_nouvelle.view.php");
        } else {
            include("afficher_flux.ctrl.php");
        }
    }
    
    if(isset($_GET['id'])){
    
        $nouvelle = $dao->readNouvelleFromID($_GET['id']);
        $data['titre'] = $nouvelle->titre();
        $data['image'] = $nouvelle->image();
        $data['url'] = $nouvelle->url();
        $data['date'] = $nouvelle->date();
        $data['desc'] = $nouvelle->description();
        $data['id'] = $nouvelle->id();
        include("../Views/afficher_nouvelle.view.php");
    }