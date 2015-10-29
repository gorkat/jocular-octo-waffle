<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('../Model/DAO.class.php');

if(isset($_GET['login']) and isset($_GET['password1']) and isset($_GET['password2'])) {
    
    $mp1 = $_GET['password1'];
    $mp2 = $_GET['password2'];
    
    if($mp1 == $mp2) {
        $dao = new DAO;
        
        $log = $_GET['login'];
        
        $doneCreate = $dao->createNewUser($log, $mp1);
        
        if($doneCreate) {
            include('../Views/Acceuil_user_logged.php');
            echo "<p>Bienvenue parmis nous ".$log.", vous êtes désormais inscrits sur le site :) </p>";
        } else {
            include('../Views/inscription.php');
            echo "<p>Désolé, ce nom d'utilisateur est déjà pris :(</p>";
        }
    } else {
        include('../Views/inscription.php');
        echo "<p>Les deux mots de passe ne correspondent pas :(</p>";
    }
} else {
    include('../Views/inscription.php');
    echo "<p>Veuillez remplir tout les champs pour procéder à votre inscription !</p>";
}