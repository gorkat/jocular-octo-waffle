<?php 

/*
<item>
      <link>http://www.lemonde.fr/m-actu/article/2014/12/07/miss-france-des-clones-et-du-kitsch_4536062_4497186.html</link>
      <title>Miss France : des clones et du kitsch</title>
      <description>Au terme d'une soirée riche en paillettes dorées, Miss Pas-de-Calais a ravi la couronne tant désirée par les 33 participantes. Que retenir d'autre de l'émission ?</description>
      <pubDate>Sun, 07 Dec 2014 01:02:41 GMT</pubDate>
      <guid isPermaLink="true">http://www.lemonde.fr/tiny/4536062/</guid>
      <enclosure url="http://s1.lemde.fr/image/2014/12/07/534x267/4536063_3_154f_miss-nord-pas-de-calais-a-ete-elue-samedi-so_6806a1cccdb51abfe8373ec434be74af.jpg" type="image/jpeg" length="37460"/>
</item>

*/

class Nouvelles {
	private $lien;
	private $titre;
	private $description;
	private $pubDate;
	private $id;
	private $image;

	public lien() { return $this->lien;}
	public titre() { return $this->titre;}
	public description() { return $this->description;}
	public pubDate() { return $this->pubDate;}
	public id() { return $this->id;}
	public image() { return $this->image;}

	public update(DOMElement $item) {

		//màj lien vers article
		$nodeList = $item->getElementByTagName('link');
		$this->lien = $nodeList->item(0)->textContent;

		// màj titre
		$nodeList = $item->getElementByTagName('title');
		$this->titre = $nodeList->item(0)->textContent;
		
		//màj description
		$nodeList = $item->getElementByTagName('description');
		$this->description = $nodeList->item(0)->textContent;
		
		// màj date
		$nodeList = $item->getElementByTagName('pubDate');
		$this->pubDate = $nodeList->item(0)->textContent;

		//màj id item
		$nodeList = $item->getElementByTagName('guid');
		$this->id = $item->item(0)->textContent;

		//màj image

	}
/*
 // On suppose que $node est un objet sur le noeud 'enclosure' d'un flux RSS
      // On tente d'accéder à l'attribut 'url'
      $node = $node->attributes->getNamedItem('url');
      if ($node != NULL) {
        // L'attribut url a été trouvé : on récupère sa valeur, c'est l'URL de l'image
        $url = $node->nodeValue;
        // On construit un nom local pour cette image : on suppose que $nomLocalImage contient un identifiant unique
        $this->image = 'images/'.$nomLocalImage'.'.jpg';
        // On télécharge l'image à l'aide de son URL, et on la copie localement.
        file_put_contents($this->image, file_get_contents($url));
*/
	downloadImage(DOMElement $item, $imageId) {
		$nodeList = $item->getElementByTagName('enclosure');
		$node = $nodeList->item(0);
		$node = $node->attributes->getNamedItem('url');

		if ($node != NULL) {
        // L'attribut url a été trouvé : on récupère sa valeur, c'est l'URL de l'image
        $url = $node->nodeValue;
        // On construit un nom local pour cette image : on suppose que $nomLocalImage contient un identifiant unique
        $this->image = 'data/'.$nomLocalImage.'.jpg';
        // On télécharge l'image à l'aide de son URL, et on la copie localement.
        file_put_contents($this->image, file_get_contents($url));
	}
}

 ?>