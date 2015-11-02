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
        if($_GET['idCourante'] > 0){
            $nouvelle = $dao->readNouvelleFromID($_GET['idCourante'] - 1);
            $data['titre'] = $nouvelle->titre();
            $data['image'] = $nouvelle->image();
            $data['url'] = $nouvelle->url();
            $data['date'] = $nouvelle->date();
            $data['desc'] = $nouvelle->description();
            $data['id'] = $nouvelle->id();
            include("../Views/nouvelles.php");
        }
    }
    
    if(isset($_GET['suiv'])){
        if($_GET['idCourante'] > 0){
            $nouvelle = $dao->readNouvelleFromID($_GET['idCourante'] + 1);
            $data['titre'] = $nouvelle->titre();
            $data['image'] = $nouvelle->image();
            $data['url'] = $nouvelle->url();
            $data['date'] = $nouvelle->date();
            $data['desc'] = $nouvelle->description();
            $data['id'] = $nouvelle->id();
            include("../Views/nouvelles.php");
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
        include("../Views/nouvelles.php");
    }