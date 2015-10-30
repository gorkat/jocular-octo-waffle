<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
if(isset($_SESSION['username'])){
    $data['user'] = $_SESSION['username'];
    include("../Views/Acceuil_user_logged.php");
} else {
    include("../Views/Acceuil.php");
}
session_write_close();