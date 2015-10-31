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
    session_start();
    $abo = $dao->readAbofromUser($_SESSION['username']);
    foreach ($abo as $key){
        var_dump($key);
    }
    $data['abo'] = 1; // on récupère tous les flux de la base
    $data['rss'] = $dao->readAllRSS();
    session_write_close();
    include("../Views/flux.php");