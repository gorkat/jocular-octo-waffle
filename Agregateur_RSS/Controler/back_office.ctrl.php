<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once('../Model/DAO.class.php');

$dao = new DAO;

////////////////////////////////////////////////////////////////////////////////
// Fonction d'envoi de mail d'avertissement aux utilisateurs
////////////////////////////////////////////////////////////////////////////////

function sendEmailto($user,$purpose) {
    $dao = new DAO;
    $userInfos = $dao->readUserfromLogin($user);
    if ($purpose == "MPMODIF"){
        $message = "Cher(e) ".$userInfos['login'].", \r\nvotre mot de passe d'accès au site My_rss.fr à été modifié par l'administrateur et est désormais :\r\n"
                . $userInfos['mp']
                . "\r\nNous vous remercions de l'Interêt que vous portez à notre site et vous souhaitons une bonne journée \r\n"
                . "Merci de ne pas répondre à ce mail, il a été envoyé automatiquement !";
        
        $message = wordwrap($message, 70, "\r\n");
        
        $sujet = "Modification de votre mot de passe sur rss_vip.fr";
        
        $mail = $userInfos['mail'];
        
        $sent = mail($mail, $sujet, $message);
        
    } else if($purpose == "REMOVED") {
        $message = "Cher(e) ".$userInfos['login'].", \r\nvotre compte personnel sur le site My_rss.fr à été supprimé par l'administrateur.\r\n"
                . "\r\nNous vous remercions de l'Interêt que vous avez porté à notre site et vous souhaitons une bonne journée \r\n"
                . "Merci de ne pas répondre à ce mail, il a été envoyé automatiquement !";
        
        $message = wordwrap($message, 70, "\r\n");
        
        $sujet = "Supression de votre compte sur rss_vip.fr";
        
        $mail = $userInfos['mail'];
        
        mail($mail, $sujet, $message);
    }
}




////////////////////////////////////////////////////////////////////////////////
//  Interface de modification des utilisateurs
////////////////////////////////////////////////////////////////////////////////

if(isset($_GET['arg']) && $_GET['arg'] == "users") {
    $data['users'] = $dao->retriveAllUsers();

    include("../Views/manage_users.view.php");

}
if(isset($_GET['arg']) && $_GET['arg'] == "manageFlux") {
    if(isset($_GET['flux'])) {
        $url = $_GET['flux'];
        $rss = $dao->readRSSfromURL($url);
        $dao->deleteNouvellesfromRSSID($rss->id());
        $dao->deleteRSSfromUrl($url);
    }
    $data['RSS'] = $dao->readAllRSS();
    
    include("../Views/manage_flux.view.php");
}
    
if(isset($_GET['arg']) && $_GET['arg'] == "addFlux") {
    
    if(isset($_GET['flux'])) {
        $url = $_GET['flux'];
        $rss = $dao->readRSSfromURL($url);

        if ($rss == NULL) {
          echo $url." n'est pas connu\n";
          echo "On l'ajoute ... \n";
          $rss = $dao->createRSS($url);
        } else {
            echo "rss est déjà connu par la bdd  |  ";
        }
        // Mise à jour du flux
        $rss->update();
        $dao->updateRSS($rss);
        foreach ($rss->nouvelles() as $key) {
                $nvl = new Nouvelles;
                $nvl->update($key);
                $o = $dao->readNouvellefromTitre($nvl->titre(), $rss->id());
                
                if ($o == NULL) {
                    $o = $dao->createNouvelle($nvl, $rss->id());
                }
                $dao->updateImageNouvelle($nvl);
        }
    }
    
    include("../Views/ajouter_flux.view.php");

}

if(isset($_GET['action']) and $_GET['action'] == "Changer mot de passe") {
        if(isset($_GET['user']) && isset($_GET['newMP'])){
            $user = $_GET['user'];
            $newMP = $_GET['newMP'];

            $dao->updateMPfromUser($user, $newMP);
            sendEmailto($user, "MPMODIF");
            $data['users'] = $dao->retriveAllUsers();
            include("../Views/manage_users.view.php");
        }
} else if(isset($_GET['action']) and $_GET['action'] == "Supprimer") {
    $userToRemove = $_GET['user'];
    
    if($userToRemove == "admin") {
        $data['users'] = $dao->retriveAllUsers();
        include("../Views/manage_users.view.php");
        echo "<p>Ahah ! Bien essayé Mr le professeur, mais le compte Administrateur ne peut pas être supprimé ;)</p>";
    } else {
        sendEmailto($userToRemove, "REMOVED");
        $dao->removeFromUser($userToRemove);
        $data['users'] = $dao->retriveAllUsers();
        include("../Views/manage_users.view.php");
        
    }
}