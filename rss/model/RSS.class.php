<?php        
class RSS {
  private $titre; // Titre du flux
  private $url;   // Chemin URL pour télécharger un nouvel état du flux
  private $date;  // Date du dernier téléchargement du flux
  private $nouvelles; // Liste des nouvelles du flux

  // Contructeur
  function __construct($url) {
    $this->url = $url;
  }

  // Fonctions getter
  function titre() {
    return $this->titre;
  }
  
  function url() {
    return $this->url;
  }

  function date() {
    return $this->date;
  }

  function nouvelles() {
    return $this->nouvelles;
  }



  // Récupère un flux à partir de son URL
  function update() {
    // Cree un objet pour accueillir le contenu du RSS : un document XML
    $doc = new DOMDocument;

    //Telecharge le fichier XML dans $rss
    $doc->load($this->url);

    // Recupère la liste (DOMNodeList) de tous les elements de l'arbre 'title'
    $nodeList = $doc->getElementsByTagName('title');

    // Met à jour le titre dans l'objet
    $this->titre = $nodeList->item(0)->textContent;
    
    // Mise à jour de la date avec celle de la dernière màj du flux
    $date = date_default_timezone_set('Europe/Paris');
    $this->date = date("H:i:s d/j/Y");


    // Récupère et stocke tout les items dans l'attribut nouvelles.
    $this->nouvelles = $doc->getElementsByTagName('item');

  }
    
}
?>