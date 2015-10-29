<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DAO
 *
 * @author gorkat
 */
require_once('RSS.class.php');
require_once('Nouvelles.class.php');

class DAO {
  
  private $db; // L'objet de la base de donnée

  // Ouverture de la base de donnée
  public function __construct() {
    $dsn = 'sqlite:/opt/lampp/htdocs/jocular-octo-waffle/Agregateur_RSS/Model/bdd/rss.db'; // Data source name
    try {
      $this->db = new PDO($dsn);
    } catch (PDOException $e) {
      exit("Erreur ouverture BD : ".$e->getMessage());
    }
    
    
  }

  public function db() { return $this->db; }
  //////////////////////////////////////////////////////////
  // Methodes CRUD sur RSS
  //////////////////////////////////////////////////////////

  // Crée un nouveau flux à partir d'une URL
  // Si le flux existe déjà on ne le crée pas
  public function createRSS($url) {
    $rss = $this->readRSSfromURL($url);
    if ($rss == NULL) {
      try {
//        $url = $this->db->quote($url);
        $q = "INSERT INTO RSS (url) VALUES ('$url')";

        $this->db->exec($q) or die("\ncreateRSS error: no rss inserted\n"); // stop l'éxécution si aucune ligne insérée (si exec == bool(false) ou exec == 0)

        return $this->readRSSfromURL($url);
      } catch (PDOException $e) {
        die("PDO Error :".$e->getMessage());
      }
    } else {
      // Retourne l'objet existant
      return $rss;
    }
  }

  // Acces à un objet RSS à partir de son URL
  public function readRSSfromURL($url) {
      $sql= $this->db->query('SELECT * FROM RSS WHERE URL="'.$url.'"');
      $tab = $sql->fetchAll(PDO::FETCH_CLASS, "RSS");
      if($tab != NULL) {
        return $tab[0];
      } else {
        return NULL;
      }
  }


  // Met à jour un flux
  public function updateRSS(RSS $rss) {
  // Met à jour uniquement le titre et la date
    $titre = $this->db->quote($rss->titre());
    $date = $this->db->quote($rss->date());
    $url = $this->db->quote($rss->url());
    $q = 'UPDATE RSS SET titre='.$titre.', date='.$date.' WHERE url='.$url;
    try {
      $this->db->exec($q) or die("\nupdateRSS error: no rss updated\n");
    } catch (PDOException $e) {
      die("PDO Error :".$e->getMessage());
    }
  }

  public function readAllRSS() {
      $q = ("Select * from RSS");
      $sql = $this->db->query($q);
      $tab = $sql->fetchAll(PDO::FETCH_CLASS, "RSS");
      
      return $tab;
  }
  
  //////////////////////////////////////////////////////////
  // Methodes CRUD sur Nouvelle
  //////////////////////////////////////////////////////////

  public function returnNouvellesFromRSS($RSS_id) {
      $id = $this->db->quote($RSS_id);
      $sql = $this->db->query('Select * from Nouvelles WHERE RSS_id='.$id);
      $tab = $sql->fetchAll(PDO::FETCH_CLASS, "Nouvelles");
      
      return $tab;
  }
  
  // Acces à une nouvelle à partir de son titre et l'ID du flux
  public function readNouvellefromTitre($titre,$RSS_id) {
    $title = $this->db->quote($titre);
    $id = $this->db->quote($RSS_id);
    $sql= $this->db->query('SELECT * FROM Nouvelles WHERE RSS_id='.$id.'AND titre ='.$title);
    $tab = $sql->fetchAll(PDO::FETCH_CLASS, "Nouvelles");
    if ($tab != NULL) {
      return $tab[0];
    } else {
      return NULL;
    }
  }

  // Crée une nouvelle dans la base à partir d'un objet nouvelle
  // et de l'id du flux auquelle elle appartient
  public function createNouvelle(Nouvelles $n, $RSS_id) {
    $nouvelle = $this->readNouvellefromTitre($n->titre(),$RSS_id);
    if ($nouvelle == NULL) {
      try {
        $titre = $this->db->quote($n->titre());
        $desc = $this->db->quote($n->description());
        $lien = $this->db->quote($n->lien());
        $image = $this->db->quote($n->image());
        $RSS_id = $this->db->quote($RSS_id);
        
        $q = "INSERT INTO Nouvelles (titre, description, url, image, RSS_id) VALUES ($titre,$desc,$lien,$image,$RSS_id)";
        $this->db->exec($q) or die("createNouvelle error: no nouvelle inserted\n");
        
        return $this->readNouvellefromTitre($n->titre(),$RSS_id);
      } catch (PDOException $e) {
        die("PDO Error :".$e->getMessage());
      }
    } else {
      // Retourne l'objet existant
      return $nouvelle;
    }
  }

  // Met à jour le champ image de la nouvelle dans la base
  public function updateImageNouvelle(Nouvelles $n) {
    // Met à jour uniquement le titre et la date
    $titre = $this->db->quote($n->titre());
    $q = "UPDATE Nouvelles SET titre=$titre, date='".$n->date()."' WHERE url='".$n->lien()."'";
    try {
      $r = $this->db->exec($q);
      if ($r == 0) {
        die("updateNouvelle error: no nouvelle updated\n");
      }
    } catch (PDOException $e) {
      die("PDO Error :".$e->getMessage());
    }
  }

  //////////////////////////////////////////////////////////
  // Methodes CRUD sur Utilisateurs
  //////////////////////////////////////////////////////////
  
  
  public function readUserfromLoginAndPassWord($login, $password) {
      //Vérifie si le mot de passe et le login correspondent à un tuple dans la base de données
      // Renvoie Vrai si oui
      // Renvoie Faux sinon
      $user = $this->db->quote($login);
      $mp = $this->db->quote($password);
      $q = ("Select login, mp FROM utilisateur WHERE login =$user and mp=$mp");
      
      $sql = $this->db->query($q);
      $res = $sql->fetchAll();
      if($res == NULL) {
          return false;
      } else {
          return true;
      }
  }
  
  public function createNewUser($login, $password) {
      $loginIsAlreadyTaken = $this->readUserfromLogin($login);
      
      if(!$loginIsAlreadyTaken) {

            $user = $this->db->quote($login);
            $mp = $this->db->quote($password);
            $q = ("Insert into utilisateur(login,mp) values ($user,$mp)");

            try {
              $this->db->exec($q) or die("\ncreateNewUser error: no user inserted\n");
            } catch (PDOException $e) {
                die("PDO Error :".$e->getMessage());
            }
            return true;
      } else { 
            return false;
      }
  }
  
  public function readUserfromLogin($login) {
      $user = $this->db->quote($login);
      $q = ("Select * FROM utilisateur WHERE login=$user");
      $sql = $this->db->query($q);
      $res = $sql->fetchall();
      
      if($res == NULL) {        // le login n'est pas déjà attribué
          return false;
      } else {
          return true;
      }
  }
}