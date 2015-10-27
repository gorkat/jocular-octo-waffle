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

  //////////////////////////////////////////////////////////
  // Methodes CRUD sur Nouvelle
  //////////////////////////////////////////////////////////

  // Acces à une nouvelle à partir de son titre et l'ID du flux
  public function readNouvellefromTitre($titre,$RSS_id) {
    $sql= $this->db->query('SELECT * FROM nouvelle WHERE RSS_id='.$RSS_id.'AND titre ='.$titre);
    $tab = $sql->fetchAll(PDO::FETCH_CLASS, "Nouvelles");
    if ($tab != NULL) {
      return tab[0];
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
        $q = 'INSERT INTO nouvelle (titre, description, url, image, RSS_id) VALUES ('.$n->titre().','.$n->description().','.$n->lien().','.$n->image().",$RSS_id)";
        $r = $this->db->exec($q);
        if ($r == 0) {
          die("createNouvelle error: no nouvelle inserted\n");
        }
        return $this->readNouvellefromTitre($RSS_id);
      } catch (PDOException $e) {
        die("PDO Error :".$e->getMessage());
      }
    } else {
      // Retourne l'objet existant
      return $rss;
    }
  }

  // Met à jour le champ image de la nouvelle dans la base
  public function updateImageNouvelle(Nouvelles $n) {
    // Met à jour uniquement le titre et la date
    $titre = $this->db->quote($nouvelle->titre());
    $q = "UPDATE nouvelle SET titre=$titre, date='".$nouvelle->date()."' WHERE url='".$nouvelle->url()."'";
    try {
      $r = $this->db->exec($q);
      if ($r == 0) {
        die("updateNouvelle error: no nouvelle updated\n");
      }
    } catch (PDOException $e) {
      die("PDO Error :".$e->getMessage());
    }
  }

}