<?php 

class Nouvelles {
	private $lien;
	private $titre;
	private $description;
	private $pubDate;
	private $id;
	private $image;

	public function lien() { return $this->lien;}
	public function titre() { return $this->titre;}
	public function description() { return $this->description;}
	public function pubDate() { return $this->pubDate;}
	public function id() { return $this->id;}
	public function image() { return $this->image;}


	public function update(DOMElement $item) {

		//màj lien vers article
		$nodeList = $item->getElementsByTagName('link');
		$this->lien = $nodeList->item(0)->textContent;

		//màj titre
		$nodeList = $item->getElementsByTagName('title');
		$this->titre = $nodeList->item(0)->textContent;
		
		//màj description
		$nodeList = $item->getElementsByTagName('description');
		$this->description = $nodeList->item(0)->textContent;
		
		//màj date
		$nodeList = $item->getElementsByTagName('pubDate');
		$this->pubDate = $nodeList->item(0)->textContent;

		//màj id item
		$nodeList = $item->getElementsByTagName('guid');
		$this->id = $nodeList->item(0)->textContent;

		//Téléchargement de l'image et màj
		$nodeList = $item->getElementsByTagName('enclosure');
		$node = $nodeList->item(0);

		$this->downloadImage($node, $this->titre);

	}

	private function downloadImage(DOMElement $item, $imageId) {

		$node = $item->attributes->getNamedItem('url');

		if ($node != NULL) {
	        // L'attribut url a été trouvé : on récupère sa valeur, c'est l'URL de l'image
	        $url = $node->nodeValue;
	        // On construit un nom local pour cette image : on suppose que $nomLocalImage contient un identifiant unique
	        $this->image = '../data/'.$imageId.'.jpg';
	        // On télécharge l'image à l'aide de son URL, et on la copie localement.
	        file_put_contents($this->image, file_get_contents($url));
		}
}

}
?>