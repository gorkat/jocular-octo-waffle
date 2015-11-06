<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once('../Model/DAO.class.php');

session_start();

if(isset($_SESSION['username'])){
    session_destroy();
    include("../Views/acceuil.view.php");
} else {
        if(isset($_GET['login']) and isset($_GET['password'])) {
        $dao = new DAO;

        $log = $_GET['login'];
        $mp = $_GET['password'];
        $userExists = $dao->readUserfromLoginAndPassWord($log,$mp);

        if($userExists != null) {
            $data['user'] = $log;
            $_SESSION['username'] = $log;
            session_write_close();
            if($log == "admin") {
                include('../Views/back_office.view.php');
            } else {
                include('../Views/index.html');
            }
        } else {
            include('../Views/acceuil.view.php');
            echo "<p>Login ou Mdp incorrect, veuillez vous inscrire ou recommencer !</p>";

        }
    } else {
        include('../Views/acceuil.view.php');
            echo "<p>Veuillez remplir correctement tous les champs !!!</p>";
    }
}
