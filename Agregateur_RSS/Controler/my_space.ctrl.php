<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once '../Model/DAO.class.php';

$dao = new DAO;
session_start();
$data['infos'] = $dao->readUserfromLogin($_SESSION['username']);
session_write_close();

if (isset($_GET['password1']) and isset($_GET['password2'])) {
    $mp1 = $_GET['password1'];
    $mp2 = $_GET['password2'];
    if($mp1 == $mp2) {
        
        session_start();
        $log = $_SESSION['username'];
        $dao->updateMPfromUser($log, $mp1);
        
        session_write_close();
    } else {
        include('../Views/my_space.view.php');
        echo "<p>Les deux mots de passe ne correspondent pas :(</p>";
    }
} else if(isset($_GET['mail'])) {
    $mail = $_GET['mail'];
    session_start();
    $user = $_SESSION['username'];
//    $data['infos'] = $dao->readUserfromLogin($user);
    session_write_close();
    $dao->updateMailfromUser($user, $mail);
} else {

    include("../Views/my_space.view.php");
}