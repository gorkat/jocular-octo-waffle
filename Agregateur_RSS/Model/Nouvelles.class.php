<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Nouvelles
 *
 * @author gorkat
 */
class Nouvelles {
    private $url;
    private $titre;
    private $description;
    private $date;
    private $id;
    private $image;

    public function url() { return $this->url;}
    public function titre() { return $this->titre;}
    public function description() { return $this->description;}
    public function date() { return $this->date;}
    public function id() { return $this->id;}
    public function image() { return $this->image;}


    public function update(DOMElement $item) {

            //màj lien vers article
            $nodeList = $item->getElementsByTagName('link');
            $this->url = $nodeList->item(0)->textContent;

            //màj titre
            $nodeList = $item->getElementsByTagName('title');
            $this->titre = $nodeList->item(0)->textContent;

            //màj description
            $nodeList = $item->getElementsByTagName('description');
            $this->description = $nodeList->item(0)->textContent;

            //màj date
            $nodeList = $item->getElementsByTagName('pubDate');
            $this->date = $nodeList->item(0)->textContent;

            //màj id item
            $nodeList = $item->getElementsByTagName('guid');
            $this->id = $nodeList->item(0)->textContent;

            //Téléchargement de l'image et màj
            $nodeList = $item->getElementsByTagName('enclosure');
            $node = $nodeList->item(0);
            if($node != null) {
                $tab1 = explode(' ',$this->titre());    // On découpe le titre pour enlever les espaces
                $titre = implode($tab1);                // On rassemble chaque mot ensemble pour former le nom de l'image
                $titre = str_replace('?','',$titre);    // On retire les caractères pouvant donner des erreurs lors du chargement de l'image
                $titre = str_replace(':','',$titre);
                $titre = str_replace('"','',$titre);
                $titre = str_replace('%','',$titre);
                $titre = str_replace(';','',$titre);
                $titre = str_replace('.','',$titre);
                $titre = str_replace('/','',$titre);
                $titre = rtrim($titre);
                $this->downloadImage($node, $titre);
            } else {
                $this->image = "../Views/Styles/Contents/default.jpeg";
            }

    }

    private function downloadImage(DOMElement $item, $imageId) {

            $node = $item->attributes->getNamedItem('url');

            if ($node != NULL) {
            // L'attribut url a été trouvé : on récupère sa valeur, c'est l'URL de l'image
            $url = $node->nodeValue;
            // On construit un nom local pour cette image : on suppose que $nomLocalImage contient un identifiant unique
            $this->image = '../Data/'.$imageId.'.jpg';
            // On télécharge l'image à l'aide de son URL, et on la copie localement.
            file_put_contents($this->image, file_get_contents($url));
            }
    }
}
