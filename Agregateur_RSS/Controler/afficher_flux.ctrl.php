<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

    require_once('../Model/RSS.class.php');
    require_once('../Model/Nouvelles.class.php');
    require_once('../Model/DAO.class.php');
    
    $dao = new DAO;
    
    $tab = $dao->readAllRSS(); // on récupère tous les flux de la base
    
    
    $i = 0;
    foreach($tab as $key){
        $data[$i] = $key->url();
        $i++;
    }
    
    include("../Views/flux.php");