<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('../Model/DAO.class.php');

if(isset($_GET['login']) and isset($_GET['password1']) and isset($_GET['password2']) and isset($_GET['mail'])) {
    
    $mp1 = $_GET['password1'];
    $mp2 = $_GET['password2'];
    $mail = $_GET['mail'];
    
    if($mp1 == $mp2) {
        $dao = new DAO;
        
        $log = $_GET['login'];
        
        $doneCreate = $dao->createNewUser($log, $mp1, $mail);
        
        if($doneCreate) {
            session_start();
            $_SESSION['username'] = $log;
            session_write_close();
            $data['user'] = $log;
            include('../Views/index.html');
            echo "<p>Bienvenue parmis nous ".$log.", vous êtes désormais inscrits sur le site :) </p>";
        } else {
            include('../Views/inscription.view.php');
            echo "<p>Désolé, ce nom d'utilisateur est déjà pris :(</p>";
        }
    } else {
        include('../Views/inscription.view.php');
        echo "<p>Les deux mots de passe ne correspondent pas :(</p>";
    }
} else {
    include('../Views/inscription.view.php');
    echo "<p>Veuillez remplir tout les champs pour procéder à votre inscription !</p>";
}