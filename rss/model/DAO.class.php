<?php 

require_once('RSS.class.php');

class DAO {
  
  private $db; // L'objet de la base de donnée

  // Ouverture de la base de donnée
  public function __construct() {
    $dsn = 'sqlite:./bdd/rss.db'; // Data source name
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
        $q = "INSERT INTO RSS (url) VALUES ('$url')";
        $r = $this->db->exec($q);
        if ($r == 0) {
          die("createRSS error: no rss inserted\n");
        }
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
      if ($sql != false) {
        $tab = $sql->fetchAll(PDO::FETCH_CLASS, "RSS");
      } else {
        $tab = NULL;
      }

      return $tab[0];
  }


  // Met à jour un flux
  public function updateRSS(RSS $rss) {
  // Met à jour uniquement le titre et la date
    $titre = $this->db->quote($rss->titre());
    $q = "UPDATE RSS SET titre=$titre, date='".$rss->date()."' WHERE url='".$rss->url()."'";
    try {
      $r = $this->db->exec($q);
      if ($r == 0) {
        die("updateRSS error: no rss updated\n");
      }
    } catch (PDOException $e) {
      die("PDO Error :".$e->getMessage());
    }
  }

  //////////////////////////////////////////////////////////
  // Methodes CRUD sur Nouvelle
  //////////////////////////////////////////////////////////

  // Acces à une nouvelle à partir de son titre et l'ID du flux
  public function readNouvellefromTitre($titre,$RSS_id) {
    $sql= $this->db->query('SELECT * FROM nouvelle WHERE id="'.$RSS_id.'"');
    if ($sql != false) {
      $tab = $sql->fetchAll(PDO::FETCH_CLASS, "Nouvelles");
    } else {
      $tab = NULL;
    }

    return $tab[0];
  }

  // Crée une nouvelle dans la base à partir d'un objet nouvelle
  // et de l'id du flux auquelle elle appartient
  public function createNouvelle(Nouvelle $n, $RSS_id) {
    $nouvelle = $this->readNouvellefromTitre($RSS_id);
    if ($nouvelle == NULL) {
      try {
        $q = "INSERT INTO nouvelle (id) VALUES ('$RSS_id')";
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
  public function updateImageNouvelle(Nouvelle $n) {
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

//  $rss = new DAO();
//  $r = $rss->createRSS('http://www.lemonde.fr/m-actu/rss_full.xml');
//  $r->update();
//  $rss->updateRSS($r);
//  var_dump($r);

?>